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
        'loft-conversion': getURLParameter('loft-conversion', 'false'),
        'loft-conversion-date': getURLParameter('loft-conversion-date'),
        'flat-or-apartment': getURLParameter('flat-or-apartment', 'false'),
        'flat-or-apartment-below': getURLParameter('flat-or-apartment-below', 'false'),
        'flat-or-apartment-above': getURLParameter('flat-or-apartment-above', 'false')
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
        //    'home-draughts': getURLParameter('home-draughts')
    },
    services: {
        'home-heating': getURLParameter('home-heating'),
        'another-heating-source': getURLParameter('another-heating-source', 'false'),
        'home-heating-extra': {
            'home-heating-extra-1': getURLParameter('home-heating-extra-1'),
            // And the rest somehow ?
        },
        'heating-controls': {
            'boiler-thermostat': getURLParameter('heating-control-boiler-thermostat', 'false'),
            'programmer': getURLParameter('heating-control-programmer', 'false'),
            'timer': getURLParameter('heating-control-timer', 'false'),
            'trv': getURLParameter('heating-control-trv', 'false'),
            'zoning': getURLParameter('heating-control-zoning', 'false')
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

function getURLParameter(name, fallback) {
    var fallback = fallback || null;
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || fallback
}

var defaultHotWaterSystem = {
    name: "Typical Gas\/LPG system boiler with rads or underfloor heating pipes in timber floor",
    category: 'System boilers',
    winter_efficiency: 80,
    summer_efficiency: 70,
    fans_and_supply_pumps: 0,
    "provides": "water",
    combi_loss: 0,
    primary_circuit_loss: 'No',
    "fraction_water_heating": 1,
    "instantaneous_water_heating": false,
    "fuel": "Mains Gas",
}

var dataIn = {
    //"scenario_name": "My Home Energy",
    //"household": {},
    "region": 7, // West Pennines
    "altitude": getURLParameter('altitude'),
    "use_custom_occupancy": false, // this means the SAP average based on floor area will be used
    "custom_occupancy": 1, // NA
    "floors": [
        {
            "name": "", // Eg ground floor
            //"area": 100, // For testing, say 100
            "area": getURLParameter('floor-area'), // From os Data
            "height": 2.7, // Storey height, FROM BHA Data, can assume 2.7 if not possible
        } // add extra floors here depending on user input
    ],
    "fabric": {
        "thermal_bridging_yvalue": 0.15, // thermal bridging kept at 0.15. If user chooses "external wall insulation", reduce to 0.08.
        "global_TMP": 1, // This indicates the "Use global TMP value" has been checked
        "global_TMP_value": 250, // This is the Medium TMP value
        "elements": [
            {//Example of a wall
                "type": "wall",
                "name": "Main house west gable",
                "l": 0,
                "h": 0,
                "area": 46.7,
                "uvalue": 2.1,
                "id": 0
            },
            {//Example of a floor
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
            {//Example of a window - this has already been added to Laravel
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
        // "measures": {} // NA
    },
    "ventilation": {
        //"number_of_chimneys": 0,
        //"number_of_openflues": 0,
        //"number_of_intermittentfans": 2.5, // 2 for properties < 100sqm, 3 for properties > 100sqm
        //"number_of_passivevents": 0,
        //"number_of_fluelessgasfires": 0,
        "ventilation_type": "IE", // IE = d =>   d means natural ventilation        
        "dwelling_construction": "timberframe",
        "suspended_wooden_floor": 0,
        "draught_lobby": false,
        "percentage_draught_proofed": 0,
        "air_permeability_test": 1, //this means the properties below (suspended wooden floor, draught lobby etc can be ignored)
        "air_permeability_value": 0, // 15: very draughty, 10: DIY draughtproofing, 5: professional air-tightness, 1.5: extreme air tightness
        "number_of_sides_sheltered": 0,
        "system_air_change_rate": 0.5,
        system_specific_fan_power: 3, // for MVHR
        "balanced_heat_recovery_efficiency": 65,
        IVF: [],
        EVP: [{ventilation_rate: 10}, {ventilation_rate: 10}] // 2 for properties < 100sqm, 3 for properties > 100sqm
    },
    "space_heating": {
        "use_utilfactor_forgains": true,
        "heating_off_summer": true
    },
    use_generation: false,
    "generation": {
        use_PV_calculator: false, // when set to true, solar_annual_kwh is calculated Using the PV calculator
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
    LAC_calculation_type: 'SAP',
    "LAC": {
        "LLE": 100, // number of low energy light fittings
        "L": 100, // total number of light fittings
        "energy_efficient_appliances": false,
        "energy_efficient_cooking": false,
        "reduced_heat_gains_lighting": 1
    },
    use_SHW: false, // if set to true Solar Hot Water is included in the calculations
    water_heating: {// the system for water heating is a gas boiler with no storage and no solar, so we don't need most of the following
        low_water_use_design: true, //
        //"instantaneous_hotwater": 0,
        override_annual_energy_content: false, // true || false
        //annual_energy_content: 0, // input to the module when override_annual_energy_content is set to true
        //hot_water_control_type: 'no_cylinder_thermostat', // no_cylinder_thermostat || Cylinder thermostat, water heating not separately timed || Cylinder thermostat, water heating separately timed
        //pipework_insulation: 'All accesible piperwok insulated', // Uninsulated primary pipework || First 1m from cylinder insulated || All accesible piperwok insulated || Fully insulated primary pipework
        //contains_dedicated_solar_storage_or_WWHRS: 0, // Volume in litres
        //solar_water_heating: false, // true || false
        //hot_water_store_in_dwelling: true, // 	true || false
        //community_heating: false, //	true || false
    },
    temperature: {
        target: 21,
        living_area: 20
    },
    currentenergy: {
        use_by_fuel: {
            'Standard Tariff': {},
            'Mains Gas': {}
        },
        onsite_generation: false, // true || false
        generation: {
            annual_generation: 1500,
            fraction_used_onsite: 0.25,
            annual_FIT_income: 0
        }
    },
    heating_systems: [],
    "fuels": JSON.parse(JSON.stringify(datasets.fuels))
};


// substitute in user's values


// results is a variable defined in results.blade.php
dataIn.fabric.elements = results.elements;
dataIn.floors = results.floors;
dataIn.LAC.LLE = results.LACLighting.lowEnergyLightFittings;
dataIn.LAC.L = results.LACLighting.totalLightFittings;

dataIn.LAC.energy_efficient_appliances = results.LAC.ARatedAppliances == "true" ? true : false;
dataIn.LAC.energy_efficient_cooking = results.LAC.ARatedAppliances == "true" ? true : false;

//dataIn.currentenergy.energyitems.electric.quantity = results.bills.electricity;
dataIn.currentenergy.use_by_fuel['Standard Tariff'].annual_use = results.bills.electricity;
//dataIn.currentenergy.energyitems["gas-kwh"].quantity = results.bills.gas;
dataIn.currentenergy.use_by_fuel['Mains Gas'].annual_use = results.bills.gas;

for (var i = 0; i < results.spaceHeating.length; i++) {
    dataIn.heating_systems.push({
        central_heating_pump: results.spaceHeating[i].central_heating_pump,
        combi_loss: results.spaceHeating[i].combi_loss,
        fans_and_supply_pumps: results.spaceHeating[i].fans_and_supply_pumps,
        fraction_space: 1,
        fraction_water_heating: 0,
        fuel: results.spaceHeating[i].fuel,
        heating_controls: results.spaceHeating[i].controlType,
        instantaneous_water_heating: false,
        name: results.spaceHeating[i].title, //"name": "Standard Gas boiler",
        primary_circuit_loss: results.spaceHeating[i].primary_circuit_loss,
        provides: "heating",
        responsiveness: results.spaceHeating[i].responsiveness,
        summer_efficiency: results.spaceHeating[i].summer,
        winter_efficiency: results.spaceHeating[i].winter,
        temperature_adjustment: results.spaceHeating[i].temperature_adjustment
    });
    if (i == 0)
        dataIn.heating_systems[0].main_space_heating_system = 'mainHS1';
    else
        dataIn.heating_systems[1].main_space_heating_system = 'secondaryHS';
}

if (results.spaceHeating.length > 1) {
    dataIn.heating_systems[0].fraction_space = 0.9;
    dataIn.heating_systems[1].fraction_space = 0.1;
}

// Add hot water system
dataIn.heating_systems.push(defaultHotWaterSystem);

switch (results.airPermeabilityValue.title) {
    case 'Very draughty':
        dataIn.ventilation.air_permeability_value = 15;
        break;
    case 'Quite draughty':
        dataIn.ventilation.air_permeability_value = 12;
        break;
    case 'Not draughty':
        dataIn.ventilation.air_permeability_value = 7.5;
        break;
    case 'Very air tight':
        dataIn.ventilation.air_permeability_value = 2.5;
        break;
    case "Don't know":
        dataIn.ventilation.air_permeability_value = 12;
        break;
}

if (results.solarPanels != 0)
    dataIn.use_generation = true;
else
    dataIn.use_generation = false;
dataIn.generation.use_PV_calculator = true;
dataIn.generation.solarpv_kwp_installed = results.solarPanels;
dataIn.generation.solarpv_inclination = 35;
dataIn.generation.solarpv_orientation = 4; //South
dataIn.generation.solarpv_overshading = 1; // None or very little, less than 20%

console.log("To see the house in more detail, paste the following string in the Import page of MyHomeEnergyPlanner");
console.log('{"master":' + JSON.stringify(dataIn) + '}');

var chartWidth = 500,
// chartHeight = 120,
        barHeight = 38,
        maxBarWidth = 500,
        marginBottom = 5,
        chartPadding = {
            top: 50,
            right: 10,
            bottom: 20,
            left: 10
        }

var barColours = [
    "#F1654F", "#C2A2AE"
];

function makeHorizBarChart(chartWrapper, dataset, options) {
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
            .attr('viewBox', '0 0 ' + svgWidth + ' ' + svgHeight)
            .attr('preserveAspectRatio', 'xMinYMin')


    var defs = svg.append("defs");
    var stripesPattern = defs.append("pattern")
            .attr({id: "stripes", width: "8", height: "8", patternUnits: "userSpaceOnUse", patternTransform: "rotate(45)"})
    stripesPattern.append("rect").attr({width: "8", height: "8", fill: "rgba(106, 41, 74, 0.4)"});
    stripesPattern.append("rect").attr({width: "1", height: "8", fill: "rgba(106, 41, 74, 0.8)"});

    var dotsPattern = defs.append("pattern")
            .attr({id: "dots", width: "30", height: "5", patternUnits: "userSpaceOnUse"})
    dotsPattern.append("circle").attr({cx: "2", cy: "2", r: "1", fill: "rgba(106, 41, 74, 0.8)"});

    var chartCanvas = svg.append("g")

    chartCanvas.attr("width", chartWidth)
            .attr("height", chartHeight)
            .attr("transform", "translate(" + chartPadding.left + "," + chartPadding.top + ")")

    chartCanvas.selectAll("rect.background")
            .data(dataset.bars)
            .enter()
            .append("rect")
            .attr("class", "background-bar")
            .attr("x", 0)
            .attr("y", function (d, i) {
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
            .attr("y", function (d, i) {
                return i * (barHeight + marginBottom);
            })
            .attr("width", function (d) {
                return xScale(d.value)
            })
            .attr("fill", function (d, i) {
                return barColours[i];
            })
            .attr("height", barHeight);


    chartCanvas.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(0," + (chartHeight) + ")")
            .call(xAxis);




    if (typeof dataset.target != "undefined") {
        chartCanvas.append("rect")
                .attr("class", "target-range")
                .attr("x", function (d) {
                    return xScale(dataset.target[0]);
                })
                .attr("y", 0)
                .attr("width", function () {
                    return xScale(dataset.target[1] - dataset.target[0]);
                })
                .attr("height", function () {
                    return dataset.bars.length * (barHeight + marginBottom) - marginBottom;
                })
                .attr("fill", "url(#stripes)")
    }

    if (typeof dataset.average != "undefined") {
        chartCanvas.append("line")
                .attr("x1", function (d) {
                    return xScale(dataset.average);
                })
                .attr("x2", function (d) {
                    return xScale(dataset.average);
                })
                .attr("y1", 0)
                .attr("y2", function () {
                    return dataset.bars.length * (barHeight + marginBottom) - marginBottom;
                })
                .attr("stroke", "rgba(106, 41, 74, 0.4)")
                .attr("stroke-dasharray", "1, 3")
                .attr("stroke-linecap", "round")
                .attr("stroke-width", 1);

        chartCanvas.append("text")
                .attr("class", "graph-average-text-box")
                .attr("y", -12)
                .attr("x", function (d) {
                    return xScale(dataset.average);
                })
                .text("UK Average")
        chartCanvas.append("text")
                .attr("class", "graph-average-text-box")
                .attr("y", -24)
                .attr("x", function (d) {
                    return xScale(dataset.average);
                })
                .text(dataset.average + " " + dataset.units)
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
            .attr("style", function (d, i) {
                return "background-color:" + barColours[i];
            })
    legendItems
            .append("p")
            .text(function (d, i) {
                return d.title;
            })

    if (typeof dataset.target != "undefined") {

        // add target range
        var targetLegendItem = legend.append("div")
                .attr("class", "chart-legend-item");

        targetLegendItem.append("div")
                .append("div")
                .attr("class", "chart-legend-item-color")
                .attr("style", "background-image:url('/img/target-range-legend-square.png')")

        targetLegendItem.append("p")
                .text(function (d) {
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


$(document).ready(function () {
    console.log(results);
    calc.run(dataIn);
    var spaceHeatingDemand = dataIn.space_heating_demand_m2;

    var primaryEnergy = dataIn.primary_energy_use_m2;
    var primaryEnergyBills = dataIn.currentenergy.primaryenergy_annual_kwhm2;

    var co2Emissions = dataIn.kgco2perm2
    var co2EmissionsBills = dataIn.currentenergy.total_co2m2

    var cost = dataIn.net_cost
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
            }, {
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
            }, {
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
            }, {
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
        if ((t /= d / 2) < 1)
            return c / 2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    }


    $(".js-show-graph-info-toggle").click(function (e) {
        e.preventDefault();

        var animationDuration = 500;
        var el = $(this).siblings('.js-graph-info');



        if (el.prop("revealed") != true) { // currently hidden, so ned to reveal
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
                height: 0,
                // opacity:0,
                // transform: "translate(-5px)"
            }, animationDuration, "easeInOutCubic");
            el.prop("revealed", false);
            el.removeClass("graph-info--revealed");
            $(this).removeClass("graph-info-toggle--active");

        }

    });

});


