<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Queue Driver: Base (Consumer)
 *
 * @package default
 * @author Luke Lanchester
 **/
abstract class Kohana_Queue_Consumer {


	/**
	 * @var array Config
	 **/
	protected $_config;


	/**
	 * Constructor
	 *
	 * @param array Config
	 * @param string Queue
	 * @return void
	 * @author Luke Lanchester
	 **/
	public function __construct($config, $queue_name) {
		$this->_config = $config;
	} // end func: __construct



	/**
	 * Consume a Job from the Queue
	 *
	 * @return Queue_Job Job
	 * @author Luke Lanchester
	 **/
	abstract public function consume();



	/**
	 * Mark a job as completed
	 *
	 * @param Queue_Job Job
	 * @return bool Result
	 * @author Luke Lanchester
	 **/
	abstract public function delete(Queue_Job $job);



} // end class: Kohana_Queue_Consumer