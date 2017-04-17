@extends('layouts.master')

@section('title', 'Protool Integration')

<script>

	var dataIn = {
	    "scenario_name": "My Home Energy",
	    "household": {},
	    "region": 0, // From OS Data
	    "altitude": 0, // From BHA Data
	    "use_custom_occupancy": false, // this means the SAP average based on floor area will be used
	    "custom_occupancy": 1, // NA
	    "floors": [
	        {
	            "name": "", // Eg ground floor
	            "area": 100, // For testing, say 100
	            // "area": 0, // From os Data
	            "height": 2.7, // For testing, say 2.7
	            // "height": 0 // FROM BHA Data, can assume 2.7 if not possible
	        } // add extra floors here depending on user input
	    ],
	    "fabric": {
	        "thermal_bridging_yvalue": 0.15, // thermal bridging kept at 0.15. If user chooses "external wall insulation", reduce to 0.08.
	        "global_TMP": 1, // This indicates the "Use global TMP value" has been checked
	        "global_TMP_value": 250, // This is the Medium TMP value
	        "elements": [
	            { //Example of a wall
	                "type": "wall",
	                "name": "Main house west gable",
	                "l": 0,
	                "h": 0,
	                "area": 46.7,
	                "uvalue": 2.1,
	                "id": 0
	            },
	            { //Example of a floor
	                "type": "floor",
	                "name": "Ground floor - suspended original house",
	                "l": 0,
	                "h": 0,
	                "area": 39.1,
	                "uvalue": 0.7, //can be 0.7 (No insulation), 0.15 (200mm), 0.25 (100mm) need U Values for 50mm
	                "id": 8
	            },
	            // {  Example of a roof
	            //     "type": "roof",
	            //     "name": "Attic",
	            //     "l": 0,
	            //     "h": 0,
	            //     "area": 30.8,
	            //     "uvalue": 0.25,
	            //     "id": 11
	            // },
	            { //Example of a window - this has already been added to Laravel
	                "type": "window",
	                "name": "Window 4",
	                "subtractfrom": 0,
	                "l": 6,
	                "h": 6,
	                // "area": 0.64965,
	                "area": 36,
	                "uvalue": 4.8,
	                "id": 13,
	                "description": "Single glazed",
	                "orientation": 4,
	                "overshading": 2,
	                "g": 0.76,
	                "gL": 0.8,
	                "ff": 0.7
	            },
	        ],
	        "measures": {}
	    },
	    "ventilation": {
	        "number_of_chimneys": 0,
	        "number_of_openflues": 0,
	        "number_of_intermittentfans": 2.5, // 2 for properties < 100sqm, 3 for properties > 100sqm
	        "number_of_passivevents": 0,
	        "number_of_fluelessgasfires": 0,
	        "air_permeability_test": 1, //this means the properties below (suspended wooden floor, draught lobby etc can be ignored)
	        "air_permeability_value": 0, // 15: very draughty, 10: DIY draughtproofing, 5: professional air-tightness, 1.5: extreme air tightness
	        "dwelling_construction": "timberframe",
	        "suspended_wooden_floor": 0,
	        "draught_lobby": false,
	        "percentage_draught_proofed": 0,
	        "number_of_sides_sheltered": 0,
	        "ventilation_type": "d", // d means natural ventilation
	        "system_air_change_rate": 0.5,
	        "balanced_heat_recovery_efficiency": 65
	    },
	    "LAC": {
	        "use_SAP_lighting": 1,
	        "use_SAP_appliances": 1, // leave at 1 if answered yes to "Are most of your appliance rated A+ or better"
	        "use_SAP_cooking": 1,
	        "LLE": 100, // number of low energy light fittings
	        "L": 100, // total number of light fittings
	        "energy_efficient_appliances": false,
	        "energy_efficient_cooking": false,
	        "reduced_heat_gains_lighting": 1
	    },
	    "generation": {
	        "solar_annual_kwh": 0,
	        "solar_fraction_used_onsite": 0.5,
	        "solar_FIT": 0,
	        "wind_annual_kwh": 0,
	        "wind_fraction_used_onsite": 0.5,
	        "wind_FIT": 0,
	        "hydro_annual_kwh": 0,
	        "hydro_fraction_used_onsite": 0.5,
	        "hydro_FIT": 0,
	        "solarpv_orientation": 3, // ????? Doesn't look like any solar questions on form
	        "solarpv_kwp_installed": 0,
	        "solarpv_inclination": 35,
	        "solarpv_overshading": 0.8,
	        "solarpv_fraction_used_onsite": 0.5,
	        "solarpv_FIT": 0,
	        "solarpv_annual_kwh": 0,
	        "total_energy_income": 0
	    },
	    "currentenergy": {
	        "energyitems": {
	            "electric": {
	                "name": "Electricity",
	                "note": "",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 3.07,
	                "unitcost": 0.1319,
	                "standingcharge": 54,
	                "selected": 0,
	                "group": "Electric",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 54
	            },
	            "electric-heating": {
	                "name": "Electricity for direct heating",
	                "note": "e.g: Storage Heaters",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 3.07,
	                "unitcost": 0.1319,
	                "standingcharge": 54,
	                "selected": 0,
	                "group": "Electric",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 54
	            },
	            "electric-heatpump": {
	                "name": "Electricity for heatpump",
	                "note": "annual electricity input to the heatpump",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 3.07,
	                "unitcost": 0.1319,
	                "standingcharge": 54,
	                "selected": 0,
	                "group": "Electric",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 54
	            },
	            "electric-waterheating": {
	                "name": "Electricity for water heating",
	                "note": "",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 3.07,
	                "unitcost": 0.1319,
	                "standingcharge": 54,
	                "selected": 0,
	                "group": "Electric",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 54
	            },
	            "electric-car": {
	                "name": "Electric car",
	                "note": "",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 3.07,
	                "unitcost": 0.1319,
	                "standingcharge": 54,
	                "selected": 0,
	                "group": "Electric",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 54
	            },
	            "electric-e7": {
	                "name": "Electricity (Economy 7)",
	                "note": "",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 2.4,
	                "unitcost": 0.1529,
	                "standingcharge": 78,
	                "selected": 0,
	                "group": "Economy 7",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 78
	            },
	            "electric-heating-e7": {
	                "name": "Electricity for direct heating (Economy 7)",
	                "note": "e.g: Storage Heaters",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 2.4,
	                "unitcost": 0.1529,
	                "standingcharge": 78,
	                "selected": 0,
	                "group": "Economy 7",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 78
	            },
	            "electric-heatpump-e7": {
	                "name": "Electricity for heatpump (Economy 7)",
	                "note": "annual electricity input to the heatpump",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 2.4,
	                "unitcost": 0.1529,
	                "standingcharge": 78,
	                "selected": 0,
	                "group": "Economy 7",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 78
	            },
	            "electric-waterheating-e7": {
	                "name": "Electricity for water heating (Economy 7)",
	                "note": "",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 2.4,
	                "unitcost": 0.1529,
	                "standingcharge": 78,
	                "selected": 0,
	                "group": "Economy 7",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 78
	            },
	            "electric-car-e7": {
	                "name": "Electric car (Economy 7)",
	                "note": "",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.519,
	                "primaryenergy": 2.4,
	                "unitcost": 0.1529,
	                "standingcharge": 78,
	                "selected": 0,
	                "group": "Economy 7",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 78
	            },
	            "gas": {
	                "name": "Mains gas",
	                "note": "",
	                "quantity": 0,
	                "units": "m3",
	                "kwh": 9.8,
	                "co2": 2.1168,
	                "primaryenergy": 1.22,
	                "unitcost": 0.34104,
	                "standingcharge": 120,
	                "selected": 0,
	                "group": "Heating (non-electric)",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 120
	            },
	            "gas-kwh": {
	                "name": "Mains gas in kWh",
	                "note": "",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 1,
	                "co2": 0.216,
	                "primaryenergy": 1.22,
	                "unitcost": 0.0348,
	                "standingcharge": 120,
	                "selected": 0,
	                "group": "Heating (non-electric)",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 120
	            },
	            "wood-logs": {
	                "name": "Wood Logs",
	                "note": "",
	                "quantity": 0,
	                "units": "m3",
	                "kwh": 1380,
	                "co2": 26.22,
	                "primaryenergy": 1.04,
	                "unitcost": 58.374,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Heating (non-electric)",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "wood-pellets": {
	                "name": "Wood Pellets",
	                "note": "In bags",
	                "quantity": 0,
	                "units": "m3",
	                "kwh": 4800,
	                "co2": 187.2,
	                "primaryenergy": 1.26,
	                "unitcost": 278.88,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Heating (non-electric)",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "oil": {
	                "name": "Oil",
	                "note": "",
	                "quantity": 0,
	                "units": "L",
	                "kwh": 10.27,
	                "co2": 3.06,
	                "primaryenergy": 1.1,
	                "unitcost": 0.5587,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Heating (non-electric)",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "lpg": {
	                "name": "LPG",
	                "note": "",
	                "quantity": 0,
	                "units": "kWh",
	                "kwh": 11,
	                "co2": 2.651,
	                "primaryenergy": 1.09,
	                "unitcost": 0.836,
	                "standingcharge": 70,
	                "selected": 0,
	                "group": "Heating (non-electric)",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 70
	            },
	            "bottledgas": {
	                "name": "Bottled gas",
	                "note": "",
	                "quantity": 0,
	                "units": "kg",
	                "kwh": 13.9,
	                "co2": 3.35,
	                "primaryenergy": 1.09,
	                "unitcost": 1.4317,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Heating (non-electric)",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "car1": {
	                "name": "Car 1",
	                "note": "",
	                "quantity": 0,
	                "units": "miles",
	                "mpg": 35,
	                "kwh": 43.65,
	                "co2": 10.395,
	                "primaryenergy": 1.1,
	                "unitcost": 0,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Transport",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "car2": {
	                "name": "Car 2",
	                "note": "",
	                "quantity": 0,
	                "units": "miles",
	                "mpg": 35,
	                "kwh": 43.65,
	                "co2": 10.395,
	                "primaryenergy": 1.1,
	                "unitcost": 0,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Transport",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "car3": {
	                "name": "Car 3",
	                "note": "",
	                "quantity": 0,
	                "units": "miles",
	                "mpg": 35,
	                "kwh": 43.65,
	                "co2": 10.395,
	                "primaryenergy": 1.1,
	                "unitcost": 0,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Transport",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "motorbike": {
	                "name": "Motorbike",
	                "note": "",
	                "quantity": 0,
	                "units": "miles",
	                "mpg": 35,
	                "kwh": 43.65,
	                "co2": 10.395,
	                "primaryenergy": 1.1,
	                "unitcost": 0,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Transport",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "bus": {
	                "name": "Bus",
	                "note": "",
	                "quantity": 0,
	                "units": "miles",
	                "kwh": 0.53,
	                "co2": 0.176,
	                "primaryenergy": 1.1,
	                "unitcost": 0,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Transport",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "train": {
	                "name": "Train",
	                "note": "",
	                "quantity": 0,
	                "units": "miles",
	                "kwh": 0.096,
	                "co2": 0.096,
	                "primaryenergy": 1.1,
	                "unitcost": 0,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Transport",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "boat": {
	                "name": "Boat",
	                "note": "",
	                "quantity": 0,
	                "units": "miles",
	                "kwh": 1,
	                "co2": 0.192,
	                "primaryenergy": 1.1,
	                "unitcost": 0,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Transport",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            },
	            "plane": {
	                "name": "Plane",
	                "note": "",
	                "quantity": 0,
	                "units": "miles",
	                "kwh": 0.69,
	                "co2": 0.43,
	                "primaryenergy": 1.1,
	                "unitcost": 0,
	                "standingcharge": 0,
	                "selected": 0,
	                "group": "Transport",
	                "annual_kwh": 0,
	                "kwhd": 0,
	                "annual_co2": 0,
	                "annual_cost": 0
	            }
	        }
	    },
	    "water_heating": {
	        "low_water_use_design": 1, // this checkbox should always be checked
	        "instantaneous_hotwater": 0,
	        "solar_water_heating": false,
	        "pipework_insulated_fraction": 1,
	        "manufacturer_loss_factor": 0,
	        "storage_volume": 150, // if this exists, assume volume 150. Q7/8?????
	        "temperature_factor_a": 0,
	        "loss_factor_b": 0,
	        "volume_factor_b": 0,
	        "temperature_factor_b": 0,
	        //hot_water_store_in_dwelling:, dependent on question answer Q7/8?????
	        "hot_water_control_type": "cylinder_thermostat_without_timer",
	        "annual_energy_content": 911.7791502172221 // not really sure what this is - it doesn't seem to have much effect??
	    },
	    "SHW": {},
	    "appliancelist": {
	        "list": [
	            {
	                "name": "LED Light",
	                "power": 6,
	                "hours": 12
	            }
	        ]
	    },
	    "applianceCarbonCoop": {
	        "list": []
	    },
	    "temperature": {
	        "responsiveness": 1, // options from Q8b ?????
	        "target": 21, // keep at 21
	        "control_type": 1,
	        "living_area": 20 // living area set at 20
	    },
	    "space_heating": {
	        "use_utilfactor_forgains": true
	    },
	    "energy_systems": {
	        "cooking": [
	            {
	                "system": "electric",
	                "fraction": 1,
	                "efficiency": 1,
	                "name": "Standard Electric",
	                "summer": 1,
	                "winter": 1,
	                "fuel": "electric",
	                "id": 1,
	                "fans_and_pumps": 0,
	                "combi_keep_hot": 0
	            }
	        ],
	        "waterheating": []
	    },
	    "fuels": {
	        "oil": {
	            "fuelcost": 0.051,
	            "standingcharge": 0,
	            "co2factor": 0.298,
	            "primaryenergyfactor": 1.1
	        },
	        "gas": {
	            "fuelcost": 0.043,
	            "standingcharge": 0,
	            "co2factor": 0.216,
	            "primaryenergyfactor": 1.22
	        },
	        "wood": {
	            "fuelcost": 0,
	            "standingcharge": 0,
	            "co2factor": 0.019,
	            "primaryenergyfactor": 1.04
	        },
	        "electric": {
	            "fuelcost": 0.145,
	            "standingcharge": 0,
	            "co2factor": 0.519,
	            "primaryenergyfactor": 3.07
	        },
	        "greenelectric": {
	            "fuelcost": 0.145,
	            "standingcharge": 0,
	            "co2factor": 0.02,
	            "primaryenergyfactor": 1.5
	        },
	        "electric-high": {
	            "fuelcost": 0.155,
	            "standingcharge": 0,
	            "co2factor": 0.519,
	            "primaryenergyfactor": 3.07
	        },
	        "electric-low": {
	            "fuelcost": 0.07,
	            "standingcharge": 0,
	            "co2factor": 0.519,
	            "primaryenergyfactor": 3.07
	        }
	    },
	    "measures": {
	        "energy_systems": {}
	    }
	}

// run calculation
// calc.run(dataIn);
</script>