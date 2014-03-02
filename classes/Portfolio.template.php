<?php

namespace Lumiart\Template;


class Portfolio {

	/**
	 * Get portfolio title for addthis
	 *
	 * to be used when postdata are set for specific portofolio
	 */
	function get_portfolio_title( $is_projects = false ) {
		$type = ( $is_projects ) ? __('Projekty', 'WPML Theme') : 'Portfolio';
		return get_the_title() . ' &raquo; ' . $type . ' &raquo; ' . get_bloginfo('name'); //TODO: integrate with yoast
	}

	function single_portfolio_strip_link($link) {
		preg_match( '/https?:\/\/(.+?)(\/|$)/', $link, $matches );
		if( isset( $matches[1] ) ) {
			return $matches[1];
		}
		return $link;
	}

}

global $lumi_template_portfolio;
$lumi_template_portfolio = new Portfolio();

function return_Portfolio() {
	global $lumi_template_portfolio;
	return $lumi_template_portfolio;
}