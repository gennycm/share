<?php
class DBCommand{
   //Aqui hago las sentencias 
//uso params para hacer la sentencia parametrizada 
    public $params = array();
    public $connection = null;
    public $query = null;

    
    public static function execute($sqlprep){
        if($sqlprep!=null){
            $sqlprep->execute(); 
        }
        return $sqlprep;
    }   
    //insert($columns, $tableName)
    public static function insert($columns,$tableName, $primaryKey){
        $keys = Array();
        foreach ($columns as $key => $value) {
            if ($key =='adblock' || $key == $primaryKey) {
                # Do nothing
            }else{
                array_push($keys, $key); 
            }
        }

        //implode a los dos arreglos.
        $keyStr = implode(',', $keys); // El str de los campos
        $valStr = implode(',:', $keys);
        $valStr = ":".$valStr; //Formo el str de los values

        $query = "INSERT INTO ".$tableName." (".$keyStr.") VALUES (".$valStr.")";
        $stmnt = DBConnection::getInstance()->getConnection()->prepare($query);

        foreach ($columns as $key => &$value) {
            if ($key =='adblock' || $key == $primaryKey) {
            }else{
                $stmnt->bindParam($key,$value); 
            }
        }

        $stmnt->execute();
    }
    
    public static function update($columns,$tableName, $primaryKey){
        $keys = Array();
        foreach ($columns as $key => $value) {
            if ($key =='adblock' || $key == $primaryKey) {
                # Do nothing
            }else{
                array_push($keys, $key); 
            }
        }

        //implode a los dos arreglos.
        $keyStr = implode(' = ? , ', $keys); // El str de los campos
        $keyStr = $keyStr." = ?";

        $query = "UPDATE ".$tableName." SET ".$keyStr." WHERE ".$primaryKey." = ". $columns[$primaryKey];
        $stmnt = DBConnection::getInstance()->getConnection()->prepare($query);
        unset($columns[$primaryKey]);                
        unset($columns['adblock']);

        $keyValues = Array();
        foreach ($columns as $key => &$value) {
            array_push($keyValues, $value); 
        }

        $stmnt->execute($keyValues);
    }

    //select columnas, tabla y condiciones
    
    public static function select($columns, $tableName){
        $keys = Array();
      //  print_r($columns);
         foreach ($columns as $key => $value) {
            if ($key =='adblock') {
                unset($columns[$key]);
            }else{
                if ($value != "") {
                     array_push($keys, $key); 
                }
                else{
                    unset($columns[$key]);
                  }
            }
        }

        $conditions ="";
        if (count($columns) == 1){
            foreach ($columns as $key => $value) {
                $conditions = $key." = ".$value;
               // echo "Key: ".$key."<br/>;";
            }
        }else{
            if (count($columns) > 1) {
                foreach ($columns as $key => $value) {
                    $conditions = $conditions.$key." = '".$value. "' AND ";
                }
                $conditions = substr($conditions,0,strlen($conditions)-4); //Elimina el ultimo AND
            }
        }

        $query = "SELECT * FROM ".$tableName." WHERE ".$conditions;
        $stmnt = DBConnection::getInstance()->getConnection()->prepare($query);

        foreach ($columns as $key => &$value) {
            if ($key =='adblock') {
            }else{
                $stmnt->bindParam($key,$value); 
            }
        }
        
        $results = $stmnt->execute();
        $result = $stmnt->fetchAll();
            return $result;

    }
    
    //select columnas, tabla DONE
     public static function selectAll($tableName){
        $query = "SELECT * FROM ".$tableName;
        $stmnt = DBConnection::getInstance()->getConnection()->prepare($query);
        $results = $stmnt->execute();
      // print_r("<br/> Results: ");
       // var_dump($results);
        $result = $stmnt->fetchAll();
        return $result;
    }


    //delete llave primaria, valor de la llave y tabla.    
    public static function delete($columns, $tableName, $primaryKey){
        $query = "DELETE FROM ".$tableName." WHERE ".$primaryKey." = :".$primaryKey."";
        $stmnt = DBConnection::getInstance()->getConnection()->prepare($query);
        $stmnt->bindParam($primaryKey, $columns[$primaryKey]);
        $result = $stmnt->execute();
        var_dump($result);
    }
}

?>
