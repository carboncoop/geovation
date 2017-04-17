<div class="col-2 {{ ($pageLocation == 'results') ? 'hidden' : '' }}">
	<div class="input-field extra-row-numbers">
		<label class="input-field__field-title"><span class="input-order-num">6</span>Please enter the number of windows you have and the direction they face.</label>
		<div class="input-number-wrapper cf">
			<input type="text" id="windows-north" class="input-number input--border-bot" name="windows-north" placeholder="0" value="{{ old('windows-north') }}">
			<label for="windows-north">North-East to North-West</label>
		</div>
		<div class="input-number-wrapper cf">
			<input type="text" id="windows-south" class="input-number input--border-bot" name="windows-south" placeholder="0" value="{{ old('windows-south') }}">
			<label for="windows-south">South-East to South-West</label>
		</div>
		<div class="input-number-wrapper cf">
			<input type="text" id="windows-east-west" class="input-number input--border-bot" name="windows-east-west" placeholder="0" value="{{ old('windows-east-west') }}">
			<label for="windows-east-west">East or West</label>
		</div>
		<p class="input-field__info">You should include any glazed or patio doors in these numbers.</p>
	</div>
</div>
<div class="col-2 cf">
	<div class="input-field">
		<label for="window-type" class="input-field__field-title"><span class="input-order-num">7</span>What type of windows do you have?</label>
		<select class="input-chosen-select input--rounded-top input--border-bot" id="window-type" name="window-type" placeholder="Select from the following..">
			@include('common.select-options', array('formField' => "window-type", 'options' => $protoolDefaults['windowTypes']))
		</select>
		<p class="input-field__info">
			@if ($pageLocation == "form")
				If you're not sure about this we will estimate based on the age of your home
			@else
				@if ($request["window-type"] == "unknown")
					Based on the age of your home, we have estimated this to be "{{ $selectedOptionTitles["window-type"] }}".
				@endif
				Choose different windows for your home and see what difference it makes to carbon, cost and comfort.
			@endif
		</p>
		@if ($errors->has('window-type')) <p class="input-field__error">{{ $errors->first('window-type') }}</p> @endif
	</div>
</div>
<div class="col-2 {{ Input::old('flat-or-apartment-above') == "true" ? 'hidden' : '' }} " data-toggle-hidden-target="apartment-above">
	<div class="input-field">
		<label for="loft-insulation" class="input-field__field-title"><span class="input-order-num">9</span>How deep in the insulation in your loft?*</label>
		<select class="input-chosen-select input--rounded-top input--border-bot" id="loft-insulation" name="loft-insulation" placeholder="Select from the following..">
			@include('common.select-options', array('formField' => "loft-insulation", 'options' => $protoolDefaults['loftInsulation']))
		</select>
		<p class="input-field__info">
			@if ($pageLocation == "form")
				If you're not sure about this we will estimate based on the age of your home. If the depth varies across your loft, choose the closest average figure.
			@else
				@if ($request["loft-insulation"] == "unknown")
					Based on the age of your home, we have estimated this to be "{{ $selectedOptionTitles["loft-insulation"] }}".
				@endif
				Increase the amount of insulation in your loft and see what difference it makes to carbon, comfort and cost.
			@endif
		</p>
		@if ($errors->has('loft-insulation')) <p class="input-field__error">{{ $errors->first('loft-insulation') }}</p> @endif
	</div>
</div>
<div class="col-2 {{ Input::old('flat-or-apartment-below') == "true" ? 'hidden' : '' }} " data-toggle-hidden-target="apartment-below">
	<div class="input-field">
		<label for="floor-insulation" class="input-field__field-title"><span class="input-order-num">10</span>How much insulation is there in your floor?*</label>
		<select class="input-chosen-select input--rounded-top input--border-bot" id="floor-insulation" name="floor-insulation" placeholder="Select from the following..">
			@include('common.select-options', array('formField' => "floor-insulation", 'options' => $protoolDefaults['floorInsulationTypes']))
		</select>
		<p class="input-field__info">
			@if ($pageLocation == "form")
				If you're not sure about this we will estimate based on the area age of your home. If the amount of insulation varies across your floor, choose the closest average figure.
			@else
				@if ($request["floor-insulation"] == "unknown")
					Based on the age of your home, we have estimated this to be "{{ $selectedOptionTitles["floor-insulation"] }}".
				@endif
				Increase the amount of insulation in your floor and see what difference it makes to carbon, comfort and cost.
			@endif
			
		</p>
		@if ($errors->has('floor-insulation')) <p class="input-field__error">{{ $errors->first('floor-insulation') }}</p> @endif
	</div>
</div>
<div class="col-2">
	<div class="input-field">
		<label for="home-draughts" class="input-field__field-title"><span class="input-order-num">11</span>How draughty is your home?*</label>
		<select class="input-chosen-select input--rounded-top input--border-bot" id="home-draughts" name="home-draughts" placeholder="Select from the following..">
			@include('common.select-options', array('formField' => "home-draughts", 'options' => $protoolDefaults['ventilation']['airPermeabilityValues']))
		</select>
		<p class="input-field__info">
			@if ($pageLocation == "form")
				This will help us to estimate how much heat is lost from your home in draughts.
			@else
				@if ($request["home-draughts"] == "unknown")
					Based on the age of your home, we have estimated this to be "{{ $selectedOptionTitles["home-draughts"] }}".
				@endif
				Make your home more draught-proof and see what difference it makes to carbon, comfort and cost.
			@endif
		</p>
		@if ($errors->has('home-draughts')) <p class="input-field__error">{{ $errors->first('home-draughts') }}</p> @endif
	</div>
</div>
