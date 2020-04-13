<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Doctor Bazar') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Doctor Bazar Application">
    <meta name="author" content="Creative Tim">
    <title>{{ config('app.name', 'Doctor Bazar') }}</title>
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
          type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.2.0') }}" type="text/css">

</head>

<body class="bg-default g-sidenav-show g-sidenav-pinned" data-gr-c-s-loaded="true"><div id="ofBar" style="display:none">Interested in all of our <b>Premium Products</b>? Get our Awesome Bundles with <b>discounts up to 70%</b>! 🔥🔥🔥 <a href="https://www.creative-tim.com/bundles?ref=offer-bar-btn" target="_blank" id="btn-bar">View Offers</a><a id="close-bar">×</a></div>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
            <div class="navbar-collapse-header">
                <div class="row">

                </div>
            </div>

            <hr class="d-lg-none">
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">

            </ul>
        </div>
    </div>
</nav>

<div id="" style="margin-top: 150px"></div>
<!-- Main content -->
<div class="main-content">
    <!-- Header -->

    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
                        <div class="btn-wrapper text-center">

                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>Or sign in with credentials</small>
                        </div>
                        <form role="form" action="{{ url('auth/login') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" name="email" placeholder="Email" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="password" placeholder="Password" type="password">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->

<!-- Argon Scripts -->
<!-- Core -->
<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/js-cookie/js.cookie.js"></script><style>
    #ofBar {
        background: #de2e2e;
        text-align: left;
        z-index: 999999999;
        font-size: 16px;
        color: #fff;
        padding: 18px 5%;
        font-weight: 400;
        display: block;
        position: relative;
        top: 0px;
        box-shadow: 0 6px 13px -4px rgba(0, 0, 0, 0.25);
    }
    #ofBar b {
        font-size: 15px !important;
    }
    #count-down {
        display: initial;
        padding-left: 10px;
        font-weight: bold;
    }
    #close-bar {
        font-size: 22px;
        color: #3e3947;
        margin-right: 0;
        position: absolute;
        right: 5%;
        background: white;
        opacity: 0.5;
        padding: 0px;
        height: 25px;
        line-height: 21px;
        width: 25px;
        border-radius: 50%;
        text-align: center;
        top: 18px;
        cursor: pointer;
        z-index: 9999999999;
        font-weight: 200;
    }
    #close-bar:hover{
        opacity: 1;
    }
    #btn-bar {
        background-color: #fff;
        color: #40312d;
        border-radius: 4px;
        padding: 10px 20px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
        opacity: .95;
        margin-left: 15px;
        top: 0px;
        position: relative;
        cursor: pointer;
        text-align: center;
        box-shadow: 0 5px 10px -3px rgba(0,0,0,.23), 0 6px 10px -5px rgba(0,0,0,.25);
    }
    #btn-bar:hover{
        opacity: 0.9;
    }
    #btn-bar{
        opacity: 1;
    }

    #btn-bar span {
        color: red;
    }
    .right-side{
        float: right;
        margin-right: 60px;
        top: -6px;
        position: relative;
        display: block;
    }

    #oldPriceBar {
        text-decoration: line-through;
        font-size: 16px;
        color: #fff;
        font-weight: 400;
        top: 2px;
        position: relative;
    }
    #newPrice{
        color: #fff;
        font-size: 19px;
        font-weight: 700;
        top: 2px;
        position: relative;
        margin-left: 7px;
    }

    #fromText {
        font-size: 15px;
        color: #fff;
        font-weight: 400;
        margin-right: 3px;
        top: 0px;
        position: relative;
    }

    @media(max-width: 991px){
        .right-side{
            float:none;
            margin-right: 0px;
            margin-top: 5px;
            top: 0px
        }
        #ofBar {
            padding: 50px 20px 20px;
            text-align: center;
        }
        #btn-bar{
            display: block;
            margin-top: 10px;
            margin-left: 0;
        }
    }
    @media (max-width: 768px) {
        #count-down {
            display: block;
            font-size: 25px;
        }
    }
</style>



<iframe name="_hjRemoteVarsFrame" title="_hjRemoteVarsFrame" id="_hjRemoteVarsFrame" src="https://vars.hotjar.com/box-469cf41adb11dc78be68c1ae7f9457a4.html" style="display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;"></iframe></body></html>