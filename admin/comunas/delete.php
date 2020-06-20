<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $comuna = new Comuna();
    $comuna->setId($_GET["id"]);
    if($comuna->eliminar())
        header("Location: ./index.php");
        die();
}
?>