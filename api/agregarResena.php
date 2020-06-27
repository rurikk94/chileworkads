<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["trabajador"])  && isset($_POST["resena"]) && isset($_POST["val"])){
        $r = new Resena();

        $r->setTrabajador_id($_POST["trabajador"]);
        $r->setQuien_resena_id(is_login(false));
        $r->setTexto($_POST["resena"]);
        $r->setImagenes($_POST["imagenes"]);
        $r->setEvaluacion($_POST["val"]);

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

        /* $ciudades = ciudades(["id_comuna"=>$_GET["comuna"]]);
        $array=[];
        foreach ($ciudades as $c) {
            array_push($array,$c->toArray());
        }
        echo json_encode($array); */


?>