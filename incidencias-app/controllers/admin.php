<?php

class Admin extends SessionController{

    function __construct(){
        parent::__construct();
    }

    function render(){
        error_log("Admin::RENDER() ");
        $stats = $this->getStatistics();
        $incidencias = $this->getIncidencias(); 

        $this->view->render('admin/index', [
            'stats' => $stats, 
            'incidencias' => $incidencias
        ]);
    }

    private function getIncidencias(){
        error_log("Admin::getIncidencias()");
        $incidencias = new IncidenciasModel(); 
        return $incidencias->getAll();  
    }

    function createCategory(){
        $this->view->render('admin/create-category');
    }

    function newCategory(){
        error_log('Admin::newCategory()');
        if($this->existPOST(['name', 'color'])){
            $name = $this->getPost('name');
            $color = $this->getPost('color');

            $categoriesModel = new CategoriesModel();

            if(!$categoriesModel->exists($name)){
                $categoriesModel->setName($name);
                $categoriesModel->setColor($color);
                $categoriesModel->save();
                error_log('Admin::newCategory() => new category created');
                $this->redirect('admin', ['success' => Success::SUCCESS_ADMIN_NEWCATEGORY]);
            }else{
                $this->redirect('admin', ['error' => Errors::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
            }
        }
    }

    private function getStatistics(){
        $res = [];

        $userModel = new UserModel();
        $users = $userModel->getAll();
        
        $expenseModel = new IncidenciasModel();
        $expenses = $expenseModel->getAll();

        $res['count-users'] = count($users);
        $res['count-expenses'] = count($expenses);
        $res['all-incidencias'] = $expenses; 
        return $res;
    }
}

?>