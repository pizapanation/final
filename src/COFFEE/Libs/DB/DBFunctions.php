<?php

namespace Libs\DB;

use PDO;
use PDOException;
use Config\DBSettings;
use Libs\DB\Interface\DbFunctions_interface;

class DBFunctions implements DbFunctions_interface
{
  private static DBFunctions $instance;
  private PDO $db;
  private string $error;

  public function __construct()
  {
    $this->db = new PDO(
      DBSettings::CONNECT,
      DBSettings::USER,
      DBSettings::PASS,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]
    );
  }

  public static function instance(){
    if(empty(self::$instance)){
      self::$instance=new DBFunctions;
    }
    return self::$instance;
  }

  public function getError()
  {
    return $this->error;
  }

  public function execute_query($sql, $params=[])
  {
    try {
      $stmt = $this->db->prepare($sql);
      $stmt->execute($params);
      return $stmt;
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      return false;
    }
  }

  public function fetch_query($sql, $params=[])
  {
    $stmt = "";
    $result = [];
    try {
      $statement = $this->execute_query($sql, $params);
      $stmt = $statement->fetch();
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      return false;
    }
    // foreach ($stmt as $key => $value) {
    //   $result[$key] = htmlspecialchars($value = is_null($value) ? '' : $value, ENT_QUOTES, 'utf-8');
    // }
    return $this->escape($stmt);
  }

  public function fetch_all_query($sql, $params=[])
  {
    $stmt='';
    try{
      $statement = $this->execute_query($sql, $params);
      $stmt = $statement->fetchAll();
    }catch(PDOException $e){
      $this->error=$e->getMessage();
      return false;
    }
    // foreach($stmt as $row){
    //   foreach($row as $column=>$value){
    //     $result[$row][$column]= htmlspecialchars($value = is_null($value) ? '' : $value, ENT_QUOTES, 'utf-8');
    //   }
    // }
    return $this->escape($stmt);
  }

  public function beginTransaction(){
    $this->db->beginTransaction();
  }

  public function commit()
  {
    try {
      $this->db->commit();
    } catch (PDOException $e) {
      $this->rollback();
    }
  }

  public function rollback()
  {
    $this->db->rollBack();
  }

  public function lastID()
  {
    $result = $this->db->lastInsertId();
    return $result;
  }

  private function escape($value){
    if(is_array($value)){
      return array_map([$this,'escape'],$value);
    }
    else if(is_string($value)){
      return htmlspecialchars($value = is_null($value) ? '' : $value, ENT_QUOTES, 'utf-8');
    }
    return $value;
  }
}