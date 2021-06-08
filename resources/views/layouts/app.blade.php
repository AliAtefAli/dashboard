<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('site.Awamer System'))</title>
    <link rel="apple-touch-icon" href="@if(isset($setting['favicon'])){{asset('assets/uploads/settings/' . $setting['favicon'] )}} @else {{ asset('assets/dashboard//app-assets/images/ico/favicon.ico') }} @endif">
    <link rel="shortcut icon" type="image/x-icon" href="@if(isset($setting['logo'])){{asset('assets/uploads/settings/' . $setting['favicon'] )}} @else {{ asset('assets/dashboard//app-assets/images/ico/favicon.ico') }} @endif">
    <link rel="shortcut icon" type="image/png" href="@if(isset($setting['logo'])){{asset('assets/uploads/settings/' . $setting['favicon'] )}} @else {{ asset('assets/dashboard//app-assets/images/ico/favicon.ico') }} @endif"/>


    <!-- Styles -->
    <link href="{{ asset('assets/web/styles/includes/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/styles/includes/font-awesome-5all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/styles/includes/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/styles/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/styles/style.css') }}" rel="stylesheet">
    <style>
        label.error {
            color: red;
            font-size: 1rem;
            display: block;
            margin-top: 5px;
        }

        input.error {
            border: 1px dashed red;
            font-weight: 300;
            color: red;
        }
    </style>

    @yield('styles')
</head>
<script>
    if (!localStorage.nightMood || localStorage.nightMood == 'false') {
        @if(session()->has('darkMode'))
        {{ session()->replace(['darkMode', 0]) }}
        @else
        {{ session()->put('darkMode', 0) }}
        @endif
    } else {
        {{ session()->forget('darkMode') }}
        {{ session()->put('darkMode', 1) }}

    }

</script>
<body class="no-transition @if(session()->get('darkMode') == 1) theme-dark @endif">

@yield('content')

<!-- New Message modal -->
<div class="modalNotify">
    <a href="{{ route('messages.system') }}">
        <div class="notfy">
            <h6>لديك رساله جديده</h6>
{{--            <span>اسم المستخدم</span>--}}
{{--            <p>هذا النص هو مثال لنص يمكن ان يستبدل بنص ف....</p>--}}
        </div>
    </a>
</div>

<script type="text/javascript" src="{{ asset('assets/web/scripts/includes/jquery-3.4.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/scripts/includes/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/scripts/includes/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/scripts/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/scripts/lightgallery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
@include('socket')

{{-- Jquery Validation--}}
<script src="{{ asset('assets/validation/jquery-validation.js') }}"></script>
@if(app()->getLocale() == 'ar')
    <script src="{{ asset('assets/validation/messages_ar.js') }}"></script>
@endif

<script>
    setTimeout(function() {$('.modalNotify').removeClass('movedown');}, 5000);
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if($('.post-media').length){
        $('.post-media').lightGallery({
            selector : '.post-media-content',
        });
    }
    @if(session()->has('success'))
    toastr.success( "{{ session()->get('success') }}" )
    @elseif(session()->has('error'))
    toastr.error("{{ session()->get('error') }}")
    @endif
    <!-- Request Errors -->
    @if($errors->any())
    toastr.error("{{ $errors->first() }}")
    @endif
    // console.log(localStorage.nightMood);
    if (!localStorage.nightMood || localStorage.nightMood == 'false') {

        localStorage.nightMood = 'false';

        $("body").removeClass("theme-dark");

    } else {

        localStorage.nightMood = 'true';

        $("body").addClass("theme-dark");

    }
    var socket = io.connect('https://managementsystem.4hoste.com:4553'),
        client = "{{auth()->id()}}";

    (function() {
        // socket.emit('add_offline_user', {'client':client});
        socket.on('offline_message', function(message) {

            // Check Message type
            if(message.type == 'image') {

            } else {
                // content = '<p>'+ message.content +'</p>';
            }

            if(message.receiver_id == {{auth()->id()}}){
                // Tone
                $('<audio id="chatAudio"><source src="{{asset('assets/notify.mp3')}}" type="audio/mpeg"></audio>').appendTo('body');
                $("#chatAudio")[0].play();

                $(".modalNotify").addClass('movedown');
                // $('#offline_message').modal('show');

            }

        });
    })();
</script>

@yield('scripts')
</body>
</html>
