<?php
require_once 'BencodeEntity.php';
require_once 'BC_Integer.php';
require_once 'BC_List.php';

class Bencode extends BencodeEntity
{
	private $currentPosition;
	private $totalLength;

	public function __construct($str)
	{
		$this->encodedString=$str;
		$this->currentPosition=0;
		$this->totalLength=strlen($this->encodedString);
	}

	public function decode()
	{
		// Make root array
		if($this->encodedString[$this->currentPosition] == 'l')
		{
			$this->decoded=array();
			$this->currentPosition++;
		}

		// Go through the string
		while($this->encodedString[$this->currentPosition] != 'e')
		{
			if($this->encodedString[$this->currentPosition] == 'i')	// We have integer
			{
				$temp=new BC_Integer($this->encodedString, $this->currentPosition);
				$this->decoded[]=$temp->getDecoded();
				$this->currentPosition=$temp->getEnd()+1;
			}
			else if($this->encodedString[$this->currentPosition] == 'l')	// We have list
			{
				$temp=new BC_List($this->encodedString, $this->currentPosition);
				$this->decoded[]=$temp->getDecoded();
				$this->currentPosition=$temp->getEnd()+1;
			}
			else
				$this->currentPosition++;
		}
	}
}