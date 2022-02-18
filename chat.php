<?php

require_once "common.php";

$username = '';
if(isset($_SESSION['username'])) {
    $username =  strtolower($_SESSION['username']);
}
else
{
    header("Location: sign_in.php");
    return;
}

$dog_name = "";
if (isset($_POST['login_user_dog'])) {
    $dog_name = $_POST['login_user_dog'];
}

$dog_img = "";
if (isset($_POST['login_user_img'])) {
    $dog_img = $_POST['login_user_img'];
}

$friend_details = "";
if (isset( $_POST['friend_details'])) {
    $friend_details = $_POST['friend_details'];
}

if ($friend_details != "") {
    $friends_arr = explode(",", $friend_details);
    $friend_username = $friends_arr[0];
    $friend_img_url = $friends_arr[1];
    $friend_dog_name = $friends_arr[2];
}

if ($username != "" && $dog_name != "" && $dog_img != "" && $friend_details != "") {
    $new_friend = new Friend(null, $username, $dog_img, $dog_name, $friend_username, $friend_img_url, $friend_dog_name);
    $friend_dao = new FriendDAO();
    $exist_status = $friend_dao->checkIfExists($username, $friend_username);
    // var_dump($exist_status);

    if (! $exist_status) {
        $create_status = $friend_dao->create($new_friend);
    // var_dump($create_status)
    }
}

//var_dump($username);

$dao = new DogDAO();

$results = $dao->retrieve($username);
$output = array("username" => $results->getUsername(), "img_src" => $results->getImg_url());
$json_obj = json_encode($output);
//var_dump($output);

$friend_dao = new FriendDAO();
$result_friends = $friend_dao->retrieveFriends($username);
//var_dump($result_friends);
$output_friend_name = [];
$output_friend_img = [];
$output_friend_dog_name = [];

if ($result_friends){
    for ($i=0 ;$i < sizeof($result_friends); $i++){
        //var_dump($result_friends[$i]->getFriend_username());
        $name =  $result_friends[$i]->getFriend_username();
        if ($name == $username){
            array_push($output_friend_name, $result_friends[$i]->getUsername());
            array_push($output_friend_img, $result_friends[$i]->getimage_url());
            array_push($output_friend_dog_name, $result_friends[$i]->getDog_name());
        }else{
            array_push($output_friend_name, $result_friends[$i]->getFriend_username());
            array_push($output_friend_img, $result_friends[$i]->getFriend_image_url());
            array_push($output_friend_dog_name, $result_friends[$i]->getFriend_dog_name());
        }
        
    }
}
$json_obj_friend_name = json_encode($output_friend_name);
$json_obj_friend_img = json_encode($output_friend_img);
$json_obj_friend_dog_name = json_encode($output_friend_dog_name);
//var_dump($json_obj_friend_name);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 

    <!-- vue -->
    <script src="https://unpkg.com/vue@next"></script>
    
    <!-- CSS for chat -->
    <link rel="stylesheet" href="css/chat.css">

    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- CSS for navbar and body-->
    <link rel="stylesheet" href="css/main.css">

    <!-- favicon-->
    <link rel="icon" href="images/dog_icon.svg">

</head>

<body style = "background-color: #FFF8EE; height: 100vh; font-size: 16px;font-family: 'Poppins', sans-serif;">

<div id = 'app'>
<nav class="navbar navbar-expand-md navbar-light" id="header">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <object id = 'logo' data="images/logo.svg" type="image/svg+xml" height="45px" width="180px" class = 'ps-3' alt = 'logo'></object></a>
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
                    <li class="nav-item">
                        <a class="nav-link active me-5" href="chat.php">Chat &nbsp</a>
                    </li>
                </ul>
                <span>
                    <span class = 'px-2' id = 'profile_text' >Hi, {{username}}! </span>
                    <div class="dropdown me-5 d-inline">
                    <a href = '#' class = 'dropdown-toggle' id = 'defaultDropdown'
                    data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                    <img :src =  'img_url' style = 'width: 50px; height : 50px; border-radius: 50%;'></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="defaultDropdown" >
                        <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="logout.php" style="text-decoration: none;"><button type = 'button' class = 'btn btn-warning rounded-pill mx-auto d-flex px-4 py-2 text-uppercase'>Sign Out</button></a></li>
                    </ul>
                    </div>
                    
                </span>
            </div>
        </div>
</nav>


    <!-- Start friends container -->

    <div class="container clearfix mt-3" style = "color: white;">
        <div class = "row">
            <div class="people-list col-4" id="people_list">
                <div class="search form-floating" id="search">
                    <input type="text" id = "name" placeholder="Search" v-model="search"/>
                    <i class="fa fa-search"></i>
                </div>

                <ul class="list" id = "people">

                    <div v-for="(chat_name,index) in chat_names">
                        <chat_list-component v-if="(chat_name.toLowerCase()).includes(search.toLowerCase()) ||
                        (owner_names[index].toLowerCase()).includes(search.toLowerCase())"
                            :name= "chat_name"
                            :owner_name = "owner_names[index]"
                            :counter = "index"
                            :chat_imgs = "chat_imgs[index]"
                            :profile_name = "username"
                            v-on:change="update($event)">
                        </chat_list-component>
                    </div>
                </ul>
            </div>

            <!-- start chat-header -->
            <div class="chat col" id="chat_window">
                <div class="chat-header clearfix">
                    <i class="back fas fa-chevron-left fa-2x" onclick="back()"></i>
                    &nbsp&nbsp&nbsp
                    <img :src='selected_img_url' alt="avatar" style = 'width: 50px; height : 50px; border-radius: 50%;'/>
                
                    <div class="chat-about">
                        <div class="chat-with" style="color:black">Dog Name : {{select_name}}</div>
                        <div class="chat-with" style="color:black">Username : <span id = "chatname">{{select_oname}}</span></div>
                    </div>
                </div>
            <!-- end chat-header -->
            
            <!-- start chat-history -->
                <div class="chat-history" id = "chat-history">
                    <ul id = "messages">
                    </ul>
                </div> 
            <!-- end chat-history --> 
            
            <!-- start chat-message -->
                <form class="chat-message clearfix" id = "messageForm">
                    <textarea name="message-to-send" id="msg-input"  placeholder="Type your message" rows="3"></textarea>
                    <button id="msg-btn" type='submit'>Send</button>  
                </form>
            <!-- end chat-message -->
            </div>
            <!-- end chat -->

            <!-- default chat page displayed -->
            <div class = "col bg-dark align-items-center justify-content-center" id="default_chat_page" style = "border-radius: 5px;">
                
                <div class = "containter bg-secondary rounded-pill p-2" style = "text-align: center;">
                    Select a chat to start messaging
                </div>
            </div>
        
        </div>
        <!-- end row -->
    </div> 

    <!-- end container -->
    <div class="row" style="margin:0">    
        <p id = 'copyright' class="text-center">Copyright &copy; 2021 DogPals. All Rights Reserved.</p>
    </div>
</div>

    <script>
            output = <?=$json_obj ?>;
            //console.log(output)

            friends_name = <?= $json_obj_friend_name ?>;
            //console.log(friends_name)

            friends_img = <?= $json_obj_friend_img ?>;
            //console.log(friends_img)

            friends_dog_name = <?= $json_obj_friend_dog_name ?>;
            const app = Vue.createApp({
            data() {
                return {
                username: output.username,
                img_url: output.img_src,
                chat_names: friends_dog_name,
                chat_imgs: friends_img,
                owner_names: friends_name,
                index: 1,
                selected_img_url: '',
                select_name:'',
                select_oname: '',
                search: ''
                }
            },
                methods: {
                update: function(update){
                    
                    //console.log('update',update)
                    this.select_name = update[0]
                    this.selected_img_url = update[1]
                    this.select_oname = update[2]
                },

                notification_all(profile_name) {
                //to check if user receive message from anyone
                    msgRef.on("value", function(snapshot) {
                        //console.log(snapshot.val());
                        for (key in snapshot.val()){
                            //console.log(snapshot.val()[key].chat_name)
                            if (profile_name == snapshot.val()[key].chat_name && snapshot.val()[key].receiverhasRead == false){
                                document.getElementById(profile_name).style.display = 'inline'
                                break
                            }
                        }
                    });
                }
                },
            })
    </script>

    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>

    <!-- firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-database.js"></script>

    <!-- <script src = "js/chat.js"></script> -->
    <!--
    <script src = "js/script.js"></script>
        -->
    <script src = "js/firebase.js"></script>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

<!-- Font Awesome Kit -->
<script src="https://kit.fontawesome.com/44ce658d05.js" crossorigin="anonymous"></script>
</body>
</html>