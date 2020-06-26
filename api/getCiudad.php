<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["comuna"])){
        $ciudades = ciudades(["id_comuna"=>$_GET["comuna"]]);
        $array=[];
        foreach ($ciudades as $c) {
            array_push($array,$c->toArray());
        }
        echo json_encode($array);

    }
?>