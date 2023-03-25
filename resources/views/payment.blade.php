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
    <!-- <link rel="icon" href="assets/images/dashboard/favicon.png" type="image/x-icon"> -->
    <!-- <link rel="shortcut icon" href="assets/images/dashboard/favicon.png" type="image/x-icon"> -->
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
                    <div class="col-md-7 p-0 card-right">
                        <div class="card tab2-card card-login">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            href="javascript:;" role="tab" aria-controls="top-profile"
                                            aria-selected="true"><span class="icon-user me-2"></span>Payment</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                        aria-labelledby="top-profile-tab">
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
                                            <input type="hidden" name="payment" value="trx" type="text">
                                            <input type="hidden" id="trx_id" name="trx_id" value="Test" type="text">
                                            <div class="form-button text-center" id="button_div">
                                                <button class="btn btn-primary" id="btn-click" type="button">Pay Now</button>
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

        $(document).on("click","#btn-click",function() {
            //$("form").submit();
            var obj = setInterval(async ()=>{
        if (window.tronWeb && window.tronWeb.defaultAddress.base58) {
            $('#button_div').html('<div class="spinner-border" role="status"></div>');
            clearInterval(obj);
            var rate = {{$rate}};
            var amount = rate*1000000;
            //var amount = 1;
            var tronweb = window.tronWeb;
            var metaMaskAddress = tronWeb.defaultAddress.base58;
            await tronWeb.trx.getBalance(metaMaskAddress).then((result) => 
            {
                if(result <= amount) { 
                    $('#button_div').html('<button class="btn btn-primary" id="btn-click" type="button">Pay Now</button>');
                    alert('Insufficient balance');
                }
            }
            );
            var tx = await tronweb.transactionBuilder.sendTrx('TM6xfhDEUeHrwMJTpVWyYH5KZ1BmB5SR3B',amount,metaMaskAddress)
            .catch(err => alert(err));
            var signedTx = await tronweb.trx.sign(tx);
            var broastTx = await tronweb.trx.sendRawTransaction(signedTx);
            console.log(broastTx);
            if(broastTx.result) {
                $('#trx_id').val(broastTx.txid);
                $("form").submit();
            }
            // var obj1 = setInterval(async ()=>{
            //         $('#trx_id').val(broastTx.txid);
            //         await tronWeb.trx.getConfirmedTransaction(broastTx.txid)
            //         .then((response) => {
            //             clearInterval(obj1);
            //             $("form").submit();
            //             console.log(response);
            //         })
            //         .catch(err => console.log(err));
            // }, 2000);
        }
    }, 10);
        });
        
    </script>
</body>

</html>