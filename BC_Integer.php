<?php
class BC_Integer
{
	public $start;
	public $end;
	public $encoded;
	public $decoded;

	public function __construct($str, $pos)
	{
		$this->start=$pos;
		$this->end=strpos($str, 'e', $this->start);
		$this->encoded=substr($str, $this->start, $this->end - $this->start);
		$this->decode();

	}

	public function length()
	{
		return $this->end - $this->start;
	}

	public function decode()
	{
		$this->decoded=trim($this->encoded, 'ie');
	}
}