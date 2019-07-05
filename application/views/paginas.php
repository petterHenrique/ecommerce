<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title></title>
		<link href="<?=base_url()?>assets/css/bootstrap4.min.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/heroic-features.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<!--SEO-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>

		<?php $this->load->view('/inc/header'); ?>

			<?php

			echo var_dump($pagina);

			?>
        

        <?php $this->load->view('/inc/footer'); ?>
	</body>
</html>