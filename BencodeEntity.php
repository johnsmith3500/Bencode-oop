<?php
// Abstract class for a bencode entity:
// string, integer, list, dictionary.

abstract class BencodeEntity
{
	protected $start;
	protected $end;
	protected $encodedString;
	protected $encodedPiece;
	protected $decoded;

	public function getStart()
	{
		return $this->start;
	}
	public function getEnd()
	{
		return $this->end;
	}
	public function getEncodedString()
	{
		return $this->encodedString;
	}
	public function getEncodedPiece()
	{
		return $this->encodedPiece;
	}
	public function getDecoded()
	{
		return $this->decoded;
	}

	public function length()
	{
		return $this->end - $this->start;
	}

	abstract public function decode();

}