


@extends('layouts.master')

@section('title', 'Building')

@section('body-class', 'no-pad-top no-pad-bottom')

@section('content')

<div class="bulding-map" id="js-building-map"></div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=XXXXXXXXXXXXXX&callback=initMap" type="text/javascript"></script>


<div class="address-overlay">
	<img src="{{ URL::asset('img/icons/map-icon.png') }}" alt="" width='80px' height='80px'>
	<select class='js-postcode-selector input-chosen-select input--rounded-top input--border-bot' data-placeholder="Please choose an address">
		<option> </option>
		@foreach ($osAddresses as $address)
			<option value="{{ $address->osTopoTOID}}">{{ $address->humanReadableAddress()}}</option>
		@endforeach
	</select>

	<a href="" class='js-proceed-to-form-given-address proceed-to-form-given-address'>Continue</a>

</div>

<script>
	var buildingGeoData = [
		@foreach ($osAddresses as $address)
		{
			id: "{{ $address->osTopoTOID}}",
			address: "{{ $address->humanReadableAddress()}}",
			coordinates: "{{ rtrim(substr($address->building->WKT, 12), ')') }}"
		},
		@endforeach
	]
</script>

@stop
