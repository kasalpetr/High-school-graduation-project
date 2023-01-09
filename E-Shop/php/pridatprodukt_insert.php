<?php

session_start();
if (isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["admin"] == 1) {
    $hodnoty = ["nazev", "cena", "popis", "typ"];
    $z5 = "pridatprodukt.php" ;
    include "imports/nactipost.php";
    $file = $_FILES["obrazek"];
    $check = getimagesize($_FILES["obrazek"]["tmp_name"]);
    if($check !== false) {
        // mkdir("produkty", 0755);
      move_uploaded_file($file["tmp_name"], "produkty/". ($uid = uniqid() . "_" . $file["name"]));

        // echo $uid;
        require("imports/db.class.php");   
        $db = DB::getInstance();

$data = $db -> prepare("INSERT INTO produkt (nazev,cena,popis,obrazek, typ) VALUES (?, ?, ?, ?, ?)");  //vkladani do databaze
$vysledek =  $data -> execute ([$nazev,$cena, $popis, $uid, $typ]);
if ($vysledek == 1) {
    $_SESSION["produktpridan"] = "Produkt byl pridan";
     header("location: ../pridatprodukt.php") ;
    exit();
    
}else{
    $_SESSION["produktpridan"] = "Produkt se posral";
     header("location: ../pridatprodukt.php") ;
    
    exit();
}
    }else{
        $_SESSION["spatnysoubor"] = "spatny";
        header("location: ../pridatprodukt.php") ;
    }
}else{
    header("location: ../Main.php") ;
    exit();
}
?>