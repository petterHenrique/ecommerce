<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util {

	public static function ConverterDataFormatoAmericano($string){
		$dataLimpa = str_replace("/","-",$string);
		return date('Y-m-d', strtotime($dataLimpa));
	}

	public static function ConverterDataFormatoBrasileiro($string){
		return date('d/m/Y', strtotime($string));
	}


	public static function TotalCarrinhoCompras(){
		$CI=& get_instance();
		$CI->load->library('cart');

		$valorTotal = 0.00;

		foreach ($CI->cart->contents() as $item) {
			$valorTotal+=number_format((float)$item['subtotal'], 2, '.', '');
		}

		$objetoTotalizados = array(
			'total' => count($CI->cart->contents()),
			'valorTotal' => number_format((float)$valorTotal, 2,',','')
		);

		return json_decode(json_encode($objetoTotalizados));
	}
}
