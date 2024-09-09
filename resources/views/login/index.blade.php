<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CPLProdi | Log in</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link href="https://sitei.ft.unri.ac.id/assets/css/signin.css" rel="stylesheet">
  <link href="https://sitei.ft.unri.ac.id/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dist/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <style>

  
    @media  only screen and (max-width: 425px) {
  
  
        .green-background {
            display: none !important;
        }
        .row{
            margin-top: -60px;
        }
        
  
        .bungkus{
            justify-content: center;
            align-items: center;
        }
  
        .vl {
            border-left: 2px solid green;
            height: 100px;
            margin-top: 20px;
            padding-left: 10px;
        }
  
        .caption h4 {
            font-size: 18px;
        }
          .gambar img{
        margin-top: -30px;
        }
  
        .container{
            margin-top: 100px;
        }
  
        .footer{
            margin-bottom: 20px;
        }
  
        .pengembang {
        color: #212529;
        }
  
        .pengembang:hover {
            color: #28a745;
        }
  
    }
  
    @media  only screen and (max-width: 768px) {
        .green-background {
            display: none !important;
        }
  
        .gambar img{
        margin-top: -25px;
        }
  
        .bungkus{
            justify-content: center;
            align-items: center
        }
  
        .vl {
            border-left: 2px solid green;
            height: 70px;
            margin-top: 20px;
            padding-left: 10px;
        }
  
        .pengembang {
        color: #212529;
        }
  
        .pengembang:hover {
            color: #28a745;
        }
      
  
    }
  
    @media  only screen and (max-width: 992px) {
        .green-background {
            display: none !important;
        }
  
  
        .bungkus{
            justify-content: center;
            align-items: center
        }
  
        .vl {
            border-left: 2px solid green;
            height: 70px;
            margin-top: 20px;
            padding-left: 10px;
        }
  
        .pengembang {
        color: #212529;
        }
  
        .pengembang:hover {
            color: #28a745;
        }
        
    }
  
    @media  only screen and (min-width: 1024px) {
        .green-background {
            display: none !important;
        }
  
        .vl {
            border-left: 2px solid green;
            height: 70px;
            margin-top: 20px;
            padding-left: 10px;
        }
  
        .caption h4 {
            font-size: 20px;
        }
  
        .footer {
            margin-bottom: 20px;
        }
  
        .pengembang {
        color: #212529;
        }
  
        .pengembang:hover {
            color: #28a745;
        }
  
        .green-background {
        background-color: #28a745;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        }
  
  
        .login-column {
            padding: 0 15px;
        }
  
        .kotak-masuk {
            border-radius: 10px;
        }
  
        .hr-line-dashed {
            border-top: 1px dashed #e7eaec;
            color: #ffffff;
            background-color: #6b9080;
            height: 1px;
            margin: 30px 0;
        }
  
        /* Add more styles as needed for responsiveness at 1024px and below */
    }
  
    .hr-line-dashed {
        border-top: 1px dashed #e7eaec;
        color: #ffffff;
        background-color: #6b9080;
        height: 1px;
        margin: 30px 0;
    }
    
  
    
  </style></head>
<body style="background: rgb(210, 210, 210);">
  <div class="container rounded rounded-sm bg-white shadow align-center">
  
    <div class="row justify-content-center align-items-center">
  
    
    <div class="col-xl-4 col-lg-5 rounded col-md-12 bg-white">
  
     <div class="px-5">
                    <main class="w-100">
                        @if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('loginError') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
                        <form action="/login" method="post">
        @csrf
        <div class="form-floating mt-5">
            <p class="text-center">Silahkan Login Terlebih Dahulu!</p>
        </div>
        <div class="form-floating mt-3">
                                <input type="text" class="form-control rounded-1 " name="username" id="username" value="" placeholder="username" autofocus="" required="">
                                    <label class="label-nim" for="username">Username</label>
                                                            </div>
        <div class="form-floating mt-3">
                                                                <input type="password" class="form-control rounded-1" name="password" id="password" placeholder="Password" required="">
                                <label for="password">Password</label>
                                <div class="position-absolute end-0 top-50 translate-middle-y">
                                    <span class="px-3">
                                        <i class="fas fa-eye-slash pointer" id="togglePassword"></i>
                                    </span>
                                </div>
                                
                            </div>
                <button class="w-100 btn btn-lg btn-primary mt-4 rounded-1" type="submit">Login</button>
    </form>
                        <small class="kecil d-block text-center mt-3">Lupa Password (Hubungi Admin
                            Prodi)<br></small>
  <br>
                    </main>
                </div>
  
    </div>
  <div class="col-xl-8 col-lg-7 col-md-12">
  
    <div id="carouselExampleControls" class="carousel slide " data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('dist/img/backgroundd.jpg') }}" class="d-block" width="100%" alt="...">
    </div>
  </div>
  </div>
    </div>
    </div>
  
  </div>
  
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
  
  
      
                                      
        
      
<script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            var passwordInput = document.getElementById("password");
            var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            this.className = type === "password" ? "fas fa-eye-slash pointer" : "fas fa-eye pointer";
        });
    </script>
    
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
</body>
</html>
