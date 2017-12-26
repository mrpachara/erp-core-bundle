<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

use Erp\Bundle\CoreBundle\Entity\Thing;

/**
 * Erp Command (CQRS)
 */
interface ErpCommand {
  /**
   * Create new instance.
   *
   * @param Thing|null $thing
   *
   * @return static
   */
  public function create(Thing $thing = null);

  /**
   * Starts a transaction on the underlying database connection.
   *
   * @return void
   */
  public function beginTransaction();

  /**
   * Executes a function in a transaction.
   *
   * The function gets passed this EntityManager instance as an (optional) parameter.
   *
   * {@link flush} is invoked prior to transaction commit.
   *
   * If an exception occurs during execution of the function or flushing or transaction commit,
   * the transaction is rolled back, the EntityManager closed and the exception re-thrown.
   *
   * @param callable $func The function to execute transactionally.
   *
   * @return mixed The non-empty value returned from the closure or true instead.
   */
  public function transactional($func);

  /**
   * Commits a transaction on the underlying database connection.
   *
   * @return void
   */
  public function commit();

  /**
   * Performs a rollback on the underlying database connection.
   *
   * @return void
   */
  public function rollback();

  /**
   * Tells the ObjectManager to make an instance managed and persistent.
   *
   * The object will be entered into the database as a result of the flush operation.
   *
   * NOTE: The persist operation always considers objects that are not yet known to
   * this ObjectManager as NEW. Do not pass detached objects to the persist operation.
   *
   * @param object $object The instance to make managed and persistent.
   *
   * @return void
   */
  public function persist($object);

  /**
   * Removes an object instance.
   *
   * A removed object will be removed from the database as a result of the flush operation.
   *
   * @param object $object The object instance to remove.
   *
   * @return void
   */
  public function remove($object);
}
