<?php
foreach ($hodnoty as $key => $value) {
    if (isset($_POST[$value]) && $_POST[$value] != "") {
        
        $$value = htmlspecialchars($_POST[$value]);
    }else{
        header("location: ".$z5) ;
        exit();
    }
}


?>