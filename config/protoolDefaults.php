<?php

return [
    "windowTypes" => [
        "single" => [
            "title" => "Single Glazed",
            "l" => 1.6733,
            "h" => 1.6733,
            "area" => 2.8,
            "uvalue" => 4.8,
            "ff" => 0.7,
            "overshading" => 2,
            "g" => 0.85,
            "gL" => 0.90
        ],
        "doubleGlazedOlder" => [
            "title" => "Doubled Glazed - installed before 2006",
            "l" => 1.6733,
            "h" => 1.6733,
            "area" => 2.8,
            "uvalue" => 2.8,
            "ff" => 0.7,
            "overshading" => 2,
            "g" => 0.76,
            "gL" => 0.80
        ],
        "doubleGlazedHighPerformance" => [
            "title" => "Double Glazed - installed after 2006",
            "l" => 1.6733,
            "h" => 1.6733,
            "area" => 2.8,
            "uvalue" => 1.8,
            "ff" => 0.7,
            "overshading" => 2,
            "g" => 0.63,
            "gL" => 0.80
        ],
        "tripleGlazed" => [
            "title" => "Triple Glazed",
            "l" => 1.6733,
            "h" => 1.6733,
            "area" => 2.8,
            "uvalue" => 1.0,
            "ff" => 0.7,
            "overshading" => 2,
            "g" => 0.64,
            "gL" => 0.70
        ],
        "secondaryGlazed" => [
            "title" => "Secondary Glazed",
            "l" => 1.6733,
            "h" => 1.6733,
            "area" => 2.8,
            "uvalue" => 2.4,
            "ff" => 0.7,
            "overshading" => 2,
            "g" => 0.76,
            "gL" => 0.80
        ],
        "unknown" => [
            "title" => "Don't know"
        ]
    ],
    "doorTypes" => [
        "house" => [
            "title" => "House Door",
            "l" => 1.414,
            "h" => 1.414,
            "area" => 2,
            "uvalue" => 2.5,
            "ff" => 0.7,
            "overshading" => 20,
            "g" => 0,
            "gL" => 0
        ],
        "apartment" => [
            "title" => "Apartment Door",
            "l" => 1.414,
            "h" => 1.414,
            "area" => 2,
            "uvalue" => 1.5,
            "ff" => 0.7,
            "overshading" => 20,
            "g" => 0,
            "gL" => 0
        ]
    ],
    "floorInsulationTypes" => [
        "none" => [
            "title" => "None",
            "uvalue" => 0.9
        ],
        "50mm" => [
            "title" => "50mm",
            "uvalue" => 0.6,
        ],
        "100mm" => [
            "title" => "100mm",
            "uvalue" => 0.3,
        ],
        "200mm" => [
            "title" => "200mm",
            "uvalue" => 0.2,
        ],
        "unknown" => [
            "title" => "Don't know",
        ]
    ],
    "loftInsulation" => [
        "noInsulation" => [
            "title" => "No insulation",
            "uvalue" => 2.3,
        ],
        "50mm" => [
            "title" => "50mm of insulation",
            "uvalue" => 0.68,
        ],
        "100mm" => [
            "title" => "100mm of insulation",
            "uvalue" => 0.4,
        ],
        "200mm" => [
            "title" => "200mm of insulation",
            "uvalue" => 0.21,
        ],
        "270mm" => [
            "title" => "270mm of insulation",
            "uvalue" => 0.16,
        ],
        "400mm" => [
            "title" => "400mm of insulation",
            "uvalue" => 0.11,
        ],
        "unknown" => [
            "title" => "Don't know",
        ]
    ],
    "wallTypes" => [
        "solidBrick" => [
            "title" => "Solid brick or masonry, uninsulated",
            "uvalue" => 1.8,
        ],
        "masonryCavityUninsulated" => [
            "title" => "Masonry cavity, uninsulated",
            "uvalue" => 1.0,
        ],
        "masonryCavityInsulated" => [
            "title" => "Masonry cavity with insulation fill",
            "uvalue" => 0.4,
        ],
        "200mm" => [
            "title" => "200mm external wall insulation on solid masonry",
            "uvalue" => 0.2,
        ],
        "150mm" => [
            "title" => "150mm external wall insulation on filled cavity",
            "uvalue" => 0.15,
        ],
        "internalWallInsulation" => [
            "title" => "Internal wall insulation on solid mansonry",
            "uvalue" => 0.35,
        ],
        "timberFrameUninsulated" => [
            "title" => "Timber frame, uninsulated",
            "uvalue" => 1.9,
        ],
        "timberFrameInsulated" => [
            "title" => "Timber frame, insulated",
            "uvalue" => 0.3,
        ],
        "unknown" => [
            "title" => "Don't know",
        ]
    ],
    "ventilation" => [
        "airPermeabilityValues" => [
            "veryDraughty" => [
                "title" => "Very draughty",
                "airPermeablilityValue" => 15
            ],
            "diyDraughtproofing" => [
                "title" => "Quite draughty",
                "airPermeablilityValue" => 10
            ],
            "professional" => [
                "title" => "Not draughty",
                "airPermeablilityValue" => 5
            ],
            "extreme" => [
                "title" => "Very air tight",
                "airPermeablilityValue" => 1.5
            ],
            "unknown" => [
                "title" => "Don't know",
            ]
        ]
    ],
    "spaceHeatingSystemsPrimary" => [
        "radiatorsWithNewGasBoiler" => [ // STMB3
            "title" => "Radiators (or underfloor heating) and new A rated Gas Boiler",
            "summer" => "80",
            "winter" => "90",
            "fuel" => "Mains Gas",
            "responsiveness" => 1,
            "controlType" => 2,
            'central_heating_pump' => 120,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 45,
            'primary_circuit_loss' => 'Yes',
            'temperature_adjustment' => 0
        ],
        "radiatorsWithOlderBoiler" => [  //STMB2
            "title" => "Radiators (or underfloor heating) and older gas boiler",
            "summer" => "70",
            "winter" => "80",
            "fuel" => "Mains Gas",
            "responsiveness" => 1,
            "controlType" => 2,
            'central_heating_pump' => 156,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'Yes',
            'temperature_adjustment' => 0
        ],
        "radiatorsWithVeryOldBoiler" => [ // STMB1
            "title" => "Radiators (or underfloor heating) and very old gas boiler",
            "summer" => "60",
            "winter" => "70",
            "fuel" => "Mains Gas",
            "responsiveness" => 1,
            "controlType" => 1,
            'central_heating_pump' => 156,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'Yes',
            'temperature_adjustment' => 0
        ],
        "electricPanelHeaters" => [
            "title" => "Electric Panel, Convector or Radiant Heaters",
            "summer" => "100",
            "winter" => "100",
            "fuel" => "Standard Tariff",
            "responsiveness" => 0.5,
            "controlType" => 1,
            'central_heating_pump' => 0,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'No',
            'temperature_adjustment' => 0
        ],
        "electricBoiler" => [
            "title" => "Electric boiler and radiators",
            "summer" => "100",
            "winter" => "100",
            "fuel" => "Standard Tariff",
            "responsiveness" => 1,
            "controlType" => 1,
            'central_heating_pump' => 156,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'Yes',
            'temperature_adjustment' => 0
        ],
        "woodfiredBoiler" => [
            "title" => "Wood fired boiler and radiators",
            "summer" => "70",
            "winter" => "70",
            "fuel" => "Wood Logs",
            "responsiveness" => 1,
            "controlType" => 2,
            'central_heating_pump' => 156,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'Yes',
            'temperature_adjustment' => 0
        ],
        "electricUnderfloorHeating" => [
            "title" => "Electric underfloor heating",
            "summer" => "100",
            "winter" => "100",
            "fuel" => "Standard Tariff",
            "responsiveness" => 0.5,
            "controlType" => 2,
            'central_heating_pump' => 156,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'Yes',
            'temperature_adjustment' => 0
        ],
        "unknown" => [
            "title" => "Don't know",
        ]
    ],
    "spaceHeatingSystemsSecondary" => [
        "openFire" => [
            "title" => "Open Fire",
            "summer" => "37",
            "winter" => "37",
            "fuel" => "House Coal",
            "responsiveness" => 0.5,
            "controlType" => 1,
            'central_heating_pump' => 0,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'No',
            'temperature_adjustment' => 0
        ],
        "gasFire" => [
            "title" => "Gas Fire",
            "summer" => "63",
            "winter" => "63",
            "fuel" => "Mains Gas",
            "responsiveness" => 0.5,
            "controlType" => 1,
            'central_heating_pump' => 0,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'No',
            'temperature_adjustment' => 0
        ],
        "electricFire" => [
            "title" => "Electric Fire",
            "summer" => "100",
            "winter" => "100",
            "fuel" => "Standard Tariff",
            "responsiveness" => 1,
            "controlType" => 1,
            'central_heating_pump' => 0,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'No',
            'temperature_adjustment' => 0
        ],
        "roomWoodBurner" => [
            "title" => "Room Wood Burner",
            "summer" => "65",
            "winter" => "65",
            "fuel" => "Wood Logs",
            "responsiveness" => 0.5,
            "controlType" => 1,
            'central_heating_pump' => 0,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'No',
            'temperature_adjustment' => 0
        ],
        "electricUnderfloorHeating" => [
            "title" => "Electric Underfloor Heating",
            "summer" => "100",
            "winter" => "100",
            "fuel" => "Standard Tariff",
            "responsiveness" => 1,
            "controlType" => 1,
            'central_heating_pump' => 156,
            'combi_loss' => 0,
            'fans_and_supply_pumps' => 0,
            'primary_circuit_loss' => 'No',
            'temperature_adjustment' => 0
        ],
    ],
    "solarPanels" => [
        // "solarpv_kwp_installed" => 2.7
        "1.4" => [
            "title" => "1.4"
        ],
        "2.1" => [
            "title" => "2.1"
        ],
        "2.4" => [
            "title" => "2.4"
        ],
        "2.7" => [
            "title" => "2.7"
        ],
        "3.0" => [
            "title" => "3.0"
        ],
        "3.4" => [
            "title" => "3.4"
        ],
        "3.8" => [
            "title" => "3.8"
        ],
        "unknown" => [
            "title" => "Don't know"
        ]
    ]
];


