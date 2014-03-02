<?php
$c = lumi_load_template( 'Contact' );
$id = $c->get_current_form_id();
/** @var array $fields */
$fields = get_field('fields', $id);
$field_type_class = array(
	'radio' => 'form_input_radio',
	'text_field' => 'form_input_text',
	'textarea' => 'form_input_text'
);
foreach( $fields as $field ) {
	if( $field['acf_fc_layout'] == 'hire_us_start' ) {
		$hire_us_hide_id = $field['hide_option_id'];
		$hire_us_show_id = $field['show_option_id'];
	}
}

?>
<?php foreach( $fields as $field ): ?>

	<?php if( $field['acf_fc_layout'] == 'text_field' || $field['acf_fc_layout'] == 'textarea' || $field['acf_fc_layout'] == 'radio' ): //if we have text field or radio ?>

		<div class="<?php echo $field_type_class[$field['acf_fc_layout']]; ?>">

			<?php if( $field['acf_fc_layout'] == 'text_field' || $field['acf_fc_layout'] == 'textarea' ): //markup for text field and textarea ?>

				<?php $required = ( $field['acf_fc_layout'] == 'text_field' && $field['required'] ) ? ' class="required" required aria-required="true"' : ''; //extra markup for required fields ?>

				<?php if( !empty( $field['label'] ) ): //if we even have label ?>

					<?php if( empty( $field['tooltip'] ) ): //if we dont have tooltip ?>

						<label for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?></label>

					<?php else: //if we do have tooltip for label ?>

						<label for="<?php echo $field['name']; ?>" class="tooltip">
							<span><?php echo $field['label']; ?></span>
							<div class="tooltip_content"><?php echo $field['tooltip']; ?></div>
						</label>

					<?php endif; //tooltip checking ?>

				<?php endif; //if we have label ?>

				<?php if( $field['acf_fc_layout'] == 'text_field' ): ?>

					<input type="<?php echo $field['html5_type']; ?>" id="<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>" placeholder="<?php echo $field['placeholder']; ?>"<?php echo $required; ?> />

				<?php elseif( $field['acf_fc_layout'] == 'textarea' ): ?>

					<textarea name="<?php echo $field['name']; ?>" id="<?php echo $field['name']; ?>" placeholder="<?php echo $field['placeholder']; ?>"></textarea>

				<?php endif; ?>

			<?php endif; //text field ?>

			<?php if( $field['acf_fc_layout'] == 'radio' ): ?>

				<?php if( !empty( $field['label'] ) ): ?>

					<?php if( empty( $field['tooltip'] ) ): ?>

						<div class="radio_label" id="<?php echo $field['name']; ?>"><?php echo $field['label']; ?></div>

					<?php else: //dont have tooltip ?>

						<div class="radio_label tooltip" id="<?php echo $field['name']; ?>">
							<span><?php echo $field['label']; ?></span>
							<div class="tooltip_content"><?php echo $field['tooltip']; ?></div>
						</div>

					<?php endif; //have tooltip ?>

				<?php endif; //if label ?>

				<?php foreach( $field['options'] as $option ): ?>

					<?php $checked = ( $option['checked'] ) ? ' checked="checked"' : ''; ?>
					<?php $labeled_by = ( !empty( $field['label'] ) ) ? ' aria-labelledby="' . $field['name'] . '"' : ''; ?>
					<?php $hire_us_hide = ( $hire_us_hide_id == $option['id'] ) ? ' data-hide-general-question' : ''; ?>
					<?php $hire_us_show = ( $hire_us_show_id == $option['id'] ) ? ' data-hide-hire-us' : ''; ?>

					<input type="radio" name="<?php echo $field['name']; ?>" id="<?php echo $option['id']; ?>" value="<?php echo esc_attr( $option['visible_name'] ); ?>"<?php echo $checked . $labeled_by . $hire_us_hide . $hire_us_show; ?> />
					<label for="<?php echo $option['id']; ?>"><?php echo $option['visible_name']; ?></label>

				<?php endforeach; //each option ?>

			<?php endif; //radio field ?>

		</div>

	<?php elseif( $field['acf_fc_layout'] == 'hire_us_start' ): //text or radio ?>

		<div class="hire_us">

	<?php elseif( $field['acf_fc_layout'] == 'hire_us_end' ): //hire us start ?>

		</div>

	<?php endif; //hire us end ?>

<?php endforeach; //fields ?>

<div class="button submit_button"><input type="submit" name="submit" value="<?php the_field('submit_button_text', $id); ?>" class="wpcf7-submit" /><div class="left_glow"></div><div class="right_glow"></div></div>