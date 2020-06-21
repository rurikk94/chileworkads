<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $ciudad = new Ciudad();
    $ciudad->setId_ciudad($_GET["id"]);
    if($ciudad->eliminar())
        header("Location: ./index.php");
        die();
}
?>