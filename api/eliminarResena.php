<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'GET')  && isset($_GET["id"])){
        $r=resenas(["id"=>$_GET["id"]])[0];
        //$r = new Resena();
        $r->setEnable(0);
        if(is_admin(false) OR ($r->getQuien_resena_id()==is_login(false)))
        if ($r->delete()) {
            header('200 OK');
            print "Eliminado";
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