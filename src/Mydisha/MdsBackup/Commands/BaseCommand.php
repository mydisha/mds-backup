<?php

namespace Mydisha\MdsBackup\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Mydisha\MdsBackup\Console;
use Mydisha\MdsBackup\ConsoleColors;
use Mydisha\MdsBackup\DatabaseBuilder;

class BaseCommand extends Command {
	/**
	 * @var Mydisha\MdsBackup\DatabaseBuilder
	 */
	protected $databaseBuilder;

	/**
	 * @var Mydisha\MdsBackup\ConsoleColors
	 */
	protected $colors;

	/**
	 * @var Mydisha\MdsBackup\Console
	 */
	protected $console;

	/**
	 * @param Mydisha\MdsBackup\DatabaseBuilder $databaseBuilder
	 * @return Mydisha\MdsBackup\Commands\BaseCommand
	 */
	public function __construct(DatabaseBuilder $databaseBuilder) {
		parent::__construct();

		$this->databaseBuilder = $databaseBuilder;
		$this->colors = new ConsoleColors();
		$this->console = new Console();
	}

	/**
	 * @return Mydisha\MdsBackup\Databases\DatabaseContract
	 */
	public function getDatabase($database) {
		$database = $database ?: Config::get('database.default');
		$realConfig = Config::get('database.connections.' . $database);

		return $this->databaseBuilder->getDatabase($realConfig);
	}

	/**
	 * @return string
	 */
	protected function getDumpsPath() {
		return Config::get('mds-backup.path');
	}

	/**
	 * @return string
	 */
	protected function getInitialName() {
		return config::get('mds-backup.initial_name');
	}

	/**
	 * @return boolean
	 */
	public function enableCompression() {
		return Config::set('mds-backup.compress', true);
	}

	/**
	 * @return boolean
	 */
	public function disableCompression() {
		return Config::set('mds-backup.compress', false);
	}

	/**
	 * @return boolean
	 */
	public function isCompressionEnabled() {
		return Config::get('mds-backup.compress');
	}

	/**
	 * @return boolean
	 */
	public function isCompressed($fileName) {
		return pathinfo($fileName, PATHINFO_EXTENSION) === "gz";
	}
}
