<?php
   session_start();
   if (isset($_SESSION["uzivatel"])) {
       if (isset($_GET["id"])) {
            $id = htmlspecialchars($_GET["id"]);
      
                 require("imports/db.class.php");   
                 $db = DB::getInstance();
      
      
                 $data = $db -> prepare("DELETE FROM oblibene WHERE mail = ? AND idproduktu = ?");  //vkladani do databaze
      
                $data -> execute ([$_SESSION["uzivatel"]["email"],$id]);
                 $vysledek = $data -> rowCount();
                if ($vysledek >= 1) {
          exit(json_encode("delete"));
      }
         $data = $db -> prepare("INSERT INTO oblibene (mail,idproduktu) VALUES (?, ?)");  //vkladani do databaze
      
         $vysledek =  $data -> execute ([$_SESSION["uzivatel"]["email"],$id]);
         if ($vysledek == 1) {
             
           
             exit("true");
          }
        // exit(json_encode($id));
       }
   }
   
   exit("false");
?>