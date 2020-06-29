<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        $p = usuarios(["id"=>is_login(false)]);
            if(sizeof($p)==1){
                $p[0]->setCV(NULL);
                if ($p[0]->actualizarCV()) {
                    header('200 OK');
                    print "Guardado";
                    return TRUE;
                } else {
                    header('HTTP/1.1 500 Internal Server Error');
                    print "Error al Guardar";
                    return FALSE;
                }
            }
    }
?>