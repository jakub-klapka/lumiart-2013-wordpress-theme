<?php $o = lumi_load_template( 'Options' ); ?>
	<footer class="main_footer lumi_box" role="contentinfo">
		<div class="copyright">&copy;<?php echo date_format( date_create(), 'Y' ); ?> Lumiart.cz</div>
		<div class="buttons">
			<?php $buttons = $o->get_field('footer_buttons', 'general_frontend'); ?>
			<?php foreach( $buttons as $button ): ?>
				<a class="button <?php echo esc_attr( $button['icon'] ); ?>" href="<?php echo esc_url( $button['link'] ); ?>">
					<span><?php echo $button['text']; ?></span>
					<i class="icon icon_<?php echo esc_attr( $button['icon'] ); ?>"></i>
					<div class="left_glow"></div><div class="right_glow"></div>
				</a>
			<?php endforeach; ?>
			<button class="button back_to_top" role="button">
				<span><?php _e('Zpět nahoru', 'WPML theme'); ?></span>
				<i class="icon icon_back_to_top"></i>
				<div class="left_glow"></div><div class="right_glow"></div>
			</button>
		</div>

		<!-- nonsemantic stuff -->
		<div class="left_corners" aria-hidden="true"></div><div class="right_corners" aria-hidden="true"></div><div class="top_tag" aria-hidden="true"><?php $o->the_field( 'footer_tag', 'general_frontend' ); ?></div><div class="bottom_tag" aria-hidden="true"><?php $o->the_field( 'footer_tag', 'general_frontend' ); ?></div>
		<!-- /nstuff -->
	</footer>

</div>

<?php wp_footer(); ?>
</body>
</html>