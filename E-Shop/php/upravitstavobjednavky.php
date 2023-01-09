<?php
   session_start();
   if (isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["admin"] == 1) {
       if (isset($_POST["idobjednavky"]) && isset($_POST["stav"])) {
            $id = htmlspecialchars($_POST["idobjednavky"]);
            $stav = htmlspecialchars($_POST["stav"]);
            require("imports/db.class.php");   
            $db = DB::getInstance();
      
            $data = $db -> prepare("UPDATE stavy SET stav = ? WHERE idobjednavky = ?");  //vkladani do databaze
        
            $vysledek =  $data -> execute ([$stav, $id]);
            if ($vysledek == 1) {
                $_SESSION["stav"]["chyba"] = "Stav byl změněn";
            }else {
                $_SESSION["stav"]["chyba"] = "Neco je špatně";
            }
       }
   }else {
        header("Location: ../Main.php");
        exit();
   }
   header("Location: ../spravahtml.php");
   exit();