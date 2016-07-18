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

	$out = '<div class="">
				<div class="">
					<h4 class="">Testimonials</h4>
				</div>';
    $out .= '<div id="owl-demo" class="owl-carousel owl-theme">
          
  <div class="item"><h1>1</h1></div>
  <div class="item"><h1>2</h1></div>
  <div class="item"><h1>3</h1></div>
  <div class="item"><h1>4</h1></div>
  <div class="item"><h1>5</h1></div>
  <div class="item"><h1>6</h1></div>
  <div class="item"><h1>7</h1></div>
  <div class="item"><h1>8</h1></div>
  <div class="item"><h1>9</h1></div>
  <div class="item"><h1>10</h1></div>
  <div class="item"><h1>11</h1></div>
  <div class="item"><h1>12</h1></div>
 
</div>
<style>
#owl-demo .item{
  background: #42bdc2;
  padding: 30px 0px;
  margin: 10px;
  color: #FFF;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  text-align: center;
}
</style>
';
	$out .= '<div id="owl-demo" class="owl-demo">';

    ob_start();

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
 
  jQuery("#owl-demo").owlCarousel({
    navigation : true
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
