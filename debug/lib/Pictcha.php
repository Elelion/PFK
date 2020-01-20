<?php
declare(strict_types=1);

require_once 'lib/functions.php';

class Pictcha
{
	private $randMin = null;
	private $randMax = null;

	public function __construct()
	{
		$this->setRandomMinMax(1, 9);
	}

	/**/

	public function getRandomNumber(): int
	{
		return rand($this->randMin, $this->randMax);
	}

	public function setRandomMinMax(int $min, int $max): void
	{
		$this->randMin = $min;
		$this->randMax = $max;
	}
}
