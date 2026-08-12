<?php
/**
 * Plugin Name: Breakdance Traditional Chinese (zh-TW)
 * Description: Loads the Traditional Chinese translation for the Breakdance editor. Update-safe — the language files live in mu-plugins, so Breakdance updates never overwrite them.
 * Version: 0.1.0
 * Author: MoTech
 * License: GPL-2.0-or-later
 *
 * How this works:
 *
 *  1. PHP strings (element names, control labels) are handled by WordPress
 *     itself, which reads wp-content/languages/plugins/breakdance-zh_TW.mo
 *     (and the .l10n.php on WP 7.0+). Nothing needed here.
 *
 *  2. The editor's Vue app is the problem. Breakdance hardcodes a read from
 *     languages/breakdance-{locale}.json inside its own plugin directory, so
 *     anything dropped there is destroyed on the next update. Instead we feed
 *     the JSON through Breakdance's own breakdance_i18n_json filter.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter(
	'breakdance_i18n_json',
	function ( $json ) {
		if ( ! in_array( get_user_locale(), array( 'zh_TW', 'zh-TW' ), true ) ) {
			return $json;
		}

		$file = __DIR__ . '/breakdance-zhtw/breakdance-zh_TW.json';

		if ( ! file_exists( $file ) ) {
			return $json;
		}

		$contents = file_get_contents( $file );

		// Fail closed: a malformed payload white-screens the editor, so if the
		// file is unreadable or not valid JSON, hand back the original untouched.
		if ( ! $contents || null === json_decode( $contents ) ) {
			return $json;
		}

		return $contents;
	}
);
