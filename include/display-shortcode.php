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
	$out = '';
	
    ob_start();
	
	if ($posts->have_posts()) {
		
	    while ($posts->have_posts()) {
	        $posts->the_post();
			
	        $out .= '<div class="testimonials_box">
	            <h4><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h4>
	            <p class="testimonial_desc">'.get_the_content().'</p>';
	            // add here more...
	        $out .= '</div>';
			
	/* these arguments will be available from inside $content
	    get_permalink()  
	    get_the_content()
	    get_the_category_list(', ')
	    get_the_title()
	    and custom fields
	    get_post_meta($post->ID, 'field_name', true);
	*/
	
		} // end while loop
		
	} else {
		return; // no posts found
	}

	echo $out;
	
    return ob_get_clean();
}
add_shortcode( 'RCTEList', 'RCTE_testimonials_list' );


// usage [RCEVList]
