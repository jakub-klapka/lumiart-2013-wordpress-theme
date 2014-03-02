<?php
/*
 * Global template for project and portfolio
 */
$o = lumi_load_template('Options');
$l = lumi_load_template('Layout');
$p = lumi_load_template('Portfolio');

global $is_projects;
$content_type = ( $is_projects ) ? 'projects' : 'portfolio';
//on ajax call return json response
global $wp_query;
if( isset( $wp_query->query_vars['json'] ) ) {
	if( !$is_projects ) {
		get_template_part( 'single-portfolio-ajax' );
	} else {
		get_template_part( 'single-projects-ajax' );
	}
	exit;
}
function lumi_load_portfolio_style() {
	wp_enqueue_style( 'portfolio' );
}
add_action( 'wp_enqueue_scripts', 'lumi_load_portfolio_style' );


?>
<?php get_header(); the_post(); ?>
<div class="main_content two_thirds">
	<article class="lumi_box" role="main">
		<?php if( !$is_projects ):
		// PORTFOLIO PART: ?>
			<h1 class="hidden"><?php _e('Portfolio', 'WPML Theme'); ?></h1>

			<div class="client_heading"><h2 class="same_as_h1 brace_it"><?php the_title(); ?></h2></div>
			<?php
			/** @var array $images */
			$images = get_field('images');
			if($images): ?>
				<ul class="client_detail_images">
					<?php foreach($images as $image): ?>
						<li>
							<div class="image_corners ratio_19_12">
								<div>
									<?php $l->responsive_image( $image['id'], 'portfolio_image' ); ?>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if( $link = get_field('link') ):
				$pre_link = $o->get_field('portfolio_pre_link', 'general_frontend');
				$pre_link = ( $pre_link ) ? $pre_link . ' ' : ''; //add space if we have prelink ?>
				<div class="center_inside"><a class="button client_link" href="<?php echo $link; ?>" target="_blank"><?php echo $pre_link . $p->single_portfolio_strip_link($link); ?><div class="left_glow"></div><div class="right_glow"></div></a></div>
			<?php endif; ?>

			<div class="client_share_buttons"><?php $l->addthis_toolbox( get_permalink() ); ?></div>

			<!-- nonsemantic stuff -->
			<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php $o->the_field( 'portfolio_detail_tag', 'general_frontend' ); ?></div><div class="bottom_tag" aria-hidden="true"><?php $o->the_field( 'portfolio_detail_tag', 'general_frontend' ); ?></div>
			<!-- /nstuff -->

		<?php else:
		//PROJECTS PART: ?>
			<h1 class="hidden"><?php _e('Projekt', 'WPML Theme'); ?></h1>

			<div class="client_heading"><h2 class="same_as_h1 brace_it"><?php the_title(); ?></h2></div>

			<?php if( $image = get_field('image') ): ?>
				<div class="image_corners ratio_19_12 project_image">
					<div>
						<?php $l->responsive_image( $image, 'projects_image' ); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php if( $link = get_field('link') ):
				$pre_link = $o->get_field('projects_pre_link', 'general_frontend');
				$pre_link = ( $pre_link ) ? $pre_link . ' ' : ''; //add space if we have prelink ?>
				<div class="center_inside"><a class="button client_link" href="<?php echo $link; ?>" target="_blank"><?php echo $pre_link . $p->single_portfolio_strip_link($link); ?><div class="left_glow"></div><div class="right_glow"></div></a></div>
			<?php endif; ?>

			<div class="client_share_buttons"><?php $l->addthis_toolbox( get_permalink() ); ?></div>

			<!-- nonsemantic stuff -->
			<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php $o->the_field( 'projects_detail_tag', 'general_frontend' ); ?></div><div class="bottom_tag" aria-hidden="true"><?php $o->the_field( 'projects_detail_tag', 'general_frontend' ); ?></div>
			<!-- /nstuff -->
		<?php endif; ?>

	</article>
	<aside class="lumi_box">

		<div class="center_inside"><a class="button back_to_portfolio" href="<?php $o->the_field( $content_type . '_link', 'general_frontend' ); ?>"><?php $o->the_field( $content_type . '_back_to_port_text', 'general_frontend' ); ?></a></div>

		<!-- nonsemantic stuff -->
		<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php $o->the_field( $content_type . '_back_to_port_tag', 'general_frontend' ); ?></div><div class="bottom_tag" aria-hidden="true"><?php $o->the_field( $content_type . '_back_to_port_tag', 'general_frontend' ); ?></div>
		<!-- /nstuff -->

	</aside>
</div>
<?php get_footer(); ?>