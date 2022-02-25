<?php

namespace App;
use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBuilder {

  private $pdo;
  private $queryFactory;

  public function __construct() {
    $this->pdo = new PDO("mysql:host=localhost;dbname=users","root","");
    $this->queryFactory = new QueryFactory('mysql');
  }

  public function getAll($table) {

    
    $select = $this->queryFactory->newSelect();
    $select->cols(['*'])
    ->from($table);

    // prepare the statement
    $sth = $this->pdo->prepare($select->getStatement());

    // bind the values and execute
    $sth->execute($select->getBindValues());

    // get the results back as an associative array
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;

  }

  public function insert($table, $data) {

    $insert = $this->queryFactory->newInsert();

      $insert
          ->into($table)                  
          ->cols($data);

          $sth = $this->pdo->prepare($insert->getStatement());
          $sth->execute($insert->getBindValues());
          $name = $insert->getLastInsertIdName('id');
  }

  public function update($table, $data, $id) {

    $update = $this->queryFactory->newUpdate();

    $update
      ->table($table)                  
      ->cols($data)
      ->where("id = $id");           
    
          var_dump($update->getStatement());
          $sth = $this->pdo->prepare($update->getStatement());
          $sth->execute($update->getBindValues());
  }

  public function delete($table, $id) {

    $delete = $this->queryFactory->newDelete();

    $delete
        ->from($table)                   
        ->where("id = $id");         
    
        var_dump($delete->getStatement());
    $sth = $this->pdo->prepare($delete->getStatement());
    $sth->execute($delete->getBindValues());

  }

}