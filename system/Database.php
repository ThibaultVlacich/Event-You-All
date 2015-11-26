<?php
/**
 * Database.php
 */
 
defined('EUA_VERSION') or die('Access denied');
/**
 * Database manages all database interactions.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-26-11-2015
 */
class Database extends PDO {
	/**
	 * Opens the PDO connection with the database.
	 *
	 * @param string $dsn database server
	 * @param string $user username
	 * @param string $password password
	 * @throws Exception
	 */
	public function __construct($dsn, $user, $password) {
		if (!class_exists('PDO')) {
			throw new Exception("Database::__construct(): Class PDO not found.");
		}
		try {
			@parent::__construct($dsn, $user, $password);
		} catch (PDOException $e) {
			$message = utf8_encode($e->getMessage());
			throw new Exception($message);
		}
	}

	/**
	 * Insert a new row in table and return its id
	 *
	 * @param string        $table table name
	 * @param array(string) $fields fields to insert
	 * @param array(*)      $data data to insert (same key as in $fields)
	 *
	 * @return int or false id of inserted row or failure
	 */
	public function insertInto($table, $fields, $data) {
		$req = 'INSERT INTO `'.$table.'`(';
		foreach ($fields as $key) {
			$req .= $key.', ';
		}
		if (count($fields) >= 1) {
			$req = substr($req, 0, -2);
		}
		$req .= ') VALUES (';
		foreach ($fields as $key) {
			$req .= ':'.$key.', ';
		}
		if (count($fields) >= 1) {
			$req = substr($req, 0, -2);
		}
		$req .= ')';
		$prep = $this->prepare($req);
		foreach ($fields as $key) {
			$data[$key] = isset($data[$key]) ? $data[$key] : '';
			$prep->bindParam(':'.$key, $data[$key]);
		}
		if ($prep->execute()) {
			return $this->lastInsertId();
		} else {
			return false;
		}
	}

	/**
	 * Update a table and return the numbers of row affected
	 *
	 * @param string        $table table name
	 * @param array(string) $fields fields to update
	 * @param array(*)      $data data to update (same key as in $fields)
	 * @param string        $cond condition(s) of update (all rows by default)
	 *
	 * @return int or false number of inserted row or failure
	 */
	public function update($table, $fields, $data, $cond = '1') {
		$req = 'UPDATE `'.$table.'` SET ';
		foreach ($fields as $key) {
			$req .= $key.' = :'.$key.', ';
		}
		if (count($fields) >= 1) {
			$req = substr($req, 0, -2);
		}
		$req .= ' WHERE '.$cond;
		$prep = $this->prepare($req);
		foreach ($fields as $key) {
			$data[$key] = isset($data[$key]) ? $data[$key] : '';
			$prep->bindParam(':'.$key, $data[$key]);
		}
		return $prep->execute();
	}
}
?>
