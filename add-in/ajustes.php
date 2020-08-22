<?php
add_shortcode("fix159775_add_to_cart", "fix159775_add_to_cart");
function fix159775_add_to_cart($atts, $content = null){
	global $post;
	ob_start();
	?>
	<script type="text/javascript">
		jQuery(function($){
			$('.fix159775_add_to_cart_<?php echo $post->ID ?>').on('click', function(e){
				e.preventDefault();
				var post_id = $(this).attr('data-id');
				$.ajax({
					url:"<?php echo site_url() ?>/fix159775_add_to_cart/?id="+post_id,
					method:"GET",
					dataType:"json",
					contentType:false,
					cache:false,
					processData:false,
				});
				return false;
			});
		});
	</script>
	<div class="elementor-button-wrapper">
		<a href="#" data-id="<?php echo $post->ID ?>" class="fix159775_add_to_cart_<?php echo $post->ID ?> elementor-button-link elementor-button elementor-size-sm" role="button">
			<span class="elementor-button-content-wrapper">
				<span class="elementor-button-text">ADICIONAR</span>
			</span>
		</a>
	</div>
	<?php
	return ob_get_clean();
}

add_action( 'parse_request', 'fix159775_parse_request');
function fix159775_parse_request( &$wp ) {
	global $woocommerce;
	if($wp->request == 'fix159775_add_to_cart'){
		$id = isset($_GET['id']) ? $_GET['id'] : 0 ;
		$woocommerce->cart->add_to_cart( $id );
		exit;
	}
}
