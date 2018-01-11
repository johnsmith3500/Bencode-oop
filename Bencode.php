<?php
require_once 'BC_Integer.php';

class Bencode
{
	public $decoded;
	public $currentPosition;
	public $encoded;
	public $totalLength;

	public function __construct($str)
	{
		$this->encoded=$str;
		$this->currentPosition=0;
		$this->totalLength=strlen($this->encoded);
	}

	public function decode()
	{
		// Make root array
		if($this->encoded[$this->currentPosition] == 'l')
		{
			$this->decoded=array();
			$this->currentPosition++;
		}

		// Go through the string
		while($this->currentPosition < $this->totalLength)
		{
			if($this->encoded[$this->currentPosition] == 'i')
			{
				$temp=new BC_Integer($this->encoded, $this->currentPosition);
				$this->decoded[]=$temp->getDecoded();
				$this->currentPosition=$temp->getEnd();
			}
			else
				$this->currentPosition++;
		}
	}

	public function decoded()
	{
		return $this->decoded;
	}
}