<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["oficios"])){
        $oficioPersona = oficioPersona(["persona"=>is_login(false)]);
        foreach($_POST["oficios"] as $oficio){
            $op = new OficioPersona();
            $op->setPersona_id(is_login(false));
            $op->setOficio_id($oficio["tipooficio"]);
            $op->setExperiencia($oficio["experiencia"]);
            $op->setDetalle($oficio["detalle"]);
            if ($op->insertar()) {
                header('200 OK');
                print "Guardado";
                //return TRUE;
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                print "Error al Guardar";
                //return FALSE;
            }
        }
        if(!is_null($oficioPersona)){
        foreach($oficioPersona as $cp){
            $cp->eliminar();
        }}
    }
?>