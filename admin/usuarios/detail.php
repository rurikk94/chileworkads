<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $u = usuarios(["id"=>$_GET["id"]])[0];
    if($u->getId_poblacion())
        $poblacion = poblaciones(["id"=>$u->getId_poblacion()])[0];
    $contactoPersona = contactoUsuario(["persona"=>$u->getId()]);
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
        <script src="https://kit.fontawesome.com/0786957a7f.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?=__URL__?>css/material-icons.css">
        <link rel="stylesheet" href="<?=__URL__?>css/css.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
    <title>Admin</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
    <?php echo adminmenu("usuarios"); ?>
                <a name="btn-volver" id="btn-add" class="btn btn-primary" href="./index.php" role="button">Volver</a>
                <a name="btn-admin" id="btn-admin" class="btn btn-info" onclick="return confirm('¿Está seguro?')" href="./admin.php?id=<?=$u->getId()?>" role="button"><?=($u->is_admin()) ? 'Quitar Admin' : 'Dar Admin'?></a>
                <a name="btn-dis" id="btn-dis" class="btn btn-warning" onclick="return confirm('¿Está seguro?')" href="./disable.php?id=<?=$u->getId()?>" role="button"><?=($u->getEnable()) ? 'Deshabilitar' : 'Habilitar'?></a>
                <a name="btn-del" id="btn-del" class="btn btn-danger" onclick="return confirm('¿Está seguro?')" href="./delete.php?id=<?=$u->getId()?>" role="button">Eliminar</a>
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
        </div>

        <script>
            $('.nav-link').hover(function() {
            $(this).toggleClass('bg-info text-light');
            });
        </script>
    </div>
</body>
<script>
var d = new Date(document.getElementById("fecha_nac").innerHTML);
document.getElementById("fecha_nac").innerHTML=d.toLocaleDateString();
</script>
</html>