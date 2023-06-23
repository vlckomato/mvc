<?php
  class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
      // Set DSN
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      // Create PDO instance
      try{
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      } catch(PDOException $e){
        $this->error = $e->getMessage();
        echo $this->error;
      }
    }

    public function query($sql) {
      $this->stmt = $this->dbh->prepare($sql);
    }

    public function select($table, $id = null) {
        if(isset($id)) {
            $sql = 'SELECT * FROM '. $table . ' WHERE Productid = :id';
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->bindValue('id', $id, PDO::PARAM_INT);
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        } else {
            $sql = 'SELECT * FROM '. $table .'';
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
    }
  }