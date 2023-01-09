<?php
session_start();
if (isset($_SESSION["uzivatel"]) && $_SESSION["uzivatel"]["admin"] == 1) {
    if (isset($_GET["id"])) {
        $id = htmlspecialchars($_GET["id"]);
        require("imports/db.class.php");   
        $db = DB::getInstance();
        $data = $db -> prepare("DELETE FROM produkt WHERE id = ?");  //vkladani do databaze
        $data -> execute ([$id]);
        $vysledek = $data -> rowCount();
        if ($vysledek >= 1) {
            exit(json_encode("delete"));
        }
    }
}
exit(json_encode("false"));
?>