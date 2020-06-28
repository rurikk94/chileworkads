<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'GET')
    && isset($_GET["id"])
    && isset($_GET["quien_resena"])
    && isset($_GET["motivo"])){
        $r = new Reporte();

        $r->setResena_id($_GET["id"]);
        $r->setPerfil_resena($_GET["perfil"]);
        $r->setQuien_reporta(is_login(false));
        $r->setQuien_resena($_GET["quien_resena"]);
        $r->setMotivo($_GET["motivo"]);

        if ($r->insertar()) {
            header('200 OK');
            print "Guardado";
            return TRUE;
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            print "Error al Guardar";
            return FALSE;
        }
    };
?>