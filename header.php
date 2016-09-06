<?php
/**
 * The Header for our theme.
 */
?>
<!doctype html>
<html class="no-js" lang="en-US">
	<head prefix="og:http://ogp.me/ns# fb:http://ogp.me/ns/fb#">
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="format-detection" content="telephone=no">

		<link rel="canonical" href="<?php bloginfo('url'); ?>" />

		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<!-- Place favicon.ico in the root directory -->

		<script src="<?php echo get_template_directory_uri(); ?>/js/detectors/modernizr-2.8.3.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/detectors/detectizr.min.js"></script>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!--[if lt IE 10]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
