<?php

class Data_MySQL{

    private static $_instance = null;

    protected $pdo;

    protected $sqlString;
    protected $errorMessages = null;

    private function __construct() {
        $this->pdo = new PDO('mysql:host=' . MYSQL_HOST . ';dbname='. DB_NAME , DB_USER_NAME, DB_PASS);
    }

    protected function __clone() {
    }

    static public function getInstance() {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function nativeExecute($sql){
        $stmt = $this->pdo->prepare($sql);
        $success = $stmt->execute();

        if($success){
            $this->errorMessages = null;
        }else{
            $this->errorMessages = $this->pdo->errorInfo();
        }

        $this->sqlString = $sql;

        return $stmt;
    }

    public function execute($sql){
        $stmt = $this->nativeExecute($sql);

        if($this->errorMessages = null){
            return true;
        }else{
            return false;
        }
    }

    public function query($sql){

        $stmt = $this->nativeExecute($sql);
        
        $result = array();

        foreach ($stmt as $k=>$v)
        {
            $result[$k] = $v;
        }

        return $result;
    }

    public function insert($table, $valuesArray){
        $valuesString = $this->createValuesString($valuesArray);
        $sql = "INSERT INTO $table " . $valuesString; 
        return $this->execute($sql);
    }


    public function update($table, $valuesArray, $whereArray){
        $valuesString = $this->createUpdateValuesString($valuesArray);
        $whereString = $this->createWhereString($whereArray);

        $sql = "UPDATE $table SET $valuesString" . $whereString; 
        
        return $this->execute($sql);
    }


    public function delete($table, $whereArray){
        $whereString = $this->createWhereString($whereArray);
        $sql = "DELETE FROM $table" . $whereString;

        return $this->execute($sql);
    }

    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }

    public function getErrorMessages(){
        return $this->errorMessages;
    }

    public function getSQLString(){
        return $this->sqlString;
    }

    public function fetchOne($table, $whereArray){

        $whereString = $this->createWhereString($whereArray);

        $sql = "SELECT * FROM $table" . $whereString;        

        return $this->query($sql);
    }

    public function fetchAll($table,$whereArray=array(),$orderArray=array(),$limit=0) {

        $whereString = $this->createWhereString($whereArray);
        $orderString = $this->createOrderString($orderArray);
        $limitString = $this->createLimitString($limit);



        $sql = "SELECT * FROM $table" . $whereString . $orderString  . $limitString;

        return $this->query($sql);
    }


    protected function createLimitString($limit){
        $result = '';

        if($limit > 0){
            $result = ' LIMIT ' . $limit;
        }

        return $result;
    }


    protected function createOrderString($orderArray){
        $orderParameterStrings = array();

        foreach ($orderArray as $key => $value) {
            $orderParameterStrings[] = "`$key` $value";
        }

        $result = implode(' , ', $orderParameterStrings);

        if($result !== ''){
            $result = ' ORDER BY ' . $result;
        }

        return $result;
    }

    protected function createWhereString($whereArray){

        $whereParameterStrings = array();

        foreach ($whereArray as $key => $value) {
            $whereParameterStrings[] = "`$key`='$value'";
        }

        $result = implode(' AND ', $whereParameterStrings);

        if($result !== ''){
            $result =  ' WHERE ' . $result;
        }
        return $result;
    }

    protected function createInsertValuesString($valuesArray){
        $result = '(' . implode(',', array_keys($valuesArray)) . ') VALUES ("' . implode('","', $valuesArray) . '")';   
        return $result;
    }

    protected function createUpdateValuesString($valuesArray){
        $valuesParametersStrings = array();

        foreach($valuesArray as $key => $value){
            $valuesParametersStrings[] = "$key = '$value'";
        }

        $result = implode(' , ', $valuesParametersStrings);

        return $result;
    }

}
