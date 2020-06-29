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
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
            <div class="card mx-auto col-10 col-md-4 m-2">
                <img src="<?=__URL__."uploads/images/".$u->getFoto_file()?>" style="width: 100px;" class="card-img-top rounded-circle mx-auto mt-2" alt="...">
                <div class="card-body text-center">
                    <h5 class="card-title"><?=$u->getNombres()?> <?=$u->getApellidos()?>
                    </h5>
                    <?php if($u->getId()==is_login(false)) : ?>
                        <a name="btn-fav" id="btn-fav" class="btn btn-outline-info mt-2" href="./edit.php" role="button"><?=($u->getId()==is_login(false)) ? '<span class="material-icons">edit</span>Editar' : ''?></a>
                    <?php endif; ?>
                    <?php if($u->getId()!=is_login(false)) : ?>
                        <a name="btn-fav" id="btn-fav" class="btn btn-outline-danger mt-2" onclick="return confirm('¿Está seguro?')" href="../favorites/toggle.php?id=<?=$u->getId()?>" role="button"><?=!is_null($favorito) ? '<span class="material-icons">favorite</span> Eliminar Favorito' : '<span class="material-icons">favorite_border</span> Agregar Favorito '?></a>
                    <?php endif;?>
                    <?=$u->getBio()?>
                </div>
                <div class="card mb-2">
                    <div class="card-header">
                        Datos
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Genero: <?=$u->getGenero()?></li>
                        <li class="list-group-item" id="fecha">Nacimiento: <?=$u->getFecha_nacimiento()?></li>
                        <li class="list-group-item">Email: <?=$u->getCorreo()?></li>
                        <li class="list-group-item">Localidad:
                        <?php if($u->getId_poblacion()){
                                    echo $poblacion->getNombre_poblacion().", ".$poblacion->getCiudad_nombre();
                                ?>
                                    <a target="_blank" href="<?="https://www.google.com/maps/search/".$poblacion->getNombre_poblacion().", ".$poblacion->getCiudad_nombre()."/";?>"><img src="<?=__URL__."uploads/images/gmap.png"?>"  style="height: 100px" alt=""></a>

                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        <hr>
        <?php if (!is_null($u->getCV())): ?>
            <h3>Curriculum Vitae</h3>
            <iframe src = "<?=__URL__?>js/ViewerJS/#<?=__URL__."uploads/docs/".$u->getCV()?>"
            width='100%' height='500' allowfullscreen webkitallowfullscreen></iframe>
        <hr>
        <?php endif;?>
        <?php if (!is_null($contactoPersona)){ ?>
            <h3>Redes Sociales</h3>

            <div class="card-columns" id="contactos">
                <?php foreach($contactoPersona as $cp): ?>
                    <div class="card red shadow bg-white rounded" id="red-<?=$cp->getId()?>" tipored="<?=$cp->getRed_id()?>" valor="<?=$cp->getValor()?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img class="card-img-top" src="<?=__URL__."uploads/images/".$cp->getIcono_red()?>" alt="Card image cap">
                                </div>
                                <div class="col-6">
                                    <h6><?=$cp->getValor()?></h6>
                                    <a href="<?=$cp->getUrl_red().$cp->getValor()?>"  target="_blank" class="btn btn-block btn-primary">Ir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <hr>
        <?php } ?>

        <?php if (!is_null($oficiosPersona)){ ?>
            <h3>Oficios</h3>
            <div class="card-columns" id="oficios">
                <?php foreach($oficiosPersona as $op): ?>
                    <div class="card oficio shadow p-3 mb-5 bg-white rounded" id="oficio-<?=$op->getId()?>" tipooficio="<?=$op->getOficio_id()?>" expeciencia="<?=$op->getExperiencia()?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img   class="card-img-top" src="<?=__URL__."uploads/images/".$op->getOficio_icon()?>" alt="Card image cap">
                                </div>
                                <div class="col-6">
                                    <h6><?=$op->getOficio_nombre()?></h6>
                                    <p>experiencia: <?=$op->getExperiencia()?></p>
                                    <p>detalle: <?=$op->getDetalle()?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <hr>
        <?php }?>

        <h3>Reseñas</h3>
        <?php if($u->getId()!=is_login(false)) : ?>
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 col-sm-3 col-md-2">
                        <?php $yo = usuarios(["id"=>is_login(false)])[0];?>
                            <img style="max-width:100px;" class="card-img-top rounded-circle img-thumbnail" src="<?=__URL__?>uploads/images/<?=$yo->getFoto_file()?>" alt="Card image cap">
                        </div>
                        <div class="col-9 col-sm-9 col-md-10">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-8">
                                    <div class="w-100 editor" id="editor" style="background-color: #f5f6f7;" name="editor">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4">
                                    <script src="<?=__URL__?>js/dropzone-5.7.0/dist/dropzone.js"></script>
                                    <link rel="stylesheet" href="<?=__URL__?>js/dropzone-5.7.0/dist/dropzone.css">
                                    <form action="../api/subirFotos.php" id="weasubir" class="dropzone"></form>
                                </div>
                            <div class="col-12 mt-2">
                                <link rel="stylesheet" href="<?=__URL__?>css/slider.css">
                                <div class="slidecontainer">
                                    <input type="range" min="0" max="10" value="0" name="estrellasResena" class="slider" id="estrellasResena">
                                    <p>Calificación: <span id="estrellasTextresena"></span></p>
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
                    <button id="addresena" class="btn btn-success btn-block">Agregar Reseña</button>
                </div>
            </div>
        <?php endif;?>

        <?php $resenas = resenas(["trabajador_id"=>$_GET["id"]]);?>
        <?php if (is_null($resenas)) {echo ("<h3>No tiene reseñas</h3>"); }
        else { ?>

            <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
            <h3>Reseñas Previas</h3>
            <?php
            foreach($resenas as $r) :
                $resenador = usuarios(["id"=>$r->getQuien_resena_id()])[0];
                ?>
                <div class="card shadow mb-4" id="resena_<?=$r->getId()?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-2">
                                <img class="my-auto rounded-circle img-thumbnail" src="<?=__URL__?>uploads/images/<?=$resenador->getFoto_file()?>" alt="Card image cap">
                            </div>
                            <div class="col-5 col-sm-5 col-md-7">
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
                            <div class="col-12 col-sm-12 col-md-3">
                                <?php $im = json_decode($r->getImagenes()); ?>
                                <?php if (!is_null($im) AND (sizeof($im)>0)): ?>
                                    <div class="fotorama mt-3" data-height="200" data-allowfullscreen="true" data-loop="true" data-nav="thumbs">
                                    <?php foreach( $im as $i): ?>
                                        <img src="<?=__URL__."uploads/images/".$i?>">
                                    <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center text-muted">
                        <?php if($resenador->getId()!=is_login(false)) : ?>
                            <i class="btn btn-outline-secondary" onclick="sendReporte('<?=$_GET['id']?>','<?=$r->getId()?>','<?=$resenador->getId()?>');" resena="<?=$r->getId()?>"><small><span class="material-icons">report_problem</span>Reportar</small></i>
                        <?php endif; ?>
                        <?php if(is_admin(false) OR ($resenador->getId()==is_login(false))) : ?>
                            <i class="btn btn-outline-danger" onclick="eliminarResena('<?=$r->getId()?>')" resena="<?=$r->getId()?>"><small><span class="material-icons">delete</span>Eliminar Reseña</small></i>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } ?>
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

<?php if($u->getId()!=is_login(false)) : ?>
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
        var imagenes = [];
    document.querySelector( '#addresena' ).addEventListener( 'click', () => {
        const resena = editor.getData();
        const val = document.getElementById("estrellasResena").value
        if(val==0)
            {
                alert("Por favor califique a la persona.");
                return;
            }
        if(resena=="")
            {
                alert("Por favor escriba una reseña.");
                return;
            }
        if(imagenes.length==0)
            {
                alert("Por favor escriba suba algunas imagenes.");
                return;
            }
        const trabajador = <?=$_GET["id"]?>
        //console.log(resena)
        const data = new FormData();
        data.append('resena', resena);
        data.append('val', val);
        data.append('imagenes', JSON.stringify(imagenes));
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
    <script>
        Dropzone.options.weasubir = {
        paramName: "file", // The name that will be used to transfer the file
        dictDefaultMessage: "Subas las imagenes",
        maxFilesize: 10, // MB
        success: function(file, response) {
            //alert(response);
            imagenes.push(response);
            },
        };
    </script>
<?php endif; ?>
    <script>const __URL__ = '<?=__URL__?>';</script>
    <script src="<?=__URL__?>js/resena.js"></script>
    <script src="<?=__URL__?>js/sendreporte.js"></script>
</html>