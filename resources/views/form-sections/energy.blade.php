<div class="col-1 cf">
	<div class="input-field energy-use-wrapper">
		<div class="col-2"><label class="input-field__field-title"><span class="input-order-num">17</span>How much energy does your home use now?</label></div>
		<div class="col-2 "><label class="input-field__field-title">Enter the figures for fuel type</label></div>

		<div class="js-clone-row energy-use cf">
			<div class="col-2">
				<select class="input-chosen-select input--rounded-top input--border-bot" name="fuel-type-1" placeholder="Select from the following..">
					<option value="electric_annual_kwh">Electric</option>
				</select>
			</div>
			<div class="col-2">
				<div class="input-number-wrapper cf">
					<input type="text" class="input-number input--border-bot input-number--wide" id="electricity-usage" name="electricity-usage" placeholder="0" value="{{ old('electricity-usage') }}">
					<label>kWh</label>
				</div>
			</div>
		</div>
		<div class="js-clone-row energy-use cf">
			<div class="col-2">
				<select class="input-chosen-select input--rounded-top input--border-bot" name="fuel-type-2" placeholder="Select from the following..">
					<option value="gas_annual_m3">Gas</option>
				</select>
			</div>
			<div class="col-2">
				<div class="input-number-wrapper cf">
					<input type="text" class="input-number input--border-bot input-number--wide" id="gas-usage" name="gas-usage" placeholder="0" value="{{ old('gas-usage') }}">
					<label>kWh</label>
				</div>
			</div>
		</div>
		<!-- <div class="col-2 js-clone-controls">
			<p class="clone-controls__info">Add and remove systems</p>
			<a href="#" class="js-clone-add btn-clone-nav btn-clone"></a>
			<a href="#" class="js-clone-remove btn-clone-nav"></a>
		</div> -->
		<div class="col-2">
			<p class="input-field__info">These figures can be found on your utility bills. We need the total amount of energy you used in kilowatt hours in a single year.</p>
		</div>

	</div>
</div>