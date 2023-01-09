<?php
session_start();
require("php/imports/db.class.php");
$db = DB::getInstance();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="stylesheet" href="css/kosik.css"> 
    <script src="https://kit.fontawesome.com/78d11c4789.js" crossorigin="anonymous"></script>
    <script src="js/kosik.js" defer></script>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
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
<body >
   
    <div id="main">
        <?php
            if (!isset($_SESSION["kosik"])) {
        ?>
            <span id="prazdny_kosik">Košík je prázdný</span>
        <?php
            }else{
                if (isset($_SESSION["error"]["objednavka"]["mail"])) {
                    echo "<p>" . $_SESSION["error"]["objednavka"]["mail"] . "</p>";
                    unset($_SESSION["error"]["objednavka"]["mail"]);
                }
                if (isset($_SESSION["error"]["objednavka"]["psc"])) {
                    echo "<p>" . $_SESSION["error"]["objednavka"]["psc"] . "</p>";
                    unset($_SESSION["error"]["objednavka"]["psc"]);
                }
                if (isset($_SESSION["error"]["objednavka"]["tel"])) {
                    echo "<p>" . $_SESSION["error"]["objednavka"]["tel"] . "</p>";
                    unset($_SESSION["error"]["objednavka"]["tel"]);
                }
                if (isset($_SESSION["error"]["objednavka"]["cp"])) {
                    echo "<p>" . $_SESSION["error"]["objednavka"]["cp"] . "</p>";
                    unset($_SESSION["error"]["objednavka"]["cp"]);
                }
        ?>
        <form action="php/novaobjednavka.php" method="post">
            <table id="tabulka_produktu" >
            <tr>
                <th class="nadpis_tabulka">Název</th>
                <th class="nadpis_tabulka">Počet</th>
                <th class="nadpis_tabulka">Cena za ks</th>
                <th class="nadpis_tabulka">Cena celkem</th>
            </tr>
                <?php
                $celkemCelkem = 0;
                    foreach ($_SESSION["kosik"] as $key => $value) {
                        $data = $db -> prepare("SELECT * FROM produkt WHERE id = ?");
                        $data -> execute ([$key]);
                        $vysledek = $data -> fetch(PDO::FETCH_NUM);

                        ?>
                            <tr class="radek_produktu">
                               
                                <td><?=$vysledek[0]?></td>
                                <input type="hidden" name="id[]" value="<?=$vysledek[3]?>" ">
                                <td><input class="pocetKosik" type="number" name="pocet[]" min="0" value="<?=$value?>" style=""></td>
                                <td><span class="cenazaks"><?=$vysledek[1]?></span> Kč</td>
                                <td><span class="celkemCena"><?=$vysledek[1] * $value?></span> Kč</td>
                            </tr>
                        <?php
                       $celkemCelkem += $vysledek[1] * $value;
                    }
                ?>
            </table>
            <h2> Celková cena: <span class="cenacelkemcelkem"><?=$celkemCelkem?></span> Kč</h2>
            <div>
                <input class="adresa" type="text" name="jmeno" required placeholder="Jméno">
                <input class="adresa" type="text" name="prijmeni" required placeholder="Příjmení">
                <input class="adresa" type="text" name="tel" required placeholder="Tel. bez předvolby">
                <input class="adresa" type="<?=(isset($_SESSION["uzivatel"]["email"])) ? "hidden" :"text" ;?>" name="mail" required placeholder="E-Mail" value="<?=(isset($_SESSION["uzivatel"]["email"])) ? ($_SESSION["uzivatel"]["email"]) :"" ;?>">
                <input class="adresa" type="text" name="mesto" required placeholder="Město">
                <input class="adresa" type="text" name="ulice" required placeholder="Ulice">
                <input class="adresa" type="text" name="cp" required placeholder="Číslo popisné">
                <input class="adresa" type="text" name="psc" required placeholder="PSČ">
            </div>
            <button type="submit" id="button_objednavka">Odeslat Objednávku</button>
        </form>

         <?php
            }
        ?>

    </div>
  
</body>

</html>