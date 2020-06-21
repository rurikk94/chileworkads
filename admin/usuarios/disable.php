<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $u = usuarios(["id"=>$_GET["id"]])[0];
    if($u->getEnable()){
        if($u->deshabilitar()){
            header("Location: ./detail.php?id=".$_GET["id"]);
            die();
        }
    }else{
        if($u->habilitar()){
            header("Location: ./detail.php?id=".$_GET["id"]);
            die();
        }

    }
}
?>