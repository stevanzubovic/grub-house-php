<?php
define("SERVER", env("SERVER"));
define("DATABASE", env("DATABASE"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv) {
    $niz = file(__DIR__."/.env");
    $vrednost = "";

    foreach($niz as $red) {
        $parametar = explode("=", $red);
        if($parametar[0]==$naziv) {
            $vrednost = trim($parametar[1]);
        }
    }
    return $vrednost;
}


