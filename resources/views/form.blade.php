@extends('layouts.master')

@section('title', 'Form')

@section('content')

<div class="page-wrapper--thin">
    <div class="page-title page-title--icon page-title--small-bot-margin">
        <div class="page-title__icon">
            <img src="{{ URL::asset('img/icons/myhome.png') }}" alt="">
        </div>
        <h1>{{ $osAddress->humanReadableAddress()}}, {{ $osAddress->postcode }}</h1>
    </div>
    <div class="page-intro">
        <h2 class="page-sub-title">How energy efficient is your home?</h2>
        <p>
            Answering these questions will help us understand how your home uses energy now. <br />
            Asterisks (*) indicate required fields.
        </p>
    </div>

    <div class="body-copy form-error-list">
        @if (count($errors) > 0)
        <p class='highlighted'>
            There were a few problems with your answers.
        </p>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>


    <form action="/os-addresses/results/{{ $osAddress->osTopoTOID }}">

        {{-- Hidden inputs that we pull from the OS data --}}
        <input type="hidden" name='floor-area' value='{{ $osAddress->singleFloorArea() }}'>
        <input type="hidden" name='external-perimeter' value='{{ $osAddress->externalPerimeter() }}'>
        <input type="hidden" name='altitude' value='{{ $osAddress->height->AbsHMin }}'>
        <input type="hidden" name='roof-height-base' value='{{ $osAddress->height->RelH2 }}'>
        <input type="hidden" name='roof-height-max' value='{{ $osAddress->height->RelHMax }}'>
        <input type="hidden" name='roof-height-max' value='{{ $osAddress->height->RelHMax }}'>

        <div class="grid grid--double-pad cf">
            <div class="form-divider cf">
                <h3>Basic Home Data</h3>
                <div class="form-divider__icon">
                    <img src="{{ URL::asset('img/icons/data.png') }}" alt="">
                </div>
            </div>

            <div class="col-2">
                <div class="input-field">
                    <label for="floor-area-user-modified" class="input-field__field-title"><span class="input-order-num"></span>We have calculated your home's ground floor area to be {{ round($osAddress->singleFloorArea()) }} m<sup>2</sup> using Ordnance Survey data. If you think this looks wrong, please enter an estimate here, otherwise please leave this blank.</label>
                    <div class="input-number-wrapper cf">
                        <input type="text" id="floor-area-user-modified" class="input-number input--border-bot" name="floor-area-user-modified">
                        <label>m<sup>2</sup></label>
                    </div>
                </div>
            </div>

            <div class="col-2">

                <div class="input-field">
                    <label for="build-date" class="input-field__field-title"><span class="input-order-num">1</span>When was your home built?</label>
                    <select class="input-chosen-select input--rounded-top input--border-bot" id="build-date" name="build-date" placeholder="Select from the following..">
                        <option> </option>
                        <option value="pre1900">before 1900</option>
                        <option value="1900-1929">1900-1929</option>
                        <option value="1930-1949">1930-1949</option>
                        <option value="1950-1966">1950-1966</option>
                        <option value="1967-1975">1967-1975</option>
                        <option value="1976-1982">1976-1982</option>
                        <option value="1983-1990">1983-1990</option>
                        <option value="1991-1995">1991-1995</option>
                        <option value="1996-2002">1996-2002</option>
                        <option value="2003-2006">2003-2006</option>
                        <option value="2007-2011">2007-2011</option>
                        <option value="post2012">2012 onwards</option>
                    </select>
                    <p class="input-field__info">This will help us to understand the construction of your home where you're not sure of it.</p>
                </div>
            </div>
            <div class="col-2 cf">
                <div class="input-field">
                    <label for="build-storeys" class="input-field__field-title"><span class="input-order-num">2</span>How many storeys does your home have?*</label>
                    <div class="input-number-wrapper cf">
                        <input type="text" id="build-storeys" class="input-number input--border-bot" name="build-storeys" placeholder="0" value="{{ old('build-storeys') }}">
                        <label for="build-storeys">Storey</label>
                    </div>
                    <p class="input-field__info">Don’t include unheated cellars in this number.</p>
                    @if ($errors->has('build-storeys')) <p class="input-field__error">{{ $errors->first('build-storeys') }}</p> @endif
                </div>
            </div>
            <div class="col-2">
                <div class="input-field">
                    <label class="input-field__field-title"><span class="input-order-num">3</span>Is one of these an attic room or loft conversion?</label>
                    <div class="btn--toggle-wrapper">
                        <input id="loft-conversion" class="btn--toggle" type="checkbox" name="loft-conversion" data-toggle-hidden="data-3a" value='true' {{ old('loft-conversion') == "true" ? 'checked' : '' }}>
                               <label for="loft-conversion" class="btn btn--round">
                            <span class="toggle-option">Yes</span>
                            <span class="toggle-option">No</span>
                        </label>
                    </div>
                    <p class="input-field__info">This is where the room sits within the roofspace - and usually has a sloping ceiling as a result.</p>
                </div>
            </div>


            <div class="col-2 cf">
                <div class="input-field">
                    <label class="input-field__field-title"><span class="input-order-num">4</span>Is your home a flat or apartment?</label>
                    <div class="btn--toggle-wrapper">
                        <input id="flat-or-apartment" class="btn--toggle" name="flat-or-apartment" type="checkbox" value='true' {{ old('flat-or-apartment') == "true" ? 'checked' : '' }}>						
                         <!--<input id="flat-or-apartment" class="btn--toggle" name="flat-or-apartment" type="checkbox" value="{{ old('flat-or-apartment') }}"> -->
                               <label for="flat-or-apartment" class="btn btn--round" data-toggle-hidden="data-4a-4b">
                            <span class="toggle-option">Yes</span>
                            <span class="toggle-option">No</span>
                        </label>
                    </div>
                </div>
            </div>


            <div class="col-1 hidden cf" data-toggle-hidden-target="data-3a">
                <div class="input-field input-field--hidden cf">
                    <div class="col-2">
                        <label for="loft-conversion-date" class="input-field__field-title">When was this attic space or loft conversion built or last refurbished?</label>
                        <select class="input-chosen-select input--rounded-top input--border-bot" id="loft-conversion-date" name="loft-conversion-date" placeholder="Select from the following..">
                            <option> </option>
                            <option value="before 1966 (no insulation)">before 1966 (no insulation)</option>
                            <option value="1967-1982 (50mm insulation)">1967-1982 (50mm insulation)</option>
                            <option value="1983-1990 (100mm insulation)">1983-1990 (100mm insulation)</option>
                            <option value="1991-2002 (150mm insulation)">1991-2002 (150mm insulation)</option>
                            <option value="2003 onwards (270mm insulation)">2003 onwards (270mm insulation)</option>
                            <option value="dont know">dont know</option>
                        </select>
                        <p class="input-field__info">We're interested in this because it will help tell us the likely level of insulation here. You can also choose based on your knowlege of the insulation here. </p>
                    </div>
                </div>
            </div>

            <div class="col-1 hidden cf" data-toggle-hidden-target="data-4a-4b">
                <div class="input-field input-field--hidden cf">
                    <div class="col-2">
                        <label class="input-field__field-title">Are there any apartments above you?</label>
                        <div class="btn--toggle-wrapper">
                                <!--<input name="flat-or-apartment-above" type="hidden" value="{{ old('flat-or-apartment-above')}}" class='js-hidden-for-checkbox'>-->
                            <input id="flat-or-apartment-above" class="btn--toggle" name="flat-or-apartment-above" type="checkbox" value='true' {{ old('flat-or-apartment-above') == "true" ? 'checked' : '' }}>
                                   <label for="flat-or-apartment-above" class="btn btn--round" data-toggle-hidden="apartment-above">
                                <span class="toggle-option">Yes</span>
                                <span class="toggle-option">No</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-2">
                        <label class="input-field__field-title">Are there any apartments below you?</label>
                        <div class="btn--toggle-wrapper">
                                <!--<input name="flat-or-apartment-below" type="hidden" value="{{ old('flat-or-apartment-below')}}" class='js-hidden-for-checkbox'>-->
                            <input id="flat-or-apartment-below" class="btn--toggle" name="flat-or-apartment-below" type="checkbox" value='true' {{ old('flat-or-apartment-below') == "true" ? 'checked' : '' }}>
                                   <label for="flat-or-apartment-below" class="btn btn--round" data-toggle-hidden="apartment-below">
                                <span class="toggle-option">Yes</span>
                                <span class="toggle-option">No</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    console.log($('input#flat-or-apartment').attr('checked'))
                    if ($('input#flat-or-apartment').attr('checked') === 'checked')
                        $('[data-toggle-hidden-target="data-4a-4b"]').removeClass('hidden');
                });
            </script>

            <div class="form-divider cf">
                <h3>Fabric and Construction</h3>
                <div class="form-divider__icon">
                    <img src="{{ URL::asset('img/icons/insulation.png') }}" alt="">
                </div>
            </div>

            <div class="col-2">
                <div class="input-field">
                    <label for="wall-material" class="input-field__field-title"><span class="input-order-num">5</span>How are the walls of your home built?*</label>
                    <select class="input-chosen-select input--rounded-top input--border-bot" id="wall-material" name="wall-material" placeholder="Select from the following..">
                        @include('common.select-options', array('formField' => 'wall-material', 'options' => $protoolDefaults['wallTypes']))
                    </select>
                    <p class="input-field__info">If you're not sure about this we will estimate based on the age of your home</p>
                    @if ($errors->has('wall-material')) <p class="input-field__error">{{ $errors->first('wall-material') }}</p> @endif
                </div>
            </div>

            @include('form-sections.fabric',  array('pageLocation' => 'form'))

            <div class="form-divider cf">
                <h3>Services</h3>
                <div class="form-divider__icon">
                    <img src="{{ URL::asset('img/icons/services.png') }}" alt="">
                </div>
            </div>

            @include('form-sections.services', array('pageLocation' => 'form'))

            <div class="form-divider cf">
                <h3>Current Energy Use</h3>
                <div class="form-divider__icon">
                    <img src="{{ URL::asset('img/icons/energy.png') }}" alt="">
                </div>
            </div>

            @include('form-sections.energy')

            <div class="form-divider cf">
                <h3>Your Priorities</h3>
            </div>

            <div class="col-2 cf">
                <div class="input-field">
                    <label class="input-field__field-title"><span class="input-order-num">18</span>Place these 3 items in order of priority for you:</label>
                    <ul id="simpleList" class="list-group">
                        <li class="list-group-item cf">
                            <p>Save Carbon</p>
                            <div class="right-align radio-group">
                                <div class="number-label">
                                    <input type="radio" name="preference-carbon" id="carbon-1" value="1" checked>
                                    <label for="carbon-1">1</label>
                                </div>
                                <div class="number-label">
                                    <input type="radio" name="preference-carbon" id="carbon-2" value="2">
                                    <label for="carbon-2">2</label>
                                </div>
                                <div class="number-label">
                                    <input type="radio" name="preference-carbon" id="carbon-3" value="3">
                                    <label for="carbon-3">3</label>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item cf">
                            <p>Reduce Bills</p>
                            <div class="right-align radio-group">
                                <div class="number-label">
                                    <input type="radio" name="preference-cost" id="cost-1" value="1">
                                    <label for="cost-1">1</label>
                                </div>
                                <div class="number-label">
                                    <input type="radio" name="preference-cost" id="cost-2" value="2" checked>
                                    <label for="cost-2">2</label>
                                </div>
                                <div class="number-label">
                                    <input type="radio" name="preference-cost" id="cost-3" value="3">
                                    <label for="cost-3">3</label>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item cf">
                            <p>Improve Comfort</p>
                            <div class="right-align radio-group">
                                <div class="number-label">
                                    <input type="radio" name="preference-comfort" id="comfort-1" value="1">
                                    <label for="comfort-1">1</label>
                                </div>
                                <div class="number-label">
                                    <input type="radio" name="preference-comfort" id="comfort-2" value="2">
                                    <label for="comfort-2">2</label>
                                </div>
                                <div class="number-label">
                                    <input type="radio" name="preference-comfort" id="comfort-3" value="3" checked>
                                    <label for="environment-3">3</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <button type="submit" title="Submit Form" class="btn btn--arrow btn--highlighted js-form-submit">Submit Form</button>
        <div class="reset-nav">
            <a href="#" class="js-return reset-nav__back">Back</a>
            <a href="/" class="reset-nav__reset">Start Again</a>
        </div>
    </form>
</div>

@stop