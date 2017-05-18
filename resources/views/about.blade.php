@extends('layouts.master')

@section('title', 'Page')

@section('content')

<div class="page-wrapper--thin page">
    <div class="page-title">
        <h1>About My Home Energy Salford</h1>
    </div>

    <div class="body-copy page-content">
        <h3>Please note that this website is limited to homes in the Salford Council area.</h3>
        <p>Ever wondered how you could reduce you energy bills, improve the comfort of your home or make it greener?</p>
        <p>My Home Energy Salford allows you to get a good idea of your home energy performance quickly and simply.</p>
        <p>Answer a handful of questions and we'll build a picture of you use energy now and what kinds of improvements you could make to use less in the future.</p>
        <p>My Home Energy Salford is a tool designed and built by <a href="http://carbon.coop/" target="_blank">Carbon Co-op</a> and <a href="http://www.urbed.coop/" target="_blank">URBED</a>, it uses Ordnance Survey data provided under license from <a href="http://www.salford.gov.uk/" target="_blank">Salford City Council</a>.</p>
        <p>It has been funded under the <a href="https://geovation.uk/" target="_blank">Geovation Challenge</a> a challenge competition for start-ups wanting to help solve pressing issues using location information.</p>
        <h3>Why is home energy important?</h3>
        <p>Over the long term, bills are increasing as energy becomes more expensive. Some people find their bills are unaffordable, known as 'Fuel Poverty'. High prices can mean using less heating and hot water which can result in cold, damp homes and chronic health conditions like asthma and eczema.</p>
        <p>The power needed to heat and light our homes contributes around 1/3 of the UK's carbon emissions, a key cause of climate change. We need to reduce our home energy usage by around ¾ to meet our 2050 carbon reduction targets.</p>
        <p>Investing in our homes through improvements such as floor, loft and wall insulation, new efficient boilers, solar panels or triple glazed windows reduces the amount of energy needed to power a home, making them cheaper, healthier and greener.</p>
        <p>These improvements can seem confusing and complicated, but having a good plan is the best place to start and My Home Energy helps you make that plan.</p>
        <p style="text-align: center"><img style="width:350px" src="{{ URL::asset('img/Geovation_SupportedBy_Portrait.png') }}" alt="Supported by Geovation logo"></p>

    </div>

    <div class="page-footer">
        <a href="#" class="btn btn--round btn--icon btn--icon-print">Share</a>
        <a href="#" class="btn btn--round btn--icon btn--icon-print">Print</a>
    </div>
</div>
@stop