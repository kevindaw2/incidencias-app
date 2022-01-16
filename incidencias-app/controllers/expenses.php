
<?php

class Expenses extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("Expenses::constructor() ");
    }

     function render(){
        error_log("Expenses::RENDER() ");

        $this->view->render('expenses/index', [
            'user' => $this->user,
            'dates' => $this->getDateList(),
            'categories' => $this->getCategoryList()
        ]);
    }

    function newExpense(){
        error_log('Expenses::newExpense()');
        if(!$this->existPOST(['fechaInicio', 'material', 'comentario', 'aula', 'prioridad'])){
            $this->redirect('dashboard', ['error' => Errors::ERROR_EXPENSES_NEWEXPENSE_EMPTY]);
            return;
        }

        if($this->user == NULL){
            $this->redirect('dashboard', ['error' => Errors::ERROR_EXPENSES_NEWEXPENSE]);
            return;
        }

        $expense = new IncidenciasModel();

        $expense->setUserId($this->user->getId());
        $expense->setFechaInicio($this->getPost('fechaInicio'));
        $expense->setMaterial($this->getPost('material'));
        $expense->setComentario($this->getPost('comentario'));
        $expense->setAula($this->getPost('aula'));
        $expense->setPrioridad($this->getPost('prioridad')); 

        $expense->save();
        $this->redirect('dashboard', ['success' => Success::SUCCESS_EXPENSES_NEWEXPENSE]);
    }

    // new expense UI
    function create(){
        $categories = new CategoriesModel();
        $this->view->render('expenses/create', [
            "categories" => $categories->getAll(),
            "user" => $this->user
        ]);
    } 

    // crea una lista con los meses donde hay expenses
  
    // crea una lista con las categorias donde hay expenses
  
    // crea una lista con los colores dependiendo de las categorias
    private function getCategoryColorList(){
        $res = [];
        $joinExpensesCategoriesModel = new JoinExpensesCategoriesModel();
        $expenses = $joinExpensesCategoriesModel->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($res, $expense->getColor());
        }
        $res = array_unique($res);
        $res = array_values(array_unique($res));

        return $res;
    }

    // devuelve el JSON para las llamadas AJAX
    function getHistoryJSON(){
        header('Content-Type: application/json');
        $res = [];
        $joinExpensesCategories = new JoinExpensesCategoriesModel();
        $expenses = $joinExpensesCategories->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($res, $expense->toArray());
        }
        echo json_encode($res);
    }

    function getTotalByMonthAndCategory($date, $categoryid){
        $iduser = $this->user->getId();
        $joinExpensesCategoriesModel = new JoinExpensesCategoriesModel();
        $total = $joinExpensesCategoriesModel->getTotalByMonthAndCategory($date, $categoryid, $iduser);
        if($total == NULL) $total = 0;
        return $total;
    }

    function delete($params){
        error_log("Expenses::delete()");
        
        if($params === NULL) $this->redirect('expenses', ['error' => Errors::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        $id = $params[0];
        error_log("Expenses::delete() id = " . $id);
        $res = $this->model->delete($id);

        if($res){
            $this->redirect('expenses', ['success' => Success::SUCCESS_EXPENSES_DELETE]);
        }else{
            $this->redirect('expenses', ['error' => Errors::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        }
    }
}

?>