@extends('layouts.master')

@section('title', 'Home')

@section('content')

<div class="bulding-map" id="js-building-map"></div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8lwWTw0bvQVEbyuNcwgFKONwdiQFzxmA&callback=initMap" type="text/javascript"></script>


@stop