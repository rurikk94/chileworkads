<?php require_once("../functions.php"); ?>
<?php is_login();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $u = usuarios(["id"=>$_GET["id"]])[0];
    if($u->getId_poblacion())
        $poblacion = poblaciones(["id"=>$u->getId_poblacion()])[0];
    $contactoPersona = contactoUsuario(["persona"=>$u->getId()]);
    $favorito = favoritos(["user"=>is_login(false),"persona"=>$u->getId()]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=__URL__?>css/bootstrap.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
    <title>Admin</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
        <h1>Usuarios</h1>
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
        <?php if($u->getId()==is_login(false)) : ?>
            <a name="btn-fav" id="btn-fav" class="btn btn-info" onclick="return confirm('¿Está seguro?')" href="./edit.php?>" role="button"><?=($u->getId()==is_login(false)) ? 'Editar Mi Perfil' : ''?></a>
        <?php else: ?>
            <a name="btn-fav" id="btn-fav" class="btn btn-info" onclick="return confirm('¿Está seguro?')" href="../favorites/toggle.php?id=<?=$u->getId()?>" role="button"><?=!is_null($favorito) ? 'Eliminar Favorito' : 'Agregar Favorito'?></a>
        <?php endif;?>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Imagen</td>
                        <td><img src="<?=__URL__."uploads/images/".$u->getFoto_file()?>" class="img-fluid rounded-circle img-thumbnail" style="height: 100px" alt=""></td>
                    </tr>
                    <tr>
                        <td>Nombres</td>
                        <td><?=$u->getNombres()?></td>
                    </tr>
                    <tr>
                        <td>Apellidos</td>
                        <td><?=$u->getApellidos()?></td>
                    </tr>
                    <tr>
                        <td>Genero</td>
                        <td><?=$u->getGenero()?></td>
                    </tr>
                    <tr>
                        <td>RUT</td>
                        <td><?=$u->getRut()?></td>
                    </tr>
                    <tr>
                        <td>Tipo Usuario</td>
                        <td><?=tipoUsuario($u->getTipoUser())?></td>
                    </tr>
                    <tr>
                        <td>Fecha de Nacimiento</td>
                        <td id="fecha_nac"><?=$u->getFecha_nacimiento()?></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><?=$u->getCorreo()?></td>
                    </tr>
                    <tr>
                        <td>Poblacion</td>
                        <td><?php if(isset($poblacion))
                        echo $poblacion->getNombre_poblacion().", ".$poblacion->getCiudad_nombre();?></td>
                    </tr>
                    <tr>
                        <td>Contacto</td>
                        <td>
                        <?php if (!is_null($contactoPersona)){foreach($contactoPersona as $cp): ?>
                            <a href="<?=$cp->getUrl_red().$cp->getValor()?>"><img src="<?=__URL__."uploads/images/".$cp->getIcono_red()?>" class="img-fluid rounded img-thumbnail" style="height: 100px" alt="<?=$cp->getNombre_red()?>"></a>
                        <?php endforeach;}?>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
var d = new Date(document.getElementById("fecha_nac").innerHTML);
document.getElementById("fecha_nac").innerHTML=d.toLocaleDateString();
</script>
</html>