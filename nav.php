<div class="container">
<?php global $site_config; ?>
  <div class="row">
      <div class="col-sm-9 col-md-4 mx-auto mt-1">
        <style>
        @font-face {
          font-family: Norwester;
          src: url("<?=__URL__?>fonts/norwester.otf");
        }
        .logo{
          height: 80px;
        }
        .titulo-chile{
          font-family: "Norwester";
          /* position: absolute;
          font-size:  2.65em;
          bottom: 8px;
          left: 100px; */

        }
        .bottom-right {
          font-family: "Norwester";
          position: absolute;
          bottom: 1px;
          left: 28%;
        }
        </style>
        <div class="row">
          <div class="col-3">
            <img class="logo" src="<?=__URL__?>logo.svg" class="img-fluid" alt="logo">
          </div>
          <div class="col-9"><h1 class="titulo-chile">Chile WorkAds </h1></div>
        </div>
        <div class="bottom-right"><?=$site_config["version"]?></div>
      </div>
    <div class="col-sm-9 col-md-8 mt-3 mx-auto">
    <?php if (is_login(false)){ ?>
      <div class="row d-flex justify-content-center">
        <a name="btn-inicio" id="btn-inicio" class="btn btn-warning" href="<?=__URL__?>" role="button"><span class="material-icons">home</span> Inicio</a>
        <?php if (is_admin(false)){ ?>
          <a name="btn-admin" id="btn-admin" class="btn btn-primary" href="<?=__URL__?>admin/index.php" role="button"><span class="material-icons">settings</span> Admin</a>
        <?php } ?>
        <a name="btn-perfil" id="btn-perfil" class="btn btn-success" href="<?=__URL__?>profile/index.php?id=<?=is_login(false)?>" role="button"><span class="material-icons"> account_box</span> Mi Perfil</a>
        <a name="btn-favorites" id="btn-favorites" class="btn btn-info" href="<?=__URL__?>favorites/index.php" role="button"><span class="material-icons"> favorite</span>Favoritos</a>
        <a name="btn-logout" id="btn-logout" class="btn btn-primary" href="<?=__URL__?>logout.php" role="button"><i class="material-icons">login</i> Salir</a>
      </div>
    <?php } ?>
    </div>
  </div>

  <?php if (is_login(false)){ ?>
  <form action="./index.php" method="get">
  <input type="hidden" name="page" value="1">
  <div class="row mt-2">
      <div class="col-sm-9 col-md-4 mx-auto">
        <h3 id="titlefiltros" class="btn btn-block btn-outline-primary lista_filtros" data-toggle="tooltip" title="Oculta los filtros" onclick="$('.lista_filtros').hide('fast');"><span class="material-icons">filter_alt</span>Filtros</h3>
      </div>
    <div class="col-sm-9 col-md-8 mx-auto">
      <div class="input-group mb-3">
        <input autocomplete="off" onclick="$('.lista_filtros').show('fast');" type="text" name="buscar" id="buscar" class="form-control" placeholder="Buscar Trabajador, Oficio" aria-label="Buscar Trabajador, Oficio" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button data-toggle="tooltip" title="Busca según datos ingresados y filtros establecidos" class="btn btn-success" type="submit"><span class="material-icons md-18">search</span>Buscar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-9 col-md-4 mx-auto lista_filtros">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link btn-outline-primary mt-2" id="v-pills-filtro-oficio-tab" data-toggle="pill" title="Filtra por Oficio" href="#v-pills-filtro-oficio" role="tab" aria-controls="v-pills-filtro-oficio" aria-selected="true"><span class="material-icons">work</span> Oficios</a>
        <a class="nav-link btn-outline-primary mt-2" id="v-pills-filtro-ubicacion-tab" data-toggle="pill" title="Filtra por Ubicación" href="#v-pills-filtro-ubicacion" role="tab" aria-controls="v-pills-filtro-ubicacion" aria-selected="false"><span class="material-icons">location_on</span> Ubicacion</a>
        <a class="nav-link btn-outline-primary mt-2" id="v-pills-filtro-calificacion-tab" data-toggle="pill" title="Filtra por Calificación" href="#v-pills-filtro-calificacion" role="tab" aria-controls="v-pills-filtro-calificacion" aria-selected="false"><span class="material-icons">grade</span> Calificación</a>
      </div>
    </div>
    <div class="col-sm-9 col-md-8 mx-auto lista_filtros">
      <?php $oficios=oficios(); ?>
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade" id="v-pills-filtro-oficio" role="tabpanel" aria-labelledby="v-pills-filtro-oficio">
          <?php foreach($oficios as $o) :?>
            <div class="form-check">
              <input class="form-check-input"name="oficio-<?=$o->getId()?>" type="checkbox" value="<?=$o->getId()?>" id="oficio-<?=$o->getId()?>">
              <label class="form-check-label" for="oficio-<?=$o->getId()?>">
                <?=$o->getOficio_nombre()?>
              </label>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="tab-pane fade" id="v-pills-filtro-ubicacion" role="tabpanel" aria-labelledby="v-pills-filtro-ubicacion">
        <?php $regiones=regiones(); ?>
        <div class="form-group">
          <label for="filtro-region">Región</label>
          <select class="form-control" onchange="cargarComunasFiltro(this.value)" name="filtro-region" id="filtro-region">
            <option value="">Seleccione una Región</option>
            <?php foreach($regiones as $r) :?>
            <option value="<?=$r->getId()?>"><?=$r->getNombreRegion()?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="form-group">
          <label for="filtro-comuna">Comuna</label>
          <select class="form-control" onchange="cargarCiudadesFiltro(this.value)"  name="filtro-comuna" id="filtro-comuna">
            <option value="">Seleccione una Comuna</option>
          </select>
        </div>
        <div class="form-group">
          <label for="filtro-ciudad">Ciudad</label>
          <select class="form-control" name="filtro-ciudad" id="filtro-ciudad">
            <option value="">Seleccione una Ciudad</option>
          </select>
        </div>

        </div>
        <div class="tab-pane fade" id="v-pills-filtro-calificacion" role="tabpanel" aria-labelledby="v-pills-filtro-calificacion">

        <link rel="stylesheet" href="<?=__URL__?>css/slider.css">
        <div class="slidecontainer">
          <input type="range" min="0" max="10" value="0" name="estrellas" class="slider" id="estrellas">
          <p>Calificación: <span id="estrellasText"></span></p>
        </div>

        <script>
          var slider = document.getElementById("estrellas");
          var output = document.getElementById("estrellasText");
          output.innerHTML = slider.value;

          slider.oninput = function() {
            output.innerHTML = this.value;
          }
        </script>
        </div>
      </div>
    </div>

  </div>
  </form>
  <?php } ?>
</div>
<script>
  $(".lista_filtros").hide();
</script>
<script>
  const URL = "<?=__URL__?>";
</script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script src="<?=__URL__?>js/comunas.js"></script>
<script src="<?=__URL__?>js/ciudades.js"></script>