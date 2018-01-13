<?php
require_once 'BencodeEntity.php';

class BC_List extends BencodeEntity
{
	public function __construct($str, $pos)
	{

		$this->start=$pos;
		$this->encodedString=$str;

		$this->decode();
	}

	public function decode()
	{
		// Make array
		$this->decoded=array();
		$currentPosition=$this->start;
		$currentPosition++;		// Skip 'l'

		// Go through the string
		while($this->encodedString[$currentPosition] != 'e')
		{

			if($this->encodedString[$currentPosition] == 'i')	// We have integer
			{

				$temp=new BC_Integer($this->encodedString, $currentPosition);
				$this->decoded[]=$temp->getDecoded();
				$currentPosition=$temp->getEnd()+1;

				
			}
			else if($this->encodedString[$currentPosition] == 'l')	// We have list
			{

				$temp=new BC_List($this->encodedString, $currentPosition);
				$this->decoded[]=$temp->getDecoded();
				$currentPosition=$temp->getEnd()+1;
			}
			else if(is_numeric($this->encodedString[$currentPosition]))	// We have string
			{
				$temp=new BC_String($this->encodedString, $currentPosition);
				$this->decoded[]=$temp->getDecoded();
				$currentPosition=$temp->getEnd()+1;
			}
			else
				$currentPosition++;

		}
		$this->end=$currentPosition;

	}		
}