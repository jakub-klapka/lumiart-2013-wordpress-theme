<?php
/*
Template name: O Nás
 */
$l = lumi_load_template('Layout');

function load_about_us_styles() {
	wp_enqueue_style('about_us');
	wp_enqueue_script('about_us');
}
add_action( 'wp_enqueue_scripts', 'load_about_us_styles' );

$team = get_field('team'); ?>
<?php get_header(); ?>

<div class="main_content one_half" role="main" itemprop="mainContentOfPage">
	<?php foreach( $team as $person ): ?>
		<article class="lumi_box" itemscope itemtype="http://schema.org/Person">
			<div class="center_inside team_heading"><h1 itemprop="name" class="brace_it"><?php echo $person['name']; ?></h1></div>

			<div class="image_corners team_image ratio_19_12 orange large">
				<div>
					<?php $l->responsive_image( $person['image'], 'team_image', 'itemprop="image"' ); ?>
				</div>
			</div>

			<?php if( !empty( $person['position'] ) || !empty( $person['skills'] ) || !empty( $person['email'] ) ): ?>
				<div class="person_meta">
					<?php if( !empty( $person['position'] ) ): ?><h3 itemprop="jobTitle"><?php echo $person['position']; ?></h3><?php endif; ?>
					<?php if( !empty( $person['skills'] ) || !empty( $person['email'] ) ): ?>
						<p>
							<?php if( !empty( $person['skills'] ) ): ?>
								<?php _e('Dovednosti:', 'WPML Theme'); ?> <strong><?php echo $person['skills']; ?></strong><?php if(!empty($person['email'])): ?><br/><?php endif; ?>
							<?php endif; ?>
							<?php if( !empty( $person['email'] ) ): ?>
								<?php _e('E-mail:', 'WPML Theme'); ?> <a class="email_decode" itemprop="email" href="<?php echo str_rot13( 'mailto:' . $person['email'] ); ?>"><?php echo str_rot13($person['email']); ?></a>
							<?php endif; ?>
						</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php echo $person['content']; ?>

			<?php if( $person['social_links'] ): ?>
				<div class="team_social_buttons">
					<?php foreach( $person['social_links'] as $link ): ?>
						<a class="button" href="<?php echo $link['link']; ?>" target="_blank"><?php echo $link['name']; ?><div class="left_glow"></div><div class="right_glow"></div></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<!-- nonsemantic stuff -->
			<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php the_field('content_tags'); ?></div><div class="bottom_tag" aria-hidden="true"><?php the_field('content_tags'); ?></div>
			<!-- /nstuff -->

		</article>
	<?php endforeach; ?>
</div>

<?php get_footer(); ?>