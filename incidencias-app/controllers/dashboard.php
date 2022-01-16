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
        $expensesModel          = new IncidenciasModel();
        $expenses               = $this->getExpenses(5);

        $this->view->render('dashboard/index', [
            'user'                 => $this->user,
            'expenses'             => $expenses
        ]);
    }
    
    //obtiene la lista de expenses y $n tiene el número de expenses por transacción
    private function getExpenses($n = 0){
        if($n < 0) return NULL;
        error_log("Dashboard::getExpenses() id = " . $this->user->getId());
        $expenses = new IncidenciasModel();
        return $expenses->getByUserIdAndLimit($this->user->getId(), $n);   
    }
}

?>