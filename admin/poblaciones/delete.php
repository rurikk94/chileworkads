<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $poblacion = new Poblacion();
    $poblacion->setId_poblacion($_GET["id"]);
    if($poblacion->eliminar())
        header("Location: ./index.php");
        die();
}
?>