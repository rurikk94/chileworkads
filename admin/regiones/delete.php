<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $region = new Region();
    $region->setId($_GET["id"]);
    if($region->eliminar())
        header("Location: ./index.php");
        die();
}
?>