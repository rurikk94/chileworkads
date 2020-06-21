<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $red = new Red();
    $red->setId($_GET["id"]);
    if($red->eliminar())
        header("Location: ./index.php");
        die();
}
?>