<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="TekawebMedia">
    <!-- <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"> -->
    <!-- <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"> -->
    <title>Login - Aplikasi Budget PT. Tritunggal Multi Cemerlang</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/feather-icon.css')}}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css" media="screen')}}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
</head>

<body style="background-color: darkslategray">
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" >
        <div class="container-fluid p-0">
            <!-- login page start-->
            <div class="authentication-main" style="background-color: darkslategray">
                <div class="row">
                    <div class="col-md-12">
                        <div class="auth-innerright">
                            <div class="authentication-box">
                                <div class="mt-4">
                                    <div class="card-body" style="background-color: darkslategray">
                                        <div class="cont text-center">
                                            <div>
                                                <form class="theme-form" method="post" action="{{route('proses.login')}}">
                                                    {!! csrf_field() !!}
                                                    <h4>LOGIN</h4>
                                                    <h6>Enter your Username and Password</h6>
                                                    <div class="form-group">
                                                        <label class="col-form-label pt-0">Your Name</label>
                                                        <input class="form-control" type="text" name="email" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Password</label>
                                                        <input class="form-control" type="password" name="password" required="">
                                                    </div>
                                                    <div class="checkbox p-0">
                                                        <input id="checkbox1" type="checkbox">
                                                        <label for="checkbox1">Remember me</label>
                                                    </div>
                                                    <div class="form-group row mt-3 mb-0">
                                                        <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="sub-cont">
                                                <div class="img">
                                                    <div class="img__text m--up">
                                                        <h2>New User?</h2>
                                                        <p>Sign up and discover great amount of new opportunities!</p>
                                                    </div>
                                                    {{-- <div class="img__text m--in">
                                                        <h2>One of us?</h2>
                                                        <p>If you already has an account, just sign in. We've missed you!</p>
                                                    </div> --}}
                                                </div>
                                                <div>
                                                    {{-- <form class="theme-form">
                                                        <h4 class="text-center">NEW USER</h4>
                                                        <h6 class="text-center">Enter your Username and Password For Signup</h6>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" placeholder="First Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" placeholder="Last Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="form-control" type="text" placeholder="User Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="form-control" type="password" placeholder="Password">
                                                        </div>
                                                    </form> --}}

                                                    <form class="theme-form" method="post" action="{{route('proses.login')}}">
                                                        {!! csrf_field() !!}
                                                        <h4>LOGIN</h4>
                                                        <h6>Enter your Username and Password</h6>
                                                        <div class="form-group">
                                                            <label class="col-form-label pt-0">Your Name</label>
                                                            <input class="form-control" type="text" name="email" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label">Password</label>
                                                            <input class="form-control" type="password" name="password" required="">
                                                        </div>
                                                        <div class="checkbox p-0">
                                                            <input id="checkbox1" type="checkbox">
                                                            <label for="checkbox1">Remember me</label>
                                                        </div>
                                                        <div class="form-group row mt-3 mb-0">
                                                            <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login page end-->
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap/bootstrap.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('assets/js/login.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
</body>

</html>