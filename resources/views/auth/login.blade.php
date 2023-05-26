<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Maolaart Store | Login</title>

    <!-- Custom fonts for this template-->
    <link href="/sb-admin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/sb-admin2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-image: url(assets/Login_Admin.jpg);">

    <div class="container bg" >

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-8">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                       
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    @if ($errors->any())    
                                    <div class="alert alert-danger">
                                        <strong>Gagal</strong>
                                        <p>{{$errors->first()}}</p>
                                    </div>
                                    @endif
                                    <form class="form-login user" method="POST" action="/login">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user email"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                            @error('email')
                                            <small class="text-danger">                                                
                                                {{$message}}  
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user password"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                            @error('password')
                                            <small class="text-danger">
                                                {{$message}}  
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/sb-admin2/vendor/jquery/jquery.min.js"></script>
    <script src="/sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/sb-admin2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/sb-admin2/js/sb-admin-2.min.js"></script>

    <script>
        $(function(){

            function setCookie(name,value,days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days*24*60*60*1000));
                    expires = "; expires=" + date.toUTCString();
                }
                  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
            }


            $('.form-login').submit(function (e) { 
                e.preventDefault()

                const email = $('.email').val();
                const password = $('.password').val();
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                console.log(csrfToken)
                
                $.ajax({
                    type: "POST",
                    url: "/login",
                    headers: {
                        'X-CSRF-Token': csrfToken
                    },
                    data: {
                        email : email,
                        password : password,
                    },
                    success: function (data) {
                        if(!data.success){
                            alert(data.message)
                        }

                        setCookie('token',data.token,7)
                        window.location.href = '/dashboard'
                    }
                });
                
            });
        })
    </script>

</body>

</html>