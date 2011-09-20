<?php

class Profiler
{
	/**
	 * The instance
	 *
	 */
	protected static $instance;

	/**
	 * Sections of code to be profiled
	 *
	 * @var array
	 */
	private $_sections;

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->_sections = array();
	}

	/**
	 * Returns an instance of the observer
	 */
	public static function getInstance() {
		if (!(self::$instance instanceof Profiler)) {
			self::$instance = new Profiler();
		}
		return self::$instance;
	}

	/**
	 * Starts a section
	 *
	 * @param  string $name the section name
	 */
	public function start($name) {
		if (!isset($this->_sections[$name])) {
			$this->_sections[$name] = new Roam_Profiler_Section($name);
			$this->_sections[$name]->start();
		} else {
			$this->_sections[$name]->resume();
		}
	}

	/**
	 * Finishes a section
	 *
	 * @param  string $name the section name
	 */
	public function finish($name) {
		if (isset($this->_sections[$name])) {
			$this->_sections[$name]->finish();
		}
	}

	/**
	 * Gets the report
	 *
	 * The report is in the format section name => report
	 *
	 * @return array the report
	 */
	public function getReport() {
		$report = array();
		foreach ($this->_sections as $name => $section) {
			$report[$name] = $section->getReport();
		}
		return $report;
	}
}

