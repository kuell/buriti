<?php

class Format {
	public static function viewDate($data) {
		$d = implode('/', array_reverse(explode('-', $data)));
		return $d;
	}

	public static function viewDateTime($date_time) {
		$d    = explode(' ', $date_time);
		$date = Format::viewDate($d[0]);
		$hora = $d[1];

		return $date.' '.$hora;
	}
}