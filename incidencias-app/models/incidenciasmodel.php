<?php

class IncidenciasModel extends Model implements IModel{

    private $id;
    private $userId; 
    private $fechaInicio; 
    private $fechaFinal; 
    private $material; 
    private $comentario; 
    private $aula; 
    private $prioridad; 

    //SET INCIDENCIAS
    public function setId($id){ $this->id = $id; }
    public function setUserId($userId){ $this->userId = $userId; }
    public function setFechaInicio($fechaInicio){ $this->fechaInicio = $fechaInicio; }
    public function setFechaFinal($fechaFinal){ $this->fechaFinal = $fechaFinal; }
    public function setMaterial($material){ $this->material = $material; }
    public function setComentario($comentario){ $this->comentario = $comentario; }
    public function setAula($aula){ $this->aula = $aula; }
    public function setPrioridad($prioridad){ $this->prioridad = $prioridad; }
    
    //GET INCIDENCIAS
    public function getId(){ return $this->id; }
    public function getUserId(){ return $this->userId; }
    public function getFechaInicio(){ return $this->fechaInicio; }
    public function getFechaFinal(){ return $this->fechaFinal; }
    public function getMaterial(){ return $this->material; }
    public function getComentario(){ return $this->comentario; }
    public function getAula(){ return $this->aula; }
    public function getPrioridad(){ return $this->prioridad; }

    public function __construct(){
        parent::__construct();
    }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO incidencias (userId, fechaInicio, fechaFinal, material, comentario, aula, prioridad) VALUES(:userId, :fechaInicio, :fechaFinal, :material, :comentario, :aula, :prioridad)');
            $query->execute([
                'userId' => $this->userId, 
                'fechaInicio' => $this->fechaInicio, 
                'fechaFinal' => $this->fechaFinal, 
                'material' => $this->material, 
                'comentario' => $this->comentario,
                'aula' => $this->aula, 
                'prioridad' => $this->prioridad
            ]);
            if($query->rowCount()) return true;

            return false;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM incidencias');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new IncidenciasModel();
                $item->from($p); 
                
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }


    /*CREAR LA TABLA EN LA BASE DE DATOS Y CREAR LA VIEW Y EL CONTROLADOR PARA VER LA PAGINA EN EL SERVIDOR LOCAL*/ 
    
    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM incidencias WHERE id = :id');
            $query->execute([ 'id' => $id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->from($user);

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAllByUserId($userid){
        $items = [];

        try{
            $query = $this->prepare('SELECT * FROM incidencias WHERE userId = :userId');
            $query->execute([ "userId" => $userId]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ExpensesModel();
                $item->from($p); 
                
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getByUserIdAndLimit($userId, $n){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM incidencias WHERE userId = :userId ORDER BY incidencias.fechaInicio DESC LIMIT 0, :n ');
            $query->execute([ 'n' => $n, 'userId' => $userId]);
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new IncidenciasModel();
                $item->from($p); 
                
                array_push($items, $item);
            }
            error_log("IncidenciasModel::getByUserIdAndLimit(): count: " . count($items));
            return $items;
        }catch(PDOException $e){
            return false;
        }
    }

    /**
     * Regresa el monto total de expenses en este mes
     */
    function getTotalAmountThisMonth($iduser){
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->db->connect()->prepare('SELECT SUM(amount) AS total FROM expenses WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :iduser');
            $query->execute(['year' => $year, 'month' => $month, 'iduser' => $iduser]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) $total = 0;
            
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }
    /**
     * Obtiene el número de transacciones por mes
     */
    function getMaxExpensesThisMonth($iduser){
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->db->connect()->prepare('SELECT MAX(amount) AS total FROM expenses WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :iduser');
            $query->execute(['year' => $year, 'month' => $month, 'iduser' => $iduser]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) $total = 0;
            
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM incidencias WHERE id = :id');
            $query->execute([ 'id' => $id]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('UPDATE incidencias SET userId = :userId, fechaInicio = :fechaIncio, fechaFinal = :fechaFinal, material = :material, comentario = :comentario, aula = :aula, prioridad = :prioridad WHERE id = :id');
            $query->execute([
                'userId' => $this->userId, 
                'fechaInicio' => $this->fechaInicio,
                'fechaFinal' => $this->fechaFinal, 
                'material' => $this->material,
                'comentario' => $this->comentario,
                'aula' => $this->aula, 
                'prioridad' => $this->prioridad
            ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function from($array){
        $this->id = $array['id'];
        $this->userId = $array['userId'];
        $this->fechaInicio = $array['fechaInicio'];
        $this->fechaFinal = $array['fechaFinal'];
        $this->material = $array['material'];
        $this->comentario = $array['comentario'];
        $this->aula = $array['aula'];
        $this->prioridad = $array['prioridad'];
    }

    /**
     * Obtiene el total de amount de expenses basado en id de categoria
     */
    function getTotalByCategoryThisMonth($categoryid, $userid){
        error_log("ExpensesModel::getTotalByCategoryThisMonth");
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT SUM(amount) AS total from expenses WHERE category_id = :categoryid AND id_user = :userid AND YEAR(date) = :year AND MONTH(date) = :month');
            $query->execute(['categoryid' => $categoryid, 'userid' => $userid, 'year' => $year, 'month' => $month]);
            
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) return 0;
            return $total;

        }catch(PDOException $e){
            error_log("**ERROR: ExpensesModel::getTotalByCategoryThisMonth: error: " . $e);
            return NULL;
        }
    }

    /**
     * Obtiene el total de amount de expenses basado en id de categoria
     */
    function getNumberOfExpensesByCategoryThisMonth($categoryid, $userid){
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT COUNT(id) AS total from expenses WHERE category_id = :categoryid AND id_user = :userid AND YEAR(date) = :year AND MONTH(date) = :month');
            $query->execute(['categoryid' => $categoryid, 'userid' => $userid, 'year' => $year, 'month' => $month]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) return 0;
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }
}


?>