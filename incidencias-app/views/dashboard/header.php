<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css">
<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/dashboard.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>


<div id="header">
    <ul>
        <li><a href="<?php echo constant('URL'); ?>dashboard">Inicio</a></li>
        <li><a href="<?php echo constant('URL'); ?>logout">Cerrar Sesión</a></li>
    </ul>

    <div id="profile-container">
        <a href="<?php echo constant('URL');?>user">
            <div class="name"><?php echo $user->getName(); ?></div>
            <div class="photo">
            </div>
        </a>
        <div id="submenu">
            <ul>
                <li><a href="<?php echo constant('URL'); ?>user">Ver perfil</a></li>
                <li class='divisor'></li>
                <li><a href="<?php echo constant('URL'); ?>logout">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</div>
