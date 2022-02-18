
<?php
    require_once "common.php";

    if(!isset($_SESSION['username'])) {
    header("Location: sign_in.php");
    exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

    <!-- External CSS Styling -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile.css">

    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!--AnimeJS CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Vue.js 3 CDN -->
    <script src="https://unpkg.com/vue@next"></script>
    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!-- Vue.js 3 CDN -->
    <script src="https://unpkg.com/vue@next"></script>
    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!--Change Favicon-->
    <link rel="icon" href="images/dog_icon.svg">


    
</head>

<body>
<main>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-md navbar-light" id="header">
        <div class="container-fluid" id = 'app'>
            <a class="navbar-brand" href="main.html">
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



    <div id = 'main'>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <div class = 'container  mt-4' style="width: 210%;">
                        <div class = 'row'>
                            <div class = 'col-md-4 ps-5 border-end orange_btn'>
                                <div style="background-color:#e6a760;" class = 'badge rounded-circle p-3 mt-5 me-2'>
                                    <i class="fas fa-heart"></i>
                                </div> <span>Liked Dogs</span>
                                <br>
                                <div style="background-color:#e6a760;" class = 'badge rounded-circle p-3 mt-5 me-2'>
                                    <i class="fas fa-cog"></i>
                                </div> <span>Settings</span>
                                <br>
                                <div style="background-color:#e6a760;" id ='sign_out_badge' class = 'badge rounded-circle p-3 mt-5 me-2'>
                                    <i class="fas fa-sign-out-alt"></i>
                                </div> <span>Sign out</span>
                            </div>

                            <div class = 'col-4 col-md-8 text-center' id = 'profile_tab'>
                                <?php showSuccess(); ?>
                                <h3 class = 'mt-5'>Profile</h3>
                                <div class = 'row mx-auto d-flex'>
                                    <ul class="nav nav-pills mb-3 justify-content-center d-flex mt-4" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active me-5" @click = 'getProfile("owner")' id="pills-owner-tab" data-bs-toggle="pill" data-bs-target="#pills-owner" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Owner</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" @click = 'getProfile("dog")' id="pills-dog-tab" data-bs-toggle="pill" data-bs-target="#pills-dog" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Dog</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active mt-4" id="pills-owner" role="tabpanel" aria-labelledby="pills-owner-tab">
                                            <form class="row g-3 px-5" method = 'post' action = 'process_update.php' id = 'owner_form' enctype="multipart/form-data">
                                                <label for="uploadFile1">
                                                    <input id="uploadFile1" name = 'owner_img_src' type="file" class="d-none" @change = 'showPreview("owner")' :disabled = '!can_edit'>
                                                    <img :src="owner_img" id = 'owner_img' class="rounded rounded-circle mt-4" style="pointer-events: none; width: 100px; height: 100px;"/>
                                                </label>
                                                <h5 class = 'mt-5'>Basic Information </h5>
                                
                                                <!-- name -->
                                                <div class = 'input-group fields'>
                                                    <span class="input-group-text">First and Last name</span>
                                                    <input id = 'fname' name = 'first_name' v-model = 'owner_fname' type="text" aria-label="First name" class="form-control rounded-start" :disabled = '!can_edit'>
                                                    <input id = 'lname' name = 'last_name' v-model = 'owner_lname' type="text" aria-label="Last name" class="form-control rounded-start" :disabled = '!can_edit'>
                                                </div>
                                
                                                <!-- gender -->
                                                <div class="btn-group fields" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" name = 'owner_gender' value = 'Male' class="btn-check" id="owner_male" autocomplete="off" v-model = 'owner_gender' :checked = 'owner_gender == "Male"' :disabled = '!can_edit'>
                                                    <label class="btn btn-outline-secondary" for="owner_male">Male</label>
                                                
                                                    <input type="radio" name = 'owner_gender' value = 'Female'  class="btn-check" id="owner_female" autocomplete="off"  v-model = 'owner_gender' :checked = 'owner_gender == "Female"' :disabled = '!can_edit'>
                                                    <label class="btn btn-outline-secondary" for="owner_female">Female</label>
                                                
                                                </div>
                                
                                                <!-- dob -->
                                                <div class = 'input-group fields'>
                                                    <span class="input-group-text">Date of Birth</span>
                                                    <input type="date" name = 'owner_dob' v-model = 'owner_dob' class="form-control rounded-start" id="owner_dob"  :disabled = '!can_edit'>  
                                                </div>

                                                <div class = 'row col-10 col-md-4 mt-4 justify-content-center mx-auto ' >
                                                    <button type="button" class="btn btn-secondary" id = 'edit_owner' @click="editProfile" v-if = '!can_edit'>Edit Profile</button>
                                                    <button type = 'button' class="btn btn-secondary" id = 'save_owner' @click = 'saveProfile("owner")' v-if = 'can_edit'>Save</button>
                                                </div>
                                                <input type = 'hidden' name = 'owner_check' value = 'owner'>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="pills-dog" role="tabpanel" aria-labelledby="pills-dog-tab">
                                            <form class="row g-3 px-5" method = 'post' action = 'process_update.php' id = 'dog_form' enctype="multipart/form-data">
                                                <label for="uploadFile2">
                                                    <input id="uploadFile2" name = 'dog_img_src' type="file" class="d-none" @change = 'showPreview("dog")' :disabled = '!can_edit'>
                                                    <img :src="dog_img" id = 'dog_img' class="rounded rounded-circle mt-4" style="pointer-events: none; width: 100px; height: 100px;"/>
                                                </label>

                                                <h5 class = 'mt-5'>Basic Information </h5>
                                
                                                <!-- name -->
                                                <div class = 'input-group fields'>
                                                    <span class="input-group-text">Name</span>
                                                    <input type="text" name = 'dog_name' class="form-control rounded-start" id="dog_name" v-model = 'dog_name' :disabled = '!can_edit'>
                                                </div>
                                
                                                <!-- gender -->
                                                <div class="btn-group fields" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="dog_gender" value = 'Male' id="dog_male"  autocomplete="off" v-model = 'dog_gender' :checked = 'dog_gender == "Male"'  :disabled = '!can_edit'>
                                                    <label class="btn btn-outline-secondary" for="dog_male">Male</label>
                                                
                                                    <input type="radio" class="btn-check" name="dog_gender"  value = 'Female' id="dog_female"  autocomplete="off" v-model = 'dog_gender' :checked = 'dog_gender == "Female"'  :disabled = '!can_edit'>
                                                    <label class="btn btn-outline-secondary" for="dog_female">Female</label>
                                                
                                                </div>
                                
                                                <!-- dob -->
                                                <div class = 'input-group fields'>
                                                    <span class="input-group-text">Date of Birth</span>
                                                    <input type="date" name = 'dog_dob' v-model = 'dog_dob' class="form-control rounded-start" id="dog_dob" :disabled = '!can_edit'>  
                                                </div>

                                                <!-- breed -->
                                                <div class = 'input-group fields'>
                                                    <span class="input-group-text">Breed</span>
                                                    <!-- insert breed list-->
                                                    <select class="form-select rounded-start" id="breed"  :disabled = '!can_edit' v-model = 'breed' name = 'breed'>
                                                        <option :selected = 'dog_breed == breed' v-for = 'dog_breed of dogs' :value = 'dog_breed' >{{dog_breed}}</option>
                                                    </select>  
                                                </div>

                                                <!-- weight -->
                                                <div class = 'input-group fields'>
                                                    <span class="input-group-text">Weight</span>
                                                    <select class="form-select rounded-start" id="weight" v-model = 'weight' :disabled = '!can_edit' name = 'weight'>
                                                        <option value = 'Less than 15kg'>Less than 15kg</option>
                                                        <option value = '15kg - 25kg'>15kg - 25kg</option>
                                                        <option value = 'More than 25kg' >More than 25kg</option>
                                                    </select>  
                                                </div>



                                                <!--personality-->
                                                <div class = 'fields'>
                                                    <h5 class = 'text-center'>Personality Type</h5>
                                                    <div class = 'col-12'>
                                                        <input type="checkbox" :checked = 'personality.includes("energetic")' v-model = 'personality' name = 'personality[]' value="energetic" id="energetic" style="width: 18px; height: 18px;" class = 'me-1 mt-2 form-check-input shadow-none ' :disabled = '!can_edit'>
                                                        <label for = 'energetic' class = 'me-2 mt-1'>Energetic</label>
                                                        <input type="checkbox"  :checked = 'personality.includes("friendly")' v-model = 'personality' name = 'personality[]' value="friendly" id="friendly" style="width: 15px; height: 16px;" class = 'me-1 mt-2 form-check-input shadow-none ':disabled = '!can_edit'>
                                                        <label for = 'friendly' class = 'me-2 mt-1'>Friendly</label>
                                                        <input type="checkbox"  :checked = 'personality.includes("gentle")' v-model = 'personality'  name = 'personality[]'value="gentle" id="gentle" style="width: 15px; height: 16px;" class = 'me-1 mt-2  form-check-input shadow-none ' :disabled = '!can_edit'>
                                                        <label for = 'gentle' class = 'me-2 mt-1'>Gentle</label>
                                                        <input type="checkbox" :checked = 'personality.includes("reserved")' v-model = 'personality'  name = 'personality[]' value="reserved" id="reserved" style="width: 15px; height: 16px;" class = 'me-1 mt-2  form-check-input shadow-none ' :disabled = '!can_edit'>
                                                        <label for = 'reserved' class = 'me-2 mt-1'>Reserved</label>
                                                    </div>
                                                
                                                    <div class = 'col-12'>
                                                        <input type="checkbox" :checked = 'personality.includes("sensitive")' v-model = 'personality'  name = 'personality[]' value="sensitive" id="sensitive" style="width: 15px; height: 16px;" class = 'me-1 mt-3 form-check-input shadow-none ' :disabled = '!can_edit'>
                                                        <label for = 'sensitive' class = 'me-2 mt-1'>Sensitive</label>
                                                        <input  type="checkbox" :checked = 'personality_others.length > 0'  name = 'personality[]' value="others" id="others" style="width: 15px; height: 16px;" class = 'me-1 mt-3  form-check-input shadow-none ' :disabled = '!can_edit' ref="isChecked">
                                                        <label for = 'others' class = 'me-2 mt-1'>Others</label>
                                                        <input type="text" id = 'others_text' class="form-control form-control-sm d-inline-flex w-50 mt-1" v-model = 'personality_others'  :disabled = '!can_edit' name = 'others'>
                                                    </div>
                                                </div>
                                            


                                                <!-- fav places -->
                                                <div class = 'input-group fields'>
                                                    <span class="input-group-text">Fav Places</span>
                                                    <textarea name = 'fav_place' class="form-control rounded-start" v-model = 'fav_place' id="fav_place" :disabled = '!can_edit'></textarea>
                                                </div>

                                                
                                                <div class = 'row col-10 col-md-4 mt-4 justify-content-center mx-auto' >
                                                    <button type="button" class="btn btn-secondary" id = 'edit_dog' @click="editProfile" v-if = '!can_edit' >Edit Profile</button>
                                                    <button type="button" class="btn btn-secondary" id = 'save_dog' @click="saveProfile('dog')" v-if = 'can_edit'>Save</button>

                                                </div>
                                                <input type = 'hidden' name = 'dog_check' value = 'dog'>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    

    </div>




</main>

<!-- firebase -->
<script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-database.js"></script>

<!--Main External JS file-->
<script src = 'js/main.js'></script>
<script src = 'js/profile.js'></script>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>