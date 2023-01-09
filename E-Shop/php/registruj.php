<?php
session_start();
$hodnoty = ["email", "nazev", "heslo" , "hesloznovu"];
$z5 = "../Main.php" ;
include "imports/nactipost.php";

$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
if (preg_match($regex, $email)) {
    
    if ($heslo == $hesloznovu) {  //kontrola shodnosti hesla
        $heslo = password_hash ($heslo, PASSWORD_DEFAULT); //heslo hash
    }else{
        $_SESSION["RegistraceHlaseni"] = "Vaše hesla se neshodují";
        header("location: ../register.php") ;
        exit();
    }
    echo $email;
    require("imports/db.class.php");   
    $db = DB::getInstance();
    
    $data = $db -> prepare("INSERT INTO uzivatel (mail,nazev,heslo, admin) VALUES (?, ?, ?, 0)");  //vkladani do databaze
    $vysledek =  $data ->execute([$email,$nazev, $heslo]);
    if ($vysledek == 1) {
        $_SESSION["RegistraceHlaseni"] = "Úspěšně zaregistrován";
        header("location: ../Main.php") ;
        exit();
    }else{
        $_SESSION["RegistraceHlaseni"] = "Použijte jiný email";
        // header("location: ../register.php") ;
        echo $email;
        echo $_SESSION["RegistraceHlaseni"];
        exit();
    }
} else { 
    
    $_SESSION["RegistraceHlaseni"] = "Špatný tvar Emailu";
    header("location: ../register.php") ;
    exit();
} 

// header("location: ../Main.html") ;
?>