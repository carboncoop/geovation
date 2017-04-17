@extends('layouts.master')

@section('title', 'Home')

@section('content')

@section('body-class', 'no-pad-top')


<div class="fullscreen-bg">

	<div class="intro-copy">
		<div class="intro-copy__text">
			<h1>My Home Energy</h1>
			<p>A energy efficient survey. Enter your postcode below to find out how your home uses energy.</p>
			@if(Session::has('noAddressesFound'))
				<p class='highlighted'>Sorry, no addresses matched that post code. Please try again.</p>
			@endif
		</div>
		<div class="intro-copy__search">
			<form class="search-field" action="/os-addresses/postcode">
				<input name="postcode" type="text" class="search__input">
				<button class="search__btn">Search</button>
			</form>
		</div>
	</div>

    <video loop muted autoplay poster="{{ URL::asset('video/preview.png') }}" class="fullscreen-bg__video">
        {{-- <source src="{{ URL::asset('video/homepage-quiet.webm') }}" type="video/webm"> --}}
        <source src="{{ URL::asset('video/homepage-letterbox-v3.mp4') }}" type="video/mp4">
        {{-- <source src="video/big_buck_bunny.ogv" type="video/ogg"> --}}
        {{-- Need to generate a ogg version of the video. --}}
    </video>
</div>

@stop