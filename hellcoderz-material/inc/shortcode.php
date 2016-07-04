<?php
function mbtn( $attr ) {

	$shortcode_atts = shortcode_atts ( array(
			'class' => '',
			'link' => '',
			'text' => 'Button',
			'icon' => '',
			), $attr);

	extract($shortcode_atts);

	$btn = (empty($link))? '<button role="button"' : '<a href="'. esc_url( $link ) . '"';

	$btn .= (empty($class))? 'class="btn">' : 'class="'. $class . '">';

	$btn .= (empty($icon))? '' : '<i class="'. $icon . '"></i> ';

	$btn .= (empty($text))? '' :  $text ;

	$btn .= (empty($link))? '</button>' :  '</a>' ;

	return $btn;

}

add_shortcode("mbtn", "mbtn");