<?php
require_once 'BencodeEntity.php';

class BC_String extends BencodeEntity
{
	public function __construct($str, $pos)
	{
		$this->start=$pos;
		$this->encodedString=$str;

		$this->decode();
	}

	public function decode()
	{
		$colon_pos=strpos($this->encodedString, ':', $this->start);	// seek nearest ':' position
		$length=substr($this->encodedString, $this->start, ($colon_pos-$this->start)); 	// extract length of our string
		$this->decoded=substr($this->encodedString, ($colon_pos+1), $length);	// extract our substring
		$this->end=$colon_pos+$length;
	}
}