<div class="container-fluid">
<div class="row d-flex justify-content-center">
    <h1>ChileWorkAds</h1>
  </div>
<div class="row d-flex justify-content-center">
    <?php if (is_admin(false)){ ?>
    <a name="btn-admin" id="btn-admin" class="btn btn-primary" href="<?=__URL__?>admin/index.php" role="button">Admin</a>
    <?php } ?>
    <?php if (is_login(false)){ ?>
    <a name="btn-perfil" id="btn-perfil" class="btn btn-success" href="<?=__URL__?>profile/index.php" role="button">Perfil</a>
    <a name="btn-favorites" id="btn-favorites" class="btn btn-info" href="<?=__URL__?>favorites/index.php" role="button">Favoritos</a>
    <a name="btn-logout" id="btn-logout" class="btn btn-primary" href="<?=__URL__?>logout.php" role="button">Salir</a>
  </div>
    <?php } ?>
</div>