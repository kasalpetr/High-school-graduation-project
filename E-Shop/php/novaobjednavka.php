<?php
session_start();
    if (isset($_POST["id"]) && isset($_POST["pocet"])) {
        require("imports/db.class.php");
        $db = DB::getInstance();
        $idpole = [];
        $pocetpole = [];
        $_SESSION["kosik"] = [];
        foreach ($_POST["id"] as $key => $value) {
            $idpole[] = htmlspecialchars($value);
            $pocetpole[] = htmlspecialchars($_POST["pocet"][$key]);
        }
        foreach ($idpole as $key => $value) {
            $_SESSION["kosik"][$value] = $pocetpole[$key];
        }
        $hodnoty = ["jmeno", "prijmeni", "tel", "mail", "mesto", "ulice", "cp", "psc"];
        $z5 = " ../kosikhtml.php";
        include "imports/nactipost.php";

        $psc = str_replace(" ", "", $psc);
        $tel = str_replace(" ", "", $tel);
        $chyba = 0;
        if (!is_numeric($tel)) {
            $_SESSION["error"]["objednavka"]["tel"] = "Špatný formát tel";
            $chyba++;
        }
        if (!is_numeric($cp)) {
            $_SESSION["error"]["objednavka"]["cp"] = "Špatný formát cp";
            $chyba++;
        }
        if (!is_numeric($psc)) {
            $_SESSION["error"]["objednavka"]["psc"] = "Špatný formát psc";
            $chyba++;
        }
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
        if (!preg_match($regex, $mail)) {
            $_SESSION["error"]["objednavka"]["mail"] = "Špatný formát mail";
            $chyba++;
        }
        if ($chyba != 0) {
            header("Location: ../kosikhtml.php");
            exit();
        }

        $data = $db -> prepare("SELECT IFNULL(MAX(id), 0)+1 FROM objednavka");
        $data -> execute ();
        $vysledek = $data -> fetch(PDO::FETCH_NUM);
        $max = $vysledek[0];
        foreach ($idpole as $key => $value) {
            $data = $db -> prepare("INSERT INTO objednavka (id,idproduktu,pocet) VALUES (?, ?, ?)");
            $vysledek =  $data -> execute ([$max, $value, $pocetpole[$key]]);
        }
        $data = $db -> prepare("INSERT INTO adresa (idobjednavky,jmeno, prijmeni, tel, mail, mesto, ulice, cp, psc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $vysledek =  $data -> execute ([$max, $jmeno, $prijmeni, $tel, $mail, $mesto, $ulice, $cp, $psc]);

        $data = $db -> prepare("INSERT INTO stavy (idobjednavky, stav) VALUES (?, 'Na skladě')");
        $vysledek =  $data -> execute ([$max]);
    
        header("Location: ../hotovaobjednavka.php");
        exit();
    }
    header("Location: ../kosikhtml.php");
    exit();
?>