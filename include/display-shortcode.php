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

    ob_start();

	$out = '<div class="">
				<div class="">
					<h4 class="">Testimonials</h4>
				</div>';

	$out .= '<div id="owlcarousel-testimonials">';

	if ($posts->have_posts()) {

	    while ($posts->have_posts()) {
	        $posts->the_post();

			$out .= '<div class="item">';
   					 		
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
				
			$out .= '</div>';

		} // end while loop

	    $out .= '</div> <!-- .slides -->';
		$out .= '</div> <!-- .doubleslider-container -->
		<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery("#owlcarousel-testimonials").owlCarousel({
        margin: 10,
        nav: true,
	    itemsDesktop : [1200,3],
	    itemsDesktopSmall : [990,2],
	    itemsTablet: [766,2],
	    itemsMobile : [540,1],
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
