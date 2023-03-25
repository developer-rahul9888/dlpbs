<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Tether">
    <meta name="keywords"
        content="Tether">
    <meta name="author" content="Tether">
    <link rel="icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <title>Dlpbs</title>

    <!-- Google font-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">


    <!-- Font Awesome-->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/vendors/font-awesome.css') }}">

    <!-- Flag icon-->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/vendors/themify-icons.css') }}">

    <!-- slick icon-->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/vendors/slick-theme.css') }}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/vendors/bootstrap.css') }}">

    <!-- App css-->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        .page-wrapper {
            background-color: #198b6c;
        }
    </style>

</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-7 p-2">
                        <div class="card tab2-card card-login">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{url('/login')}}" role="tab" aria-controls="top-profile"
                                            aria-selected="true"><span class="icon-user me-2"></span>Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            href="{{url('/register')}}" role="tab" aria-controls="top-contact"
                                            aria-selected="false"><span class="icon-unlock me-2"></span>Register</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    
                                    <div class="tab-pane fade show active" id="top-contact" role="tabpanel"
                                        aria-labelledby="contact-top-tab">
                                        @if (count($errors) > 0)
                                                <div class = "alert alert-danger">
                                                {{ $errors->first() }}
                                                </div>
                                        @endif

                                        @if(session('success'))
                                            <div class="alert alert-success">{{session('success')}}</div>
                                        @endif

                                        @if(session('error'))
                                            <div class="alert alert-danger">{{session('error')}}</div>
                                        @endif
                                        <form class="form-horizontal auth-form" action="" method="POST">
                                        @csrf
                                            <div class="form-group">
                                                <input required="" name="full_name" type="text"
                                                    class="form-control" value="{{old('full_name')}}" placeholder="Full name">
                                            </div>

                                            <div class="form-group">
                                                <input required="" name="email" type="email"
                                                    class="form-control" value="{{old('email')}}" placeholder="Email">
                                            </div>

                                            <div class="form-group">
                                                <input required="" name="phone" type="number"
                                                    class="form-control" value="{{old('phone')}}" placeholder="Phone number">
                                            </div>

                                            <div class="form-group">
                                                <input required="" name="password" type="password"
                                                    class="form-control" value="{{old('password')}}" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input required="" name="password_confirmation" type="password"
                                                    class="form-control" value="{{old('password_confirmation')}}" placeholder="Confirm Password">
                                            </div>

                                            <div class="form-group">
                                                <input required="" id="userid" name="referral_id" type="text"
                                                    class="form-control" value="{{old('referral_id',$referralCode)}}" placeholder="Referral ID">
                                                    <span id="username"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-check-label" for="radio2">Placement</label>
                                                    <input type="radio" class="form-check-input" checked name="placement" value="left">
                                                    <label class="form-check-label" for="radio2">Left</label>
                                                    <input type="radio" class="form-check-input" name="placement" value="right">
                                                    <label class="form-check-label" for="radio2">Right</label>
                                            </div>
                                            <div class="form-button">
                                                <button class="btn btn-primary" type="submit">Register</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{url('/')}}" class="btn btn-primary back-btn"><i data-feather="arrow-left"></i>back</a>
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- Sidebar jquery-->
    <script src="{{ asset('admin/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('admin/assets/js/slick.js') }}"></script>

    <!-- lazyload js-->
    <script src="{{ asset('admin/assets/js/lazysizes.min.js') }}"></script>

    <!--right sidebar js-->
    <script src="{{ asset('admin/assets/js/chat-menu.js') }}"></script>

    <!--script admin-->
    <script src="{{ asset('admin/assets/js/admin-script.js') }}"></script>
    <script>
        $('.single-item').slick({
            arrows: false,
            dots: true
        });
    </script>
<script>

jQuery('#userid').keyup(function(){
    var userid = jQuery(this).val();
    jQuery.ajax({
        url: "{{url('username')}}/"+userid,
        success: function(result){
        $("#username").html(result);
}});
});
</script>
</body>

</html>