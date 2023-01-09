<?php
session_start();

    if (isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["admin"] == 1) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/administrace.css">
    <script src="https://kit.fontawesome.com/78d11c4789.js" crossorigin="anonymous"></script>

    <title>Administrace</title>
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

    </header>
<body>
   <div id="main">
      
        <a href="pridatprodukt.php" style="color: black;background-color: none; text-decoration: none;"> 
            <div class="navigace">Přidat produkt</div>
        </a>
        <a href="pridatdruh.php" style="color: black;background-color: none; text-decoration: none;">
            <div class="navigace">Přidat druh</div>  
        </a>
        <a href="spravahtml.php" style="color: black;background-color: none; text-decoration: none;">
            <div class="navigace">Správa objednávek</div>  
        </a>
        <a href="prehledobjednavek.php" style="color: black;background-color: none; text-decoration: none;">
            <div class="navigace">Přehled objednávek</div>  
        </a>
        <a href="Main.php" style="color: black;background-color: none; text-decoration: none;">
            <div class="navigace">Zpět k produktům</div>  
        </a>

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