<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8" />
    <title>@lang('view_pages.admin_login')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ url('assets/vendor_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-extend.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/css/master_style.css') }}">

    <!-- Fab Admin skins -->
    <link rel="stylesheet" href="{{ url('assets/css/skins/_all-skins.css') }}">

    <style>
        .error-style {
            list-style: none;
            color: red;
            text-align: center;
            margin-top: 15%;
            padding: 0;
        }

        body {
            background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)),
                url('{{ asset('assets/images/bg.jpeg') }}') !important;
            background-size: cover !important;
        }
    </style>
</head>

<body class="hold-transition login-page">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-lg-8 col-md-4 d-none d-md-block"></div>

            <div class="col-lg-4 col-md-8 col-12">
                <div class="login-box">
                    <div class="login-box-body text-center">
                        <img src="{{ fav_icon() ?? asset('images/favicon.png') }}" alt="">
                        <h3 class="text-center">Admin Panel</h3>
                        <p class="login-box-msg"></p>
                        <form action="{{ route('login') }}" method="POST" class="login_form" id="form">
                            @csrf
                            <div class="col-12 form-group has-feedback"
                                style="display:flex;margin-bottom:15px;background: #fff;padding: 0px;">
                                <div class="print-error-msg" style="position: absolute;right: 0;left: 0;">
                                    <ul class="error-style"></ul>
                                </div>

                                <div class="col-md-11 mx-auto p-0 login-email">
                                    <input type="text" name="username" id="username" style="border-radius:none;"
                                        class="form-control rounded" required placeholder="User name" maxlength="74">
                                </div>
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            </div>

                            <div class="col-12 form-group has-feedback"
                                style="display:flex;margin-bottom:10px;background: #fff;padding: 0px;">
                                <div class="col-md-11 mx-auto text-center p-0 login-email">
                                    <input type="password" name="password" style="border-radius:none;" required
                                        id="password" class="form-control rounded" placeholder="Password"
                                        maxlength="30">
                                </div>
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="checkbox">
                                        <input type="checkbox" id="basic_checkbox_1">
                                        <label for="basic_checkbox_1">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <span><a href="{{ url('forgot_password') }}">Forgot Password</a></span>
                                </div>

                                <div class="col-12 text-center login-btn">
                                    <button class="btn btn-info btn-block margin-top-10 submit_button"
                                        type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery 3 -->
    <script src="{{ url('assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap 4.0-->
    <script src="{{ url('assets/vendor_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/jquery.form-validator.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    @if (session()->has('success'))
        <script>
            var alertMessage = "{{ session()->get('success') }}";

            $.toast({
                heading: '',
                text: alertMessage,
                position: 'top-right',
                loaderBg: '#5ba035',
                icon: 'success',
                hideAfter: 5000,
                stack: 1
            });
        </script>
    @endif
</body>

</html>