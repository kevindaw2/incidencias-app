<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/expense.css">
<form class="mx-5" id="form-expense-container" action="incidencias/newIncidencia" method="POST">
    <h3>Registrar nueva incidencia</h3>
    <div class="section mx-5">
        <label for="fechaInicio">Fecha de registro</label>
        <input type="date" name="fechaInicio" id="" required>
    </div>
    <div class="section">
        <label for="material">Material</label>
        <div><input class="mx-5" type="text" name="material" autocomplete="off" required></div>
    </div>
    <div class="section">
        <label for="comentario">Comentario</label>
        <div><input type="text" name="comentario" autocomplete="off" required></div>
    </div>
    <div class="section">
        <label for="aula">Aula</label>
        <input type="number" name="aula" id="amount" autocomplete="off" required>
    </div>
    <div class="section">
        <label for="prioridad">Prioridad</label>
        <div><input type="text" name="prioridad" autocomplete="off" required></div>
    </div>
          
    <div class="center">
        <input type="submit" value="Nueva Incidencia">
    </div>
</form>