<?php

class Format {
	public static function viewDate($data) {
		$d = implode('/', array_reverse(explode('-', $data)));
		return $d;
	}
	public static function dbDate($data) {
		$d = implode('-', array_reverse(explode('/', $data)));
		return $d;
	}

	public static function viewDateTime($date_time) {
		$d    = explode(' ', $date_time);
		$date = Format::viewDate($d[0]);
		$hora = $d[1];

		return $date.' '.$hora;
	}

	public static function valorDb($valor) {
		$valor = str_replace(',', '.', str_replace('.', '', $valor));

		return $valor;
	}

	public static function valorView($valor, $casas = 2) {
		return number_format($valor, $casas, ',', '.');
	}
}