<?php
  use Core\Router;
  use Core\HP;
  use App\Models\Users;

  $menu = Router::getMenu('menu_acl');//dnd($menu);
  $currentPage = HP::currentPage();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?= PROJECT_ROOT.'home' ?>"><?= MENU_BRAND ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="main_menu">
    <ul class="navbar-nav mr-auto">
      <?php foreach ($menu as $key => $value):
        $active = '' ?>
      <?php if(is_array($value)): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $key ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach($value as $k => $v):
              $active = ($value = $currentPage) ? 'active' : '' ?>
              <?php if($k == 'separator'):?>
               <div class="dropdown-divider"></div>
              <?php else:?>
                <a class="dropdown-item" href="<?= $v ?>"><?= $k ?></a>
              <?php endif; ?>
          <?php endforeach; ?>
          </div>
        </li>
       <?php else:
          $active = ($v = $currentPage) ?'active' : ''?>
          <li class="nav-item active">
            <a class="nav-link" href="<?= $value ?>"><?= $key ?> <span class="sr-only">(current)</span></a>
          </li>

      <?php endif;?>
    <?php endforeach; ?>

      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>