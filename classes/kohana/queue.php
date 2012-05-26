<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Queue
 *
 * @package default
 * @author Luke Lanchester
 **/
class Kohana_Queue {


	/**
	 * @var string Default Queue configuration group
	 **/
	public static $default = 'default';


	/**
	 * @var array Producer Queues
	 **/
	protected static $producers = array();


	/**
	 * @var array Consumer Queues
	 **/
	protected static $consumers = array();


	/**
	 * Return a Producer, to add Jobs to a Queue
	 *
	 * @param string Queue name
	 * @param string Queue config group name
	 * @return void
	 * @author Luke Lanchester
	 **/
	public static function producer($queue, $group = null) {
		
		if($group === null) $group = Queue::$default;

		if(!isset(Queue::$producers[$group])) {

			$config = Kohana::$config->load("queue.$group");
			$driver = Arr::get($config, 'driver');
			$class = "Queue_{$driver}_Producer";

			if(!class_exists($class)) throw new Queue_Exception('The requested Queue driver does not support producers: :driver', array(':driver' => $driver));
			Queue::$producers[$group] = new $class($config, $queue);

		}

		return Queue::$producers[$group];

	} // end func: producer



	/**
	 * Return a Consumer, to process jobs in a Queue
	 *
	 * @param string Queue name
	 * @param string Queue config group name
	 * @return void
	 * @author Luke Lanchester
	 **/
	public static function consumer($queue, $group = null) {
		
		if($group === null) $group = Queue::$default;

		if(!isset(Queue::$consumers[$group])) {

			$config = Kohana::$config->load("queue.$group");
			$driver = Arr::get($config, 'driver');
			$class = "Queue_{$driver}_Consumer";

			if(!class_exists($class)) throw new Queue_Exception('The requested Queue driver does not support consumer: :driver', array(':driver' => $driver));
			Queue::$consumers[$group] = new $class($config, $queue);

		}

		return Queue::$consumers[$group];

	} // end func: consumer



} // end class: Kohana_Queue