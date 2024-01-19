<?php

namespace Libs\DB\Interface;

/**
 * DB Interface
 */
interface DbFunctions_interface
{

  /**
   * return error message if catch PDOException
   * @return string
   */
  public function getError();

  /**
   * execute用
   * @param string $sql
   * @param mixed[] $params
   * @return mixed 
   */
  public function execute_query($sql, $params);

  /**
   *fetch用
   * @param string $sql
   * @param mixed[] $params
   * @return mixed
   */
  function fetch_query($sql, $params);

  /**
   * fetchAll
   * @param string $sql
   * @param mixed[] $params
   * 
   * @return mixed
   */
  function fetch_all_query($sql, $params);

  /**
   * begin transaction
   * @return  void
   */
  public function beginTransaction();

  /**
   * commit sql if the transaction was successfully completed
   * @return  void
   */
  public function commit();

  /**
   * rollback action if the transaction was not successfully completed
   */
  public function rollBack();

}
