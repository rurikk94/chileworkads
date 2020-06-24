<?php require_once("../../functions.php"); ?>
<?php is_login();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["addpoblacion"]) && isset($_POST["selectciudad"])){
    $poblacion = new Poblacion();
    $poblacion->setNombre_poblacion($_POST["addpoblacion"]);
    $poblacion->setCiudad_id($_POST["selectciudad"]);
    if($poblacion->insertar())
        //header("Location: ./index.php");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        echo("<script>alert('Población Agregada')</script>");
        //header("Location: ./index.php");
        //die();
}
?>