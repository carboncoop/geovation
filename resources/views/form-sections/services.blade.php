<div class="col-2">
	<div class="input-field">
		<label for="home-heating" class="input-field__field-title"><span class="input-order-num">12</span>What's your home's main heating system?</label>
		<select class="input-chosen-select input--rounded-top input--border-bot" id="home-heating" name="home-heating" placeholder="Select from the following..">
			@include('common.select-options', array('formField' => "home-heating", 'options' => $protoolDefaults['spaceHeatingSystemsPrimary']))
		</select>
		@if ($errors->has('home-heating')) <p class="input-field__error">{{ $errors->first('home-heating') }}</p> @endif

		@if ($pageLocation == "results")
			<p class="input-field__info">
				@if ($request["home-heating"] == "unknown")
					Based on the age of your home, we have estimated this to be "{{ $selectedOptionTitles["home-heating"] }}".
				@endif
				Improve your home’s heating system to see what difference it makes to comfort, carbon and cost.
			</p>
		@endif

	</div>
</div>

<div class="col-2">
	<div class="input-field">
		<label class="input-field__field-title"><span class="input-order-num">13</span>Do you have another source of heating?</label>
		<div class="btn--toggle-wrapper">
			<input name="another-heating-source" type="hidden" value="{{ Input::old('another-heating-source')}}" class='js-hidden-for-checkbox'>

			<input id="another-heating-source" class="btn--toggle" name="another-heating-source" type="checkbox" value="true" {{ Input::old('another-heating-source') == "true" ? 'checked' : '' }}>
			<label for="another-heating-source" class="btn btn--round" data-toggle-hidden="data-13a">
				<span class="toggle-option">Yes</span>
				<span class="toggle-option">No</span>
			</label>
		</div>
	</div>
</div>

<div class="col-1 cf {{ Input::old('another-heating-source') == "true" ? '' : 'hidden' }}" data-toggle-hidden-target="data-13a">
	<div class="input-field input-field--hidden cf">
		<div class="col-2">
			<label class="input-field__field-title">Add secondary heating system</label>
			<div class="js-clone-row extra-heating-systems cf">
<!-- 				<select class="input-chosen-select input--rounded-top input--border-bot" name="home-heating-extra-1" placeholder="Select from the following..">
					<option></option>
					<option value="open fire">open fire</option>
					<option value="gas fire">gas fire</option>
					<option value="electric fire">electric fire</option>
					<option value="room wood burner">room wood burner</option>
					<option value="electric underfloor heating">electric underfloor heating</option>
				</select> -->
				<select class="input-chosen-select input--rounded-top input--border-bot" id="home-heating-extra-1" name="home-heating-extra-1" placeholder="Select from the following..">
					@include('common.select-options', array('formField' => "home-heating-extra-1", 'options' => $protoolDefaults['spaceHeatingSystemsSecondary']))
				</select>
			</div>
			<!-- <div class="js-clone-controls">
				<p class="clone-controls__info">Add and remove systems</p>
				<a href="#" class="js-clone-add btn-clone-nav btn-clone"></a>
				<a href="#" class="js-clone-remove btn-clone-nav"></a>
			</div> -->
		</div>
	</div>
</div>

<div class="col-2 cf">
	<div class="input-field light-fittings-field">
		<label for="total-light-fittings" class="input-field__field-title"><span class="input-order-num">14</span>What light fittings do you have?</label>
		<div class="input-number-wrapper input-number-wrapper--right-align cf">
			<input type="text" id="total-light-fittings" class="input-number input--border-bot" name="total-light-fittings" value="{{ Input::old('total-light-fittings') }}">
			<label for="total-light-fittings">Total number of light fittings</label>
		</div>
		<p class="input-field__info">These are fixed light fittings only - don't include lamps etc...</p>
		<div class="input-number-wrapper input-number-wrapper--right-align cf">
			<input type="text" id="low-energy-light-fittings" class="input-number input--border-bot" name="low-energy-light-fittings" value='{{ Input::old('low-energy-light-fittings') }}'>
			<label for="low-energy-light-fittings">Total number of these that are low energy</label>
		</div>
		<p class="input-field__info">
			@if ($pageLocation == "form")
				These are LEDs, compact fluorescents and fluorescent tubes
			@else
				Improve your home’s lighting to see what difference it makes to comfort, carbon and cost.
			@endif
		</p>

	</div>
</div>

<div class="col-2">
	<div class="input-field">
		<div class="input-field__field-title"><span class="input-order-num">15</span>Are most of your appliances A+ rated or better?</div>
		<div class="btn--toggle-wrapper">
			<input name="appliance-rated" type="hidden" value="false" class='js-hidden-for-checkbox'>
			<input id="appliance-rated" class="btn--toggle" name="appliance-rated" type="checkbox" value='true' {{ Input::old('appliance-rated') == "true" ? 'checked' : '' }}>
			<label for="appliance-rated" class="btn btn--round">
				<span class="toggle-option">Yes</span>
				<span class="toggle-option">No</span>
			</label>
		</div>
		<div class="input-field__info">
			@if ($pageLocation == "form")
				Please give an overall average
			@else
				Improve your home’s appliances to see what difference it makes to comfort, carbon and cost.
			@endif
		</div>
	</div>
</div>

<div class="col-2 cf">
	<div class="input-field">
		<div class="input-field__field-title"><span class="input-order-num">16</span>Does your home have solar panels?</div>
		<div class="btn--toggle-wrapper">
			<input name="home-solar" type="hidden" value="false" class='js-hidden-for-checkbox'>
			<input id="home-solar" class="btn--toggle" name="home-solar" type="checkbox" value='true' {{ Input::old('home-solar') == "true" ? 'checked' : '' }}>
			<label for="home-solar" class="btn btn--round" data-toggle-hidden="data-16a">
				<span class="toggle-option">Yes</span>
				<span class="toggle-option">No</span>
			</label>
		</div>

		<p class="input-field__info">
			@if ($pageLocation == "results")
				Add solar panels to your home to see what difference it makes to carbon, comfort and cost. 
			@endif
		</p>
		
	</div>
</div>

<div class="col-1 {{ Input::old('home-solar') == "true" ? '' : 'hidden' }} cf" data-toggle-hidden-target="data-16a">
	<div class="input-field input-field--hidden cf">
		<div class="col-2">
			<label for="home-solar-rating" class="input-field__field-title">If yes, what’s the kwp rating of your system? (If you don’t know this, we will estimate it)</label>
			<select class="input-chosen-select input--rounded-top input--border-bot" id="home-solar-rating" name="home-solar-rating" placeholder="Select from the following..">
				@include('common.select-options', array('formField' => "home-solar-rating", 'options' => $protoolDefaults['solarPanels']))
			</select>
			@if ($errors->has('home-solar-rating')) <p class="input-field__error">{{ $errors->first('home-solar-rating') }}</p> @endif
		</div>
	</div>
</div>