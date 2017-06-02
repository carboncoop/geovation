@extends('layouts.master')

@section('title', 'Results')

@section('content')

<div class="page-wrapper--thin">
    <div class="page-title page-title--icon page-title--small-bot-margin">
        <div class="page-title__icon">
            <img src="{{ URL::asset('img/icons/results.png') }}" alt="">
        </div>
        <h1>My Home Energy Results</h1>
    </div>
    <div class="page-intro">
        <h2 class="page-sub-title">{{ $osAddress->humanReadableAddress()}}, {{ $osAddress->postcode }}</h2>
    </div>
</div>

<div class="page-wrapper">
    <div class="grid cf grid--two-col">
        <div class="col-2">
            <div class="house-illustration">
                <a data-modal-trigger="fabric-modal" data-info-ref="insulation-info" href="#" class="house-illustration__icon--insulation">
                    <img src="{{ URL::asset('img/icons/insulation.png') }}" alt="">
                    <img src="{{ URL::asset('img/icons/insulation-white.png') }}" class="white-hover" alt="">
                </a>
                <a data-modal-trigger="services-modal" data-info-ref="services-info" href="#" class="house-illustration__icon--services">
                    <img src="{{ URL::asset('img/icons/services.png') }}" alt="">
                    <img src="{{ URL::asset('img/icons/services-white.png') }}" class="white-hover" alt="">
                </a>
                <!-- <a data-modal-trigger="roof-modal" data-info-ref="data-info" href="#" class="house-illustration__icon--data">
                        <img src="{{ URL::asset('img/icons/data.png') }}" alt="">
                        <img src="{{ URL::asset('img/icons/data-white.png') }}" class="white-hover" alt="">
                </a> -->
                <a data-modal-trigger="energy-modal" data-info-ref="energy-info" href="#" class="house-illustration__icon--energy">
                    <img src="{{ URL::asset('img/icons/energy.png') }}" alt="">
                    <img src="{{ URL::asset('img/icons/energy-white.png') }}" class="white-hover" alt="">
                </a>
                <img src="{{ URL::asset('img/house-illustration.svg') }}" alt="">
            </div>

            <div class="house-illustration-info body-copy insulation-info">
                <b>Fabric/Insulation:</b>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum optio aperiam sapiente laboriosam quaerat dolor cumque. Blanditiis veniam rerum odio!</p>
            </div>
            <div class="house-illustration-info body-copy services-info">
                <b>Services:</b>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi possimus, blanditiis laboriosam temporibus quo nulla vitae debitis soluta impedit. Aliquam.</p>
            </div>
            <div class="house-illustration-info body-copy data-info">
                <b>Home Data:</b>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, doloremque facere sequi labore officia delectus in qui assumenda voluptas, eius.</p>
            </div>
            <div class="house-illustration-info body-copy energy-info">
                <b>Current Energy Use:</b>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas id, iste repellendus cumque voluptates dolores sequi. Rerum cupiditate quo, optio?</p>
            </div>
        </div>
        <div class="col-2 results-graphs">
            <div class="body-copy home-instructions">
                <p><b>Instructions:</b> The graphs here show the results for your home. Adjust the different aspects of its construction and services to see what changes you can make.</p>
            </div>

            @foreach ($resultsData['preferences'] as $preference)
            @include('graphs.' . $preference, array('resultsData' => $resultsData ))
            @endforeach

        </div>
    </div>
    <div class="ctext overview-sharing body-copy body-copy--dbl-margin">
        <a href="#" class="btn btn--basic btn--highlighted">Email my results</a>
        <p>You can share or print your My Home Energy results</p>
        <a href="#" class="btn btn--round btn--icon btn--icon-print">Share</a>
        <a href="#" class="btn btn--round btn--icon btn--icon-print">Print</a>
    </div>
    <a href="/overview" class="btn btn--basic btn--highlighted  find-out-more">Find out more</a>
    <div class="reset-nav">
        <a href="#" class="js-return reset-nav__back">Back</a>
        <a href="/" class="reset-nav__reset">Start Again</a>
        <a href="mailto:email-me@my-email.org?Subject=MyHomeEnergySalford results&body={{  $results_summary_for_email }}" class="reset-nav__reset">Email my results</a>
        <span style="color:rgb(149, 149, 149);padding-left:25px;">Share on</span>
        <a target='blank' href="https://www.facebook.com/dialog/share?app_id=616700828538791&href={{Request::url()}}"><img src='{{ URL::asset('img/fb-icon.png') }}' style="width:15px"></a>
        <img src='{{ URL::asset('img/twitter-icon.png') }}' style="width:15px;margin-left:15x">
        <a href="#" class="" onclick="window.print()" style="color:rgb(149, 149, 149);padding-left:25px; text-decoration: none"><img src='{{ URL::asset('img/print-icon.svg') }}' style="width:15px"> Print</a>
        <a href="#" onclick="fb_share(); return(false)">Share FB</a>
    </div>

<script>
    function fb_share(){
        window.open("https://www.facebook.com/dialog/feed?app_id=616700828538791&caption=hola&link=http%3A%2F%2Fmyhomeenergysalford.carbon.coop%2F&redirect_uri=http%3A%2F%2Fmyhomeenergysalford.carbon.coop%2F","Share My Home Energy Saldford", "height=236, width=516");
    }
</script>    


</div>

<div class="modal" data-modal-id="fabric-modal">
    <form action="#">
        <div class="grid grid--double-pad cf">
            <div class="form-divider cf">
                <h3>Fabric and Construction</h3>
                <div class="form-divider__icon form-divider__icon--modal">
                    <img src="{{ URL::asset('img/icons/insulation.png') }}" alt="">
                </div>
            </div>

            @include('form-sections.fabric',  array('pageLocation' => 'results'))

        </div>
    </form>
    <a href="#" class="btn btn--round btn--highlighted modal-save">Update</a>
    <a href="#" class="btn btn--round btn modal-close">Cancel</a>
</div>

<div class="modal" data-modal-id="services-modal">
    <form action="#">
        <div class="grid grid--double-pad cf">
            <div class="form-divider cf">
                <h3>Services</h3>
                <div class="form-divider__icon form-divider__icon--modal">
                    <img src="{{ URL::asset('img/icons/insulation.png') }}" alt="">
                </div>
            </div>

            @include('form-sections.services', array('pageLocation' => 'results'))

        </div>
    </form>
    <a href="#" class="btn btn--round btn--highlighted modal-save">Update</a>
    <a href="#" class="btn btn--round btn modal-close">Close</a>
</div>

<div class="modal" data-modal-id="energy-modal">
    <form action="#">
        <div class="grid grid--double-pad cf">
            <div class="form-divider cf">
                <h3>Energy</h3>
                <div class="form-divider__icon form-divider__icon--modal">
                    <img src="{{ URL::asset('img/icons/energy.png') }}" alt="">
                </div>
            </div>

            @include('form-sections.energy')

        </div>
    </form>
    <a href="#" class="btn btn--round btn--highlighted modal-save">Update</a>
    <a href="#" class="btn btn--round btn modal-close">Close</a>
</div>

<div class="modal" data-modal-id="roof-modal">
    <form action="#">
        <div class="grid grid--double-pad cf">
            <div class="form-divider cf">
                <h3>Roof</h3>
                <div class="form-divider__icon form-divider__icon--modal">
                    <img src="{{ URL::asset('img/icons/insulation.png') }}" alt="">
                </div>
            </div>

            <div class="col-2">
                <div class="input-field">
                    <label for="loft-insulation" class="input-field__field-title"><span class="input-order-num">9</span>How deep in the insulation in your loft?</label>
                    <select class="input-chosen-select input--rounded-top input--border-bot" id="loft-insulation" name="loft-insulation" placeholder="Select from the following..">
                        @include('common.select-options', array('formField' => "loft-insulation", 'options' => $protoolDefaults['loftInsulation']))
                        <option value="unknown">don't know.</option>
                    </select>

                    <p class="input-field__info">If you're not sure about this we will estimate based on the age of your home</p>
                </div>
            </div>
        </div>
    </form>
    <a href="#" class="btn btn--round btn--highlighted modal-save">Update</a>
    <a href="#" class="btn btn--round btn modal-close">Close</a>
</div>

<script>
    var results = <?php echo json_encode($resultsData); ?>;
</script>

<iframe name="fb-iframe" style="width:800px; height:800px;" src="https://www.facebook.com/dialog/feed?app_id=616700828538791&caption=hola&link=http%3A%2F%2Fmyhomeenergysalford.carbon.coop%2F&redirect_uri=http%3A%2F%2Fmyhomeenergysalford.carbon.coop%2F"></iframe>
@stop

