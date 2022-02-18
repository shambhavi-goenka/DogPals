<?php
    require_once 'common.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dogpals</title>

    <!-- Main External CSS file -->
    <link rel="stylesheet" href="css/sign_in.css" />

    <!--Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!--Font Awesome -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!--Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!--AnimeJS CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Change Favicon-->
    <link rel="icon" href="images/dog_icon.svg">

    

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light" style="background-color: #e6f1f8;">
      <div class="container-fluid">
        <a class="navbar-brand" href="main.html"><object data="images/logo.svg" type="image/svg+xml" height="45px" width="180px" class = 'ps-3'></object></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex justify-content-around">
            <li class="nav-item">
              <a class="nav-link me-5" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-5" href="find_a_playmate.html">Find a Playmate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-5" href="find_a_place.html">Find a Place</a>
            </li>
          </ul>
        
          
          <span>
              <form action = 'sign_in.php' method="POST" style="display: inline-block;">
                  <button class="btn btn-warning me-4 px-4 py-2 rounded-pill text-uppercase" type="submit" name = 'signup'>Sign Up</button>
              </form>
              
              <form action = 'sign_in.php' method="POST" style="display: inline-block;">
                  <button class="btn btn-warning me-5 px-4 py-2 rounded-pill text-uppercase" type="submit" name = 'login'>Login</button>
              </form>
              </span>
        </div>
      </div>
    </nav>

      <main class = <?php if(isset($_POST['signup'])) {
        echo "sign-up-mode";
        } 
      else {
        echo " ";
      }  ?> >
      <div class="box">
          <div class="inner-box">
          <div class="forms-wrap">
              <form action="process_login.php" method = 'post' autocomplete="off" class="form sign-in-form" id = 'form1'>
              <div class="heading">
                  <h2>Welcome Back!</h2>
                  <h6>New to DogPals?</h6>
                  <a href="#" class="toggle" id = 'sign-up-link'>Sign up</a>
              </div>

              <?php showError(); ?>

              <div class="actual-form">
                  <div class="input-wrap">
                  <i class="fas fa-user"></i>
                  <input type="text" id = 'username1' placeholder="Username" class="input-field" name = 'username'/>
                  <i class="fas fa-check-circle"></i>
                  <i class = 'fas fa-exclamation-circle'></i>
                  <small>Error Message</small>
                  </div>
  
                  <div class="input-wrap">
                  <i class="fas fa-lock"></i>
                  <input type="password" id = 'password1' placeholder="Password" class="input-field" name = 'password'/>
                  <i class="fas fa-check-circle"></i>
                  <i class = 'fas fa-exclamation-circle'></i>
                  <small>Error Message</small>
                  </div>
                  
                  <div class = 'text-center'>
                    <input type="submit" value="Login" class="sign-btn" />
                  </div>
  
                  <p class="text text-center">
                  Forgot password?
                  <a href="#">Get help</a>
                  </p>
              </div>
              </form>
  
              <form action="process_register.php" method = 'post' autocomplete="off" class="form sign-up-form" id = 'form2'>
  
              <div class="heading" id = 'form2-heading'>
                  <h2>Hello There!</h2>
                  <h6>Already have an account?</h6>
                  <a href="#" class="toggle" id = 'sign-in-link'>Sign in</a>
              </div>
  
              <div class="actual-form">
                  <div class="input-wrap">
                    <i class="fas fa-user"></i>
                    <input type="text" id = 'username2' placeholder = 'Username' class="input-field" name = 'username' oninput = 'checkUsername()'/>
                    <i class="fas fa-check-circle"></i>
                    <i class = 'fas fa-exclamation-circle'></i>
                    <small>Error Message</small>
                    <span id = 'check-username'></span>
                  </div>

                  <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id = 'email2' placeholder="Email" class="input-field" name = 'email'/>
                    <i class="fas fa-check-circle"></i>
                    <i class = 'fas fa-exclamation-circle'></i>
                    <small>Error Message</small>
                  </div>
  
  
                  <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" id = 'password2' placeholder="Password" class="input-field" name = 'password'/>
                    <i class="fas fa-check-circle"></i>
                    <i class = 'fas fa-exclamation-circle'></i>
                    <small>Error Message</small>
                  </div>

                  <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" id = 'confirmpassword2' placeholder = 'Confirm Password' class="input-field" name = 'confirmPassword'/>
                    <i class="fas fa-check-circle"></i>
                    <i class = 'fas fa-exclamation-circle'></i>
                    <small>Error Message</small>
                  </div>
                  
                  
                  <div class = 'text-center'>
                    <span id = 'recaptcha_error' style = 'display:none;'>reCAPTCHA is mandatory</span>
                    <div class="g-recaptcha brochure__form__captcha" id = 'recaptcha' data-callback = 'isChecked'data-sitekey="6Le_A7gcAAAAAEL46h44k_aonZEewi4kqxGxi5X-"></div>
                    <input type="submit" value="Sign Up" class="sign-btn" id = 'signup'/>
                  </div>
  
              </div>
              </form>
          </div>
  
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="images/carousel1.jpg" class="d-block w-100 image img-1" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <p class = 'fst-italic'>" A true friend leaves paw prints on your heart"</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="images/carousel2.jpg" class="d-block w-100 image img-2" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <p class = 'fst-italic'>" A real friend is one who walks in when the rest of the world walks out"</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="images/carousel3.jpg" class="d-block w-100 image img-3" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <p class = 'fst-italic'>" A sweet friendship refreshes the soul"</p>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </main>

    
        

    <!-- External Javascript file -->
    <script src="./js/sign_in.js"></script>
    <!--Jquery -->
    <script src = 'https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
  </body>
</html>
