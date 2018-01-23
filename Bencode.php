<?php
require_once 'BencodeEntity.php';
require_once 'BC_Integer.php';
require_once 'BC_String.php';
require_once 'BC_List.php';
require_once 'BC_Dictionary.php';

class Bencode extends BencodeEntity
{
	public function __construct($str)
	{
		$this->start=0;
		$this->encodedString=$str;

		$this->decode();
	}

	public function decode()
	{
		$currentPosition=$this->start;
		
		// Go through the encoded string
		if($this->encodedString[$currentPosition] == 'l')	// We have list in root
		{
			$this->decoded=(new BC_List($this->encodedString, $currentPosition))->getDecoded();
		}
		else if($this->encodedString[$currentPosition] == 'd')	// We have dictionary in root
		{
			$this->decoded=(new BC_Dictionary($this->encodedString, $currentPosition))->getDecoded();
		}
		else 	// Invalid char
		{
			print 'ERROR! Wrong data.';
			exit(1);
		}
	}
}