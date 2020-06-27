<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'GET') && is_admin(false)  && isset($_GET["id"])){
        //$r = new Reporte();
        $r=reportesO(["id_resena"=>$_GET["id"]])[0];
        if($r->getRevisado())
            $r->setRevisado('0');
        else
            $r->setRevisado('1');

        if ($r->actualizar()) {
            header('200 OK');
            print "Modificado";
            return TRUE;
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            print "Error al Guardar";
            return FALSE;
        }
    }else{

        header('HTTP/1.1 403 Error');
        print "Error";
        return FALSE;
    }


?>