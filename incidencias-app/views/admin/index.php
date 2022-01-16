<?php
    $stats = $this->d['stats'];
    $incidencias = $this->d['incidencias']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php require 'header.php'; ?>

    <div id="main-container">
        <?php
            $this->showMessages();
         ?>
        <div id="dashboard-container" class="container">
            <div id="left-container">
                <h2>Incidencias más recientes: </h2>
                <?php
                    if($incidencias === NULL){
                        showError('Error al cargar los datos');
                    }else if(count($incidencias) == 0){
                        showInfo('No hay transacciones');
                    }else{
                        foreach ($incidencias as $incidencia) { ?>
                            <div class='preview-expense'>
                                <div class="left">
                                    <div class="inidencias-comentario">Comentario: <?php echo $incidencia->getComentario(); ?></div>
                                    <div class="incidencias-comentario-admin">Comentario admin: </div>
                                    <div class="incidencias-material">Material: <?php echo $incidencia->getMaterial(); ?></div>
                                    <div class="incidencias-prioridad">Prioridad: <?php echo $incidencia->getPrioridad(); ?></div>
                                    <div class="expense-date">Aula: <?php echo $incidencia->getAula(); ?></div> 
                                    <div class="incidencias-inicio">Fecha Inicio:  <?php echo $incidencia->getFechaInicio(); ?></div>
                                    <div class="incidencias-final"> Fecha Final:  <?php echo $incidencia->getFechaFinal(); ?></div>
                                </div>
                                <div class="right">
                                    <button id="new-category">Editar</button>
                                </div>
                            </div>
                    <?php
                        }
                    } 
                    ?>
            </div>
            <div id="right-container">
                <div class="panel">
                    <div class="title">Usuarios</div>
                    <div class="datum"><?php echo $stats['count-users']; ?></div>
                    <div class="description">Registrados</div>
                </div>
                <div class="panel">
                    <div class="title">Incidencias</div>
                    <div class="datum"><?php echo $stats['count-expenses']; ?></div>
                    <div class="description">Registrados</div>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/admin.js"></script>
</body>
</html>