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
	$number_of_returned_posts = $posts->found_posts;
	$last_slide_id = round( $number_of_returned_posts / 2 ); // mod 2
	
	$out = '<div class="doubleslider-container">
				<div class="doubleslider-titlewrapper">
					<h4 class="doubleslider-title">Testimonials</h4>
				</div>';
	$out .= '<ul class="slides">';

    ob_start();

	$i = 1;
	$printed = 0;
	if ($posts->have_posts()) {

	    while ($posts->have_posts()) {
	        $posts->the_post();
			
			if ($i % 2 == 1) {
			$printed++;
			$out .= '<input type="radio" name="radio-btn" id="img-'.$printed.'" '.($printed == 1 ? 'checked' : '' ).' />
   					 <li class="slide-container">
   					 	<div class="slide">';
			}
   					 		
			/* slide content */
			$out .= '<div class="doubleslider-box">
				<div class="doubleslider-thumbnail">'.get_the_post_thumbnail( $post_id, 'doubleslider-img', array( 'class' => 'doubleslider-thumb' ) ).'</div>
			    <div class="doubleslider-desc">
					<h5><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h5>
				<p>'.get_the_content().'</p>
				</div>
				</div> <!-- .doubleslider-box -->';				
			
			if ( $i % 2 == 0 || $i == $number_of_returned_posts ) {	
   			$out .= '</div>
   					 	<div class="nav">
   					 		<label for="img-'.( $printed == 1 ? $last_slide_id : $printed - 1).'" class="prev">&#x2039;</label>
   					 		<label for="img-'.( $printed == $last_slide_id ? 1 : $printed + 1 ).'" class="next">&#x203a;</label>
   					 	</div>
   					 </li>';
			}

			$i++;

		} // end while loop

		// in case I have an odd number of items, I need to close li
		//if ( substr($dynamicstring, -5) != '</li>' )  $out .= '</li>';
		$out .= '<li class="nav-dots">';
		for ( $j = 1; $j <= $last_slide_id; $j++ ) {
			$out .= '<label for="img-'.$j.'" class="nav-dot" id="img-dot-'.$j.'"></label>';		
		}
		$out .= '</li>';
	    $out .= '</ul>';
		$out .= '</div> <!-- .doubleslider-container -->';

	} else {
		return; // no posts found
	}

	echo $out;

    return ob_get_clean();
}
add_shortcode( 'RCTEDoubleSlider', 'RCTE_doubleslider' );

/*
<ul class="slides">
    <input type="radio" name="radio-btn" id="img-1" checked />
    <li class="slide-container">
		<div class="slide">
			<img src="http://farm9.staticflickr.com/8072/8346734966_f9cd7d0941_z.jpg" />
        </div>
		<div class="nav">
			<label for="img-6" class="prev">&#x2039;</label>
			<label for="img-2" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-2" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8504/8365873811_d32571df3d_z.jpg" />
        </div>
		<div class="nav">
			<label for="img-1" class="prev">&#x2039;</label>
			<label for="img-3" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-3" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8068/8250438572_d1a5917072_z.jpg" />
        </div>
		<div class="nav">
			<label for="img-2" class="prev">&#x2039;</label>
			<label for="img-4" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-4" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8061/8237246833_54d8fa37f0_z.jpg" />
        </div>
		<div class="nav">
			<label for="img-3" class="prev">&#x2039;</label>
			<label for="img-5" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-5" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8055/8098750623_66292a35c0_z.jpg" />
        </div>
		<div class="nav">
			<label for="img-4" class="prev">&#x2039;</label>
			<label for="img-6" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-6" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8195/8098750703_797e102da2_z.jpg" />
        </div>
		<div class="nav">
			<label for="img-5" class="prev">&#x2039;</label>
			<label for="img-1" class="next">&#x203a;</label>
		</div>
    </li>

    <li class="nav-dots">
      <label for="img-1" class="nav-dot" id="img-dot-1"></label>
      <label for="img-2" class="nav-dot" id="img-dot-2"></label>
      <label for="img-3" class="nav-dot" id="img-dot-3"></label>
      <label for="img-4" class="nav-dot" id="img-dot-4"></label>
      <label for="img-5" class="nav-dot" id="img-dot-5"></label>
      <label for="img-6" class="nav-dot" id="img-dot-6"></label>
    </li>
</ul>
*/