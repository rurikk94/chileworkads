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
        <script src="<?=__URL__?>js/validarRUT.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
    <title>Editar Mi Perfil</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
  <div class="container">
          <style>.breadcrumb {
                background-color: white;
                font-size: 1em;
            }
          </style>
          <div class="row">
              <div class="col-sm-10">
                  <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?=__URL__?>">Inicio</a></li>
                      <li class="breadcrumb-item"><a href="<?=__URL__?>profile/index.php?id=<?=is_login(false)?>">Mi Perfil</a></li>
                      <li class="breadcrumb-item"><a href="<?=__URL__?>profile/edit.php">Editar</a></li>
                  </ol>
                  </nav>
              </div>
          </div> <?php //breadcrumb ?>
          <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3">
              <div class="sticky-top">
                <h1>Editar Mi Perfil</h1>
                <!--<div id="list-example" class="list-group">
                  <a class="list-group-item list-group-item-action" href="#list-item-1">Imagen</a>
                  <a class="list-group-item list-group-item-action" href="#list-item-2">Curriculum</a>
                  <a class="list-group-item list-group-item-action" href="#list-item-3">Biografía</a>
                  <a class="list-group-item list-group-item-action" href="#list-item-4">Detalles Personales</a>
                  <a class="list-group-item list-group-item-action" href="#list-item-5">Redes Sociales</a>
                  <a class="list-group-item list-group-item-action" href="#list-item-6">Oficios</a>
                </div> -->
              </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9" data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">

                <div class="row" id="list-item-1">
                  <div class="col-12">
                    <h3>Imagen</h3>
                  </div>
                  <div class="col-4 text-center">
                    <img src="<?=__URL__."uploads/images/".$u->getFoto_file()?>" class="img-fluid rounded-circle img-thumbnail" style="height: 100px" alt=""></td>
                  </div>
                  <div class="col-8">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-row">
                          <div class="col-12 custom-file">
                            <input type="file" class="custom-file-input" name="photo-file" id="photo-file" lang="es" required>
                            <label class="custom-file-label" for="customFile">Subir Foto</label>
                          </div>
                          <div class="col-12">
                            <button type="submit" class="btn btn-primary">Cambiar Foto</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>  <?php //row ?>
                <hr>
                <div class="row">
                  <div class="col-12">
                    <h3>Curriculum</h3>
                  </div>
                  <div class="col-5 text-center" id="list-item-2">
                  <?php if(!is_null($u->getCV())) : ?>
                    <a href="<?=__URL__."uploads/docs/".$u->getCV()?>" target="_blank" rel="noopener noreferrer">
                      <img src="<?=__URL__."uploads/images/pdf.svg"?>" class="img-fluid" style="height: 100px" alt="">
                      <p>CV.pdf</p>
                    </a>
                  <?php endif;?>
                  </div>
                  <div class="col-7">
                      <script src="<?=__URL__?>js/dropzone-5.7.0/dist/dropzone.js"></script>
                      <link rel="stylesheet" href="<?=__URL__?>js/dropzone-5.7.0/dist/dropzone.css">
                      <form action="../api/subirCV.php" id="weasubir" class="dropzone"></form>
                  </div>
                  <div class="col-5">
                    <button id="delcv" onclick="borrarPDF()" class="btn btn-danger btn-block">Borrar CV</button>
                  </div>
                  <div class="col-7">
                      <button id="addcv" onclick="guardarPDF()" class="btn btn-success btn-block">Guardar CV</button>
                  </div>
                </div>  <?php //row ?>
                <hr>
                <div class="row" id="list-item-3">
                  <div class="col-12">
                    <h3>Biografía</h3>
                  </div>
                  <div class="col-12">
                    <div class="editor" style="background-color:powderblue;">
                      <?=!is_null($u->getBio()) ? $u->getBio():'Escribe algo sobre ti.'?>
                    </div>
                    <button type="submit" id="btn_bio"class="btn btn-primary">Guardar Bio</button>
                  </div>
                </div>  <?php //row ?>
                <hr>
                <div class="row" id="list-item-4">
                  <div class="col">
                    <h3>Detalles</h3>
                    <form method="post">
                      <div class="card">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><h6>Nombres</h6> <input class="form-control" type="text" name="nombres" id="nombres" value="<?=!is_null($u->getNombres()) ? $u->getNombres():''?>"></li>
                          <li class="list-group-item"><h6>Apellidos</h6><input class="form-control" type="text" name="apellidos" id="apellidos" value="<?=!is_null($u->getApellidos()) ? $u->getApellidos():''?>"></li>
                          <li class="list-group-item"><h6>Genero</h6> <input class="form-control" type="text" name="genero" id="genero" value="<?=!is_null($u->getGenero()) ? $u->getGenero():''?>"></li>
                          <li class="list-group-item"><h6>Rut</h6> <input class="form-control" type="text" oninput="checkRut(this)" name="rut" id="rut" value="<?=!is_null($u->getRut()) ? $u->getRut():''?>"></li>
                          <li class="list-group-item"><h6>¿Quién puede ver tu perfil?</h6>
                            <select class="form-control" name="tipoUser" id="tipoUser">
                              <option value="1" <?=(!is_null($u->getTipoUser()) && (1==$u->getTipoUser())) ? 'selected':''?>>Nadie</option>
                              <option value="2" <?=(!is_null($u->getTipoUser()) && (2==$u->getTipoUser())) ? 'selected':''?>>Todos</option>
                            </select>
                            <p class="text-muted">Esta opción le permite que su perfil sea visible por otras personas, de esta forma,
                            lo pueden buscar y contactar</p>
                          </li>
                          <li class="list-group-item"><h6>Fecha de Nacimiento</h6><input class="form-control" type="date" name="fecha_nac" id="fecha_nac" value="<?=!is_null($u->getFecha_nacimiento()) ? $u->getFecha_nacimiento():''?>"></li>
                          <li class="list-group-item"><h6>Correo</h6><input class="form-control" type="email" name="correo" id="correo" value="<?=!is_null($u->getCorreo()) ? $u->getCorreo():''?>"> </li>
                          <li class="list-group-item"><h6>Ubicación</h6>
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
                            </select><br>
                            <button type="button" class="btn btn-info mt-2" data-toggle="modal" data-target="#localidadModal" data-whatever="@fat">¿Su población no aparece?</button>
                          </li>
                          <li class="list-group-item"><button type="submit" class="btn btn-primary">Guardar</button></li>
                        </ul>
                      </div>
                    </form>
                  </div>  <?php //col ?>
                </div>  <?php //row ?>
                <hr>
                <div class="row" id="list-item-5">
                  <div class="col">
                  <div class="col-12">
                    <h3>Redes Sociales</h3>
                  </div>
                  <div class="btn-group mb-2" role="group" aria-label="Basic example">
                    <button type="button" name="btn-editar-contactos" id="btn-editar-contactos" class="btn btn-primary" onclick="showBtnDel()">Editar</button>
                    <button type="button" name="btn-guardar-contactos" id="btn-guardar-contactos" class="btn btn-success" onclick="guardarContactos()">Guardar</button>
                    <button type="button" name="btn-add-contactos" id="btn-add-contactos"  class="btn btn-primary" data-toggle="modal" data-target="#ModalContacto">Agregar</button>
                  </div>
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
                  </div>  <?php //col ?>
                </div>  <?php //row ?>
                <hr>
                <div class="row" id="list-item-6">
                  <div class="col">
                  <h3>Oficios</h3>
                  <div class="btn-group mb-2" role="group" aria-label="Basic example">
                    <button type="button" name="btn-editar-oficios" id="btn-editar-oficios" class="btn btn-primary" onclick="showBtnDelOficio()">Editar</button>
                    <button type="button" name="btn-guardar-oficios" id="btn-guardar-oficios" class="btn btn-success" onclick="guardarOficios()">Guardar</button>
                    <button type="button" name="btn-add-oficios" id="btn-add-oficios"  class="btn btn-primary" data-toggle="modal" data-target="#ModalOficio">Agregar</button>
                  </div>
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
                  </div>  <?php //col ?>
                </div>  <?php //row ?>
            </div>
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
                  bootbox.alert("Bio guardada");
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
        var pdf = [];
        Dropzone.options.weasubir = {
        paramName: "file", // The name that will be used to transfer the file
        acceptedFiles: "application/pdf",
        maxFiles: 1,
        dictDefaultMessage: "Suba un PDF",
        maxFilesize: 25, // MB
        success: function(file, response) {
            //alert(response);
            pdf.push(response);

            },
        };

        function guardarPDF(){
          if(pdf.length>0){
            const data = new FormData();
            data.append('pdf', pdf);
            fetch('../api/agregarCVPerfil.php', {
              method: 'POST',
              body: data
            }).then(function(response) {
                if(response.ok) {
                    console.log('Respuesta OK');
                    bootbox.alert("Archivo subido");
                    location.reload();
                } else {
                    console.log('Respuesta de red OK pero respuesta HTTP no OK');
                }
            })
            .catch(function(error) {
            console.log('Hubo un problema con la petición Fetch:' + error.message);
            });
          }else{
            bootbox.alert("Debe subir algún PDF");
          }

        }
    </script>
    <?php if(!is_null($u->getCV())) : ?>
      <script>
        function borrarPDF(){
          fetch('../api/borrarCVPerfil.php', {
                  method: 'POST'
                }).then(function(response) {
                    if(response.ok) {
                        console.log('Respuesta OK');
                        bootbox.alert("Archivo Eliminado");
                        location.reload();
                    } else {
                        console.log('Respuesta de red OK pero respuesta HTTP no OK');
                    }
                })
                .catch(function(error) {
                console.log('Hubo un problema con la petición Fetch:' + error.message);
                });
              }

      </script>
    <?php endif; ?>
  </div>
</body>
</html>