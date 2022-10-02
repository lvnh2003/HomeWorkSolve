@extends('users.layout.master')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Paper Kit 2 PRO by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />



</head>

<body class="full-screen register">


    <div class="wrapper">
        {{-- style="background-image: url('http://doan.test//image/soroush-karimi.jpg');" --}}
        <div class="page-header">
            <div class="filter"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-7 col-12 ml-auto">
                        <div class="info info-horizontal">
                            <div class="icon">
                                <i class="fa fa-umbrella"></i>
                            </div>
                            <div class="description">
                                <h3> We've got you covered </h3>
                                <p>Larger, yet dramatically thinner. More powerful, but remarkably power efficient.
                                    Everything you need in a single case.</p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon">
                                <i class="fa fa-map-signs"></i>
                            </div>
                            <div class="description">
                                <h3> Clear Directions </h3>
                                <p>Efficiently unleash cross-media information without cross-media value. Quickly
                                    maximize timely deliverables for real-time schemas.</p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon">
                                <i class="fa fa-user-secret"></i>
                            </div>
                            <div class="description">
                                <h3> We value your privacy </h3>
                                <p>Completely synergize resource taxing relationships via premier niche markets.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5 col-12 mr-auto">
                        <div class="card card-register">
                            <h3 class="card-title text-center">Register</h3>
                            <div class="social">
                                <button href="#paper-kit" class="btn btn-just-icon btn-facebook"><i
                                        class="fa fa-facebook"></i></button>
                                <button href="#paper-kit" class="btn btn-just-icon btn-google"><i
                                        class="fa fa-google"></i></button>
                                <button href="#paper-kit" class="btn btn-just-icon btn-twitter"><i
                                        class="fa fa-twitter"></i></button>
                            </div>

                            <div class="division">
                                <div class="line l"></div>
                                <span>or</span>
                                <div class="line r"></div>
                            </div>
                            <form class="register-form" method="POST" action="{{ route('register.register') }}">
                                @csrf
                                <input type="text" class="form-control" placeholder="Email" name="email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <input type="password" class="form-control" placeholder="Password" name="password">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <input type="password" class="form-control" placeholder="Confirm Password"
                                    name="password_confirmation">
                                @error('cpassword')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button class="btn btn-block btn-round">Register</button>
								<br>
                                @if (session()->has('success'))
                                    <div class="alert alert-success">

                                        {{ session()->get('success') }}

                                    </div>
                                @endif
                            </form>
                            <div class="login">
                                <p>Already have an account? <a href="#0">Log in</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>


</html>
