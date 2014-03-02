<?php
/*
Template name: Kontakt

Notes:
in WCF7 use class 'required' for required inputs, to have onblur validation
 */
//global $lumi_classes_path;
//require $lumi_classes_path . 'Contact.template.php';

$c = lumi_load_template( 'Contact' );

//change to ajax loader have to be in functions for early execution

?>
<?php get_header(); ?>
<div class="main_content" role="main">
	<article class="lumi_box">
		<div class="center_inside"><h1 class="brace_it"><?php the_field('main_heading'); ?></h1></div>
		<?php the_post(); ?>

		<?php $c->output_form(); ?>

		<!-- nonsemantic stuff -->
		<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php the_field('content_block_tag'); ?></div><div class="bottom_tag" aria-hidden="true"><?php the_field('content_block_tag'); ?></div>
		<!-- /nstuff -->
	</article>
</div>
<?php get_footer(); ?>