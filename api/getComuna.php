<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["region"])){
        $comunas = comunas(["id_region"=>$_GET["region"]]);
        $array=[];
        foreach ($comunas as $c) {
            array_push($array,$c->toArray());
        }
        echo json_encode($array);

    }
?>