<?php get_header(); ?>
<div class="main_content" role="main">
	<article class="lumi_box">
		<?php the_post(); the_content(); ?>

		<!-- nonsemantic stuff -->
		<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true">Content</div><div class="bottom_tag" aria-hidden="true">Content</div>
		<!-- /nstuff -->
	</article>
</div>
<?php get_footer(); ?>