<?php namespace Mydisha\MdsBackup\Commands\Helpers;

use File;
use Mydisha\MdsBackup\ConsoleColors;

class BackupHandler {

	/**
	 * @var Mydisha\MdsBackup\ConsoleColors
	 */
	protected $colors;

	/**
	 * @param Mydisha\MdsBackup\ConsoleColors $colors
	 * @return Mydisha\MdsBackup\Commands\Helpers\BackupHandler
	 */
	public function __construct($colors) {
		$this->colors = $colors;
	}

	/**
	 * @param boolean $status
	 * @return string
	 */
	public function errorResponse($status) {
		return $this->consoleResponse('Database backup failed. %s', $status, 'red');
	}

	/**
	 * @param string $filenameArg
	 * @param string $filePath
	 * @param string $fileName
	 * @return string
	 */
	public function dumpResponse($filenameArg, $filePath, $fileName) {
		$message = 'Database backup was successful. %s was saved in the backup folder';
		$param = $fileName;

		if ($filenameArg) {
			$message = 'Database backup was successful. Saved to %s';
			$param = $filePath;
		}

		return $this->consoleResponse($message, $param);
	}

	/**
	 * @return string
	 */
	public function s3DumpResponse() {
		return $this->consoleResponse('Upload complete.');
	}

	/**
	 * @return string
	 */
	public function localDumpRemovedResponse() {
		return $this->consoleResponse('Removed dump as it\'s now stored on S3.');
	}

	/**
	 * @param string $message
	 * @param mixed $param
	 * @param string $color
	 * @return string
	 */
	private function consoleResponse($message, $param = null, $color = 'green') {
		$coloredString = $this->colors->getColoredString("\n" . $message . "\n", $color);

		return $param ? sprintf($coloredString, $param) : $coloredString;
	}
}
