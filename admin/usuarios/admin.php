<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $u = usuarios(["id"=>$_GET["id"]])[0];
    if($u->is_admin()){
        if($u->cambiarAdmin(0)){
            header("Location: ./detail.php?id=".$_GET["id"]);
            die();
        }
    }else{
        if($u->cambiarAdmin(1)){
            header("Location: ./detail.php?id=".$_GET["id"]);
            die();
        }

    }
}
?>