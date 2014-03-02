<?php

namespace Lumiart\Template;


class Options {

	/**
	 * Hardcoded ID's, which won't change, so there would be extra db query for no reason
	 * @return array
	 */
	private function set_options_aliases() {
		switch( ICL_LANGUAGE_CODE ) {
			case 'cs':
				$options_aliases = array(
					'general_frontend' => 9
				);
				break;
			case 'en':
				$options_aliases = array(
					'general_frontend' => 16
				);
				break;
		};
		return $options_aliases;
	}

	/**
	 * @param $field_name
	 * @param string $options_alias
	 * @return mixed
	 */
	public function get_field( $field_name, $options_alias = 'general_frontend')
	{
		$options_aliases = $this->set_options_aliases();
		$id_to_fetch = $options_aliases[$options_alias];
		return get_field( $field_name, $id_to_fetch );
	}

	public function the_field($field_name, $options_alias = 'general_frontend')
	{
		echo $this->get_field( $field_name, $options_alias );
	}

}

global $lumi_template_options;
$lumi_template_options = new Options();

function return_Options() {
	global $lumi_template_options;
	return $lumi_template_options;
}