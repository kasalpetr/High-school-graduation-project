<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whisky-EShop</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/main800.css" media="(max-width:900px)">
    <script src="https://kit.fontawesome.com/78d11c4789.js" crossorigin="anonymous"></script>
    <script src="js/main.js" defer></script>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
</head> 
<header id="header">
<a href="Main.php" style="text-decoration:none;  color: rgb(228, 197, 161); text-align:center">  <div id="nadpis">  <b>Whisky</b></div> </a>

      
      <?php
      $limit = 6;
      if (isset($_GET["typ"])) {
        $typ = htmlspecialchars($_GET["typ"]);
      }else{
          $typ = false;
      }


  


      if (isset($_GET["strana"])) {
    $strana = htmlspecialchars($_GET["strana"]);
    if (!is_numeric($strana)) {
        $strana = 0;    
        
    }
}else {
    $strana = 0;
}


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
        
        <div id="navigace">
        <a href="Main.php" style="  color: black;background-color: none; text-decoration: none;"> <div class="navigace">
               Všechny Whisky
            </div>
</a>
            <?php
            require("php/imports/db.class.php");
            $db = DB::getInstance();
                $data = $db -> prepare("SELECT * FROM druhy");
                $data -> execute ();
                $vysledek = $data -> fetchAll(PDO::FETCH_NUM);
                foreach ($vysledek as $key => $value) {
                    ?>
                    <a href="?typ=<?=$value[2]?>" style="color: black;background-color: none; text-decoration: none;"> 
                        <div class="navigace"><?=$value[1]?></div>
                    </a>
                    <?php
                }
                ?>

                <a href="?typ=oblibene" style="color: black;background-color: none; text-decoration: none;"> 
                                       <div class="navigace">Oblíbené Whisky</div>
                                   </a>
                                   <?php
if (isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["admin"] == 1) {
    ?>
 <a href="administrace.php" style="color: black;background-color: none; text-decoration: none;"> <div class="navigace"> 
    Administrace
 </div>  
 </a>
 <?php
}

?>

              
           
            
        </div>
        
<?php

if ($typ) {
    //SELECTP podle typ
    if ($typ == "oblibene") {
        // print_r($_SESSION);
        if (isset($_SESSION["uzivatel"]["email"])) {
            # code...
            $data = $db -> prepare("SELECT produkt.*, IFNULL(oblibene.id,- 1)  FROM produkt LEFT JOIN oblibene ON produkt.id = oblibene.idproduktu  WHERE oblibene.mail = :mail ORDER BY produkt.id DESC LIMIT :limit OFFSET :offset");
            $data ->bindValue (":mail", ($_SESSION["uzivatel"]["email"]), PDO::PARAM_STR);
            // echo("11111111111111111111111111111111111111111111111111111111111");
        }else {
            $data = $db -> prepare("SELECT 1 FROM produkt WHERE 0 ORDER BY produkt.id DESC LIMIT :limit OFFSET :offset");
        }


    }else{

            $data = $db -> prepare("SELECT produkt.*, IFNULL(t1.id,- 1)  FROM produkt LEFT JOIN (SELECT * FROM oblibene WHERE oblibene.mail = :mail) t1 ON produkt.id = t1.idproduktu  WHERE produkt.typ = :typ ORDER BY produkt.id DESC LIMIT :limit OFFSET :offset");
            $data ->bindValue (":mail", (isset($_SESSION["uzivatel"]["email"]))?$_SESSION["uzivatel"]["email"]: "-1", PDO::PARAM_STR);
            $data ->bindValue (":typ", ($typ), PDO::PARAM_STR);

    }
} else {
    //SELECT bez typ

        $data = $db -> prepare("SELECT produkt.*, IFNULL(t1.id,- 1) FROM produkt LEFT JOIN (SELECT * FROM oblibene WHERE oblibene.mail = :mail) t1 ON produkt.id = t1.idproduktu  ORDER BY produkt.id DESC LIMIT :limit OFFSET :offset"); 
        $data ->bindValue (":mail", (isset($_SESSION["uzivatel"]["email"]))?$_SESSION["uzivatel"]["email"]: "-1", PDO::PARAM_STR);

}


    
    $data ->bindValue (":limit", (int) $limit, PDO::PARAM_INT);
    $data ->bindValue (":offset", (int) ($limit * $strana), PDO::PARAM_INT);
    $data -> execute ();
    $vysledek = $data -> fetchAll(PDO::FETCH_NUM);
    //  var_dump ($vysledek);
    //  echo $typ;
   
    ?>
<div id="main_produkty">
    <?php
foreach ($vysledek as $key => $value) {
    ?>
     <a href="produkt.php?id=<?=$value[3]?>" style="  color: black;background-color: none; text-decoration: none;">
        <div class="produkt" > 
            <div class="produkt_image" ><img  class="obrazek" src="php/produkty/<?=$value[4]?>" alt=""></div>
            <div class="produkt_name" ><?= $value[0]?></div>
            <div class="produkt_price"><?= $value[1]?> Kč</div>
            <div class="produkt_do_kosiku "> <button id="<?= $value[3]?>" class="produkt_do_kosiku_button  zrusitodkaz" >Do Košíku</button></div> 
            <div class="oblibeny_produkt " > <i style="color:<?= ($value[6] >= 0) ? "red" : "#DDE74B" ; ?>" id="<?= $value[3]?>" class=" fa-solid fa-heart oblibeny_produkt_button zrusitodkaz "  > </i><span id="<?= $value[3]?>" class="cross zrusitodkaz"><?=(isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["admin"] == 1) ? "&#x2715;" : "" ;?></span></div>
        </div>
    </a>
    
    <?php
}

if (!$vysledek) {
    if ($typ ==1 ) {
        if ($strana != 0) {
            # code...
            header("location: Main.php") ; 
            exit();
        }
    } else {
        if ($strana != 0 ) {
            # code...
            header("location: Main.php?typ=$typ") ; 
            exit();
        }
    }
    
}
?>
</div>
<!-- <div class="produkt"> 
    <div class="produkt_image"></div>
    <div class="produkt_name">Whisky 12y.o.</div>
    <div class="produkt_price">9999 Kč</div>
    <div class="produkt_do_kosiku"> <button class="produkt_do_kosiku_button"  >Do Kosiku</button></div>
</div> -->


</div>
<div style="text-align:center;">
    <?php
    if($typ == 1){
        ?>
        <a href="?strana=<?=--$strana?>" style="font-size:60px; color:black; margin: 20px; " class="fa-solid fa-angles-left"> </a>
        <?php
        $strana++;
    }else{
        ?>
        <a href="?typ=<?=$typ?>&strana=<?=--$strana?>" style=" font-size:60px; color:black; margin: 20px;" class="fa-solid fa-angles-left" >  </a>
        <?php
        $strana++;
        
    }
    ?>


<?php
    if($typ == 1){
        ?>
        <a href="?strana=<?=++$strana?>" style="font-size:60px; color:black; margin: 20px; " class="fa-solid fa-angles-right">   </a>
        <?php
    }else{
        ?>
        <a href="?typ=<?=$typ?>&strana=<?=++$strana?>" style=" font-size:60px; color:black; margin: 20px;" class="fa-solid fa-angles-right">  </a>
        <?php
    }
    ?>  
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
                <p>©  Petr Kasal 2022</p>
                </div>
            </div>
    </div>
        
    </footer>
</html>