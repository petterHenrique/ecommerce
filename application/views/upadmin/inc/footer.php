

	<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/js/metisMenu.min.js"></script>

	<script src="<?=base_url()?>assets/js/pnotify.custom.min.js"></script>
	<script src="<?=base_url()?>assets/js/notificacao.js"></script>
	<script src="<?=base_url()?>assets/js/ui-block.js"></script>
	<script src="<?=base_url()?>assets/js/block.js"></script>
	<script src="<?=base_url()?>assets/js/raphael.min.js"></script>
	<script src="<?=base_url()?>assets/js/jquery.mask.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="<?=base_url()?>assets/js/dropzone.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script src="<?=base_url()?>assets/js/require.min.js"></script>
    <script src="<?=base_url()?>assets/js/dashboard.js"></script>
    <script src="<?=base_url()?>assets/plugins/maps-google/plugin.js"></script>
    <script src="<?=base_url()?>assets/plugins/input-mask/plugin.js"></script>

    <script>


    //TODO:  REFATORAR CRIAR UM ARQUIO DE SCRIPTS
    //seta theme bootstrpa select2 TODO: retirar e criar um config js
    $.fn.select2.defaults.set("theme", "bootstrap");

    $(function(){
    	$(".select2").select2();
    	$('.datepicker').datepicker({
		    format: 'dd/mm/yyyy',
	    	language: 'pt-BR',
	    	title: "",
	    	weekStart: 0,
	    	startDate:'0d',
	    	autoclose: true,
	    	todayHighlight: true,
	    	forceParse: false
		});
    });
    </script>