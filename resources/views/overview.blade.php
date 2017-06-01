@extends('layouts.master')

@section('title', 'Overview')

@section('content')
<div class="page-wrapper--thin">
    <div class="page-title page-title--icon page-title--small-bot-margin">
        <div class="page-title__icon">
            <img src="{{ URL::asset('img/icons/overview.png') }}" alt="">
        </div>
        <h1>My Home Energy Overview</h1>
    </div>
    <div class="page-intro">
        <h2 class="page-sub-title">59 Lever Street, Manchester M1 1EA</h2>
    </div>
</div>
<div class="page-wrapper">
    <div class="grid cf overview-results">
        <div class="col-3">
            <img class="overview-results__graph" src="{{ URL::asset('img/temp-graph.png') }}" alt="">
        </div>
        <div class="col-3">
            <img class="overview-results__graph" src="{{ URL::asset('img/temp-graph.png') }}" alt="">
        </div>
        <div class="col-3">
            <img class="overview-results__graph" src="{{ URL::asset('img/temp-graph.png') }}" alt="">
        </div>
    </div>
    <!--<div class="ctext overview-sharing body-copy body-copy--dbl-margin">
        <a href="#" class="btn btn--basic btn--highlighted">Email my results</a>
        <p>You can share or print your My Home Energy results</p>
        <a href="#" class="btn btn--round btn--icon btn--icon-print">Share</a>
        <a href="#" class="btn btn--round btn--icon btn--icon-print">Print</a>
    </div>-->
</div>
<div class="grey-bg overview-more-info">
    <div class="page-wrapper">
        <div class="grid grid--double-pad cf">
            <div class="col-4 body-copy body-copy--dbl-margin">
                <h3 class="line-accent">Salford Council</h3>
                <p>The local authority for the city of Salford, Salford Council provided the data license that enables this site to operate.</p>
                <a href="http://www.salford.gov.uk/" target="_blank" class="btn btn--basic btn--highlighted">Find out more</a>
            </div>
            <div class="col-4 body-copy body-copy--dbl-margin">
                <h3 class="line-accent">URBED</h3>
                <p>Technical partners and retrofit experts, URBED specialise in urban design and sustainability in an urban context</p>
                <a href="http://www.urbed.coop/" target="_blank" class="btn btn--basic btn--highlighted">Find out more</a>
            </div>
            <div class="col-4 body-copy body-copy--dbl-margin">
                <h3 class="line-accent">Geovation Challenge</h3>
                <p>A challenge competition for start-ups wanting to help solve pressing issues using location information.</p>
                <a href="https://geovation.uk/" target="_blank" class="btn btn--basic btn--highlighted">Find out more</a>
            </div>
            <div class="col-4 body-copy body-copy--dbl-margin">
                <h3 class="line-accent">Fieldwork</h3>
                <p>A collaborative design agency working on everything from digital platforms to brand identities</p>
                <a href="http://madebyfieldwork.com/" target="_blank" class="btn btn--basic btn--highlighted">Find out more</a>
            </div>
        </div>
    </div>
</div>
<div class="overview-case-studies">
    <div class="page-wrapper--thin">
        <div class="page-title page-title--icon-overlap page-title--small-bot-margin page-title--no-border">
            <div class="page-title__icon">
                <img src="{{ URL::asset('img/icons/case-studies.png') }}" alt="">
            </div>
            <h1>Case Studies</h1>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="grid cf">
            <div class="col-3 body-copy body-copy--dbl-margin">
                <div class="case-study">
                    <img src="{{ URL::asset('img/case-studies/dominic-mccann.png') }}" class="case-study__thumb" alt="">
                    <h3 class="line-accent highlighted">Dominic McCann - the Victorian Terrace whole house retrofit</h3>
                    <p><b>Case Study:</b> With the help of Carbon Co-op, Dominic made big changes to the fabric of his home, adding external wall insulation, triple glazed windows, underfloor insulation and solar panels.</p>
                    <a href="https://vimeo.com/142379756" target="_blank" class="btn btn--round btn--highlighted">Find out more</a>
                </div>
            </div>
            <div class="col-3 body-copy body-copy--dbl-margin">
                <div class="case-study">
                    <img src="{{ URL::asset('img/case-studies/lorenza-casini.png') }}" class="case-study__thumb" alt="">
                    <h3 class="line-accent highlighted">Lorenza Casini - slow and steady improvements over time</h3>
                    <p><b>Case Study:</b> Lorenza and Paul have made step-by-step improvements over a number of years, using DIY and professional help including adding roof, floor and walls insulation and triple glazed windows.</p>
                    <a href="https://vimeo.com/142238564" target="_blank" class="btn btn--round btn--highlighted">Find out more</a>
                </div>
            </div>
            <div class="col-3 body-copy body-copy--dbl-margin">
                <div class="case-study">
                    <img src="{{ URL::asset('img/case-studies/gervase-mangwana.png') }}" class="case-study__thumb" alt="">
                    <h3 class="line-accent highlighted">Gervase Mangwana - taking the house apart and putting it back together again</h3>
                    <p><b>Case Study:</b> Gervase took on the project of a whole house retrofit, planning and carrying out the work himself. This extensive work involved many different improvements including solid wall insulation and a heat recovery ventilation system.</p>
                    <a href="https://vimeo.com/142371233" target="_blank" class="btn btn--round btn--highlighted">Find out more</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="overview-contact-us">
    <div class="page-wrapper--x-thin page-intro body-copy body-copy--dbl-margin">
        <h2 class="page-sub-title">59 Lever Street, Manchester M1 1EA</h2>
        <p>For more information contact Carbon Co-op at: <a href="mailto:info@carbon.coop">info@carbon.coop</a></p>
        <a href="mailto:info@carbon.coop" class="btn btn--basic btn--highlighted">Get In touch</a>
    </div>
</div>
@stop