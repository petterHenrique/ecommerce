<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MasterClienteLogado{

    public function logado()
    {
    	$bool = $_SESSION["logado"];
    	if($bool == 1){
    		return true;
    	}else{
    		return false;
    	}
    }

    public static function verificaClienteLogado(){
    	if(isset($_SESSION['clienteLogado'])){
			return true;
    	}else{
    		return false;
    	}
    }
}
