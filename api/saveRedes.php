<?php require_once("../functions.php"); ?>
<?php
    is_login();

    if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["redes"])){
        $contactoPersona = contactoUsuario(["persona"=>is_login(false)]);
        foreach($_POST["redes"] as $red){
            $r = new Contacto();
            $r->setId_persona(is_login(false));
            $r->setRed_id($red["tipored"]);
            $r->setValor($red["valor"]);
            if(!$r->insertar())
                $error=1;
        }
        if(!is_null($contactoPersona)){
        foreach($contactoPersona as $cp){
            $cp->eliminar();
        }}
    }
?>