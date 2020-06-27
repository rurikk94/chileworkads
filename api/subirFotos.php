<?php require_once("../functions.php"); ?>
<?php

    if (($_SERVER["REQUEST_METHOD"] == 'POST') && is_login(false)){
        $config["upload_path"] = "uploads/images/";
        $config["allowed_type"] = ["jpg","png","jpeg","gif","webp","svg","svg"];
        $config["max_size"] = 10*1000000;//*1Mb

        if (isset($_FILES["file"])){
            $subida = new Upload($config);
            if ($subida->do_upload($_FILES["file"]))
            {
                header('200 OK');
                //print "Eliminado";
                print $subida->nombre_archivo_subido;
                return TRUE;
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                print "Error al Guardar";
                return FALSE;
            }
        }
    }{

        header('HTTP/1.1 403 Error');
        print "Error";
        return FALSE;
    }


?>