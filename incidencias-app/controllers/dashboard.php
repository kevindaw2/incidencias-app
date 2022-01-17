<?php

class Dashboard extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("Dashboard::constructor()");
    }

     function render(){
        error_log("Dashboard::RENDER() ");
        $incidenciasModel          = new IncidenciasModel();
        $incidencias               = $this->getIncidencias(10);

        $this->view->render('dashboard/index', [
            'user'                 => $this->user,
            'incidencias'          => $incidencias
        ]);
    }
    
    //obtiene la lista de incidencias y $n limita el numero de resultados
    private function getIncidencias($n = 0){
        if($n < 0) return NULL;
        error_log("Dashboard::getIncidencias() id = " . $this->user->getId());
        $incidencias = new IncidenciasModel();
        return $incidencias->getByUserIdAndLimit($this->user->getId(), $n);   
    }
}

?>