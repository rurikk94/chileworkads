<?php require_once("./functions.php"); ?>
<?php is_login(true);?>
<?php

if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET)){
    $filtroOficios = filtroOficios($_GET);
    if(sizeof($filtroOficios)>0){

        $trabajadores = oficioPersona(["oficios"=>$filtroOficios]);
    $trab = [];
    if(isset($trabajadores))
    {
        foreach ($trabajadores as $t)
            array_push($trab,$t->getPersona_id());
    }
    if(sizeof($trab)>0)
        {$filtro["personas"]=$trab;}
    else{$filtro["personas"]=["0"=>0];}
    }
    if (isset($_GET["buscar"]) && !is_null($_GET["buscar"]))
        $filtro["nombre_like"]=$_GET["buscar"];

    if (isset($_GET["filtro-region"]) && !is_null($_GET["filtro-region"]) && !empty($_GET["filtro-region"]))
        $filtro["region"]=$_GET["filtro-region"];
    if (isset($_GET["filtro-comuna"]) && !is_null($_GET["filtro-comuna"]) && !empty($_GET["filtro-comuna"]))
        $filtro["comuna"]=$_GET["filtro-comuna"];
    if (isset($_GET["filtro-ciudad"]) && !is_null($_GET["filtro-ciudad"]) && !empty($_GET["filtro-ciudad"]))
        $filtro["ciudad"]=$_GET["filtro-ciudad"];
    if (isset($_GET["filtro-poblacion"]) && !is_null($_GET["filtro-poblacion"]) && !empty($_GET["filtro-poblacion"]))
        $filtro["poblacion"]=$_GET["filtro-poblacion"];

    $filtro["tipo"]=2;
    $filtro["enable"]=2;
    if(isset($_GET["estrellas"]))
        $filtro["avg"]=$_GET["estrellas"];
        $filtro["order"]="  COUNT  DESC, AVG desc";
    $resultadosPagina = 25;
        $filtro["limit"]="   LIMIT ".($_GET["page"]-1)*$resultadosPagina. " ";
    //if(isset($_GET["page"]) && $_GET["page"]>1)
        $filtro["limit"].=", ".$resultadosPagina;
        //$filtro["order"]="  RAND()";
    $usuarios = usuariosPag($filtro);
    $count = $usuarios["count"];
    $usuarios = $usuarios["data"];
    $paginas = (($count/$resultadosPagina)-(($count%$resultadosPagina)/$resultadosPagina))+1;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=__URL__?>css/bootstrap.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <link rel="icon" type="image/vnd.microsoft.icon" href="./favicon.ico">
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/0786957a7f.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?=__URL__?>css/material-icons.css">
        <link rel="stylesheet" href="<?=__URL__?>css/css.css">
    <title>ChileWorkAds</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
        <h1>Trabajadores</h1>
        <?php if (is_null($usuarios)): ?>
            <h2>No hay Usuarios</h2>
        <?php else: ?>

            <?php if (!isset($_GET["page"])) $_GET["page"]=1;
            if($paginas>0): ?>
            <nav aria-label="...">
                <ul class="pagination">
                    <?php if($_GET["page"]-1>0): ?>
                    <li class="page-item">
                        <a class="page-link" onclick="cambiarPagina(<?=$_GET['page']-1?>)">Anterior</a>
                    </li>
                    <li class="page-item"><a class="page-link"  onclick="cambiarPagina(<?=$_GET['page']-1?>)"><?=$_GET["page"]-1?></a></li>
                    <?php endif; ?>
                    <li class="page-item active">
                    <span class="page-link">
                        <?=$_GET["page"]?>
                        <span class="sr-only">(current)</span>
                    </span>
                    </li>
                    <?php if($_GET["page"]+1<=$paginas): ?>
                    <li class="page-item"><a class="page-link" onclick="cambiarPagina(<?=$_GET['page']+1?>)"><?=$_GET["page"]+1?></a></li>
                    <li class="page-item">
                        <a class="page-link" onclick="cambiarPagina(<?=$_GET['page']+1?>)">Siguiente</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:130px">Imagen</th>
                        <th>Usuario</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($usuarios as $u) : ?>
                    <tr>
                        <td><img src="<?=__URL__."uploads/images/".$u->getFoto_file()?>" class="img-fluid rounded-circle img-thumbnail w-100" alt=""></td>
                        <td><p><?=$u->getNombres()?> <?=$u->getApellidos()?></p>
                        <?php if($u->getRut()) : ?>
                            <i class="material-icons google-icon">verified</i>
                        <?php endif; ?>
                        <?php $nota = $u->getCalificacion();
                         if($nota>6):?>
                        <span class="material-icons md-48">star</span><?=$nota?>
                        <?php elseif($nota>3): ?>
                        <i class="material-icons md-18">star_outline</i><?=$nota?>
                        <?php elseif($nota>0): ?>
                        <i class="material-icons md-36">star_half</i><?=$nota?>
                        <?php endif; ?>
                        </td>
                        <td>
                            <a name="btn-detail" id="btn-detail" class="btn btn-info" href="./profile/index.php?id=<?=$u->getId()?>" role="button">Perfil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (!isset($_GET["page"])) $_GET["page"]=1;
            if($paginas>0): ?>
            <nav aria-label="...">
                <ul class="pagination">
                    <?php if($_GET["page"]-1>0): ?>
                    <li class="page-item">
                        <a class="page-link" onclick="cambiarPagina(<?=$_GET['page']-1?>)">Anterior</a>
                    </li>
                    <li class="page-item"><a class="page-link"  onclick="cambiarPagina(<?=$_GET['page']-1?>)"><?=$_GET["page"]-1?></a></li>
                    <?php endif; ?>
                    <li class="page-item active">
                    <span class="page-link">
                        <?=$_GET["page"]?>
                        <span class="sr-only">(current)</span>
                    </span>
                    </li>
                    <?php if($_GET["page"]+1<=$paginas): ?>
                    <li class="page-item"><a class="page-link" onclick="cambiarPagina(<?=$_GET['page']+1?>)"><?=$_GET["page"]+1?></a></li>
                    <li class="page-item">
                        <a class="page-link" onclick="cambiarPagina(<?=$_GET['page']+1?>)">Siguiente</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <script>
    function cambiarPagina(pag){
        var link = window.location.href
        link = link.replace(window.location.search,"");
        var params = new URLSearchParams(window.location.search)

        //if(params.has('page'))
        //{
            params.set('page', pag);
        //}
        link = link.concat("?");
        link = link.concat(params.toString());
        window.location.href = link;
    }
    </script>
</body>
</html>