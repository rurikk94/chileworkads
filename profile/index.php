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
        <script src="https://kit.fontawesome.com/0786957a7f.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?=__URL__?>css/material-icons.css">
        <link rel="stylesheet" href="<?=__URL__?>css/css.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?=__URL__?>css/material-icons.css">
        <link rel="stylesheet" href="<?=__URL__?>css/css.css">
        <link rel="stylesheet" href="<?=__URL__?>css/cards.css">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
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
        <div class="table">
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
                        <td>Bio</td>
                        <td><?=$u->getBio()?></td>
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
                        <td id="fecha"><?=$u->getFecha_nacimiento()?></td>
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
                        <td>Redes Sociales</td>
                        <td>

                            <div class="card-columns" id="contactos">
                            <?php if (!is_null($contactoPersona)){foreach($contactoPersona as $cp): ?>
                                <div class="card red" id="red-<?=$cp->getId()?>" tipored="<?=$cp->getRed_id()?>" valor="<?=$cp->getValor()?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-9 col-md-3">
                                                <img class="card-img-top" src="<?=__URL__."uploads/images/".$cp->getIcono_red()?>" alt="Card image cap">
                                            </div>
                                            <div class="col-sm-9 col-md-9">
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
                                            <div class="col-sm-9 col-md-3">
                                                <img class="card-img-top" src="<?=__URL__."uploads/images/".$op->getOficio_icon()?>" alt="Card image cap">
                                            </div>
                                            <div class="col-sm-9 col-md-9">
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
                    <tr>
                        <td>Reseñas
                        </td>
                        <td>

                        <?php if($u->getId()!=is_login(false)) : ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-9 col-md-2">
                                        <?php $yo = usuarios(["id"=>is_login(false)])[0];?>
                                            <img style="max-width:100px;" class="card-img-top rounded-circle img-thumbnail" src="<?=__URL__?>uploads/images/<?=$yo->getFoto_file()?>" alt="Card image cap">
                                        </div>
                                        <div class="col-sm-9 col-md-10 ">
                                            <div class="row">
                                                <div class="w-100 editor" id="editor" style="background-color: #f5f6f7;" name="editor"></div>
                                            </div>
                                            <div class="row">
                                                <link rel="stylesheet" href="<?=__URL__?>css/slider.css">
                                                <div class="slidecontainer">
                                                    <input type="range" min="0" max="10" value="0" name="estrellasResena" class="slider" id="estrellasResena">
                                                    <p>Valoración: <span id="estrellasTextresena"></span></p>
                                                </div>
                                                <script>
                                                var slider = document.getElementById("estrellasResena");
                                                var output = document.getElementById("estrellasTextresena");
                                                output.innerHTML = slider.value;

                                                slider.oninput = function() {
                                                    output.innerHTML = this.value;
                                                }
                                                </script>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <button id="addresena" class="btn btn-success">Agregar Reseña</button>
                            </div>

                        <?php endif;?>
                        <?php $resenas = resenas(["trabajador_id"=>$_GET["id"]]);?>
                        <?php if (is_null($resenas)) {echo ("<h1>No tiene reseñas</h1>"); }
                        else {
                        echo '<h3>Reseñas Previas</h3>';
                        foreach($resenas as $r) :
                        $resenador = usuarios(["id"=>$r->getQuien_resena_id()])[0];
                        ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-9 col-md-2">
                                        <img style="max-width:100px;" class="card-img-top rounded-circle img-thumbnail" src="<?=__URL__?>uploads/images/<?=$resenador->getFoto_file()?>" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-9 col-md-10">
                                        <p><a href="<?=__URL__?>profile?id=<?=$resenador->getId()?>"><?=$resenador->getNombres()?> <?=$resenador->getApellidos()?> </a><span class="text-muted fecha"><?=$r->getFecha()?></span></p>
                                    <?php $nota = $r->getEvaluacion();
                                    if($nota>6):?>
                                    <span class="material-icons md-48">star</span><?=$nota?>
                                    <?php elseif($nota>3): ?>
                                    <i class="material-icons md-36">star_half</i><?=$nota?>
                                    <?php elseif($nota>0): ?>
                                    <i class="material-icons md-18">star_outline</i><?=$nota?>
                                    <?php endif; ?>
                                        <h6 class="card-title"><?=$r->getTexto()?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                                    <?php } ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    var d = new Date($('#fecha').html());
    $('#fecha').html(d.toLocaleDateString());
    $('.fecha').each( function(index) {
        var d = new Date($(this).html());
        $(this).html(d.toLocaleDateString() + " " + d.toLocaleTimeString());
    });
</script>

<script src="../js/ckeditor.js"></script>
	<script>InlineEditor
			.create( document.querySelector( '#editor' ), {
                placeholder: 'Escriba una reseña...',

				toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'underline',
						'blockQuote',
						'insertTable',
						'undo',
						'redo'
					]
				},
				language: 'en',
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',

			} )
			.then( editor => {
				window.editor = editor;




			} )
			.catch( error => {
				console.error( 'Oops, something gone wrong!' );
				console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
				console.warn( 'Build id: 4eoalpo8okv1-lqk2ucq9lghg' );
				console.error( error );
      } );
	</script>
    <script>
    document.querySelector( '#addresena' ).addEventListener( 'click', () => {
        const resena = editor.getData();
        const val = document.getElementById("estrellasResena").value
        const trabajador = <?=$_GET["id"]?>
        //console.log(resena)
        const data = new FormData();
        data.append('resena', resena);
        data.append('val', val);
        data.append('trabajador', trabajador);
        fetch('../api/agregarResena.php', {
          method: 'POST',
          body: data
        }).then(function(response) {
            if(response.ok) {
                console.log('Respuesta OK');
                alert("Reseña publicada");
                location.reload();
            } else {
                console.log('Respuesta de red OK pero respuesta HTTP no OK');
            }
        })
        .catch(function(error) {
        console.log('Hubo un problema con la petición Fetch:' + error.message);
        });

        // ...
    } );
    </script>
</html>