<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Queue Driver: Base (Producer)
 *
 * @package default
 * @author Luke Lanchester
 **/
abstract class Kohana_Queue_Producer {


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
	 * Add a Job to the Queue
	 *
	 * @param Queue_Job Job
	 * @return bool Result
	 * @author Luke Lanchester
	 **/
	abstract public function add(Queue_Job $job);



} // end class: Kohana_Queue_Producer