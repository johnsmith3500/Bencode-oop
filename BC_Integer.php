<?php
require_once 'BencodeEntity.php';

class BC_Integer extends BencodeEntity
{
	public function __construct($str, $pos)
	{
		$this->start=$pos;
		$this->end=strpos($str, 'e', $this->start);
		$this->encoded=substr($str, $this->start, $this->end - $this->start);
		$this->decode();

	}

	public function decode()
	{
		$this->decoded=trim($this->encoded, 'ie');
	}
}