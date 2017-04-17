{{--

	Comments are only there to make it easier to find components.
	Don't copy the comments over, and the components shouldn't contain
	any style guide specific markup.

	TODO: Add in title styles.
	TODO: Add in subtitle styles with line accent.

---}}

@extends('layouts.master')

@section('title', 'Style Guide')

@section('content')


<div class="page-wrapper">
	<div class="style-guide">
		<div class="style-guide__typography">
			<h2 class="style-guide__title">Typography</h2>
			<div class="body-copy">
				<h1>h1: Both sides now: It was the best of times, it was the worst of times?</h1>
				<h2>h2: Both sides now: It was the best of times, it was the worst of times?</h2>
				<h3>h3: Both sides now: It was the best of times, it was the worst of times?</h3>

				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est <a href="#">laborum</a>.
				</p>
			</div>
			<div class="grid cf">
				<div class="col-2">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est <a href="#">laborum</a>.
				</p>
				</div>
				<div class="col-2">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est <a href="#">laborum</a>.
				</p>
				</div>
			</div>
		</div>
		<div class="style-guide__color-palette">
			<h2 class="style-guide__title">Color Palette</h2>
			<div class="grid cf">
				<div class="col-4">
					<div class="color-swatch"></div>
				</div>
				<div class="col-4">
					<div class="color-swatch"></div>
				</div>
				<div class="col-4">
					<div class="color-swatch"></div>
				</div>
				<div class="col-4">
					<div class="color-swatch"></div>
				</div>
			</div>
		</div>
		<div class="style-guide__form-buttons">
			<h2 class="style-guide__title">Button Options</h2>
			<div class="grid cf style-guide__buttons">
				<div class="col-5">
					{{-- Basic Button (highlighted) --}}
					<button href="#" class="btn btn--basic btn--highlighted">Basic Button</button>
					{{-- End Basic Button --}}
				</div>
				<div class="col-5">
					{{-- Arrow Button (highlighted) --}}
					<a href="#" class="btn btn--arrow btn--highlighted">Arrow Button</a>
					{{-- End Arrow Button --}}
				</div>
				<div class="col-5">
					{{-- Basic Round Button --}}
					<a href="#" class="btn btn--round btn--highlighted">More Info Button</a>
					{{-- End Basic Round Button --}}
				</div>
				<div class="col-5">
					{{-- Icon Button --}}
					<a href="#" class="btn btn--round btn--icon btn--icon-print">Print</a>
					{{-- End Icon Button --}}
				</div>
				<div class="col-5">
					{{-- Toggle Button (Same as form) --}}
					<div class="btn--toggle-wrapper">
					  <input id="toggle-id" class="btn--toggle" type="checkbox">
					  <label for="toggle-id" class="btn btn--round">
					  	<span class="toggle-option">Yes</span>
					  	<span class="toggle-option">No</span>
					  </label>
					</div>
					{{-- End Toggle Button --}}
				</div>
			</div>
		</div>
		<div class="style-guide__search-field cf">
			<h2 class="style-guide__title">Search Field</h2>
			{{-- Search Field Input + Button --}}
			<form class="search-field">
				<input type="text" class="search__input">
				<button class="search__btn">Search</button>
			</form>
			{{-- End Search Field--}}
		</div>
		<div class="style-guide__modal-examples">
			<h2 class="style-guide__title">Modals</h2>
			{{-- Modal Example (with trigger mechanism) --}}
			<a href="#" class="btn btn--basic btn--highlighted" data-modal-trigger="test-modal">Show Modal</a>
			<div class="modal" data-modal-id="test-modal">
				<h3 class="modal__title">Modal Title</h3>
				<div class="body-copy">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis temporibus nostrum porro labore dolorem illum officiis excepturi error alias architecto repellendus, maxime iure maiores tempora a voluptate eaque dolor! Ipsam!</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi consequatur perferendis eaque, totam dolorem. Ea!</p>
				</div>
				<a href="#" class="btn btn--round btn--highlighted modal-close">Close</a>
			</div>
			{{-- End Modal Example--}}
		</div>
		<div class="style-guide__form-fields">
			<h2 class="style-guide__title">Form Field Options</h2>
			<form action="#">
				{{-- Form Divider (icon) --}}
				<div class="form-divider">
					<h3>Form Section Title</h3>
					<div class="form-divider__icon">
						<img src="{{ URL::asset('img/icons/insulation.png') }}" alt="">
					</div>
				</div>
				{{-- End Form Divider --}}
				{{-- Form Divider (square icon, just so you can see the effects of background sizing better than with just a tall one) --}}
				<div class="form-divider">
					<h3>Form Section Title Alt Icon</h3>
					<div class="form-divider__icon">
						<img src="{{ URL::asset('img/icons/services.png') }}" alt="">
					</div>
				</div>
				{{-- End Form Divider --}}
				{{-- Form Divider (no icon) --}}
				<div class="form-divider">
					<h3>Form Section Title No Icon</h3>
				</div>
				{{-- End Form Divider --}}
				<div class="grid cf">
					<div class="col-2">
						{{-- Basic Text Field --}}
						<div class="input-field">
							<label for="text-id" class="input-field__field-title"><span class="input-order-num">1</span>Basic Text Input</label>
							<input class="input-basic-text input--rounded-top input--border-bot" id="text-id" type="text" placeholder="Enter number">
						</div>
						{{-- End Basic Text Field --}}
					</div>
					<div class="col-2">
						{{-- Select Field --}}
						<div class="input-field">
							<label for="select-id" class="input-field__field-title"><span class="input-order-num">2</span>Single Select Dropdown</label>
							<select class="input-chosen-select input--rounded-top input--border-bot" id="select-id" placeholder="Select from the following..">
								<option> </option>
								<option value="#">a) built before 1983</option>
								<option value="#">b) built 1984-1996</option>
								<option value="#">b) built 1984-1996</option>
								<option value="#">a) built before 1983</option>
							</select>
						</div>
						{{-- End Select Field --}}
					</div>

					<div class="col-2">
						{{-- Number Fields --}}
						<div class="input-field">
							<label for="number-id" class="input-field__field-title"><span class="input-order-num">3</span>Number Inputs</label>
							<div class="input-number-wrapper cf">
								<input type="text" id="number-id" class="input-number input--border-bot" placeholder="2">
								<label for="number-id">Number</label>
							</div>
							<div class="input-number-wrapper cf">
								<input type="text" id="number-id" class="input-number input--border-bot" placeholder="2">
								<label for="number-id">Number</label>
							</div>
							<div class="input-number-wrapper cf">
								<input type="text" id="number-id" class="input-number input--border-bot" placeholder="2">
								<label for="number-id">Number</label>
							</div>
						</div>
						{{-- End Number Fields --}}
					</div>
					<div class="col-2">
						{{-- Checkbox Field --}}
						<div class="input-field">
							<label class="input-field__field-title"><span class="input-order-num">4</span>Tick Checkbox Inputs</label>
							<div class="input-checkbox-wrapper">
								<div class="checkbox-label-wrapper">
									<input id="checkbox-id-1" type="checkbox" value="">
									<label for="checkbox-id-1" class="checkbox--tick"></label>
								</div>
								<label for="checkbox-id-1">Tick selection</label>
							</div>
							<div class="input-checkbox-wrapper">
								<div class="checkbox-label-wrapper">
									<input id="checkbox-id-2" type="checkbox" value="">
									<label for="checkbox-id-2" class="checkbox--tick"></label>
								</div>
								<label for="checkbox-id-2">Tick selection</label>
							</div>
							<div class="input-checkbox-wrapper">
								<div class="checkbox-label-wrapper">
									<input id="checkbox-id-3" type="checkbox" value="">
									<label for="checkbox-id-3" class="checkbox--tick"></label>
								</div>
								<label for="checkbox-id-3">Tick selection</label>
							</div>
							<p class="input-field__info">We’re interested in this because it will help tell us the likely level of insulation here.</p>
						</div>
						{{-- End Checkbox Field--}}
					</div>
					<div class="col-2">
						{{-- Toggle Field--}}
						<div class="input-field">
							<label class="input-field__field-title"><span class="input-order-num">5</span>Toggle Switch Input</label>
							<div class="btn--toggle-wrapper">
								<input id="toggle-id-2" class="btn--toggle" type="checkbox">
								<label for="toggle-id-2" class="btn btn--round">
									<span class="toggle-option">Yes</span>
									<span class="toggle-option">No</span>
								</label>
							</div>
						</div>
						{{-- End Toggle Field--}}
					</div>
					<div class="col-2">
						{{-- Orderable List Field (now with radiobuttons!)--}}
						<div class="input-field">
							<label class="input-field__field-title"><span class="input-order-num">6</span>Orderable List Input</label>
							<ul id="simpleList" class="list-group">
							    <li class="list-group-item cf">
							    	<p>Carbon</p>
							    	<div class="right-align radio-group">
										<div class="number-label">
											<input type="radio" name="carbon" id="carbon-1" value="1" checked>
											<label for="carbon-1">1</label>
										</div>
										<div class="number-label">
											<input type="radio" name="carbon" id="carbon-2" value="2">
											<label for="carbon-2">2</label>
										</div>
										<div class="number-label">
											<input type="radio" name="carbon" id="carbon-3" value="3">
											<label for="carbon-3">3</label>
										</div>
									</div>
							    </li>
							    <li class="list-group-item cf">
							    	<p>Cost</p>
							    	<div class="right-align radio-group">
										<div class="number-label">
											<input type="radio" name="cost" id="cost-1" value="1">
											<label for="cost-1">1</label>
										</div>
										<div class="number-label">
											<input type="radio" name="cost" id="cost-2" value="2" checked>
											<label for="cost-2">2</label>
										</div>
										<div class="number-label">
											<input type="radio" name="cost" id="cost-3" value="3">
											<label for="cost-3">3</label>
										</div>
									</div>
							    </li>
							    <li class="list-group-item cf">
							    	<p>Environment</p>
							    	<div class="right-align radio-group">
										<div class="number-label">
											<input type="radio" name="environment" id="environment-1" value="1">
											<label for="environment-1">1</label>
										</div>
										<div class="number-label">
											<input type="radio" name="environment" id="environment-2" value="2">
											<label for="environment-2">2</label>
										</div>
										<div class="number-label">
											<input type="radio" name="environment" id="environment-3" value="3" checked>
											<label for="environment-3">3</label>
										</div>
									</div>
							    </li>
							</ul>
						</div>
						{{-- End Orderable List Field--}}
					</div>
					<div class="col-2">
						{{-- Basic Text Field (with info text) --}}
						<div class="input-field">
							<label for="text-id-2" class="input-field__field-title"><span class="input-order-num">7</span>Basic Text Input with info text</label>
							<input class="input-basic-text input--rounded-top input--border-bot" id="text-id-2" type="text" placeholder="Enter number">
							<p class="input-field__info">We’re interested in this because it will help tell us the likely level of insulation here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, possimus quibusdam ipsam provident assumenda deleniti accusamus, ratione hic dolorem similique!</p>
						</div>
						{{-- End Basic Text Field --}}
					</div>
					<div class="col-2">
					{{-- Hidden content toggle, specify target class with heating-5a, toggles the .hidden class --}}
						<div class="input-field">
							<label class="input-field__field-title"><span class="input-order-num">5</span>Toggle Hidden Content.</label>
							<div class="btn--toggle-wrapper">
								<input id="toggle-id-3" class="btn--toggle" type="checkbox">
								<label for="toggle-id-3" class="btn btn--round" data-toggle-hidden="heating-5a">
									<span class="toggle-option">Yes</span>
									<span class="toggle-option">No</span>
								</label>
							</div>
						</div>
					{{-- End hidden content toggle --}}
					</div>
				</div>
				{{-- Hidden content needs to be in its own grid/row or it breaks the float clears --}}
				<div class="grid">
					<div class="col-1 hidden" data-toggle-hidden-target="heating-5a">
						<div class="input-field input-field--hidden">
							<label for="text-id-3" class="input-field__field-title">5a. Basic Text Input with info text</label>
							<input class="input-basic-text input--rounded-top input--border-bot" id="text-id-3" type="text" placeholder="Enter number">
							<p class="input-field__info">We’re interested in this because it will help tell us the likely level of insulation here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, possimus quibusdam ipsam provident assumenda deleniti accusamus, ratione hic dolorem similique!</p>
						</div>
					</div>
				</div>
				{{-- End hidden content --}}
				<div class="grid">
					<div class="col-2">
						<div class="input-field">
							<label for="text-id" class="input-field__field-title"><span class="input-order-num">6</span>Demonstrating Hidden Field Reveal</label>
							<input class="input-basic-text input--rounded-top input--border-bot" id="text-id" type="text" placeholder="Enter number">
						</div>
					</div>
					<div class="col-2">
						<div class="input-field">
							<label for="text-id" class="input-field__field-title"><span class="input-order-num">7</span>Demonstrating Hidden Field Reveal</label>
							<input class="input-basic-text input--rounded-top input--border-bot" id="text-id" type="text" placeholder="Enter number">
						</div>
					</div>
				</div>
				<button type="submit" title="Submit Form" class="btn  btn--arrow btn--highlighted">Submit Form</button>
				{{-- Form reset field --}}
				<div class="reset-nav">
					<a href="#" class="js-return reset-nav__back">Back</a>
					<a href="/" class="reset-nav__reset">Start Again</a>
				</div>
				{{-- End Form reset field --}}
			</form>
		</div>
	</div>
</div>
@stop