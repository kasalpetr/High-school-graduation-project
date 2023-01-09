<?php
session_start();
session_destroy();

if (isset($_GET["idproduktu"])) {
    header("location: ../produkt.php?id=".$_GET["idproduktu"]);
} else {
    header("location: ../Main.php");
}
?>