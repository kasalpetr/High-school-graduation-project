<?php
session_start();
?>

<?php
require("php/imports/db.class.php");
$db = DB::getInstance();

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $idproduktuhodnoceni = $id;
  $data = $db -> prepare("SELECT * FROM produkt WHERE id = ?"); 
 $data -> execute ([$id]);
 $vysledek = $data -> fetch(PDO::FETCH_ASSOC);


} else {
  header("location: Main.php") ;
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/thisprodukt.css">
    <script src="https://kit.fontawesome.com/78d11c4789.js" crossorigin="anonymous"></script>
    <script src="js/main.js" defer></script>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <title>Produkt</title>
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
<body id="<?=$id?>">
  <div class="thisprodukt_info">
    
    <div class="produkt_image"><img  class="obrazek" src="php/produkty/<?=$vysledek["obrazek"]?>"></div>

<div class="thisprodukt_popis"><span id="nazev_produktu"><?=$vysledek["nazev"]?></span>
<p> 
  <?php
 $data = $db -> prepare("SELECT ROUND(AVG(hodnota),1) FROM hodnoceniproduktu WHERE idproduktu = ?"); 
 $data -> execute ([$idproduktuhodnoceni]);
 $hodnocenivysledek = $data -> fetch(PDO::FETCH_NUM);
if ($hodnocenivysledek[0] == null) {
  $hodnocenivysledek[0] = 0;
}

?>
<div id="prumer_hodnoceni">
<?=$hodnocenivysledek[0]?>
 <i class="fa-solid fa-star" style="color:yellow"></i> 
 </div>
 <p> 
   <?=$vysledek["popis"]?> 

   <!-- kosik button -->
   <div class="produkt_do_kosiku "> <button id="<?= $id?>" class="produkt_do_kosiku_button  zrusitodkaz" >Do Košíku</button></div> 

</div>

<div class="produkt_image_right"><img  class="obrazek" src="php/produkty/<?=$vysledek["obrazek"]?>"></div>



</div>
<div id="hodnoceni">
<?php
      if (isset($_SESSION["uzivatel"])) {   
  $hvezda = $db -> prepare("SELECT hodnota FROM hodnoceniproduktu WHERE mail = ? AND idproduktu = ?"); 
  $hvezda -> execute ([$_SESSION["uzivatel"]["email"],$idproduktuhodnoceni]);
  $vysledek = $hvezda -> fetch(PDO::FETCH_ASSOC);
        
      ?>  
<i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 1)?"yellow":"black"?>" ></i>
<i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 2)?"yellow":"black"?>" ></i>
<i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 3)?"yellow":"black"?>" ></i>
<i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 4)?"yellow":"black"?>" ></i>
<i class="fa-solid fa-star hodnoceni" style="color: <?=(isset($vysledek["hodnota"]) && $vysledek["hodnota"] >= 5)?"yellow":"black"?>" ></i>


<?php
      }
?>
</div>
<?php
if (isset($_SESSION["uzivatel"])){
  # code...
 ?> 
   <form action="php/komentar.php?idproduktu=<?=$id?>" method="POST">
 <div class="komentare">
   <textarea  name="komentar" style="resize:none" class="kom" cols="80" rows="10" required></textarea>
   <button  type="submit" class="pridat_komentar">Přidat komentář</button>
  </div>
  </form>
<?php
} else {
 ?> <div class="komentare">
  <textarea disabled name=""  cols="80" rows="5" id="zadavanikom"> Pro zadání komentáře se přihlaste </textarea>
 </div>
 <?php
}


$data = $db -> prepare("SELECT * FROM komentare INNER JOIN uzivatel ON komentare.mail = uzivatel.mail WHERE komentare.idproduktu = ? ORDER BY komentare.id DESC"); 
$data -> execute ([$id]);
$vysledek = $data -> fetchall(PDO::FETCH_ASSOC);

foreach ($vysledek as $key => $value) {
  ?>

<div class="komentare">
  <div  class="kom_jmeno" ><?= $value["nazev"] ?> <?php
      if (isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["admin"] == 1) {      
      ?>  
      <i class="fa-solid fa-trash-can"  style="float:right" id="<?=$value["id"]?>" ></i> 
      <?php
      }else{
        if (isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["email"] === $value["mail"] ) {
        ?>
          <i class="fa-solid fa-trash-can" style="float:right"  id="<?=$value["id"]?>"></i> 
          <?php
        }
      }
  
  ?>
  
</div>
<div  name="" class="kom" ><?=$value["komentar"]?></div>
</div>


<?php
}
?>

  
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