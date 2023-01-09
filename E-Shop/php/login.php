<?php
session_start();
$hodnoty = ["email", "heslo"];
$z5 = "../Main.html" ;
include "imports/nactipost.php";
if (isset($_GET["idproduktu"])) {
    $presmerovani = " ../produkt.php?id=".$_GET["idproduktu"];
} else {
    $presmerovani = " ../Main.php";
}


require("imports/db.class.php");
$db = DB::getInstance();

$data = $db -> prepare("SELECT heslo,admin FROM uzivatel WHERE mail = ?");

 $data -> execute ([$email]);
 $vysledek = $data -> fetch(PDO::FETCH_NUM);
 
 if (!$vysledek) {
    $_SESSION["email"] = "Špatný Email";
    header("location:".$presmerovani) ;
    exit();
}

//  if (!$data -> fetch(PDO::FETCH_NUM)) {
//     echo "necospatne-mail";
//     exit();
//  }
if (password_verify($heslo,  $vysledek[0])) {
    $_SESSION["uzivatel"]["email"] = $email;
    $_SESSION["uzivatel"]["admin"] = $vysledek[1];
    
    header("location:".$presmerovani) ;
}else{
    $_SESSION["heslo"] = "Spatne Heslo";
    header("location:".$presmerovani) ;
    
}
?>