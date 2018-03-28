<?php
/*
Plugin Name: Tableau Shortcode
Description: A plugin that adds shortcode for inserting Tableau graphics.
Version: 0.1
Author: Roshan Giyanani
License: GPLv2 or later
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class TABLEAU_SHORTCODE {

    /* INTERNAL METHODS */
    public static function register_embed_handler() {
        $regex = "http://public\.tableau\.com/";
        $callback = array('TABLEAU_SHORTCODE', 'embed_handler');

        /* register tableau shortcode */
        wp_embed_register_handler( 'tableau', $regex, $callback );
        error_log("registering");
    }

    public static function unregister_embed_handler() {
        wp_embed_unregister_handler( 'tableau' );
        error_log("unregistering");
    }

    /* EMBED HANDLER METHODS */
    public static function embed_handler( $matches, $attr, $url, $rawattr ) {
        error_log("handler called");
        $embed = "<span>hello world</span>";
        return apply_filters( 'tableau', $embed, $matches, $attr, $url, $rawattr );
    }
}

function activate_tableau_shortcode() {
    error_log("activating");
    TABLEAU_SHORTCODE::register_embed_handler();
}

function deactivate_tableau_shortcode() {
    error_log("deactivating");
    TABLEAU_SHORTCODE::unregister_embed_handler();
}

register_activation_hook( __FILE__, 'activate_tableau_shortcode' );
register_deactivation_hook( __FILE__, 'deactivate_tableau_shortcode');

?>