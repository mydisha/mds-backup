<?php namespace Mydisha\MdsBackup\Commands\Helpers;
use Illuminate\Support\Facades\Config;

class BackupFile {

	/**
	 * @var string
	 */
	private $fileName;
	private $filePath;

	/**
	 * @param mixed $filenameArg
	 * @param Mydisha\MdsBackup\Databases\DatabaseContract $database
	 * @param string $dumpPath
	 * @return Mydisha\MdsBackup\Commands\Helpers\BackupFile
	 */
	public function __construct($filenameArg, $database, $dumpPath) {
		if ($filenameArg) {
			$this->buildWithArguments($filenameArg);
		} else {
			$this->build($dumpPath, $database->getFileExtension());
		}
	}

	/**
	 * @return string
	 */
	public function name() {
		return $this->fileName;
	}

	/**
	 * @return string
	 */
	public function path() {
		return $this->filePath;
	}

	/**
	 * @param string $dumpPath
	 * @param string $fileExtension
	 * @return void
	 */
	private function build($dumpPath, $fileExtension) {
		$initial_name = Config::get('mds-backup.initial_name');
		if (empty($initial_name)) {
			$this->fileName = date('YmdHis') . '.' . $fileExtension;
		} else {
			$this->fileName = $initial_name . '-' . date('YmdHis') . '.' . $fileExtension;

		}
		$this->filePath = rtrim($dumpPath, '/') . '/' . $this->fileName;
	}

	/**
	 * @param string $filename
	 * @return void
	 */
	private function buildWithArguments($filename) {
		$this->filePath = substr($filename, 0, 1) !== '/' ? getcwd() . '/' : '';
		$this->filePath .= $filename;

		$this->fileName = basename($this->filePath);
	}
}
