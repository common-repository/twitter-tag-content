<?php
/*
Plugin Name: Twitter Tag Content
Plugin URI: http://hughwillfayle.de/wordpress/twitter-tag-content
Description: This plugin replaces words with a leading "#" with a link to the twitter hashtag search, or to a user by giving a leading @
Author: Hugh Will Fayle
Version: 0.3
Author URI: http://hughwillfayle.de/
*/

class twitter_tag_content {
	function twitter_tag_content() {
		add_filter( 'the_content', array( &$this, 'replace_content' ) );
	}
	
	function replace_content( $content = '' ) {
		// Replacer for the hashtags
		$content = preg_replace( '/(^|\s)#(\w+)/', ' <a href="http://search.twitter.com/search?q=%23\2">#\2</a>', $content );
		
		// Replacer for the usernames
		$content = preg_replace( '/([^a-zA-Z0-9]@)([_a-zA-Z0-9]+)/i', ' <a href="http://twitter.com/$2" target="_blank">@$2</a>', $content );
		
		// Return Content
		return $content;
	}
}

function twitter_tag_content_start () { 
	new twitter_tag_content();
}
add_action('plugins_loaded', 'twitter_tag_content_start');

?>