//desenvolvido e projetado na mão sem uso de Wix ou qualquer outro software pronto.
//FSG empreendedorismo

function loading(msg){

	//remove do corpo e depois abaixo joga novamente
	$(document).find("#spinner").remove();

	$.blockUI.defaults = { 
	    css: { 
	        padding:        0, 
	        margin:         0, 
	        width:          '10%', 
	        top:            '40%', 
	        left:           '45%', 
	        textAlign:      'center', 
	        color:          '#000', 
	        border:         'none', 
	        'border-radius': '5px',
	        backgroundColor:'#fff', 
	        cursor:         'wait' 
	    }, 
	    fadeIn:  280, 
 
	    // fadeOut time in millis; set to 0 to disable fadeOut on unblock 
	    fadeOut:  400, 
	 
	    // time in millis to wait before auto-unblocking; set to 0 to disable auto-unblock 
	    timeout: 0, 
	 
	    // disable if you don't want to show the overlay 
	    showOverlay: true, 
	    // styles for the overlay 
	    overlayCSS:  { 
	        backgroundColor: '#000', 
	        opacity:         0.6, 
	        cursor:          'wait' 
	    }, 
	    cursorReset: 'default', 
	    growlCSS: { 
	        width:    '50px', 
	        top:      '10px', 
	        left:     '', 
	        right:    '10px', 
	        border:   'none', 
	        padding:  '5px', 
	        opacity:   0.6, 
	        cursor:    null, 
	        color:    '#fff', 
	        backgroundColor: '#000', 
	        '-webkit-border-radius': '10px', 
	        '-moz-border-radius':    '10px' 
	    }, 
	    showOverlay: true, 
	    focusInput: true, 
	    onBlock: null, 
	    onUnblock: null, 
	    quirksmodeOffsetHack: 4, 
	    blockMsgClass: 'blockMsg', 
	    ignoreIfBlocked: false 
	}; 

	$(document.body).append(objHTML);

	if(msg != "" && msg != null)
	{
		$(document).find("#spinner").find('.titulo-msg').text(msg);
	}else{
		$(document).find("#spinner").find('.titulo-msg').remove();
	}

	$.blockUI({message: $('#spinner')}); 
}
function loaded(){
	$.unblockUI();
}

let objHTML =  '<div id="spinner" style="display:none;">';
	objHTML += '</br>';
	objHTML += '<h4 style="font-size:18px;" class="titulo-msg"></h4>';
	objHTML += '</br>';
	objHTML += '<i class="fas fa-spinner fa-lg fa-spin fa-lgshutdown -s -t 10"></i>';
	objHTML += '</br>';
	objHTML += '</br>';
	objHTML += '</div>';

		
	