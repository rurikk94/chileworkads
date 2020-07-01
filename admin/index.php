<?php require_once "../functions.php";?>
<?php is_admin();?>
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
    <title>Admin</title>
</head>
<body>
    <?php require_once __BASE__ . "nav.php";?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Administrar</h1>
                <h5>Seleccione una opción</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a name="" id="" class="nav-link" href="<?=__URL__?>admin/usuarios/index.php#title" role="button">Usuarios</a>
                    <a name="" id="" class="nav-link" href="<?=__URL__?>admin/regiones/index.php#title" role="button">Regiones</a>
                    <a name="" id="" class="nav-link" href="<?=__URL__?>admin/comunas/index.php#title" role="button">Comunas</a>
                    <a name="" id="" class="nav-link" href="<?=__URL__?>admin/ciudades/index.php#title" role="button">Ciudades</a>
                    <a name="" id="" class="nav-link" href="<?=__URL__?>admin/poblaciones/index.php#title" role="button">Poblaciones</a>
                    <a name="" id="" class="nav-link" href="<?=__URL__?>admin/oficios/index.php#title" role="button">Oficios</a>
                    <a name="" id="" class="nav-link" href="<?=__URL__?>admin/redes/index.php#title" role="button">Redes Sociales</a>
                    <a name="" id="" class="nav-link" href="<?=__URL__?>admin/reportes/index.php#title" role="button">Reportes</a>
                </div>
            </div>
            <div class="col-sm-10 col-md-9">
            </div>
        </div>
        <script>
            $('.nav-link').hover(function() {
            $(this).toggleClass('bg-info text-light');
            });
        </script>
    </div>
    </body>
</html>