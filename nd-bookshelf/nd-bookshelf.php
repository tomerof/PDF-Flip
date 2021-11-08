<?php
/**
* Plugin Name:     Bokshelf
* Plugin URI:      https://www.netdesign.media/bookshelf
* Description:     add books to the bookshelf page
* Author:          Tomer Ofer
* Author URI:      https://www.netdesign.media
* Text Domain:     nd-dm
* Domain Path:     /languages
* Version:         0.0.1
*
*/

namespace Netdesign;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Bookshelf {

    public function __construct(){

        add_action('wp_enqueue_scripts', [$this, 'register_scripts_and_styles']);
        add_shortcode('bookshelf', [$this, 'bookshelf_shortcode']);

        //add_action('wp_ajax_nopriv_');

        add_action('init', [$this, 'rewrite_rule']);
        add_action('query_vars',[$this,'controller_set_query_var']);
        add_filter('template_include', [$this,'include_controller']);

        add_action('init', [$this, 'register_post_types']);
    }

    public function register_scripts_and_styles(){
        $pluginPath = plugin_dir_url(__FILE__);
        $cssPath = "{$pluginPath}/assets/css";
        $commentsListCss = "{$cssPath}/comments-list.css";
        //wp_register_style('comments-list-style', $commentsListCss);
    }

    public function bookshelf_shortcode(){

        ob_start();
        return ob_get_clean();
    }

    public function rewrite_rule(){
        add_rewrite_rule('^bookshelf','index.php?bookshelf=1','top');
    }

    public function controller_set_query_var($vars) {
        array_push($vars, 'bookshelf');
        return $vars;
    }

    public function include_controller($template){
        if(get_query_var('bookshelf')){
            $template = __DIR__.'/index.php';
        }
        return $template;
    }

    function register_post_types() {

        register_post_type('book', [
            'labels'              => [
                'name'          => 'Books', // Plural name
                'singular_name' => 'Book'   // Singular name
            ],
            'description'         => 'Books for bookshelf', // Description
            'supports'            => ['title', 'thumbnail', 'excerpt'],
            'public'              => false,  // Makes the post type public
            'show_ui'             => true,  // Displays an interface for this post type
            'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel)
            'show_in_nav_menus'   => false,  // Displays in Appearance -> Menus
            'show_in_admin_bar'   => true,  // Displays in the black admin bar
            'menu_position'       => 5,     // The position number in the left menu
            'can_export'          => true,  // Allows content export using Tools -> Export
            'has_archive'         => false,  // Enables post type archive (by month, date, or year)
            'exclude_from_search' => true, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
            'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true
            'capability_type'     => 'post' // Allows read, edit, delete like “Post”
        ]); //Create a post type with the slug is ‘book’ and arguments in $args.
    }

}

new Bookshelf();
