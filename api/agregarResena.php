<?php require_once("../functions.php"); ?>
<?php
    if (!is_login(false))
    {
        http_response_code(403);
        return FALSE;
    }

    if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["trabajador"])  && isset($_POST["resena"]) && isset($_POST["val"])){

    try {
        $array["trabajador_id"] = $_POST["trabajador"];
        $array["quien_resena_id"] = is_login(false);
        $array["texto"] = $_POST["resena"];
        $array["evaluacion"] = $_POST["val"];
        $array["imagenes"] = $_POST["imagenes"];

        $r = Resena::fromArray($array);

        if ($r->insertar()) {
            header('201 Created');
            print "Guardado";
            return TRUE;
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            print "Error al Guardar";
            return FALSE;
        }
    } catch (Exception $e) {

        //header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(["error"=>$e->getMessage()]);
        http_response_code(400);
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        print "Error al Guardar";
        return FALSE;
    }
    };


?>