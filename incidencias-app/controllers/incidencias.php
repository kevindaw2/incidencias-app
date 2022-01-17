
<?php

class Incidencias extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("Incidencias::constructor() ");
    }

     function render(){
        error_log("Incidencias::RENDER() ");

        $this->view->render('incidencias/index', [
            'user' => $this->user,
            'dates' => $this->getDateList()
        ]);
    }

    function newIncidencia(){
        error_log('Incidencias::newIncidencia()');
        if(!$this->existPOST(['fechaInicio', 'material', 'comentario', 'aula', 'prioridad'])){
            $this->redirect('dashboard', ['error' => Errors::ERROR_INCIDENCIAS_NEWINCIDENCIA_EMPTY]);
            return;
        }

        if($this->user == NULL){
            $this->redirect('dashboard', ['error' => Errors::ERROR_INCIDENCIAS_NEWINCIDENCIA]);
            return;
        }

        $incidenia = new IncidenciasModel();

        $incidenia->setUserId($this->user->getId());
        $incidenia->setFechaInicio($this->getPost('fechaInicio'));
        $incidenia->setFechaFinal($this->getPost('fechaFinal'));
        $incidenia->setMaterial($this->getPost('material'));
        $incidenia->setComentario($this->getPost('comentario'));
        $incidenia->setAula($this->getPost('aula'));
        $incidenia->setPrioridad($this->getPost('prioridad')); 
       
        $incidenia->save();
        $this->redirect('dashboard', ['success' => Success::SUCCESS_INCIDENCIAS_NEWINCIDENCIA]);
    }

    // new incidenia UI
    function create(){
        $this->view->render('incidencias/create', [
            "user" => $this->user,
        ]);
    } 

    function delete($params){
        error_log("Incidencias::delete()");
        
        if($params === NULL) $this->redirect('incidencias', ['error' => Errors::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        $id = $params[0];
        error_log("Incidencias::delete() id = " . $id);
        $res = $this->model->delete($id);

        if($res){
            $this->redirect('incidencias', ['success' => Success::SUCCESS_INCIDENCIAS_DELETE]);
        }else{
            $this->redirect('incidencias', ['error' => Errors::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        }
    }

}

?>