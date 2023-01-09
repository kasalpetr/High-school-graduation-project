<?php

session_start();
if (isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["admin"] == 1) {
    $hodnoty = ["nazev", "zkratka"];
    $z5 = "pridatdruh.php" ;
    include "imports/nactipost.php";
        require("imports/db.class.php");   
        $db = DB::getInstance();

        $data = $db -> prepare("INSERT INTO druhy (nazev, zkratka) VALUES (?, ?)");  //vkladani do databaze
        $vysledek =  $data -> execute ([$nazev, $zkratka]);
    if ($vysledek == 1) {
        $_SESSION["zkratkahotovo"] = "Zkratka byla přidána";
        header("location: ../pridatdruh.php") ;
        exit();
    }
}
$_SESSION["zkratkahotovo"] = "Zkratka nebyla";
header("location: ../pridatdruh.php") ;
?>