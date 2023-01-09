<?php
session_start();
require("php/imports/db.class.php");
$db = DB::getInstance();
    if (isset($_SESSION["uzivatel"])) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/uzivatel.css">
    <script src="https://kit.fontawesome.com/78d11c4789.js" crossorigin="anonymous"></script>
    <script src="js/hodnoceniobchodu.js" defer></script>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <title>Uživatel</title>
</head>
<header id="header">
<a href="Main.php" style="text-decoration:none;  color: rgb(228, 197, 161);">  <div id="nadpis">  <b>Whisky</b></div> </a>

      
      <?php
//uzivatel - login

if (isset($_SESSION["uzivatel"])) { 
    ?>



    <div id="uzivatel">
    

        <a href="uzivatel.php" style="text-decoration:none;  color: rgb(228, 197, 161);">  <i class="fa-solid fa-user-large uzivatel_button"></i></a>
        <a href="php/odhlasit.php" style="text-decoration:none;  color: rgb(228, 197, 161);">   <i class="fa-solid fa-right-from-bracket odhlasit_button"></i></a>
     
    <div id="uzivateljmeno"> <?=  $_SESSION["uzivatel"]["email"];?> 
    </div>
        <!-- <a href="php/odhlasit.php" style="display:block; margin-top: 5px;"> <button> Odhlásit se</button></a> -->
    </div>
<?php
}else{
    ?>
    <form action="php/login.php" method="post">
    <div id="login">
      <div style="margin: 15px;"><label class="login_text" for="name" ><b></b></label>
      <input  type="text" class="login_text_input" placeholder="<?=isset($_SESSION["email"]) ? $_SESSION["email"]: "Email"  ?>" name="email" required>
  </div>
  <div style="margin: 15px; ">
      <label class="login_text" for="psw" ><b></b></label>
      <input  type="password" placeholder="<?=isset($_SESSION["heslo"]) ? $_SESSION["heslo"]: "Heslo" ?>" name="heslo" required>
  </div>
  <button style="margin: 15px; background-color: rgb(170, 133, 107);" type="submit" class="login">Přihlásit se</button>

 
  
  <a href="register.php">  <button  style="margin: 15px;background-color: rgb(170, 133, 107);" type="button" class="registr">Registrovat</button></a>
</form>
</div>
<?php
}


?>

<!-- kosik -->
<a href="kosikhtml.php"  style="text-decoration: none; color: brown">

   <div class=" fa-solid fa-cart-shopping kosik_header " >
    <span id="kosik_pocet">
        <?php
        if (isset($_SESSION["kosik"])) {
            $pocet = 0;
            foreach ($_SESSION["kosik"] as $key => $value) {
                $pocet += $value;
                
            }
            echo($pocet);
        }else{
            echo("0");
        }
        ?>
    </span>
    
   </div>
</a>

    </header>
<body>
   <div id="main">
        <div class="objednavka">    
            <div id="prumer_hodnoceni">
                <?php
                    $data = $db -> prepare("SELECT ROUND(AVG(hodnota),1) FROM hodnoceniobchodu"); 
                    $data -> execute ();
                    $hodnocenivysledek = $data -> fetch(PDO::FETCH_NUM)[0];
                    if ($hodnocenivysledek == null) {
                        $hodnocenivysledek = 0;
                    }
                ?>
                Hodnocení našeho obchodu:
            <?=$hodnocenivysledek?>
               <i class="fa-solid fa-star" style="color:yellow"></i> 
            </div>
        
            <div id="hodnoceni">
        <?php
        $hvezda = $db -> prepare("SELECT hodnota FROM hodnoceniobchodu WHERE mail = ?"); 
        $hvezda -> execute ([$_SESSION["uzivatel"]["email"]]);
        $vysledek = $hvezda -> fetch(PDO::FETCH_ASSOC);
                
            ?>  
        <i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 1)?"yellow":"black"?>" ></i>
        <i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 2)?"yellow":"black"?>" ></i>
        <i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 3)?"yellow":"black"?>" ></i>
        <i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 4)?"yellow":"black"?>" ></i>
        <i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 5)?"yellow":"black"?>" ></i>


            </div>
            <table id="tabulka_objednavek">
            <tr id="">
                    <th class="objednavka_cislo">Objednavka číslo</th>
                    <th class="adresa"> Adresa</th>
                    <th class="postup_objednavky">Telefon</th>
                    <th class="postup_objednavky">Postup objednávky</th>
                    <th class="cena_objednavky"> Cena objednávky</th>
                </tr>
                <?php
                    $data = $db -> prepare("SELECT concat(adresa.mesto, ', ', adresa.ulice, ' ', adresa.cp) AS adresa, adresa.tel AS telefon, objednavka.id AS id, SUM(objednavka.pocet*produkt.cena) AS cena, adresa.mail AS mail, stavy.stav AS stav FROM ((objednavka INNER JOIN produkt ON objednavka.idproduktu = produkt.id) INNER JOIN adresa ON objednavka.id=adresa.idobjednavky) INNER JOIN stavy ON stavy.idobjednavky = objednavka.id WHERE adresa.mail = ? GROUP BY objednavka.id");
                    $data -> execute ([$_SESSION["uzivatel"]["email"]]);
                    $vysledek = $data -> fetchAll(PDO::FETCH_ASSOC);
                    if (!$vysledek) {
                        // echo "sss";
                    }
                    foreach ($vysledek as $key => $value) {
                        ?>
                            <tr class="radek_objednavky">
                                <td><?=$value["id"]?></td>
                                <td> <?=$value["adresa"]?></td>
                                <td> <?=$value["telefon"]?></td>
                                <td><?=$value["stav"]?></td>
                                <td> <?=$value["cena"]?> kč</td>
                            </tr>
                        <?php
                    }
                
                ?>
            </table>
            
        </div>

    </div>
</body>
<footer>    
    <div id="info_footer">
            <div id="info_footer_in">
                <div class="kontakty">
        <a  class="fa fa-facebook-official" href="https://www.facebook.com/" style="font-size:60px;text-decoration:none;  color: black "></a>
        <a  class="fa fa-instagram" href="https://www.instagram.com/" style="font-size:60px;margin-left: 20px; text-decoration:none;  color: black "></a>
        <a class="fa fa-twitter"  href="https://www.twitter.com/" style="font-size:60px;margin-right: 20px; margin-left: 20px; text-decoration:none;  color: black "></a>
                </div>
                <div class="kontakty">
                    <span class="kontakt_span"><b>TEL:</b> 892 022 109</span>
                    <span class="kontakt_span"><b>Email:</b> info@whisky.eu</span>
                    <span class="kontakt_span"><b>Adresa:</b> Pardubice Příčná ulice 22</span>
                </div>
                <div class="kontakty">
                Zákaz prodeje alkoholu osobám mladším 18 let.
                Při převzetí zboží bude ověřen váš věk.
                Fotografie produktů a zboží jsou ilustrativní
                </div>
            </div>
    </div>
        
    </footer>
</html>
<?php
}else{
    header("location: Main.php") ;
    exit();
}

?>