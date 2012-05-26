<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Queue Driver: Pheanstalk (Producer)
 *
 * @package default
 * @author Luke Lanchester
 **/
class Kohana_Queue_Pheanstalk_Producer extends Queue_Producer {


	/**
	 * @var Pheanstalk Queue instance
	 **/
	protected $queue;


	/**
	 * Create a connection to a new Tube to put jobs in
	 *
	 * @param string Tube name
	 * @return void
	 * @author Luke Lanchester
	 **/
	public function __construct($config, $tube_name) {
		parent::__construct($config, $tube_name);

		try {

			$host_address = Arr::get($config, 'host');
			$this->queue = new Pheanstalk($host_address);
			$this->queue->useTube($tube_name);

		} catch(Pheanstalk_Exception $e) {
			throw new Queue_Exception($e->getMessage());
		}

	} // end func: __construct



	/**
	 * Add a Job to the Queue
	 *
	 * @param Queue_Job Job
	 * @return bool Result
	 * @author Luke Lanchester
	 **/
	public function add(Queue_Job $job) {
		try {
			return (bool) $this->queue->put(serialize($job->get_data()));
		} catch(Pheanstalk_Exception $e) {
			return false;
		}
	} // end func: add



} // end class: Kohana_Queue_Pheanstalk_Producer