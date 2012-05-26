<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Queue Driver: Pheanstalk (Consumer)
 *
 * @package default
 * @author Luke Lanchester
 **/
class Kohana_Queue_Pheanstalk_Consumer extends Queue_Consumer {


	/**
	 * @var Pheanstalk Queue instance
	 **/
	protected $queue;


	/**
	 * Create a connection to a new Tube to get jobs from
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
			$this->queue->watch($tube_name)->ignore('default');

		} catch(Pheanstalk_Exception $e) {
			throw new Queue_Exception($e->getMessage());
		}

	} // end func: __construct



	/**
	 * Consume a Job from the Queue
	 *
	 * @return Queue_Job Job
	 * @author Luke Lanchester
	 **/
	public function consume() {
		try {
			$job = $this->queue->reserve();
			return Queue_Job::factory(unserialize($job->getData()), $job);
		} catch(Pheanstalk_Exception $e) {
			return false;
		}
	} // end func: consume



	/**
	 * Mark a job as completed
	 *
	 * @param Queue_Job Job
	 * @return bool Result
	 * @author Luke Lanchester
	 **/
	public function delete(Queue_Job $job) {

		$original_job = $job->get_raw();
		if(!$original_job) return false;

		try {
			$this->queue->delete($original_job);
			return true;
		} catch(Pheanstalk_Exception $e) {
			return false;
		}

	} // end func: delete



} // end class: Kohana_Queue_Pheanstalk_Consumer