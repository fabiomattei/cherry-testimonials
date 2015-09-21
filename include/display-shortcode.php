<?php

/**
 * This function handle the short code
 */
function RCTE_testimonials_list( $atts, $content ) {
	global $post;

	$atts = array( // a few default values
			'posts_per_page' => '3',
			'post_type' => RCTE_SLUG
			);

	$posts = new WP_Query( $atts );
	$out = '<div class="testimonials-container">
				<h4>Testimonials</h4>';
	$out = '<ul id="testimonalis-container">';

    ob_start();

		$i = 1;
	if ($posts->have_posts()) {

	    while ($posts->have_posts()) {
	        $posts->the_post();

	        if ($i % 2 == 1) $out .= '<li id="#slide'.($i / 2 + 0.5).'">';

			$out .= '<div class="testimonial-box">
				<div class="testimonial-thumbnail">'.get_the_post_thumbnail( $post_id, 'testimonial-img', array( 'class' => 'testimonal-thumb' ) ).'</div>
	            <div class="testimonial-desc">
					<h5><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h5>
				<p>'.get_the_content().'</p>
				</div>
				</div> <!-- .testimonial-box -->';

	        if ($i % 2 == 0) $out .= '</li>';

					$i++;
	/* these arguments will be available from inside $content
	    get_permalink()
	    get_the_content()
	    get_the_category_list(', ')
	    get_the_title()
	    and custom fields
	    get_post_meta($post->ID, 'field_name', true);
	*/

		} // end while loop

		// in case I have an odd number of items, I need to close li
		if ( substr($dynamicstring, -5) != '</li>' )  $out .= '</li>';

		$out .= '</ul>
			</div> <!-- .testimonials-container -->
		<script type="text/javascript">
jQuery( document ).ready(function( jQuery ) {
	jQuery(\'#testimonalis-container\').slippry({
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
add_shortcode( 'RCTEList', 'RCTE_testimonials_list' );


// usage [RCTEList]
