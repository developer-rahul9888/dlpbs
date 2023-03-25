
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description"
        content="Dlpbs">
    <meta name="keywords"
        content="Dlpbs">
    <meta name="author" content="Dlpbs">
    <link rel="icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <title>Dlpbs</title>


        {{-- for extra head data --}}
        @yield('head')

        {{-- seo meta data --}}
        @yield('seo')

        {{-- all styles --}}
        @include('admin.layouts.styles')

        {{-- Extra Styles --}}
        @yield('styles')
        <style>
.card-body {
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
}
        </style>

</head>


<body>

                <!-- page-wrapper Start-->
    <div class="page-wrapper">



        <!-- Page Body Start-->
        <div class="page-body-wrapper">

        @section('body-header')
        
        @include('admin.layouts.header')

        @show

        {{--  sidebar  --}}
        @include('admin.layouts.sidebar')

        {{-- main app --}}
        @yield('content-wrapper')


       

        {{-- footer --}}
        @section('footer')
            


        @include('admin.layouts.footer')

        </div>
    </div>

        @show
        {{-- all scripts --}}
        @include('admin.layouts.scripts')

        @yield('scripts')

        </body>
</html>