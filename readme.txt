=== Markdown RSS ===
Contributors: wpspecialprojects, cagrimmett, fmfernandes
Tags: rss
Requires at least: 6.2
Tested up to: 6.9
Stable tag: 1.0.0
Requires PHP: 7.2
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Adds the source:markdown element to WordPress' RSS feeds.

== Description ==

This WordPress plugin adds a new element, `<source:markdown>` to your WordPress RSS feeds. This is useful for feed readers that support that format as well as AI agents to understand your content.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/markdown-rss` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.

== Instructions ==

To use this plugin, you must first add the Query Loop block into your post content, then add the Pagination block inside the Query Loop. When working with the Pagination block, you will see new options to enable load more on the block.
The load more option allows you to set a loading text parameter and also the button text. The load more button works with the alignment options and arrow options of the pagination block.
Here is how to enable the load more option:

1. Add the Query Loop block to your post content.
2. Inside the Query Loop block, add the Pagination block.
3. In the Pagination block settings, enable the "Load More" option.
4. Set the loading text parameter and the button text.
5. Customize the alignment and arrow options if desired.

That's it! Your visitors can now load more posts by clicking the load more button without refreshing the page.

== Changelog ==

= 1.0.0 =
Initial release.
