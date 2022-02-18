<?php

require 'common.php';

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // echo $id;
    $dao = new DogDAO();
    $dog_object = $dao->getDogByID($id);
    // var_dump($dog_object);

    if ($dog_object) {

        $json_obj = json_encode($dog_object);
        // exit($json_obj);
    }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DogPals</title>

    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- External CSS Styling -->
    <link rel="stylesheet" href="css/find_a_playmate.css">
    <link rel="stylesheet" href="css/heart.css">

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

    <!-- CSS Fonts  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JS Fonts  -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <!--AnimeJS CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Vue.js 3 CDN -->
    <script src="https://unpkg.com/vue@next"></script>

    <!--Font Awesome -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <!--Change Favicon-->
    <link rel="icon" href="images/dog_icon.svg">

</head>
<body>

<main id='app'>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-md navbar-light" id="header">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <object id = 'logo' data="images/logo.svg" type="image/svg+xml" height="45px" width="180px" class = 'ps-3'></object></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex justify-content-around">
                    <li class="nav-item">
                    <a class="nav-link me-5" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active me-5" aria-current="page" href="find_a_playmate.html">Find a Playmate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-5" href="find_a_place.html">Find a Place</a>
                    </li>
                    <li class="nav-item" v-if = 'login'>
                        <a class="nav-link me-5" href="chat.php">Chat
                            <div id = "notification" v-show ="notification(username)">
                                <i class='bell fa fa-bell faa-ring'></i>
                            </div>
                        </a>
                    </li>
                </ul>

                <span v-if = 'login'>
                    <span class = 'px-2' id = 'profile_text' >Hi, {{username}}! </span>
                    <div class="dropdown me-5 d-inline">
                    <a href = '#' class = 'dropdown-toggle' id = 'defaultDropdown'
                    data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                    <img :src =  'img_url' style = 'width: 50px; height : 50px; border-radius: 50%; '></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="defaultDropdown" >
                        <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="logout.php" style="text-decoration: none;"><button type = 'button' class = 'btn btn-warning rounded-pill mx-auto d-flex px-4 py-2 text-uppercase'>Sign Out</button></a></li>
                    </ul>
                    </div>
                </span>

                <span v-else>
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
</main> 

    <!-- Dog Info -->
    <div id="individual_dog">
        <h3 id="dog_heading" class="text-center mt-5 mx-4" style="color: #DDAA61">Meet {{ dog_info.name }} , {{ dog_info.gender }} , {{ dog_info.age }} years old</h3>
        <h6 id="dog_sub_heading" class="text-center mt-4 mb-4 mx-3" style="color: #DD7878;">{{ dog_info.name }} is a cute {{ dog_info.size }} {{ dog_info.breed }} dog. Would you like to meet {{ dog_info.name }}?</h6>
        
        <img :src="dog_info.image_url" class="zoom rounded mx-auto d-block mb-4"  id="dog_img" style="width: 600px; max-width: 80%;" alt="...">

        <div class="mx-auto" style="width: 600px; max-width: 50%;">
            <div class="row">
                <div class="col col-xs-6">
                    <h4 style="color: #DD7878"> <span id="likeCount">{{ dog_info.likes }}</span> Likes</h4> 
                </div>
                <div class="col col-xs-6 d-flex justify-content-end">

                    <span v-if="isUserDog()">
                            <button class="btn me-4 px-4 py-2 rounded-pill" style="background-color: #DDAA61; color: white;" type="submit" disabled>Contact Owner</button>
                    </span>

                    <span v-else-if='login'>
                        <form action = 'chat.php' method="POST">
                            <button class="btn me-4 px-4 py-2 rounded-pill" style="background-color: #DDAA61; color: white;" type="submit">Contact Owner</button>
                            <input type="hidden" name="login_user" :value="login_user_username">
                            <input type="hidden" name="login_user_dog" :value="login_user_dog_name">
                            <input type="hidden" name="login_user_img" :value="login_user_img_url">
                            <input type="hidden" name="friend_details" :value="getFriendDetails()">
                        </form>
                    </span>
                
                    <span v-else>
                        <button class="btn me-4 px-4 py-2 rounded-pill" style="background-color: #DDAA61; color: white;" type="submit" @click="popUpMsg()" data-bs-toggle="modal" data-bs-target="#exampleModal">Contact Owner</button>
                        <div v-show=" not_login_check ">
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sorry! Please login in!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Please login to your account to chat with {{ dog_info.name  }}'s owner!
                                            If you do not have an account yet, do sign up for one!
                                        </div>
                                        <div class="modal-footer">
                                            <form action = 'sign_in.php' method="POST">
                                                <button class="btn btn-warning rounded-pill text-uppercase" type="submit" name = 'signup'>Sign Up</button>
                                            </form>
                                            
                                            <form action = 'sign_in.php' method="POST">
                                                <button class="btn btn-warning rounded-pill text-uppercase" type="submit" name = 'login'>Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>

                    <button type="button" class="btn justify-content-end" style="background-color: #DD7878; color: white;" @click="likes()"><i class="bi bi-heart"></i></button>

                </div>
            </div>
        </div>

        <div class="mx-auto mt-5" style="width: 600px; max-width: 80%;">
            <h3 class="mb-4">About {{ dog_info.name }}</h3>
            <p class="mb-3"> <i class='fas fa-birthday-cake' style='font-size:22px; margin-right: 5px;'></i> Birthday: {{ dog_info.birthday }} </p>
            <p class="mb-3"> <i class='fas fa-weight' style='font-size:22px; margin-right: 5px;'></i> Weight: {{ dog_info.weight }} </p>
            <p class="mb-3"> <i class='fas fa-grin-beam' style='font-size:22px; margin-right: 5px;'></i> Personality: 
                <ul class="personality" v-for="type in personality()"> 
                        <li>{{ type }}</li>
                </ul>
            </p>
            <p class="mb-3"> <i class='fas fa-map-marker-alt' style='font-size:22px; margin-right: 5px;'></i> {{ dog_info.name }}'s Favorite Places to go in Singapore: 
                <ul v-for="place in fav_places()"> 
                    <li>{{ place }}</li>
                </ul>
            </p>
        </div>
        

    </div>

    <p id = 'copyright'>Copyright &copy; 2021 DogPals. All Rights Reserved.</p>

    <script>

        dog_profile = <?=$json_obj ?>;
        // console.log(dog_profile)

    
        Vue.createApp({
            data() {
                return {      
                    dog_info: dog_profile,
                    not_login_check: false,
                    msg: "",
                    login_user_username: "",
                    login_user_dog_name: "",
                    login_user_img_url: "",
                    login: false,
                    liked_dog: false


                }

            }, 
            
            created: function() {
                
                // console.log(this.login)
                    
                axios.get("authenticate.php")
                .then(response => {
                    let data = response.data
                    // console.log(data)

                    this.login_user_username = data.username
                    // console.log(this.login_user_username) // current login user's username

                    this.login_user_dog_name = data.dog_name
                    // console.log(this.login_user_dog_name) // current login user's dog name

                    this.login_user_img_url = data.img_src
                    // console.log(this.login_user_img_url) // current login user's dog img

                    if (data.username && data.img_src) {
                        this.login = true

                    }
                    else {
                        this.login = false

                    }

                })
                .catch(error => {
                    console.log(error.message)
                })

            }, 

            methods: {
                likes() {
                    let new_likes_total = this.dog_info.likes++

                    return new_likes_total
                }, 
                

                personality() {
                    let dog_personality = this.dog_info.personality.split(",")
                    
                    return dog_personality

                },

                fav_places() {
                    let dog_fav_places = this.dog_info.fav_places.split(",")
                    
                    return dog_fav_places
                }, 

                isUserDog() {
                    
                    var current_owner_username = this.dog_info.username
                    
                    if (this.login_user_username  == current_owner_username) {
                        return true
                    }

                },

                popUpMsg() {

                    // console.log("Sign in pls")

                    this.not_login_check = true

                }, 

                getFriendDetails() {

                    var friend_username = this.dog_info.username
                    // console.log(friend_username) // dog's owner username
                    var friend_dog_name = this.dog_info.name
                    // console.log(friend_dog_name) // dog's name
                    var friend_dog_img = this.dog_info.image_url
                    // console.log(friend_dog_img) // dog's img


                    var friends = [friend_username, friend_dog_img, friend_dog_name]

                    // console.log(friends)

                    return friends


                }

            }

            
        }).mount("#individual_dog")


    </script>


<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-database.js"></script>

<!-- External JS File -->
<script src='js/individual_dog.js'></script>
<script src ='js/main.js'></script> 

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

<!-- Bootstrap CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>