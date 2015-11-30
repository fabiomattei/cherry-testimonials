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

            wp_enqueue_style('rcte-testimonialscss', RCTE_PLUGIN_URL.'slick/slick.css');
            wp_enqueue_style('rcte-testimonialscss', RCTE_PLUGIN_URL.'slick/slick-theme.css');

            wp_enqueue_script('rcte-slick-lib', RCTE_PLUGIN_URL.'lib/slick/slick.min.js', array('jquery'), '', true);
            wp_enqueue_script('rcte-slick-init', RCTE_PLUGIN_URL.'js/slick-init.js', '', '', true);

            break;
        } //end of if
    } //end of foreach
}
add_action( 'wp', 'RCTE_ShortCodeDetect' );
