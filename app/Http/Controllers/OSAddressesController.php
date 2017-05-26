<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\OSAddress;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OSAddressesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     // $osAddresses = OSAddress::orderBy('created_at', 'desc')->get();
    //     // $osAddresses = OSAddress::get();
    //     $osAddresses = OSAddress::where('postcode', "M7 3GJ")->get();
    //     // $osAddresses = OSAddress::findByPostcode("M7 3PJ");
    //     // $osAddresses = (new OSAddress)->findByPostcode("M7 3PJ");
    //     return view('os-addresses.index', compact('osAddresses'));
    // }

    public function postcode(Request $request) {
        $postcode = $request->input('postcode');
        // $osAddresses = OSAddress::where('postcode', $postcode)->get()->sortBy('buildingNumber');
        $osAddresses = OSAddress::has('building')->has('height')->where('postcode', $postcode)->get()->sortBy('buildingNumber');


        if (!count($osAddresses)) {
            // dd(!count($osAddresses));
            Session::flash('noAddressesFound', true);

            return view('home');
        }

        return view('os-addresses.postcode', compact('osAddresses'));
    }

    public function building($osID) {
        $osAddress = OSAddress::where('osTopoTOID', $osID)->first();

        $windowTypes = config('protoolDefaults.windowTypes');
        $doorTypes = config('protoolDefaults.windowTypes');
        $protoolDefaults = config('protoolDefaults');

        return view('form', compact('osAddress', 'windowTypes', 'doorTypes', 'protoolDefaults'));
    }

    public function results($osID, Request $request) {

        $osAddress = OSAddress::where('osTopoTOID', $osID)->first();

        $protoolDefaults = config('protoolDefaults');
        $ageBasedAssumptions = config('ageBasedAssumptions');

        $request->flash();

        // Validation
        $validation_array = [
            // 'title' => 'required|unique:posts|max:255',
            'build-storeys' => 'required',
            'wall-material' => 'required',
            //'floor-insulation' => 'required',
            //'loft-insulation' => 'required',
            'home-draughts' => 'required',
            'home-heating' => 'required',
            'window-type' => 'required',
                // 'door-type' => 'required'
        ];

        echo('flat: ');
        var_dump($request["flat-or-apartment"]);
        echo('<br />below: ');
        var_dump($request["flat-or-apartment-below"]);
        echo('<br />above: ');
        var_dump($request["flat-or-apartment-above"]);

        if (is_null($request["flat-or-apartment"])) {
            $validation_array['floor-insulation'] = 'required';
            $validation_array['loft-insulation'] = 'required';
        } else {
            if ($request['flat-or-apartment-below'] != "true") {
                $validation_array['floor-insulation'] = 'required';
                echo('<br /> I am in');
            }
            if ($request['flat-or-apartment-above'] != 'true') {
                $validation_array['loft-insulation'] = 'required';
            }
        }
        $this->validate($request, $validation_array);

        // if user has modified the floor area, use that, else use the OS data.
        $selectedFloorArea = ($request["floor-area-user-modified"] != null ) ? str_replace(',', '', $request["floor-area-user-modified"]) : $request["floor-area"];

        $selectedBuildDate = $request["build-date"];


        // insert age-based assumptions if necessary
        $selectedWindowType = $request["window-type"] == "unknown" ? $ageBasedAssumptions["windowTypes"][$selectedBuildDate] : $request["window-type"];
        $selectedWallMaterial = $request["wall-material"] == "unknown" ? $ageBasedAssumptions["wallTypes"][$selectedBuildDate] : $request["wall-material"];
        $selectedDraughtyness = $request["home-draughts"] == "unknown" ? $ageBasedAssumptions["ventilation"][$selectedBuildDate] : $request["home-draughts"];
        $selectedLoftInsulation = $request["loft-insulation"] == "unknown" ? $ageBasedAssumptions["loftInsulation"][$selectedBuildDate] : $request["loft-insulation"];
        $selectedFloorInsulationType = $request["floor-insulation"] == "unknown" ? $ageBasedAssumptions["floorInsulationTypes"][$selectedBuildDate] : $request["floor-insulation"];
        $selectedHeating = $request["home-heating"] == "unknown" ? $ageBasedAssumptions["spaceHeatingSystemsPrimary"][$selectedBuildDate] : $request["home-heating"];

        $selectedOptionTitles = [
            "window-type" => config('protoolDefaults.windowTypes')[$selectedWindowType]["title"],
            "wall-material" => config('protoolDefaults.wallTypes')[$selectedWallMaterial]["title"],
            "home-draughts" => config('protoolDefaults.ventilation')["airPermeabilityValues"][$selectedDraughtyness]["title"],
            "loft-insulation" => config('protoolDefaults.loftInsulation')[$selectedLoftInsulation]["title"],
            "floor-insulation" => config('protoolDefaults.floorInsulationTypes')[$selectedFloorInsulationType]["title"],
            "home-heating" => config('protoolDefaults.spaceHeatingSystemsPrimary')[$selectedHeating]["title"]
        ];


        // $selectedDoorType = $request["door-type"];
        // $selectedFloorInsulationType = $request["floor-insulation"];
        // $selectedWallMaterial = $request["wall-material"];
        // $selectedDraughtyness = $request["home-draughts"];
        // $selectedLoftInsulation = $request["loft-insulation"];
        // $selectedHeating = $request["home-heating"];
        $selectedSolarPanels = $request["home-solar"];
        $selectedSolarPanelsRating = $request["home-solar-rating"];
        $selectedARatedApplicances = $request["appliance-rated"];
        $selectedRoomInRoof = $request["loft-conversion"];
        $selectedApartment = $request["flat-or-apartment"];
        $selectedAnotherHeatingSource = $request["another-heating-source"];
        $selectedHomeHeatingSecondary = $request["home-heating-extra-1"];


        $resultsData = [];



        // $selectedFloorArea = 100;



        $floors = [];
        // $floors is a reference to all the floors to calculate total floor area
        // Number of floors
        for ($i = 0; $i < $request["build-storeys"]; $i++) {
            if ($selectedRoomInRoof === "true" && ($i == $request["build-storeys"] - 1)) {
                // if there is an attic/room in roof, the floor area of this level is estimated
                // to be 60% of floor area. NB For the fabric/heat loss floor calculation, the
                // floor area is still assumed to be that of the floor below. 
                $area = $selectedFloorArea * 0.6;
            } else {
                $area = $selectedFloorArea;
            }
            array_push($floors, [
                'area' => (float) $area,
                'height' => 2.7,
            ]);
        }
        $resultsData["floors"] = $floors;


        $floorElements = [];
        // $floorElements is used in the fabric calculations, and must only refer to the one touching the ground - if the building is an apartment with another property below it should not have a floor element.
        if ($request['flat-or-apartment'] != 'true' || $request['flat-or-apartment-below'] != "true") {
            array_push($floorElements, [
                "name" => '',
                "type" => 'floor',
                "area" => (float) $selectedFloorArea,
                "h" => 2.7,
                "l" => 0,
                "uvalue" => config('protoolDefaults.floorInsulationTypes')[$selectedFloorInsulationType]["uvalue"]
            ]);
        }


        // Roofs
        // If the building is an apartment with a property above, don't add a roof
        $roofs = [];
        if ($request['flat-or-apartment'] != 'true' || $request['flat-or-apartment-above'] != "true") {
            array_push($roofs, [
                "type" => 'roof',
                "area" => (float) $selectedFloorArea,
                "uvalue" => config('protoolDefaults.loftInsulation')[$selectedLoftInsulation]["uvalue"]
            ]);
        }



        // Window orientation codes
        // 0 North
        // 1 NE/NW
        // 2 East/West
        // 3 SE/SW
        // 4 South
        // Overshading codes, we are assuming average overshading
        // 0 Heavy, 80%
        // 1 More than average > 60%-80%
        // 2 Average or unknown 20-60%
        // 3 Very little < 20% 


        $windows = [];
        // $selectedWindowTypeTitle = config('protoolDefaults.windowTypes')[$selectedWindowType]["title"];
        if ($request["windows-north"] > 0) {
            for ($i = 0; $i < $request["windows-north"]; $i++) {
                $dataElement = config('protoolDefaults.windowTypes')[$selectedWindowType];
                $dataElement["orientation"] = 0;
                $dataElement["subtractfrom"] = 0;
                $dataElement["type"] = "window";
                array_push($windows, $dataElement);
            }
        }

        if ($request["windows-south"] > 0) {
            for ($i = 0; $i < $request["windows-south"]; $i++) {
                $dataElement = config('protoolDefaults.windowTypes')[$selectedWindowType];
                $dataElement["orientation"] = 4;
                $dataElement["subtractfrom"] = 0;
                $dataElement["type"] = "window";
                array_push($windows, $dataElement);
            }
        }

        if ($request["windows-east-west"] > 0) {
            for ($i = 0; $i < $request["windows-east-west"]; $i++) {
                $dataElement = config('protoolDefaults.windowTypes')[$selectedWindowType];
                $dataElement["orientation"] = 2;
                $dataElement["subtractfrom"] = 0;
                $dataElement["type"] = "window";
                array_push($windows, $dataElement);
            }
        }
        // $resultsData["windows"] = $windows;


        $doors = [];
        if ($selectedApartment == true) {
            $dataElement = config('protoolDefaults.doorTypes')['apartment'];
            $dataElement["orientation"] = 0;
            $dataElement["subtractfrom"] = 0;
            $dataElement["type"] = "door";
            array_push($doors, $dataElement);
        } else {
            for ($i = 0; $i < 2; $i++) {
                $dataElement = config('protoolDefaults.doorTypes')['house'];
                $dataElement["orientation"] = 0;
                $dataElement["subtractfrom"] = 0;
                $dataElement["type"] = "door";
                array_push($doors, $dataElement);
            }
        }


        // All the property's walls are combined into a single wall with id=0 from which all windows and doors are subtracted 

        if ($selectedRoomInRoof === "true") {
            $wallHeatLossArea = $request["external-perimeter"] * 2.7 * ($request["build-storeys"] - 1) + (11 * sqrt($request["external-perimeter"] / 1.5));
        } else {
            $wallHeatLossArea = $request["external-perimeter"] * 2.7 * $request["build-storeys"];
        }

        $walls = [];
        $dataElement = [
            "id" => 0,
            "name" => '',
            "area" => $wallHeatLossArea,
            "h" => 0, // should this be 2.7 or...?
            "l" => 0, // 
            "uvalue" => config('protoolDefaults.wallTypes')[$selectedWallMaterial]["uvalue"],
            "type" => "wall"
        ];
        array_push($walls, $dataElement);

        // $resultsData["elements"] = array_merge($walls, $floors, $windows, $doors);
        $resultsData["elements"] = array_merge($walls, $floorElements, $windows, $roofs);

        $resultsData["airPermeabilityValue"] = config('protoolDefaults.ventilation.airPermeabilityValues')[$selectedDraughtyness];

        $resultsData["LACLighting"] = [
            "totalLightFittings" => $request["total-light-fittings"],
            "lowEnergyLightFittings" => $request["low-energy-light-fittings"]
        ];

        $resultsData["LAC"] = [
            "ARatedAppliances" => $selectedARatedApplicances
        ];

        $resultsData["bills"] = [
            "electricity" => str_replace(',', '', $request["electricity-usage"]),
            "gas" => str_replace(',', '', $request["gas-usage"]),
        ];

        $resultsData["preferences"] = [
            intval($request["preference-cost"]) => "cost",
            intval($request["preference-comfort"]) => "comfort",
            intval($request["preference-carbon"]) => "carbon"
        ];

        ksort($resultsData["preferences"]);


        $resultsData["spaceHeating"] = [];

        // add primary heating
        array_push($resultsData["spaceHeating"], config('protoolDefaults.spaceHeatingSystemsPrimary')[$selectedHeating]);



        // add secondary heating if necessary
        if ($selectedAnotherHeatingSource === "true") {
            array_push($resultsData["spaceHeating"], config('protoolDefaults.spaceHeatingSystemsSecondary')[$selectedHomeHeatingSecondary]);
            $resultsData["spaceHeating"][0]["fraction"] = 0.9;
            $resultsData["spaceHeating"][1]["fraction"] = 0.1;
        } else {
            $resultsData["spaceHeating"][0]["fraction"] = 1;
        }


        if ($selectedSolarPanels === "true") {
            $resultsData["solarPanels"] = $selectedSolarPanelsRating;
        } else {
            $resultsData["solarPanels"] = 0;
        }



        return view('results', compact('osAddress', 'resultsData', 'protoolDefaults', 'request', 'selectedOptionTitles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
