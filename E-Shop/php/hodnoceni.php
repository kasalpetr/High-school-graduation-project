<?php
   session_start();
   if (isset($_SESSION["uzivatel"])) {
       if (isset($_GET["idproduktu"]) && isset($_GET["hodnota"])) {
            $id = htmlspecialchars($_GET["idproduktu"]);
            $hodnota = htmlspecialchars($_GET["hodnota"]);
      
                if ($hodnota > 5) {
                    $hodnota = 5;
                }
                if ($hodnota < 1) {
                    $hodnota = 1;
                }
                 require("imports/db.class.php");   
                 $db = DB::getInstance();
      
                 $data = $db -> prepare("INSERT INTO hodnoceniproduktu (hodnota,mail,idproduktu) VALUES (?, ?, ?)");  //vkladani do databaze
                  $vysledek =  $data -> execute ([$hodnota,$_SESSION["uzivatel"]["email"],$id]);
      
                  if ($vysledek == 1) {
             
           
                    exit(json_encode("true"));
                 }else{
                 $data = $db -> prepare("UPDATE  hodnoceniproduktu SET hodnota = ? WHERE mail = ? AND idproduktu = ?");  //vkladani do databaze
                 $vysledek =  $data -> execute ([$hodnota,$_SESSION["uzivatel"]["email"],$id]);
                    if ($vysledek == 1) {
                    exit(json_encode("true"));
                        
                    }

                 }
      }
      
       }
   
   
   exit(json_encode("false"));
?>