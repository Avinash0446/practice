    <!DOCTYPE html>
    <html>

    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link type="" href="{{ asset('images/favicon.png') }}" rel="shortcut icon">

        <title> Custom App</title>

        <link type="text/css" href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
            rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
            rel="stylesheet"
            integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
            crossorigin="anonymous" />
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    </head>

    <body>

        @include('layouts.header')
        
        <main>
            @yield('content')
        </main>
        
        @include('layouts.footer')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/custom2.js') }}"></script>
        {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"> --}}
        </script>
        @stack('scripts')
    </body>
    </html>