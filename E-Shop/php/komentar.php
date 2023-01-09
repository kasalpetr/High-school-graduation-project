<?php

session_start();
if (isset($_SESSION["uzivatel"])) {
    
            if (isset($_GET["idproduktu"])) {
                $idproduktu = $_GET["idproduktu"];
                $hodnoty = ["komentar"];
                $z5 = " ../produkt.php?id=".$_GET["idproduktu"] ;
                include "imports/nactipost.php";
            }else {
                header("location: ../Main.php") ;
                exit();
            }
  
        require("imports/db.class.php");   
        $db = DB::getInstance();
if (($komentar == "")) {
    header("location: ../produkt.php?id=".$_GET["idproduktu"]) ;

    exit();
    
}

$data = $db -> prepare("INSERT INTO komentare (mail,komentar,idproduktu) VALUES (?, ?, ?)");  //vkladani do databaze
$vysledek =  $data -> execute ([$_SESSION["uzivatel"]["email"],$komentar, $idproduktu]);
if ($vysledek == 1) {
    $_SESSION["produktpridan"] = "Produkt byl pridan";
     header("location: ../produkt.php?id=".$_GET["idproduktu"]) ;
    exit();
    
}else{
    $_SESSION["produktpridan"] = "Produkt se posral";
     header("location: ../produkt.php?id=".$_GET["idproduktu"]) ;
    
    exit();
}
}else{
    header("location: ../Main.php") ;
    exit();
}
?>