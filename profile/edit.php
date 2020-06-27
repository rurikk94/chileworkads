<?php require_once("../functions.php"); ?>
<?php
    is_login();
    $u = usuarios(["id"=>is_login(false)])[0];
    $contactoPersona = contactoUsuario(["persona"=>$u->getId()]);
    $redes = redesSociales();
    $oficios = oficios();
    $ciudades = ciudades();
    $oficiosPersona = oficioPersona(["persona"=>$u->getId()]);
    if($u->getId_poblacion())
        $poblacion = poblaciones(["id"=>$u->getId_poblacion()])[0];
    if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_FILES["photo-file"])){
        $config["upload_path"] = "uploads/images/";
        $config["allowed_type"] = ["jpg","png","jpeg","gif","webp","svg","svg"];
        $config["max_size"] = 10*1000000;//*1Mb

        if (isset($_FILES["photo-file"])){
            $subida = new Upload($config);
            if ($subida->do_upload($_FILES["photo-file"]))
            {
                $u->setFoto_file($subida->nombre_archivo_subido);
                if($u->actualizarFoto())
                    echo "<script>alert('Usuario Modificado')</script>";
            }
        }
    }
    if(($_SERVER["REQUEST_METHOD"] == 'POST') && !isset($_FILES["photo-file"]))
    {
        $u->setNombres($_POST["nombres"]);
        $u->setApellidos($_POST["apellidos"]);
        $u->setGenero($_POST["genero"]);
        $u->setRut($_POST["rut"]);
        if($_POST["fecha_nac"]=="") $_POST["fecha_nac"]=NULL;
        $u->setFecha_nacimiento($_POST["fecha_nac"]);
        $u->setCorreo($_POST["correo"]);
        $u->setTipoUser($_POST["tipoUser"]);
        $u->setId_poblacion($_POST["poblacion"]);
        if($u->actualizar())
            header("Refresh:0");

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
        <script src="<?=__URL__?>js/validarRUT.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <title>Editar Mi Perfil</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
<div class="container">
<h1>Editar Mi Perfil</h1>

<div class="table-responsive">
    <table class="table">
        <tbody>
            <tr>
                <td><img src="<?=__URL__."uploads/images/".$u->getFoto_file()?>" class="img-fluid rounded-circle img-thumbnail" style="height: 100px" alt=""></td>
                <td>
                    <form method="post" enctype="multipart/form-data">
  <div class="form-row">
                        <div class="col-5 custom-file">
                            <input type="file" class="custom-file-input" name="photo-file" id="photo-file" lang="es" required>
                            <label class="custom-file-label" for="customFile">Subir Foto</label>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Cambiar Foto</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </td>
            </tr>
            <tr><td>Descripción</td>
            <td>
              <div class="editor" style="background-color:powderblue;">
                <?=!is_null($u->getBio()) ? $u->getBio():'Escribe algo sobre ti.'?>
              </div>
            <button type="submit" id="btn_bio"class="btn btn-primary">Guardar Bio</button>
            </td>

            </tr>
            <form method="post">
            <tr>
                <td>Nombres</td>
                <td><input type="text" name="nombres" id="nombres" value="<?=!is_null($u->getNombres()) ? $u->getNombres():''?>"></td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td><input type="text" name="apellidos" id="apellidos" value="<?=!is_null($u->getApellidos()) ? $u->getApellidos():''?>"></td>
            </tr>
            <tr>
                <td>Genero</td>
                <td><input type="text" name="genero" id="genero" value="<?=!is_null($u->getGenero()) ? $u->getGenero():''?>"></td>
            </tr>
            <tr>
                <td>RUT</td>
                <td><input type="text" oninput="checkRut(this)" name="rut" id="rut" value="<?=!is_null($u->getRut()) ? $u->getRut():''?>"></td>
            </tr>
            <tr>
                <td>Mostrar Perfil</td>
                <td>
                <select name="tipoUser" id="tipoUser">
                <option value="1" <?=(!is_null($u->getTipoUser()) && (1==$u->getTipoUser())) ? 'selected':''?>>No</option>
                <option value="2" <?=(!is_null($u->getTipoUser()) && (2==$u->getTipoUser())) ? 'selected':''?>>Si</option>
                </select>
                <p>Esta opción le permite que los otros usuarios puedan ver su perfil y
                 que lo puedan contactar con alguna de sus redes sociales</p>
                </td>
            </tr>
            <tr>
                <td>Fecha de Nacimiento</td>
                <td><input type="date" name="fecha_nac" id="fecha_nac" value="<?=!is_null($u->getFecha_nacimiento()) ? $u->getFecha_nacimiento():''?>"></td>
            </tr>
            <tr>
                <td>Correo</td>
                <td><input type="email" name="correo" id="correo" value="<?=!is_null($u->getCorreo()) ? $u->getCorreo():''?>"></td>
            </tr>
            <tr>
                <td>Ubicación</td>
                <td>
                <select class="js-example-basic-single" style="width: 50%" name="poblacion">
                    <?php //foreach($ciudades as $c) : ?>
                    <?php $poblaciones = poblaciones(/* ["ciudad_id"=>$c->getID()] */); ?>
                    <?php if(!is_null($poblaciones)) : ?>
                        <?php foreach($poblaciones as $p) : ?>
                        <?php //if($p->getCiudad_id()==$c->getId()) : ?>
                            <option value="<?=$p->getId()?>" <?=(isset($poblacion)&&($p->getId()==$poblacion->getId()))?'selected':''?>>
                                <?=$p->getNombre_poblacion()?>, <?=$p->nombre_ciudad?>
                            </option>
                        <?php //endif;?>
                        <?php endforeach;?>
                    <?php endif;?>
                    <?php //endforeach;?>
                </select>

                <?php
                if(isset($poblacion))
                    echo $poblacion->getNombre_poblacion().", ".$poblacion->getCiudad_nombre();
                ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#localidadModal" data-whatever="@fat">Agregar Población</button>
                </td>
            </tr>
            <tr>
            <td><button type="submit" class="btn btn-primary">Guardar</button></td><td></td>
            </tr>
            </form>
            <tr>
                <td>Redes Sociales
                    <button type="button" name="btn-editar-contactos" id="btn-editar-contactos" class="btn btn-primary btn-lg btn-block" onclick="showBtnDel()">Editar</button>
                    <button type="button" name="btn-guardar-contactos" id="btn-guardar-contactos" class="btn btn-success btn-lg btn-block" onclick="guardarContactos()">Guardar</button>
                    <button type="button" name="btn-add-contactos" id="btn-add-contactos"  class="btn btn-primary" data-toggle="modal" data-target="#ModalContacto">Agregar</button>
                </td>
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
                                        <a href="<?=$cp->getUrl_red().$cp->getValor()?>" class="btn btn-block btn-primary">Ir</a>
                                        <button onclick="eliminarContacto(this)" type="button" name="btn-eliminar-contacto" id="<?=$cp->getId()?>" class="btn btn-danger btn-lg btn-block btn-del-red">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;}?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Oficios
                    <button type="button" name="btn-editar-oficios" id="btn-editar-oficios" class="btn btn-primary btn-lg btn-block" onclick="showBtnDelOficio()">Editar</button>
                    <button type="button" name="btn-guardar-oficios" id="btn-guardar-oficios" class="btn btn-success btn-lg btn-block" onclick="guardarOficios()">Guardar</button>
                    <button type="button" name="btn-add-oficios" id="btn-add-oficios"  class="btn btn-primary" data-toggle="modal" data-target="#ModalOficio">Agregar</button>
                </td>
                <td>
                    <div class="card-columns" id="oficios">
                    <?php if (!is_null($oficiosPersona)){foreach($oficiosPersona as $op): ?>
                        <div class="card oficio" id="oficio-<?=$op->getId()?>" tipooficio="<?=$op->getOficio_id()?>" experiencia="<?=$op->getExperiencia()?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img class="card-img-top" src="<?=__URL__."uploads/images/".$op->getOficio_icon()?>" alt="Card image cap">
                                    </div>
                                    <div class="col-9">
                                        <h6 class="card-title"><?=$op->getOficio_nombre()?></h6>
                                        <p>experiencia: <?=$op->getExperiencia()?></p>
                                        <button onclick="eliminarOficio(this)" type="button" name="btn-eliminar-oficio" id="<?=$op->getId()?>" class="btn btn-danger btn-lg btn-block btn-del-red-of">Eliminar</button>
                                        <p>detalle:</p>
                                       <p class="oficio-detalle"> <?=$op->getDetalle()?></p>
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
<div class="modal fade" id="ModalContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Red de Contacto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="input-red" class="col-form-label">Red:</label>
            <select name="input-red" id="input-red">
                <?php foreach ($redes as $r) : ?>
                    <option value="<?=$r->getId()?>"><?=$r->getNombre_red()?></option>
                <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="input-valor" class="col-form-label">Ingrese su red</label>
            <input type="text" class="form-control" id="input-valor"></input>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-add-red-input" onclick="agregarContacto()" data-dismiss="modal" >Agregar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalOficio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Oficio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="input-oficio" class="col-form-label">Oficio:</label>
            <select name="input-oficio" id="input-oficio">
                <?php foreach ($oficios as $o) : ?>
                    <option value="<?=$o->getId()?>"><?=$o->getOficio_nombre()?></option>
                <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="input-exp" class="col-form-label">Ingrese su experiencia</label>
            <input type="text" class="form-control" id="input-exp"></input>
          </div>
          <div class="form-group">
            <label for="input-detalle" class="col-form-label">Ingrese un detalle</label>
            <input type="text" class="form-control" id="input-detalle"></input>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-add-red-input" onclick="agregarOficio()" data-dismiss="modal" >Agregar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="localidadModal" tabindex="-1" role="dialog" aria-labelledby="localidadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="localidadModalLabel">Agregar Población</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="../admin/poblaciones/addpoblacion.php" method="post">
          <div class="form-group">
            <label for="selectciudad" class="col-form-label">Ciudad:</label>
            <select  class="js-example-basic-ciudad text-capitalize" style="width:100%"  name="selectciudad" id="selectciudad">
              <option value="">Seleccione una Ciudad</option>
              <?php foreach(ciudades() as $c):?>
              <option value="<?=$c->getId()?>"><?=$c->getNombre_ciudad()?>, <?=$c->nombre_region?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="addpoblacion" class="col-form-label">Población:</label>
            <input type="text" name="addpoblacion" id="addpoblacion">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="../js/perfil.js"></script>
<script>const __URL__="<?=__URL__?>"</script>
<script>
    $('#photo-file').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.js-example-basic-ciudad').select2();
    });
</script>

<script src="../js/ckeditor.js"></script>
	<script>InlineEditor
			.create( document.querySelector( '.editor' ), {

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

    document.querySelector( '#btn_bio' ).addEventListener( 'click', () => {
        const bio = editor.getData();
        console.log(bio)
        const data = new FormData();
        data.append('bio', bio);
        fetch('../api/saveBio.php', {
          method: 'POST',
          body: data
        }).then(function(response) {
            if(response.ok) {
                console.log('Respuesta OK');
                alert("Bio guardada");
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
</body>
</html>