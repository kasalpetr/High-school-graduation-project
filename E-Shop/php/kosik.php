<?php
session_start();
    if (isset($_GET["id"])) {
            $id = htmlspecialchars($_GET["id"]);
        if (isset($_SESSION["kosik"][$id])) {
            $_SESSION["kosik"][$id]++;
        }else{
            $_SESSION["kosik"][$id] = 1;
        }
        $pocet = 0;
        foreach ($_SESSION["kosik"] as $key => $value) {
            $pocet+= $value;
        }
         exit(json_encode($pocet));
        }
exit(json_encode("false"));
?>