<?php require_once("../functions.php"); ?>
<?php is_login();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $u = usuarios(["id"=>$_GET["id"]])[0];
    if($u->getId_poblacion())
        $poblacion = poblaciones(["id"=>$u->getId_poblacion()])[0];
    $contactoPersona = contactoUsuario(["persona"=>$u->getId()]);
    $favorito = favoritos(["user"=>is_login(false),"persona"=>$u->getId()]);
    $oficiosPersona = oficioPersona(["persona"=>$u->getId()]);
}
if(!isset($_GET["id"])){
    header("location:".__URL__."index.php");exit();
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
    <title>Usuario</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
        <h1>Usuario</h1>
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
        <?php if($u->getId()==is_login(false)) : ?>
            <a name="btn-fav" id="btn-fav" class="btn btn-info" href="./edit.php" role="button"><?=($u->getId()==is_login(false)) ? 'Editar Mi Perfil' : ''?></a>
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
                        <td><?php if($u->getId_poblacion()){
                                echo $poblacion->getNombre_poblacion().", ".$poblacion->getCiudad_nombre();
                            ?>
                                <a target="_blank" href="<?="https://www.google.com/maps/search/".$poblacion->getNombre_poblacion().", ".$poblacion->getCiudad_nombre()."/";?>"><img src="<?=__URL__."uploads/images/gmap.png"?>"  style="height: 100px" alt=""></a>

                        <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Contacto</td>
                        <td>

                            <div class="card-columns" id="contactos">
                            <?php if (!is_null($contactoPersona)){foreach($contactoPersona as $cp): ?>
                                <div class="card red" id="red-<?=$cp->getId()?>" tipored="<?=$cp->getRed_id()?>" valor="<?=$cp->getValor()?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <img class="card-img-top" src="<?=__URL__."uploads/images/".$cp->getIcono_red()?>" alt="Card image cap">
                                            </div>
                                            <div class="col-9">
                                                <h6 class="card-title"><?=$cp->getValor()?></h6>
                                                <a href="<?=$cp->getUrl_red().$cp->getValor()?>"  target="_blank" class="btn btn-block btn-primary">Ir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;}?>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>Oficios</td>
                        <td>
                            <div class="card-columns" id="oficios">
                            <?php if (!is_null($oficiosPersona)){foreach($oficiosPersona as $op): ?>
                                <div class="card oficio" id="oficio-<?=$op->getId()?>" tipooficio="<?=$op->getOficio_id()?>" expeciencia="<?=$op->getExperiencia()?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <img class="card-img-top" src="<?=__URL__."uploads/images/".$op->getOficio_icon()?>" alt="Card image cap">
                                            </div>
                                            <div class="col-9">
                                                <h6 class="card-title"><?=$op->getOficio_nombre()?></h6>
                                                <p>experiencia: <?=$op->getExperiencia()?></p>
                                                <p>detalle: <?=$op->getDetalle()?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;}?>
                            </div>

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