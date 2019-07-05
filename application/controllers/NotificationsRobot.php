<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationsRobot extends MasterLogado {

	public function atualizarStatusPedido()
	{
		$this->load->model("PedidosAdminModel");
		$this->PedidosAdminModel->atualizarPedidosPagseguro();


		//recebe o corpo do conteudo pagseguro
		$data = json_decode(file_get_contents('php://input'));
		echo var_dump($data);
	}
}
