<?php

/**
 * This functions check the loaded post, in case a shortcode is present id loads
 * necessary css and js in order to show the gallery
 *
 * It relies on a jquery dependency
 */
function RCTE_ShortCodeDetect() {
    global $wp_query;
    $Posts = $wp_query->posts;
    foreach ($Posts as $Post) {
		if ( strpos($Post->post_content, 'RCTEDoubleSlider' ) ) {
			// loading css scripts
			//wp_enqueue_style('rcte-testimonialscss', RCTE_PLUGIN_URL.'css/rctestimonials.css');

			// loading owl.carousel js scripts
			wp_enqueue_script('rcte-carousel-javascript', RCTE_PLUGIN_URL.'vendors/owlcarousel/owl.carousel.min.js', array('jquery'), '', true);

            // loading owl.carousel css scripts
			wp_enqueue_style('rcte-carousel-css', RCTE_PLUGIN_URL.'vendors/owlcarousel/owl.carousel.css');
            wp_enqueue_style('rcte-carousel-theme-css', RCTE_PLUGIN_URL.'vendors/owlcarousel/owl.theme.css');
            wp_enqueue_style('rcte-carousel-transitions-css', RCTE_PLUGIN_URL.'vendors/owlcarousel/owl.transitions.css');

            break;
        } //end of if
    } //end of foreach
}
add_action( 'wp', 'RCTE_ShortCodeDetect' );
