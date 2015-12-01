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
    $Pattern = get_shortcode_regex();
    foreach ($Posts as $Post) {
		if ( strpos($Post->post_content, 'RCTEDoubleSlider' ) ) {
			// loading css scripts
			wp_enqueue_style('rcte-testimonialscss', RCTE_PLUGIN_URL.'css/rctestimonials.css');

			// loading slippry js scripts
			wp_enqueue_script('rcte-slippry-javascript', RCTE_PLUGIN_URL.'lib/slippry/slippry.min.js', array('jquery'), '', true);
			// loading slippry css scripts
			wp_enqueue_style('rcte-slippry-css', RCTE_PLUGIN_URL.'lib/slippry/slippry.css');

            break;
        } //end of if
    } //end of foreach
}
add_action( 'wp', 'RCTE_ShortCodeDetect' );
