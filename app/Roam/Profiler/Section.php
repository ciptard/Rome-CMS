<?php

class Roam_Profiler_Section
{
	/**
	 * The section's name
	 *
	 * @var string
	 */
	private $_name;

	/**
	 * Start time from microtime()
	 *
	 * @var float
	 */
	private $_startTime;

	/**
	 * Finish time from microtime()
	 *
	 * @var float
	 */
	private $_finishTime;

	/**
	 * Elapsed time from previous runs
	 *
	 * @var float
	 */
	private $_elapsedTime;

	/**
	 * Memory load at start
	 *
	 * @var int
	 */
	private $_startMemory;

	/**
	 * Memory load at finish
	 *
	 * @var int
	 */
	private $_finishMemory;

	/**
	 * Memory used in previous runs
	 *
	 * Note that a negative number is possible.
	 *
	 * @var int
	 */
	private $_memoryUsed;

	/**
	 * Whether the section is started
	 *
	 * @var bool
	 */
	private $_started = false;

	/**
	 * Whether the section is finished
	 *
	 * @var bool
	 */
	private $_finished = false;

	/**
	 * The number of times this section was encountered
	 *
	 * @var int
	 */
	private $_encounters;

	/**
	 * Constructor
	 *
	 * @param  string $name the section's name
	 */
	public function __construct($name){
		$this->_name = $name;
	}

	/**
	 * Gets the section's name
	 *
	 * @return string the section's name
	 */
	public function getName() {
		return $this->_name;
	}

	/**
	 * Starts the section
	 */
	public function start() {
		if (!$this->_started && !$this->_finished) {
			$this->_startTime   = microtime(true);
			$this->_startMemory = memory_get_usage();
			$this->_started     = true;
			$this->_finished    = false;
			$this->_encounters  = 1;
		} else {
			var_dump('not starting "' . $this->getName() . '"');
		}
	}

	/**
	 * Continues the section if it's been interrupted
	 */
	public function resume() {
		if ($this->_started && $this->_finished) {
			$this->_elapsedTime += $this->_finishTime - $this->_startTime;
			$this->_memoryUsed  += $this->_finishMemory - $this->_startMemory;
			$this->_startTime   = microtime(true);
			$this->_startMemory = memory_get_usage();
			$this->_started     = true;
			$this->_finished    = false;
			$this->_encounters  += 1;
		} else {
			var_dump('not resuming "' . $this->getName() . '"');
		}
	}

	/**
	 * Finishes the section
	 */
	public function finish() {
		if ($this->_started) {
			$this->_finishTime   = microtime(true);
			$this->_finishMemory = memory_get_usage();
			$this->_started      = true;
			$this->_finished     = true;
		} else {
			var_dump('not finishing "' . $this->getName() . '"');
		}
	}

	/**
	 * Gets the report
	 *
	 * The report is formatted as follows:
	 *    'time'   => float (seconds)
	 *    'memory' => int (bytes)
	 *
	 * @return array the report, or false if the section has not finished
	 */
	public function getReport() {
		if ($this->_finished) {
			$report = array();
			$report['time']   = $this->_elapsedTime + ($this->_finishTime - $this->_startTime);
			$report['memory'] = $this->_memoryUsed + ($this->_finishMemory - $this->_startMemory);
			$report['encounters'] = $this->_encounters;
			return $report;
		} else {
			var_dump('not reporting "' . $this->getName() . '"');
			return false;
		}
	}
}

