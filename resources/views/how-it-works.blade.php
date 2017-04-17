@extends('layouts.master')

@section('title', 'Page')

@section('content')

<div class="page-wrapper--thin page">
	<div class="page-title">
		<h1>How it works</h1>
	</div>

	<div class="body-copy page-content">
		<p>We build up a picture of your home using the data you provide and publicly available information from Ordinance Survey.</p>

<p>We do this using a detailed, open source energy tool, My Home Energy Planner, at its core this tool uses the <a href="https://www.gov.uk/guidance/standard-assessment-procedure" target="_blank">SAP (Standard Assessment Procedure)</a> model, the methodology used by the Government to assess and compare the energy and environmental performance of homes and buildings.</p>

<p>Be aware, as with all models, the information you get out is only as good as the information you enter and necessarily some assumptions and simplifications are made. However, the results should give you a good idea of the energy performance of your home.</p>

<h3>Steps:</h3>
<ol>
	<li>Identify your home using your postcode and the online map</li>
	<li>Carefully read the questions and answer them as best you can, if you are unsure of anything the select 'don't know' – it might help to have some energy bills handy!</li>
	<li>'My Home Energy Results' displays your home's energy performance in terms of Carbon, Energy Cost and Comfort. Click on the information buttons to learn more.</li>
	<li>Now, interact with the house graphic by clicking on the icons to open up a form. Then, change the input values and click "update" to see how different improvements affect the results.</li>
</ol>

<h3>Important</h3>

<p>The My Home Energy Salford is a guide to assist with domestic energy awareness and to provide a guide to energy efficiency decision making.</p>

<p>Consult an industry professional or carry out more in depth, detailed research to inform any purchasing decisions.</p>
	</div>

	<div class="page-footer">
		<a href="#" class="btn btn--round btn--icon btn--icon-print">Share</a>
		<a href="#" class="btn btn--round btn--icon btn--icon-print">Print</a>
	</div>
</div>
@stop