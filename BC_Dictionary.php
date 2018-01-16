<?php
require_once 'BencodeEntity.php';

class BC_Dictionary extends BencodeEntity
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
		$currentPosition++;		// Skip 'd'

		// Go through the string
		while($this->encodedString[$currentPosition] != 'e')
		{
			//
			// Get key (must be BC_String)
			//
			$temp=new BC_String($this->encodedString, $currentPosition);
			$key=$temp->getDecoded();
			$currentPosition=$temp->getEnd()+1;

			//
			// Get value
			//
			if($this->encodedString[$currentPosition] == 'i')	// We have integer
			{
				$temp=new BC_Integer($this->encodedString, $currentPosition);	
			}
			else if($this->encodedString[$currentPosition] == 'l')	// We have list
			{
				$temp=new BC_List($this->encodedString, $currentPosition);
			}
			else if(is_numeric($this->encodedString[$currentPosition]))	// We have string
			{
				$temp=new BC_String($this->encodedString, $currentPosition);
			}
			else if($this->encodedString[$currentPosition] == 'd')	// We have dictionary
			{
				$temp=new BC_Dictionary($this->encodedString, $currentPosition);
			}
			
			$value=$temp->getDecoded();
			$this->decoded[$key]=$value;

			$currentPosition=$temp->getEnd()+1;

		}
		$this->end=$currentPosition;
	}
}