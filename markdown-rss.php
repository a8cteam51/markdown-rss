<?php
/**
 * The Markdown RSS bootstrap file.
 *
 * @since       1.0.0
 * @version     1.0.0
 * @author      Automattic Special Projects
 * @license     GPL-3.0-or-later
 *
 * @noinspection    ALL
 *
 * @wordpress-plugin
 * Plugin Name:       Markdown RSS
 * Description:       Adds the element source:markdown to the RSS feed.
 * Version:           1.0.0
 * Requires at least: 6.2
 * Tested up to:      6.9
 * Requires PHP:      7.2
 * Author:            Automattic Special Projects
 * Author URI:        https://specialprojects.automattic.com/
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       markdown-rss
 * Domain Path:       /languages
 **/

defined( 'ABSPATH' ) || exit;

if ( ! is_file( __DIR__ . '/vendor/autoload.php' ) ) {
	add_action(
		'admin_notices',
		static function () {
			$message      = __( 'It seems like <strong>Markdown RSS</strong> is corrupted. Please reinstall!', 'markdown-rss' );
			$html_message = wp_sprintf( '<div class="error notice">%s</div>', wpautop( $message ) );
			echo wp_kses_post( $html_message );
		}
	);
	return;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Adds the <source:markdown> element to the RSS feed.
 *
 * @since 1.0.0
 *
 * @return void
 */
function markdown_rss_add_source_markdown_element() {
	$post = get_post();

	if ( ! $post ) {
		return;
	}

	if ( ! empty( $post->post_content ) ) {
		$content = apply_filters( 'the_content', $post->post_content ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	} else {
		return;
	}

	$content   = str_replace( ']]>', ']]&gt;', $content );
	$converter = new League\HTMLToMarkdown\HtmlConverter( array( 'strip_tags' => true ) );

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Content is wrapped in CDATA with ]]> escaped.
	echo "\t\t<source:markdown><![CDATA[" . $converter->convert( $content ) . "]]></source:markdown>\n";
}

add_action( 'rss2_item', 'markdown_rss_add_source_markdown_element' );

/**
 * Adds the source namespace to the RSS feed.
 *
 * @since 1.0.0
 *
 * @return void
 */
function markdown_rss_namespace() {
	echo 'xmlns:source="https://source.scripting.com/"';
}

add_action( 'rss2_ns', 'markdown_rss_namespace' );
