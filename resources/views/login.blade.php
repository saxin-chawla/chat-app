<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
<style>
    .invalid{
        color: red;
    }
</style>
</head>

<body>
@if(session('success'))
    <div class="alert alert-success" id="success-alert">
        <!-- <button type="button" class="close" data-dismiss="alert">x</button> -->
        <strong>Success! </strong> {{ session('success') }}.
    </div>

@endif
@if(session('notLog'))
    <div class="alert alert-danger" id="login-alert">
        <!-- <button type="button" class="close" data-dismiss="alert">x</button> -->
        <strong>Access Denied! </strong> {{ session('notLog') }}.
    </div>

@endif

@if(session('loginfail'))
    
    <div class="alert alert-danger" id="failed-alert">
        <!-- <button type="button" class="close" data-dismiss="alert">x</button> -->
        <strong>Failed! </strong> Invalid Email or Password.
    </div>
    
@endif
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="post" action="/login">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">Logo</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Email address</label>
                                        </div>
                                        <span class="invalid">
                                            @error('email')
                                                {{$message}}
                                            @enderror
                                        </span>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27" name="password" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27" >Password</label>
                                        </div>
                                        <span class="invalid">
                                            @error('password')
                                                {{$message}}
                                            @enderror
                                        </span>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="{{route('signup')}}" style="color: #393f81;">Register here</a></p>
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#success-alert").fadeTo(2000, 1000).slideUp(1000, function(){
                $("#success-alert").slideUp(1000);
            });
        });
        $(document).ready(function() {
            $("#failed-alert").fadeTo(2000, 1000).slideUp(1000, function(){
                $("#failed-alert").slideUp(1000);
            });
        });
        $(document).ready(function() {
            $("#login-alert").fadeTo(2000, 1000).slideUp(1000, function(){
                $("#login-alert").slideUp(1000);
            });
        });
    </script>
</body>

</html>