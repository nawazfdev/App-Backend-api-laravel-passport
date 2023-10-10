<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Task Remainder</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

<!-- jquery.vectormap css -->
<link href="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}?v=<php echo time(); ?>" rel="stylesheet" type="text/css" />

<!-- DataTables -->
<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}?v=<php echo time(); ?>" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}?v=<php echo time(); ?>" rel="stylesheet" type="text/css" />  

<!-- Bootstrap Css -->
<link href="{{ asset('backend/assets/css/bootstrap.min.css') }}??v=<php echo time(); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('backend/assets/css/icons.min.css') }}?v=<php echo time(); ?>" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('backend/assets/css/app.min.css') }}?v=<php echo time(); ?>" id="app-style" rel="stylesheet" type="text/css" />



    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">
    
                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                <!-- <img src="{{ asset('backend/assets/images/logo-dark.png') }}" height="30" class="logo-dark mx-auto" alt=""> -->
<!-- <img src="{{ asset('backend/assets/images/logo-light.png') }}" height="30" class="logo-light mx-auto" alt=""> -->

                                </a>
                            </div>
                        </div>
    
                        <h4 class="text-muted text-center font-size-18"><b>Register Yourself</b></h4>
    
                        <div class="p-3">
                        <form method="POST" action="{{ route('register') }}">
        @csrf
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" id="name" name="name" type="text" required="" placeholder="Name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                    </div>
                                </div>
     
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="email" id="email" name="email" required="" placeholder="Email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" id="password"  name="password" required="" placeholder="password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                    </div>
                                </div>
                                <!-- Password Confirmation -->
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" id="password_confirmation"  name="password_confirmation" required="" placeholder="Password Confirmation">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                    </div>
                                </div>
    
                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>
    
                                <div class="form-group mt-2 mb-0 row">
                                    <div class="col-12 mt-3 text-center">
                                        <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
                                    </div>
                                </div>
                            </form>
                            <!-- end form -->
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->
        

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
