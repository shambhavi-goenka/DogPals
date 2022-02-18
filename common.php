<?php

/***
to auto-load class definitions from PHP files
***/
spl_autoload_register(function($class) {
    
    $path = "model/".$class. ".php";
    require_once $path; 
    
});



/***
session related stuff
***/
session_start();


function showError() {
    if(isset($_SESSION['errors'])){
        $result ='<div class="alert alert-danger py-2" id = "error-alert" style = "font-size: 12px;">Invalid username or password. Please try again.</div>';
        echo $result;
        unset($_SESSION['errors']);
    }
    else {
        echo "";
    }
}

function showSuccess() {
    if(isset($_SESSION['update_success']) && $_SESSION['update_success'] == 'Y'){
        $result = ' <div class="alert alert-success alert-dismissible fade show" role="alert" id = "alert_error">
        Profile updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        echo $result;
        unset($_SESSION['update_success']);
    }

    elseif(isset($_SESSION['update_success']) && $_SESSION['update_success'] == 'N') {
        $result = ' <div class="alert alert-danger alert-dismissible fade show" role="alert" id = "alert_error">
        Error updating profile. Please try again!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        echo $result;
        unset($_SESSION['update_success']);
    }
    else {
        echo "";
    }
}


?>

