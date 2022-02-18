<?php

$connect = @mysqli_connect("localhost","root","","dogpals");

if($connect) {
    if(!empty($_POST['username'])){
        $query = "SELECT * FROM users WHERE username='".$_POST['username']."'";
        $result = mysqli_query($connect,$query);
        $count = mysqli_num_rows($result);
        if($count > 0){
            echo "<span id = 'check-username'style = 'color:#E00004'>Username already exists</span>";
        }
    }
    
}
?>