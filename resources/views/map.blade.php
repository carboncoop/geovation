@extends('layouts.master')

@section('title', 'Home')

@section('content')

<div class="bulding-map" id="js-building-map"></div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=XXXXXXXXXXXXX&callback=initMap" type="text/javascript"></script>

@stop