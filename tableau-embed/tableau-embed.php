<?php
/*
Plugin Name: Tableau Embed
Description: A plugin that adds oEmbed support for Tableau graphics.
Version: 0.1
Author: Roshan Giyanani
License: GPLv2 or later
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class TABLEAU_EMBED {

    private static $enabled = FALSE;
    private static $regex = "http://public.tableau.com/";
    private static $callback = array('TABLEAU_EMBED', 'embed_handler');

    /* Plugin Management Functions */
    public static function start() {
        register_uninstall_hook( __FILE__, array(__CLASS__, 'on_delete') );
        self::register_embed_handler();
    }
    
    public static function on_delete() {
        self::unregister_embed_handler();
    }

    /* INTERNAL METHODS */
    private static function register_embed_handler() {
        wp_embed_register_handler( 'tableau', self::$regex, self::$callback );
        error_log("registering");
    }

    private static function unregister_embed_handler() {
        wp_embed_unregister_handler( 'tableau' );
        error_log("unregistering");
    }

    /* EMBED HANDLER METHODS */
    private static function embed_handler( $matches, $attr, $url, $rawattr ) {
        error_log("handler called");
        $embed = "<span>hello world</span>";
        return apply_filters( 'tableau', $embed, $matches, $attr, $url, $rawattr );
    }
}

TABLEAU_EMBED::start();

?>