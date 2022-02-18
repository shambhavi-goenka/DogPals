<?php

session_start();


    if (isset ($_SESSION["username"])){
        unset($_SESSION["username"]);
        unset($_SESSION["errors"]);
        $_SESSION = [];
        header("Location: index.html");
        exit;
    }
    else
    {
        header("Location: sign_in.php");
        $_SESSION = [];
        die;
    }

?>