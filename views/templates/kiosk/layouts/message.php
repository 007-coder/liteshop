<?php defined('YV_LiteShop') or die ('Restricted Access!');
$message = (isset($data['message']) && count($data['message'])) ? $data['message'] : false;
 ?>
 
<?php if ($message !== false) { ?>

<script type="text/javascript">
	$(document).ready(function() { 
		var messWrap = $('.message_wrap'); 		
		if (messWrap.length) {
			setTimeout(function() { 					
					messWrap.fadeOut('400'); 
				}, 18000
			);
			setTimeout(function() { 					
					messWrap.remove(); 
				}, 23000
			);
		}		

		$('.message_wrap .message .close_btn').click(function(e) {			
			messWrap.fadeOut('400');
			setTimeout(function() { 					
					messWrap.remove(); 
				}, 4000
			);		
		});

	});
</script>

<div class="message_wrap mt-20">
	<div class="row align-items-start justify-content-center">
		<div class="col-md-8 col-sm-12 <?php echo $message['type'] ?> ptb-30 message">
			<h4 class="text-center"><?php echo $message['text']; ?></h4>

			<div class="close_btn">
				<i class="fas fa-times"></i>
			</div>			
		</div>

		
	</div>		
	
</div>
<?php } ?>