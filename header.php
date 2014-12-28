<?php $l = lumi_load_template( 'Layout' ); $o = lumi_load_template('Options') ?>
<!doctype html>
<html <?php language_attributes(); ?><?php if( defined( 'ADDTHIS_XMLNS' ) ): ?> xmlns:addthis="http://www.addthis.com/help/api-spec"<?php endif; ?> itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title(); ?></title>

	<script type="text/javascript">
		window.root_url = '<?php bloginfo('template_url'); ?>/';
	</script>

	<script type="text/javascript">
		function loadCSS(e,t,n){"use strict";var i=window.document.createElement("link");var o=t||window.document.getElementsByTagName("script")[0];i.rel="stylesheet";i.href=e;i.media="only x";o.parentNode.insertBefore(i,o);setTimeout(function(){i.media=n||"all"})}
	</script>

	<!-- Cricital CSS -->

	<?php $l->critical_css(); ?>

	<!-- /Cricital CSS -->

	<?php wp_head(); ?>

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-196x196.png" sizes="196x196">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-16x16.png" sizes="16x16">
	<meta name="msapplication-TileColor" content="#001218">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-144x144.png">
	<meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-70x70.png">
	<meta name="msapplication-square144x144logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-144x144.png">
	<meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-150x150.png">
	<meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-310x310.png">
	<meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-310x150.png">

</head>

<body>

<div class="page_wrap">
	<header class="main_header lumi_box" role="banner">
		<a href="<?php bloginfo('url'); ?>" class="logo"><span>LUMIART</span></a>
		<button class="open_menu button" aria-controls="menu" aria-hidden="true" role="button" aria-pressed="false">
			<span><?php _e('Otevřít menu', 'WPML theme'); ?></span>
			<i class="icon icon_open_menu"></i>
			<div class="left_glow"></div><div class="right_glow"></div>
		</button>
		<div class="addthis_toolbox share">
			<a class="addthis_button_expanded button"><?php _e('Sdílet', 'WPML theme'); ?>
				<i class="icon icon_share"></i>
				<div class="left_glow"></div><div class="right_glow"></div>
			</a>
		</div>
		<a href="<?php echo $l->lm_language_switch_anchor(); ?>" class="languages button">
			<span<?php if( ICL_LANGUAGE_CODE == 'cs' ) { echo ' class="active"'; }; ?>>CZ</span>&nbsp;&nbsp;/&nbsp;&nbsp;<span<?php if( ICL_LANGUAGE_CODE == 'en' ) { echo ' class="active"'; }; ?>>EN</span>
			<div class="left_glow"></div><div class="right_glow"></div>
		</a>
		<nav class="main_menu" id="menu">
			<h3 class="hidden" aria-hidden="false"><?php _e('Menu', 'WPML theme'); ?></h3>

			<?php $l->lumi_display_main_menu(); ?>

			<!-- nonsemantic stuff -->
			<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php _e('Menu', 'WPML theme'); ?></div><div class="bottom_tag" aria-hidden="true"><?php _e('Menu', 'WPML theme'); ?></div>
			<!-- /nstuff -->
		</nav>

		<!-- nonsemantic stuff -->
		<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php $o->the_field( 'header_tag', 'general_frontend' ); ?></div><div class="bottom_tag" aria-hidden="true"><?php $o->the_field( 'header_tag', 'general_frontend' ); ?></div>
		<!-- /nstuff -->
	</header>