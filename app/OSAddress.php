<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;


class OSAddress extends Model
{
    protected $table = 'os_addresses';

    public function building()
    {
        return $this->hasOne('App\OSBuilding', 'fid', 'osTopoTOID');
    }

    public function height()
    {
        return $this->hasOne('App\OSHeight', 'OS_TOPO_TOID', 'osTopoTOID');
    }

    public function externalPerimeter(){
        return $this->externalToInternal($this->building->ext_peri);
    }

    public function singleFloorArea(){
        return $this->externalToInternal($this->building->calculated); 
    }

    public function humanReadableAddress()
    {
        $addressArray = [];
        if ($this->subBuildingName != ""){
            array_push($addressArray, $this->subBuildingName);
        }
        if ($this->buildingName != ""){
            array_push($addressArray, $this->buildingName);
        }
        if ($this->buildingNumber != ""){
            array_push($addressArray, $this->buildingNumber);
        }
        if ($this->streetDescription != ""){
            array_push($addressArray, $this->streetDescription);
        }
        if ($this->townName != ""){
            array_push($addressArray, $this->townName);
        }

        return ucWords(strtolower(implode(", ", $addressArray)));
    }

    public function externalToInternal($externalMeasurement){
        return $externalMeasurement * 0.95;
    }

    // public function findByPostcode($postcode)
    // {
    	
    // 	// return DB::table('os_addresses')->where('postcode', '=', $postcode)->get();
    // 	// return DB::select('SELECT * FROM os_addresses WHERE REPLACE(postcode, " ", "") = REPLACE(?, " ","")', [$postcode]);
    // }
}
