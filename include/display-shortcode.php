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

/*
	<div class="doubleslider-container">
  	<div>your content</div>
 	<div>your content</div>
  	<div>your content</div>
	</div>
*/
	
	$out = '<div class="doubleslider-container">
				<div class="doubleslider-titlewrapper">
					<h4 class="doubleslider-title">Testimonials</h4>
				</div>';
	$out .= '<div class="doubleslider-slides">';

    ob_start();

	$i = 1;
	$printed = 0;
	if ($posts->have_posts()) {

	    while ($posts->have_posts()) {
	        $posts->the_post();
   					 		
			/* slide content */
			$out .= '<div class="doubleslider-box">
				<div class="doubleslider-thumbnail">'.get_the_post_thumbnail( $post_id, 'doubleslider-img', array( 'class' => 'doubleslider-thumb' ) ).'</div>
			    <div class="doubleslider-desc">
					<h5><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h5>
				<p>'.get_the_content().'</p>
				</div> <!-- .doubleslider-desc -->
				</div> <!-- .doubleslider-box -->';				

			$i++;

		} // end while loop

		$out .= '</li>';
	    $out .= '</div> <!-- .slides -->';
		$out .= '</div> <!-- .doubleslider-container -->';

	} else {
		return; // no posts found
	}

	echo $out;

    return ob_get_clean();
}
add_shortcode( 'RCTEDoubleSlider', 'RCTE_doubleslider' );
