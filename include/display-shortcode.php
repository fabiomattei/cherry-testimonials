<?php

/**
 * This function handle the short code
 */
function RCTE_doubleslider( $atts, $content ) {

	global $post;

	$atts = array( // a few default values
			'posts_per_page' => '3',
			'post_type' => RCTE_SLUG
			);

	$posts = new WP_Query( $atts );

	$out = '<div class="doubleslider-container">
				<div class="doubleslider-titlewrapper">
					<h4 class="doubleslider-title">Testimonials</h4>
				</div>';
	$out .= '<ul id="doubleslider-slides">';

    ob_start();

	$i = 1;
	$printed = 0;
	if ($posts->have_posts()) {

	    while ($posts->have_posts()) {
	        $posts->the_post();
			
			// opening li
			if ($i % 2 == 1) $out .= '<li id="#slide'.($i / 2 + 0.5).'">';
   					 		
			/* slide content */
			$out .= '<div class="doubleslider-box-negative">
				<div class="doubleslider-thumbnail">
					'.get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'doubleslider-thumb' ) ).'
					</div> <!-- .doubleslider-thumbnail -->
			    <div class="doubleslider-desc">
					<h6><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h6>
				<p>'.get_the_content().'</p>
				</div> <!-- .doubleslider-desc -->
				</div> <!-- .doubleslider-box -->';		
				
			// closing li
			if ($i % 2 == 0) $out .= '</li>';		

			$i++;

		} // end while loop

		// if li has been not closed I close it
		if ( substr( $out, -5 ) != '</li>' ) $out .= '</li>';
		
	    $out .= '</ul> <!-- .slides -->';
		$out .= '</div> <!-- .doubleslider-container -->
		<script type="text/javascript">
jQuery( document ).ready(function( jQuery ) {
	jQuery(\'#doubleslider-slides\').slippry({
		adaptiveHeight: true,
	});
});
</script>';

	} else {
		return; // no posts found
	}

	echo $out;

    return ob_get_clean();
}
add_shortcode( 'RCTEDoubleSlider', 'RCTE_doubleslider' );
