<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Queue Job
 *
 * @package default
 * @author Luke Lanchester
 **/
class Kohana_Queue_Job {


	/**
	 * Create a Queue_Job
	 *
	 * @param mixed Job data
	 * @param mixed Original Job enclosure e.g. driver specific object
	 * @return Queue_Job
	 * @author Luke Lanchester
	 **/
	public static function factory($data, $original_enclosure = null) {
		return new Queue_Job($data, $original_enclosure);
	} // end func: factory



	/**
	 * @var mixed Job data
	 **/
	protected $data;


	/**
	 * @var mixed Original Job
	 **/
	protected $original_enclosure;


	/**
	 * Create a Job
	 *
	 * @param mixed Job data
	 * @param mixed Original Job enclosure e.g. driver specific object
	 * @return void
	 * @author Luke Lanchester
	 **/
	protected function __construct($data, $original_enclosure = null) {
		$this->data = $data;
		$this->original_enclosure = $original_enclosure;
	} // end func: __construct



	/**
	 * Return the original enclosure of this Job
	 *
	 * @return mixed Job data
	 * @author Luke Lanchester
	 **/
	public function get_data() {
		return $this->data;
	} // end func: get_data



	/**
	 * Return the original enclosure of this Job
	 *
	 * @return mixed Original enclosure
	 * @author Luke Lanchester
	 **/
	public function get_raw() {
		return $this->original_enclosure;
	} // end func: get_raw



} // end class: Kohana_Queue_Job