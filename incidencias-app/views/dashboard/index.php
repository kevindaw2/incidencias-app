<?php
    $incidencias            = $this->d['incidencias'];
    $user                   = $this->d['user'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense App - Dashboard</title>
</head>
<body>
    <?php require 'header.php'; ?>

    <div id="main-container">
        <?php $this->showMessages();?>
        <div id="expenses-container" class="container">
            <div id="left-container">
                <div id="expenses-summary">
                    <div>
                        <h2>Bienvenido <?php echo $user->getName() ?></h2>
                    </div>
                </div>
                <div id="chart-container" >
                    <div id="chart" >
                    <div class="transactions-container">
                    <section id="expenses-recents">
                        <h2>Incidencias más recientes</h2>
                    </section>
                    <table id="incidenciasTable">
                        <thead>
                        <th>Fecha Petición</th>
                        <th>Comentario</th>
                        <th>Aula</th>
                        <th>Material</th>
                        <th>Prioridad</th>
                    </thead>
                    <tbody>
                        <?php 
                            if(!empty($incidencias)) { ?>
                            <?php foreach($incidencias as $incidencia) { ?>
                                <tr>
                                    <td><?php echo $incidencia->getFechaInicio(); ?></td>
                                    <td><?php echo $incidencia->getComentario(); ?></td>
                                    <td><?php echo $incidencia->getAula(); ?></td>
                                    <td><?php echo $incidencia->getMaterial(); ?></td>
                                    <td><?php echo $incidencia->getPrioridad(); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else {
                            showError('Error al cargar los datos');
                        } ?>
                    </tbody>
                    </table>
                </div>
                    </div>
                </div>
            </div>

            <div id="right-container">
                <div id="chart-container" >
                    <div id="chart" >
                        <h2>Añadir Incidencias</h2>
                        <div class="transactions-container">
                        <section class="operations-container">
                        <button class="btn-main" id="new-expense">
                            <i class="material-icons">add</i>
                            <span>Añadir</span>
                        </button>
                        </section>
                    </div>
                </div> 
                
            </div>
        </div>

    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="public/js/dashboard.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#incidenciasTable').DataTable();
        });
    </script>
    
</body>
</html>