<?php
/*
Template name: Home
 */
$l = lumi_load_template('Layout');

function load_home_styles() {
	wp_enqueue_style('home');
	wp_enqueue_script('home');
}
add_action( 'wp_enqueue_scripts', 'load_home_styles' );
?>
<?php get_header(); ?>

<div class="main_content desktop_only_two_thirds">
	<article class="lumi_box" role="main" itemprop="mainContentOfPage">

		<?php
		$header_image_id = get_field('header_image');
		$header_heading = get_field('header_heading');
		?>

		<?php if( $header_heading || $header_image_id ): ?>
			<header class="home_header">
				<?php if( $header_image_id ): ?>
					<div class="image_corners ratio_19_12">
						<div>
							<?php $l->responsive_image($header_image_id, 'home_heading'); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if( $header_heading ): ?>
					<div class="heading_wrap"><h1><?php echo $header_heading; ?></h1></div>
				<?php endif; ?>

			</header>
		<?php endif; ?>

		<?php the_post(); the_content(); ?>

		<!-- nonsemantic stuff -->
		<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php the_field('main_content_tags'); ?></div><div class="bottom_tag" aria-hidden="true"><?php the_field('main_content_tags'); ?></div>
		<!-- /nstuff -->

	</article>
	<aside class="lumi_box">
		<?php
		$testimonials_heading = get_field('testimonials_heading');
		$testimonials = get_field('testimonials');
		?>
		<?php if($testimonials_heading): ?>
			<div class="testimonials_heading_wrap"><h1 class="brace_it"><?php echo $testimonials_heading; ?></h1></div>
		<?php endif; ?>

		<ul class="testimonials_list">
			<?php foreach( $testimonials as $item): ?>
				<li itemscope itemtype="http://schema.org/Review">
					<meta itemprop="itemReviewed" content="Lumiart.cz" />
					<?php if($item['image']): ?>
						<div class="image_corners ratio_19_8 orange">
							<div>
								<a href="<?php echo esc_url( $item['link'] ); ?>">
									<?php $l->responsive_image( $item['image'], 'home_testimonials' ); ?>
								</a>
							</div>
						</div>
					<?php endif; ?>
					<?php if( $item['name'] || $item['link'] ): ?>
						<div class="name" itemprop="author" itemscope itemtype="http://schema.org/Person">
							<?php if($item['name']): ?><span itemprop="name"><?php echo $item['name']; ?></span>, <?php endif; ?>
							<?php if($item['link']): ?><a href="<?php echo esc_url( $item['link'] ); ?>" itemprop="url"><?php echo $item['link']; ?></a><?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if($item['quote']): ?>
						<q itemprop="reviewBody"><?php echo $item['quote']; ?></q>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>

		<!-- nonsemantic stuff -->
		<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php the_field('testimonials_tags'); ?></div><div class="bottom_tag" aria-hidden="true"><?php the_field('testimonials_tags'); ?></div>
		<!-- /nstuff -->

	</aside>
</div>

<?php get_footer(); ?>