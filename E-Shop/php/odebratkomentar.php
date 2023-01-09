<?php
   session_start();
   
            require("imports/db.class.php");   
            $db = DB::getInstance();
            if (isset($_GET["id"]) ){
                $id = htmlspecialchars($_GET["id"]);
                $data = $db -> prepare("SELECT mail FROM komentare WHERE komentare.id = ? "); 
                $data -> execute ([$id]);
                $vysledek = $data -> fetch(PDO::FETCH_ASSOC);
                
       if (isset($_SESSION["uzivatel"]) && ($_SESSION["uzivatel"]["admin"] == 1 || $_SESSION["uzivatel"]["email"] == $vysledek["mail"])) {
           
        

          
                     $data = $db -> prepare("DELETE FROM komentare WHERE id = ?");  //vkladani do databaze
          
                    $data -> execute ([$id]);
                     $vysledek = $data -> rowCount();
                    if ($vysledek >= 1) {
              exit(json_encode("true"));
                    }
              }
    
    
        }else {
            exit(json_encode("false1"));
        }
         
          
      
    
    exit(json_encode("false"));
   
?>