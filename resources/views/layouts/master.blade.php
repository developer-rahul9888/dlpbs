
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="fxearning">
    <meta name="keywords"
        content="fxearning">
    <meta name="author" content="fxearning">
    <link rel="icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <meta name="description" content="fxearning">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>DLPBS</title>


        {{-- for extra head data --}}
        @yield('head')

        {{-- seo meta data --}}
        @yield('seo')

        {{-- all styles --}}
        @include('layouts.styles')

        {{-- Extra Styles --}}
        @yield('styles')

</head>


<body>

            <!-- ***** Preloader Start ***** -->
            <div id="preloader">
                <div class="jumper">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>  
            <!-- ***** Preloader End ***** -->

        @section('body-header')
        
        {{--  header  --}}
            @include('layouts.header')

        @show


        {{-- main app --}}
        @yield('content-wrapper')

        {{-- footer --}}
        @section('footer')
            

        @include('layouts.footer')


        @show
        {{-- all scripts --}}
        @include('layouts.scripts')

        @yield('scripts')

        </body>
</html>