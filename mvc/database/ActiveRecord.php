<?php
class ActiveRecord{
    public $columns; 
    public $isNewRecord;
    public $dbCom; 
    public $metadata; 
    public $primaryKey;
    private $tbName;
    
    public function __construct() {
        $this->dbCom = new DBCommand();
        $this->columns = Array();
        $this->metadata = Array();
        $this->getMetaData();
    } 
    
    public function getTableName(){        
      return strtolower(get_class($this));    
   }
    
    protected function getMetaData(){
        $classname = $this->getTableName();
        $query = "SHOW COLUMNS FROM ". $classname;
        $sqlprep = DBConnection::getInstance()->getConnection()->prepare($query);
        $results = DBConnection::getInstance()->getDBCommand()->execute($sqlprep);
        $this->metadata = $results->fetchAll();

        foreach ($this->metadata as $row) {
          $field = $row["Field"];
          $this->columns[$field] = null;
          if ($row["Key"] == "PRI") {
            $this->primaryKey = $row["Field"];
          }
        }

         $keys = Array();
        foreach ($this->columns as $key => $value) {
          //  array_push($keyValues, "'".$value."'");
            array_push($keys, $key);
        }
    }

    public function getPrimaryKey(){
      return $this->primaryKey;
    }

    public function __set($attributes, $value){
      if (array_key_exists($attributes, $this->columns)) {
          $this->columns[$attributes];
      }else{
        //return parent::__set($attributes);
      }
   }

   public function __get($attributes){ 
      if (array_key_exists($attributes, $this->columns)) {
        return $this->columns[$attributes];
      }else{
        //return parent::__get($attributes);
      }
   }
    
    public function getAttributes(){
      //lo obtengo de la bd, arreglo del usuario
      //de aqui agarro los atributos y valores para pasarselos al update
        return $this->columns;
    }
    
    public function setAttributes($attributes){ 
      $this->isNewRecord = true;

      foreach ($attributes as $column => $value) {
        $field = $column;
         if ($field == $this->primaryKey){
          if (is_numeric($value)) {
            $this->isNewRecord = false;
          }else{
            $this->isNewRecord = true;
          }
         }

         if (in_array($field,$this->columns)) {
            $this->columns[$field]= $value;
         }
      }
   }
    
    public function save(){
      //Si es nuevo, insert
      if ($this->isNewRecord) {
       $results = DBConnection::getInstance()->getDBCommand()->insert($this->columns,$this->getTableName(), $this->primaryKey);
      }else{
      //Si no, update
        $results = DBConnection::getInstance()->getDBCommand()->update($this->columns,$this->getTableName(), $this->primaryKey);
      }
 
    }
    
    public function delete(){
        $results = DBConnection::getInstance()->getDBCommand()->delete($this->columns,$this->getTableName(), $this->primaryKey);
    }
    
    //find($conditions)
    public function find(){
        $result = DBConnection::getInstance()->getDBCommand()->select($this->columns, $this->getTableName());
     //   if (count($results)) {
        $modelObj = Array();
        foreach ($result as $auxArray) {
            foreach ($auxArray as $key => $value) {
              if(!is_numeric($key)) {
                $modelObj[$key] = $value;
              }
            }
          }
          //print_r($modelObj);
          $this->setAttributes($modelObj);
     //   }else{
      //    echo "Error :( hay más de un registro con el id";
       // }
          return $this;
    }
    
    public function findAll(){
        $result = DBCommand::selectAll($this->getTableName());
//        print_r($result);
        $modelObj = Array();
        $allmodelObjs = Array();
        foreach ($result as $auxArray) {
          foreach ($auxArray as $key => $value) {
            if(!is_numeric($key)) {
            //  echo "<br/>Key: ".$key ."  Valor: ".$value."<br/>";
              $modelObj[$key] = $value;
            }
          }
          array_push($allmodelObjs, $modelObj);
        }
        //print_r($allmodelObjs);
        return $allmodelObjs;
    }


    public function executeQuery($query){
      $result = DBCommand::executeQuery($query);
      return $result;
    }
}
?>
