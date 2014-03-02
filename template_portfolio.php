<?php
/*
Template name: Portfolio/Projects
Common template for portfolio and projects list, they are similar enough
 */
$o = lumi_load_template('Options');
$l = lumi_load_template('Layout');
$p = lumi_load_template('Portfolio');

$content_type = get_field('content_type'); //portfolio or projects

define("ADDTHIS_XMLNS", true);
function load_portfolio_script_styles() {
	wp_enqueue_style('portfolio');

	global $content_type;
	if( $content_type === 'portfolio' ) {
		wp_enqueue_script('portfolio');
	} else {
		wp_enqueue_script('projects');
	}
}
add_action( 'wp_enqueue_scripts', 'load_portfolio_script_styles' );

$portfolio_permalink = get_permalink();

$portfolio_posts = new WP_Query(array(
	'post_type' => $content_type,
	'nopaging' => true,
	'order' => 'ASC',
	'orderby' => 'menu_order'
));
?>

<?php get_header(); the_post();?>

<div class="main_content two_thirds" role="main">
	<article class="lumi_box portfolio_content" itemprop="maincontentofpage">
		<?php if( $content_type === 'portfolio' ):
		// PORFOLIO ARTICLE: ?>
			<h1 class="hidden"><?php the_title(); ?></h1>

			<div class="portfolio_client_content" data-hb-template-name="portfolio_hb_template" itemscope itemtype="http://schema.org/WebPage">
				<?php
				setup_postdata( $GLOBALS['post'] =& $portfolio_posts->post );
				?>
				<div class="client_heading"><h2 class="same_as_h1 brace_it" itemprop="name"><?php the_title(); ?></h2></div>

				<?php if($images = get_field( 'images' ) ): ?>
					<ul class="client_detail_images" itemprop="thumbnailUrl" itemscope itemtype="http://schema.org/ImageGallery">
						<?php foreach($images as $image): ?>
							<li itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
								<div class="image_corners ratio_19_12">
									<div>
										<?php $l->responsive_image( $image['id'], 'portfolio_image', 'itemprop="image"' ); ?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if( $link = get_field('link') ):
					$pre_link = $o->get_field('portfolio_pre_link', 'general_frontend');
					$pre_link = ( $pre_link ) ? $pre_link . ' ' : ''; //add space if we have prelink ?>
					<div class="center_inside client_link"><a class="button" href="<?php echo $link; ?>" target="_blank" itemprop="url"><?php echo $pre_link . $p->single_portfolio_strip_link($link); ?><div class="left_glow"></div><div class="right_glow"></div></a></div>
				<?php endif; ?>

				<div class="client_share_buttons"><?php $l->addthis_toolbox( $portfolio_permalink . '#' . $GLOBALS['post']->post_name, $p->get_portfolio_title() ); ?></div>


			</div>

			<div class="article_active_indicator" aria-hidden="true"></div>

			<!-- nonsemantic stuff -->
			<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php $o->the_field( 'portfolio_detail_tag', 'general_frontend' ); ?></div><div class="bottom_tag" aria-hidden="true"><?php $o->the_field( 'portfolio_detail_tag', 'general_frontend' ); ?></div>
			<!-- /nstuff -->

			<?php wp_reset_postdata(); ?>

		<?php else:
		// PROJECTS ARTICLE PART: ?>

			<h1 class="hidden"><?php the_title(); ?></h1>

			<div class="portfolio_client_content" data-hb-template-name="projects_hb_template" itemscope itemtype="http://schema.org/WebPage">
				<?php
				setup_postdata( $GLOBALS['post'] =& $portfolio_posts->post );
				?>
				<div class="client_heading"><h2 class="same_as_h1 brace_it" itemprop="name"><?php the_title(); ?></h2></div>

				<?php if( $image = get_field('image') ): ?>
					<div class="image_corners ratio_19_12 project_image">
						<div>
							<?php $l->responsive_image( $image, 'projects_image', 'itemprop="image"' ); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php the_content(); ?>

				<?php if( $link = get_field('link') ):
					$pre_link = $o->get_field('projects_pre_link', 'general_frontend');
					$pre_link = ( $pre_link ) ? $pre_link . ' ' : ''; //add space if we have prelink ?>
					<div class="center_inside client_link"><a class="button" href="<?php echo $link; ?>" target="_blank" itemprop="url"><?php echo $pre_link . $p->single_portfolio_strip_link($link); ?><div class="left_glow"></div><div class="right_glow"></div></a></div>
				<?php endif; ?>

				<div class="client_share_buttons"><?php $l->addthis_toolbox( $portfolio_permalink . '#' . $GLOBALS['post']->post_name, $p->get_portfolio_title(true) ); ?></div>

			</div>

			<div class="article_active_indicator" aria-hidden="true"></div>

			<!-- nonsemantic stuff -->
			<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php $o->the_field( 'projects_detail_tag', 'general_frontend' ); ?></div><div class="bottom_tag" aria-hidden="true"><?php $o->the_field( 'projects_detail_tag', 'general_frontend' ); ?></div>
			<!-- /nstuff -->

		<?php endif; ?>

	</article>

	<aside class="lumi_box">
		<?php $posts_per_page = 3; ?>
		<ul class="portfolio_list" role="navigation"><?php $i = 0; ?>
			<?php while( $portfolio_posts->have_posts() ): ?>
				<?php
					$i++;
					$portfolio_posts->the_post();
					setup_postdata( $GLOBALS['post'] =& $portfolio_posts->post );
					$classes = array();
					if( $i == 1 ) { $classes[] = 'active'; }
					if( $i <= $posts_per_page ) { $classes[] = 'visible'; }
					$class = implode( ' ', $classes );
				?>
				<li class="<?php echo $class; ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<meta itemprop="name" content="<?php the_title(); ?>"/>
					<a class="image_corners hover ratio_19_8 portfolio_list_image" href="<?php the_permalink(); ?>" data-slug="<?php echo $GLOBALS['post']->post_name; ?>" itemprop="url">
						<div>
							<div class="img">
								<?php $l->responsive_image( get_field( 'logo' ), 'portfolio_logo', 'itemprop="image"' ); ?>
							</div>
						</div>
						<?php $l->hover_images_svg(); ?>
						<span class="preloader" aria-hidden="true"></span>
					</a>
				</li>
				<?php wp_reset_postdata(); ?>
			<?php endwhile; ?>
		</ul>

		<?php if( count( $portfolio_posts->posts ) > $posts_per_page ): ?>
			<?php
				$pages = ceil( count( $portfolio_posts->posts ) / $posts_per_page );
			?>
			<div class="portfolio_list_pagination">
				<button class="button prev">&lt;<div class="left_glow"></div><div class="right_glow"></div></button>
				<div class="page"><span class="current">1</span>&nbsp;/&nbsp;<?php echo $pages; ?></div>
				<button class="button next">&gt;<div class="left_glow"></div><div class="right_glow"></div></button>
			</div>
		<?php endif; ?>

		<div class="portfolio_list_indicator"><div class="connect_link"></div></div>

		<!-- nonsemantic stuff -->
		<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php $o->the_field( $content_type . '_navigation_tag', 'general_frontend' ); ?></div><div class="bottom_tag" aria-hidden="true"><?php $o->the_field( $content_type . '_navigation_tag', 'general_frontend' ); ?></div>
		<!-- /nstuff -->

	</aside>
</div>
<?php get_footer(); ?>