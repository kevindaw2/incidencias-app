
<?php

class Pizzarra extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("Pizzarra::constructor() ");
    }

     function render(){
        error_log("Pizzarra::render() ");
        $expensesModel          = new IncidenciasModel();
        $expenses               = $this->getIncidencias(5);
        $totalThisMonth         = $expensesModel->getTotalAmountThisMonth($this->user->getId());
        $maxExpensesThisMonth   = $expensesModel->getMaxExpensesThisMonth($this->user->getId());
        $categories             = $this->getCategories();

        $this->view->render('pizarra/index', [
            'user'                 => $this->user,
            'expenses'             => $expenses,
            'totalAmountThisMonth' => $totalThisMonth,
            'maxExpensesThisMonth' => $maxExpensesThisMonth,
            'categories'           => $categories
        ]);
    }
    
    //obtiene la lista de expenses y $n tiene el número de expenses por transacción
    private function getIncidencias($n = 0){
        if($n < 0) return NULL;
        error_log("Pizzarra::getExpenses() id = " . $this->user->getId());
        $incidencias = new IncidenciasModel();
        return $incidencias->getByUserIdAndLimit($this->user->getId(), $n);   
    }

    function getCategories(){
        $res = [];
        $categoriesModel = new CategoriesModel();
        $incidenciasModel = new ExpensesModel();

        $categories = $categoriesModel->getAll();

        foreach ($categories as $category) {
            $categoryArray = [];
            //obtenemos la suma de amount de expenses por categoria
            $total = $incidenciasModel->getTotalByCategoryThisMonth($category->getId(), $this->user->getId());
            // obtenemos el número de expenses por categoria por mes
            $numberOfExpenses = $incidenciasModel->getNumberOfExpensesByCategoryThisMonth($category->getId(), $this->user->getId());
            
            if($numberOfExpenses > 0){
                $categoryArray['total'] = $total;
                $categoryArray['count'] = $numberOfExpenses;
                $categoryArray['category'] = $category;
                array_push($res, $categoryArray);
            }
            
        }
        return $res;
    }
}

?>