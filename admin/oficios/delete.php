<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $oficio = new Oficio();
    $oficio->setId($_GET["id"]);
    if($oficio->eliminar())
        header("Location: ./index.php");
        die();
}
?>