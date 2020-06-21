<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $u = usuarios(["id"=>$_GET["id"]])[0];
    if($u->is_admin()){
        if($u->cambiarTipoUser(2)){
            header("Location: ./detail.php?id=".$_GET["id"]);
            die();
        }
    }else{
        if($u->cambiarTipoUser(3)){
            header("Location: ./detail.php?id=".$_GET["id"]);
            die();
        }

    }
}
?>