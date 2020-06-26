<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["bio"])){
        $p = usuarios(["id"=>is_login(false)]);
        //foreach($_POST["oficios"] as $oficio){
            //$p = new User();
            //$p->setPersona_id(is_login(false));
            if(sizeof($p)==1){
                $p[0]->setBio($_POST["bio"]);
                if ($p[0]->actualizar()) {
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