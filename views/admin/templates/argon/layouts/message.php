<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
?>

<div class="row mb-3">
	<div class="col-12 mb-5 mb-xl-0">

		<div class="alert alert-<?php echo ($message['type'] == 'ok') ? 'success' : 'danger'   ?> alert-dismissible fade show" role="alert">	
			<p class="text-center mb-0">				
				<?php if ($message['type'] == 'ok') { ?>
					<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<?php } ?>
	    	<span class="alert-inner--text"><?php echo $message['text'] ?></span>	
			</p>		
	    
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
		</div>

	</div>	
</div>
