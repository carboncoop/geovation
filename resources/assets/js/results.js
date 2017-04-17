/*

	Testing getting the variables out of the url on the results page.

	Need to handle and group the fuel-type-usage and fuel-type fields.
	Need to group the heating-extra fields.

	All the possible fields:

	another-heating-source: "true"
	appliance-rated: "true"
	build-date: "1930-1949"
	build-storeys: "4"
	door-type: "#"
	flat-or-apartment: "true"
	flat-or-apartment-above: "true"
	flat-or-apartment-below: "true"
	floor-insulation: "none"
	fuel-type-1: "gas fire"
	fuel-type-2: "gas fire"
	fuel-type-3: "electric fire"
	(etc...)
	fuel-type-usage-1: "4444"
	fuel-type-usage-2: "5555"
	fuel-type-usage-3: "6666"
	(etc...)
	heating-system-boiler-thermostat: "true"
	heating-system-programmer: "true"
	heating-system-timer: "true"
	heating-system-trv: "true"
	heating-system-zoning: "true"
	home-draughts: "quite draughty"
	home-heating: "Radiators and very Old Gas Boiler (>10 years old)"
	home-heating-extra-1: "gas fire"
	home-heating-extra-2: "electric fire"
	home-heating-extra-3: "room wood burner"
	(etc...)
	home-solar: "true"
	loft-conversion: "true"
	loft-conversion-date: "1967-1982 (50mm insulation)"
	loft-insulation: "50mm of insulation"
	low-energy-light-fittings: "2"
	preference-carbon: "3"
	preference-comfort: "2"
	preference-cost: "1"
	total-light-fittings: "2"
	wall-material: "masonry cavity with insulation fill"
	window-type: "double glazed - older and poor performance"
	windows-east-west: "1"
	windows-north: "4"
	windows-south: "2"

	I've proposed a structure to work with, if there are any missing data fields from the form they will
	default to null so we know when to replace them with the default data provided by carbon coop.

	If the getURLParameter() has 'false', it's just changing what the fallback (null) is if there is no data.
	False seemed slightly better for checkboxes than null.

*/

var structuredVars = {
	basicData: {
		'build-date': getURLParameter('build-date'),
		'build-storeys': getURLParameter('build-storeys'),
		'loft-conversion': getURLParameter('loft-conversion','false'),
		'loft-conversion-date': getURLParameter('loft-conversion-date'),
		'flat-or-apartment': getURLParameter('flat-or-apartment','false'),
		'flat-or-apartment-below': getURLParameter('flat-or-apartment-below','false'),
		'flat-or-apartment-above': getURLParameter('flat-or-apartment-above','false')
	},
	fabricAndConstruction: {
		'wall-material': getURLParameter('wall-material'),
		'windows': {
			'north': getURLParameter('windows-north'),
			'south': getURLParameter('windows-south'),
			'east-west': getURLParameter('windows-east-west')
		},
		'window-type': getURLParameter('window-type'),
		'door-type': getURLParameter('door-type'),
		'loft-insulation': getURLParameter('loft-insulation'),
		'floor-insulation': getURLParameter('floor-insulation'),
		'home-draughts': getURLParameter('home-draughts')
	},
	services: {
		'home-heating': getURLParameter('home-heating'),
		'another-heating-source': getURLParameter('another-heating-source','false'),
		'home-heating-extra': {
			'home-heating-extra-1': getURLParameter('home-heating-extra-1'),
			// And the rest somehow ?
		},
		'heating-controls': {
			'boiler-thermostat': getURLParameter('heating-control-boiler-thermostat','false'),
			'programmer': getURLParameter('heating-control-programmer','false'),
			'timer': getURLParameter('heating-control-timer','false'),
			'trv': getURLParameter('heating-control-trv','false'),
			'zoning': getURLParameter('heating-control-zoning','false')
		},
		'lights': {
			'total': getURLParameter('total-light-fittings'),
			'low-energy': getURLParameter('low-energy-light-fittings')
		},
		'appliances-rated': getURLParameter('appliances-rated', 'false'),
		'solar': getURLParameter('home-solar')
	},
	currentEnergyUse: {
		'fuel-type-1': {
			'type': getURLParameter('fuel-type-1'),
			'usage': getURLParameter('fuel-type-usage-1')
		}
		// And the rest somehow ?
	},
	priorities: {
		'carbon': getURLParameter('preference-carbon'),
		'comfort': getURLParameter('preference-comfort'),
		'cost': getURLParameter('preference-cost')
	}
}

function getURLParameter(name,fallback) {
  var fallback = fallback || null;
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||fallback
}


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
            // {  //Example of a roof
            //     "type": "roof",
            //     "name": "Attic",
            //     "l": 0,
            //     "h": 0,
            //     "area": 30.8,
            //     "uvalue": 0.25,
            //     "id": 11
            // }, // Need another entry if the house has a room in the roof
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
        "solarpv_orientation": 3,
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
                "selected": 1,
                "group": "Electric",
                "annual_kwh": 0,
                "kwhd": 0,
                "annual_co2": 0,
                "annual_cost": 5
            },
            // "electric-heating": {
            //     "name": "Electricity for direct heating",
            //     "note": "e.g: Storage Heaters",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 3.07,
            //     "unitcost": 0.1319,
            //     "standingcharge": 54,
            //     "selected": 0,
            //     "group": "Electric",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 54
            // },
            // "electric-heatpump": {
            //     "name": "Electricity for heatpump",
            //     "note": "annual electricity input to the heatpump",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 3.07,
            //     "unitcost": 0.1319,
            //     "standingcharge": 54,
            //     "selected": 0,
            //     "group": "Electric",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 54
            // },
            // "electric-waterheating": {
            //     "name": "Electricity for water heating",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 3.07,
            //     "unitcost": 0.1319,
            //     "standingcharge": 54,
            //     "selected": 0,
            //     "group": "Electric",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 54
            // },
            // "electric-car": {
            //     "name": "Electric car",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 3.07,
            //     "unitcost": 0.1319,
            //     "standingcharge": 54,
            //     "selected": 0,
            //     "group": "Electric",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 54
            // },
            // "electric-e7": {
            //     "name": "Electricity (Economy 7)",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 2.4,
            //     "unitcost": 0.1529,
            //     "standingcharge": 78,
            //     "selected": 0,
            //     "group": "Economy 7",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 78
            // },
            // "electric-heating-e7": {
            //     "name": "Electricity for direct heating (Economy 7)",
            //     "note": "e.g: Storage Heaters",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 2.4,
            //     "unitcost": 0.1529,
            //     "standingcharge": 78,
            //     "selected": 0,
            //     "group": "Economy 7",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 78
            // },
            // "electric-heatpump-e7": {
            //     "name": "Electricity for heatpump (Economy 7)",
            //     "note": "annual electricity input to the heatpump",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 2.4,
            //     "unitcost": 0.1529,
            //     "standingcharge": 78,
            //     "selected": 0,
            //     "group": "Economy 7",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 78
            // },
            // "electric-waterheating-e7": {
            //     "name": "Electricity for water heating (Economy 7)",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 2.4,
            //     "unitcost": 0.1529,
            //     "standingcharge": 78,
            //     "selected": 0,
            //     "group": "Economy 7",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 78
            // },
            // "electric-car-e7": {
            //     "name": "Electric car (Economy 7)",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 1,
            //     "co2": 0.519,
            //     "primaryenergy": 2.4,
            //     "unitcost": 0.1529,
            //     "standingcharge": 78,
            //     "selected": 0,
            //     "group": "Economy 7",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 78
            // },
            // "gas": {
            //     "name": "Mains gas",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "m3",
            //     "kwh": 9.8,
            //     "co2": 2.1168,
            //     "primaryenergy": 1.22,
            //     "unitcost": 0.34104,
            //     "standingcharge": 120,
            //     "selected": 0,
            //     "group": "Heating (non-electric)",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 120
            // },
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
            "coal": {
                "name": "Coal",
                "note": "",
                "quantity": 0,
                "units": "kg",
                "kwh": 1,
                "co2": 0.226,
                "primaryenergy": 1.02,
                "unitcost": 0.039,
                "standingcharge": 0,
                "selected": 0,
                "group": "Heating (non-electric)",
                "annual_kwh": 0,
                "kwhd": 0,
                "annual_co2": 0,
                "annual_cost": 0
            },
            // "wood-logs": {
            //     "name": "Wood Logs",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "m3",
            //     "kwh": 1380,
            //     "co2": 26.22,
            //     "primaryenergy": 1.04,
            //     "unitcost": 58.374,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Heating (non-electric)",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "wood-pellets": {
            //     "name": "Wood Pellets",
            //     "note": "In bags",
            //     "quantity": 0,
            //     "units": "m3",
            //     "kwh": 4800,
            //     "co2": 187.2,
            //     "primaryenergy": 1.26,
            //     "unitcost": 278.88,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Heating (non-electric)",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "oil": {
            //     "name": "Oil",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "L",
            //     "kwh": 10.27,
            //     "co2": 3.06,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0.5587,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Heating (non-electric)",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "lpg": {
            //     "name": "LPG",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "kWh",
            //     "kwh": 11,
            //     "co2": 2.651,
            //     "primaryenergy": 1.09,
            //     "unitcost": 0.836,
            //     "standingcharge": 70,
            //     "selected": 0,
            //     "group": "Heating (non-electric)",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 70
            // },
            // "bottledgas": {
            //     "name": "Bottled gas",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "kg",
            //     "kwh": 13.9,
            //     "co2": 3.35,
            //     "primaryenergy": 1.09,
            //     "unitcost": 1.4317,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Heating (non-electric)",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "car1": {
            //     "name": "Car 1",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "miles",
            //     "mpg": 35,
            //     "kwh": 43.65,
            //     "co2": 10.395,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Transport",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "car2": {
            //     "name": "Car 2",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "miles",
            //     "mpg": 35,
            //     "kwh": 43.65,
            //     "co2": 10.395,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Transport",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "car3": {
            //     "name": "Car 3",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "miles",
            //     "mpg": 35,
            //     "kwh": 43.65,
            //     "co2": 10.395,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Transport",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "motorbike": {
            //     "name": "Motorbike",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "miles",
            //     "mpg": 35,
            //     "kwh": 43.65,
            //     "co2": 10.395,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Transport",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "bus": {
            //     "name": "Bus",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "miles",
            //     "kwh": 0.53,
            //     "co2": 0.176,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Transport",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "train": {
            //     "name": "Train",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "miles",
            //     "kwh": 0.096,
            //     "co2": 0.096,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Transport",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "boat": {
            //     "name": "Boat",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "miles",
            //     "kwh": 1,
            //     "co2": 0.192,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Transport",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // },
            // "plane": {
            //     "name": "Plane",
            //     "note": "",
            //     "quantity": 0,
            //     "units": "miles",
            //     "kwh": 0.69,
            //     "co2": 0.43,
            //     "primaryenergy": 1.1,
            //     "unitcost": 0,
            //     "standingcharge": 0,
            //     "selected": 0,
            //     "group": "Transport",
            //     "annual_kwh": 0,
            //     "kwhd": 0,
            //     "annual_co2": 0,
            //     "annual_cost": 0
            // }
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
    "energy_systems": { // these values should affect the "Primary energy graph"
        "cooking": [ // this needs to be ammended with user input
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
        // Is this right ???!
        "solarpv2": [ 
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
        "waterheating": [ // this needs to be ammended with user input
                {
                    "system": "gasboiler",
                    "fraction": 1,
                    "efficiency": 0.7965848065679438,
                    "name": "Standard Gas boiler",
                    "summer": "0.702",
                    "winter": "0.803",
                    "fuel": "gas",
                    "id": 0,
                    "fans_and_pumps": 45,
                    "combi_keep_hot": 0
                }
        ],
        "spaceheating": [ // this needs to be ammended with user input
            {
                "system": "gasboiler",
                "fraction": 0.7,
                "efficiency": "0.794",
                "name": "Standard Gas boiler",
                "summer": "0.702",
                "winter": "0.803",
                "fuel": "gas",
                "id": 0,
                "fans_and_pumps": 45,
                "combi_keep_hot": 0
            }
        ],
        "lighting": [
                {
                    "system": "electric",
                    "fraction": 1,
                    "efficiency": 1,
                    "name": "Standard Electric",
                    "summer": 1,
                    "winter": 1,
                    "fuel": "electric",
                    "id": 0,
                    "fans_and_pumps": 45,
                    "combi_keep_hot": 0
                }
            ],
            "appliances": [
                {
                    "system": "electric",
                    "fraction": 1,
                    "efficiency": 1,
                    "name": "Standard Electric",
                    "summer": 1,
                    "winter": 1,
                    "fuel": "electric",
                    "id": 0,
                    "fans_and_pumps": 45,
                    "combi_keep_hot": 0
                }
            ],
    },
    "measures": {
        "energy_systems": {}
    }
}


// substitute in user's values


// results is a variable defined in results.blade.php

dataIn.fabric.elements = results.elements;
dataIn.floors = results.floors;
dataIn.LAC.LLE = results.LACLighting.lowEnergyLightFittings;
dataIn.LAC.L = results.LACLighting.totalLightFittings;

dataIn.LAC.energy_efficient_appliances = results.LAC.ARatedAppliances == "true" ? true : false;
dataIn.LAC.energy_efficient_cooking = results.LAC.ARatedAppliances == "true" ? true : false;

dataIn.currentenergy.energyitems.electric.quantity = results.bills.electricity;
dataIn.currentenergy.energyitems["gas-kwh"].quantity = results.bills.gas;

dataIn.energy_systems.space_heating = [];

for (var i = 0 ; i < results.spaceHeating.length ; i++){

    dataIn.energy_systems.space_heating.push({
        "system": results.spaceHeating[i].title,
        "fraction": 1, // if there is an additional heating source, this needs to come down to 0.9 and the other source should be 0.1
        "efficiency": results.spaceHeating[i].summer,
        "name": "Standard Gas boiler",
        "summer": results.spaceHeating[i].summer,
        "winter": results.spaceHeating[i].winter,
        "fuel": results.spaceHeating[i].fuel,
        "id": 0,
        "fans_and_pumps": 45,
        "combi_keep_hot": 0
    });
}

// Use primary space heating for these
dataIn.temperature.responsiveness = results.spaceHeating[0].responsiveness;
dataIn.temperature.control_type = results.spaceHeating[0].controlType;

if (results.solarPanels){
    dataIn.use_generation = true;
}

dataIn.generation.solarpv_kwp_installed = results.solarPanels;


var chartWidth = 500,
// chartHeight = 120,
barHeight = 38,
maxBarWidth = 500,
marginBottom = 5,
chartPadding = {
    top:50,
    right:10,
    bottom:20,
    left:10
}

var barColours = [
    "#F1654F", "#C2A2AE"
];

function makeHorizBarChart(chartWrapper, dataset, options){
    var chartHeight = dataset.bars.length * (barHeight + marginBottom)

    var xScale = d3.scale.linear()
                        .domain(options.xDomain)
                        .range([0, chartWidth]);

    var xAxis = d3.svg.axis()
        .scale(xScale)
        .orient("bottom");

    var svgWidth = chartWidth + chartPadding.right + chartPadding.left;
    var svgHeight = chartHeight + chartPadding.top + chartPadding.bottom;

    // xAxis.;
    var svg = d3.select(chartWrapper)
                .append("svg")
                .attr("width", svgWidth)
                .attr("height", svgHeight)
                .attr('viewBox','0 0 '+svgWidth+' '+svgHeight)
                .attr('preserveAspectRatio','xMinYMin')


    var defs = svg.append("defs");
        var stripesPattern = defs.append("pattern")
            .attr({ id:"stripes", width:"8", height:"8", patternUnits:"userSpaceOnUse", patternTransform:"rotate(45)"})
                stripesPattern.append("rect").attr({ width:"8", height:"8", fill:"rgba(106, 41, 74, 0.4)" });
                stripesPattern.append("rect").attr({ width:"1", height:"8", fill:"rgba(106, 41, 74, 0.8)" });

        var dotsPattern = defs.append("pattern")
            .attr({ id:"dots", width:"30", height:"5", patternUnits:"userSpaceOnUse"})
                dotsPattern.append("circle").attr({ cx:"2", cy:"2", r:"1", fill:"rgba(106, 41, 74, 0.8)" });

    var chartCanvas = svg.append("g")

    chartCanvas.attr("width", chartWidth)
                .attr("height", chartHeight)
                .attr("transform", "translate("+ chartPadding.left +"," + chartPadding.top + ")")

    chartCanvas.selectAll("rect.background")
       .data(dataset.bars)
       .enter()
            .append("rect")
            .attr("class", "background-bar")
            .attr("x", 0)
            .attr("y", function(d, i){
                return i * (barHeight + marginBottom);
            })
            .attr("width", chartWidth)
            .attr("height", barHeight);

    chartCanvas.selectAll("rect.bar")
      .data(dataset.bars)
      .enter()
           .append("rect")
           .attr("class", "value-bar")
           .attr("x", 0)
           .attr("y", function(d, i){
                return i * (barHeight + marginBottom);
            })
           .attr("width", function(d){
                return xScale(d.value)
            })
           .attr("fill", function(d, i){
                return barColours[i];
           })
           .attr("height", barHeight);


    chartCanvas.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(0," + (chartHeight) + ")")
        .call(xAxis);




    if (typeof dataset.target != "undefined"){ 
        chartCanvas.append("rect")
            .attr("class", "target-range")
            .attr("x", function(d){
                return xScale(dataset.target[0]);
            })
            .attr("y", 0)
            .attr("width", function(){
                return xScale(dataset.target[1] - dataset.target[0]);
            })
            .attr("height", function(){
                return dataset.bars.length * (barHeight + marginBottom) - marginBottom;
            })
            .attr("fill", "url(#stripes)")
    }

    if (typeof dataset.average != "undefined"){ 
        chartCanvas.append("line")
            .attr("x1", function(d){
                return xScale(dataset.average);
            })
            .attr("x2", function(d){
                return xScale(dataset.average);
            })
            .attr("y1", 0)
            .attr("y2", function(){
                return dataset.bars.length * (barHeight + marginBottom) - marginBottom;
            })
            .attr("stroke", "rgba(106, 41, 74, 0.4)")
            .attr("stroke-dasharray", "1, 3")
            .attr("stroke-linecap", "round")
            .attr("stroke-width", 1);

        chartCanvas.append("text")
            .attr("class", "graph-average-text-box")
            .attr("y", -12)
            .attr("x", function(d){
                return xScale(dataset.average);  
            })
            .text("UK Average")
        chartCanvas.append("text")
            .attr("class", "graph-average-text-box")
            .attr("y", -24)
            .attr("x", function(d){
                return xScale(dataset.average);  
            })
            .text(dataset.average +" "+ dataset.units)
    }

    var legend = d3.select(chartWrapper)
                    .append("div")
                    .attr("class", "chart-legend")

    var legendItems = legend.selectAll("div.chart-legend-item")
        .data(dataset.bars)
        .enter()
            .append("div")
            .attr("class", "chart-legend-item")
    
    legendItems.append("div")
        .attr("class", "chart-legend-item-color")
        .attr("style", function(d, i){
            return "background-color:" + barColours[i];
        })
    legendItems
        .append("p")
        .text(function(d, i){
            return d.title;
        })

    if (typeof dataset.target != "undefined"){ 

        // add target range
        var targetLegendItem = legend.append("div")
            .attr("class", "chart-legend-item");

        targetLegendItem.append("div")
            .append("div")
            .attr("class", "chart-legend-item-color")
            .attr("style", "background-image:url('/img/target-range-legend-square.png')")

        targetLegendItem.append("p")    
            .text(function(d){
                return dataset.target[0] + " - " + dataset.target[1] + " Target Range";
            })
            

    }

}


// needed when clicking on house interface
function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}


$(document).ready(function(){
	calc.run(dataIn);
	var spaceHeatingDemand = dataIn.fabric_energy_efficiency;

    // var primaryEnergy = dataIn.primary_energy_use_m2;
	var primaryEnergy = 0;
	var primaryEnergyBills = dataIn.currentenergy.primaryenergy_annual_kwhm2;


    if (typeof dataIn.energy_requirements['lighting'] !== "undefined"){
        primaryEnergy += dataIn.energy_requirements['lighting'].quantity/dataIn.TFA;
    }

    if (typeof dataIn.energy_requirements['appliances'] !== "undefined"){
        primaryEnergy += dataIn.energy_requirements['appliances'].quantity/dataIn.TFA;
    }

    if (typeof dataIn.energy_requirements['cooking'] !== "undefined"){
        primaryEnergy += dataIn.energy_requirements['cooking'].quantity/dataIn.TFA;
    }

    if (typeof dataIn.energy_requirements['waterheating'] !== "undefined"){
        primaryEnergy += dataIn.energy_requirements['waterheating'].quantity/dataIn.TFA;
    }

    if (typeof dataIn.energy_requirements['space_heating'] !== "undefined"){
        primaryEnergy += dataIn.energy_requirements['space_heating'].quantity/dataIn.TFA;
    }

    if (typeof dataIn.energy_requirements['fans_and_pumps'] !== "undefined"){
        primaryEnergy += dataIn.energy_requirements['fans_and_pumps'].quantity/dataIn.TFA;
    }


    var co2Emissions = dataIn.kgco2perm2
    var co2EmissionsBills = dataIn.currentenergy.total_co2m2

    var cost =  dataIn.net_cost
    var costBills = dataIn.currentenergy.total_cost

    var spaceHeatingOptions = {
        xDomain: [0, 260]
    };

    var primaryEnergyOptions = {
        xDomain: [0, 500]
    };

    var carbonEmissionsOptions = {
        xDomain: [0, 200]
    };

    var costOptions = {
        xDomain: [0, 2500]
    };



    var spaceHeatingData = {
        bars: [{
            title: "Space heating demand",
            value: spaceHeatingDemand,
        }],
        target: [20, 60],
        average: 140,
        units: "kWh/m2.year",
    }

    var primaryEnergyData = {
        bars: [{
            title: "Primary Energy Use",
            value: primaryEnergy,
        },{
            title: "Primary Energy Use (bills)",
            value: primaryEnergyBills,
            bills: true
        }],
        target: [0, 120],
        average: 365,
        units: "kWh/m2.year"
    }

    var carbonEmissionsData = {
        bars: [{
            title: "Carbon Emissions",
            value: co2Emissions,
        },{
            title: "Carbon Emissions (bills)",
            value: co2EmissionsBills,
            bills: true
        }],
        target: [0, 20],
        average: 104,
        units: "kgCO2/m2.year"
    }

    var costData = {
        bars: [{
            title: "Cost",
            value: cost,
        },{
            title: "Cost (bills)",
            value: costBills,
            bills: true
        }],
        units: "£"
    }

    makeHorizBarChart(".js-space-heating-chart", spaceHeatingData, spaceHeatingOptions);
    makeHorizBarChart(".js-primary-energy-use-chart", primaryEnergyData, primaryEnergyOptions);
    makeHorizBarChart(".js-carbon-emissions-chart", carbonEmissionsData, carbonEmissionsOptions);
    makeHorizBarChart(".js-annual-cost-chart", costData, costOptions);

	console.log("Space heating: ", spaceHeatingDemand, "\nPrimary Energy", primaryEnergy, "\nCO2", co2Emissions, "\nCost", cost);

    // custom easing
    $.easing.easeInOutCubic = function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t + b;
        return c/2*((t-=2)*t*t + 2) + b;
    }


    $(".js-show-graph-info-toggle").click(function(e){
        e.preventDefault();

        var animationDuration = 500;
        var el = $(this).siblings('.js-graph-info');

        

        if (el.prop("revealed") != true){ // currently hidden, so ned to reveal
            var curHeight = el.height();
            var autoHeight = el.css('height', 'auto').height();
            el.height(curHeight).animate({
                height: autoHeight,
            }, animationDuration, "easeInOutCubic");
            el.prop("revealed", true);
            el.addClass("graph-info--revealed");
            $(this).addClass("graph-info-toggle--active");

        } else { // currently revealed so need to hide.
            el.animate({
                height:0,
                // opacity:0,
                // transform: "translate(-5px)"
            }, animationDuration, "easeInOutCubic");
            el.prop("revealed", false);
            el.removeClass("graph-info--revealed");
            $(this).removeClass("graph-info-toggle--active");

        }

    });

});


