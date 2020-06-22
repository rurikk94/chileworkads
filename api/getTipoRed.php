<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
        $redes = redesSociales(["id"=>$_GET["id"]])[0];
        echo json_encode($redes->toArray());

    }
?>