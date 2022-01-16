<?php
    $expenses               = $this->d['expenses'];
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
                    <?php
                         if($expenses === NULL){
                            showError('Error al cargar los datos');
                        }else if(count($expenses) == 0){
                            showInfo('No hay transacciones');
                        }else{
                            foreach ($expenses as $expense) { ?>
                            <div class='preview-expense'>
                                <div class="left">
                                    <div class="inidencias-comentario">Comentario: <?php echo $expense->getComentario(); ?></div>
                                    <div class="incidencias-comentario-admin">Comentario admin: </div>
                                    <div class="incidencias-material">Material: <?php echo $expense->getMaterial(); ?></div>
                                    <div class="incidencias-prioridad">Prioridad: <?php echo $expense->getPrioridad(); ?></div>
                                    <div class="expense-date">Aula: <?php echo $expense->getAula(); ?></div>                                </div>
                                <div class="right">
                                    <div class="expense-amount">
                                        <div class="incidencias-inicio">
                                            Fecha Inicio:  <?php echo $expense->getFechaInicio(); ?>
                                        </div>
                                        <div class="incidencias-final">
                                            Fecha Final:  <?php echo $expense->getFechaFinal(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        } 
                     ?>
                    </section>
                </div>
                    </div>
                </div>
            </div>

            <div id="right-container">
                <div id="chart-container" >
                    <div id="chart" >
                        <div class="transactions-container">
                        <section class="operations-container">
                        <h2>Incidencias</h2>  
                        
                        <button class="btn-main" id="new-expense">
                            <i class="material-icons">add</i>
                            <span>Añadir nueva incidencia</span>
                        </button>
                        </section>
                    </div>
                </div> 
                
            </div>
        </div>

    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="public/js/dashboard.js"></script>
    
</body>
</html>