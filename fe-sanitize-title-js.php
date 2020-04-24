<?php
/**
 * Plugin Name: Sanitize Title JavaScript Shortcode
 * Plugin URI: https://github.com/salcode/fe-sanitize-title-js
 * Description: Use the shortcode [sanitize-title-js] to display a code block that shows how to recreate the WordPress PHP function sanitize_title() in JavaScript.
 * Version: 1.1.1
 * Author: Sal Ferrarello
 * GitHub Plugin URI: https://github.com/salcode/fe-sanitize-title-js
 * Author URI: http://salferrarello.com/
 * Text Domain: fe-sanitize-title-js
 * Domain Path: /languages
 *
 * @package FeSanitizeTitleJS
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
add_shortcode( 'sanitize-title-js', 'fe_sanitize_title_js_shortcode' );

/**
 * Process [sanitize-title-js] shortcode and enqueue JavaScript.
 *
 * @return string HTML markup div#wp-fe-sanitize-title-js-result for targeted display.
 */
function fe_sanitize_title_js_shortcode() {
	$test_strs = array(
		'AB CD ED G',
		'AB 12 34 DE',
		'The-Beginning--and---the-end',
		'The-áZZmtéqr í ou Ó ----Ú--',
		'Trailing Space    ',
		'Trailing Dash ---',
		'Trailing Dash Space --- ',
		'523 abc GHI!*&m5^&3#e@$/',
		'Captain <strong>Awesome</strong>',
		'Spaces, -Dashes-, and other ch@racter$ are %REMOVED%!',
		'M.Brown/Beige',
		'This contains an en dash–here',
		'This contains an en dash – here',
		'This contains an en dash-– here with a keyboard dash',
		'This contains an em dash—here',
		'This contains an em dash — here',
		'This contains an em dash-—-here surrounded by keyboard dashes.',
		'Non-breaking space', // This line contains a non-breaking space.
		'HTML&nbsp;Entity&nbsp;Non-Breaking&nbsp;Space',
		'one&ndash;two&mdash;three&times;four&iexcl;five&reg;',
	);
	$test_data = array();
	foreach ( $test_strs as $test_str ) {
		$test_data[] = (object) array(
			'before_escaped' => esc_html( $test_str ),
			'before' => $test_str,
			'after'  => sanitize_title( $test_str ),
		);
	}

	// Load wpFeSanitizeTitle() JavaScript Function.
	wp_enqueue_script(
		'fe-sanitize-title-js',
		plugins_url( 'assets/wp-fe-sanitize-title.js', __FILE__ ) ,
		array(),
		'1.1.1',
		true
	);

	// Load demo code for wpFeSanitizeTitle() JavaScript Function.
	wp_enqueue_script(
		'fe-sanitize-title-demo-js',
		plugins_url( 'assets/wp-fe-sanitize-title-demo.js', __FILE__ ) ,
		array( 'fe-sanitize-title-js' ),
		'1.1.1',
		true
	);

	// Make test data available to JavaScript as feSanitizeTitleDemo.testData.
	wp_localize_script(
		'fe-sanitize-title-demo-js',
		'feSanitizeTitleDemo',
		array(
			'testData' => $test_data,
		)
	);

	$output = '';
	$output .= '<div id="wp-fe-sanitize-title-js-result"></div>';
	$output .= '<h2>Source Code for wpFeSanitizeTitle()</h2>';
	$output .= '<pre><code>' . esc_html( file_get_contents( __DIR__ . '/assets/wp-fe-sanitize-title.js' ) ) . '</code></pre>';

	return $output;
}
