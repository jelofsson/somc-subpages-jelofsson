<?php

/**
 * The core file of the plugin, defines our Plugin_Widget class.
 *
 * A class definition that includes attributes and functions used across 
 * both the public-facing side of the site and the admin area.
 *
 * @link       https://github.com/jelofsson
 * @package    WordPress
 * @subpackage Component
 * @since      1.0.0
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 */

/**
 * Plugin_Widget class, extends WP_Widget.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 */
class Plugin_Widget extends WP_Widget
{
    
	/**
	 * The current version of the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $version    The current version of the plugin.
	 */
	protected $_version;
    
    /**
	 * The name of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $name    The string used to name this plugin.
	 */
	public $name;
    
    /**
	 * The string used to uniquely identify this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $identifier    The unique identifier of this plugin.
	 */
	protected $_identifier;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout 
     * the plugin. Load the dependencies, define the locale, and set the hooks
     * for the admin area and the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
    public function __construct() 
    {
        $this->_version    = '1.0.0';
        $this->name        = 'SOMC Subpages';
        $this->_identifier = urlencode($this->name);
        
        // instantiate the parent object
        parent::WP_Widget(false, $name = __(
            $this->name,
            $this->_identifier
        ));
        
        $this->_define_widget_hooks();
        $this->_define_widget_filters();
	}

	/**
     * Create the widget form in the administration
     * 
     * @since 1.0.0
     * @param array $instance
     */
	public function form($instance) 
    {	
        // check value
        $number = ($instance) ? esc_attr($instance['number']) : 5;
        
        // output the form
        include( plugin_dir_path( __FILE__ ) . 'includes/templates/form.php');
	}

	/**
     * Save widget data during edition
     *
     * @since 1.0.0
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
	public function update($new_instance, $old_instance) 
    {
        // get old instance
		$instance = $old_instance;
        
        // set instance value
        $instance['number'] = strip_tags($new_instance['number']);

        return $instance;
	}

	/**
     * Display the widget content on the front-end
     *
     * @since 1.0.0
     * @param array $args
     * @param array $instance
     */
	public function widget($args, $instance) 
    {
        extract($args);
        
        // set up the objects needed
        $post_id = get_the_ID();
        $wp_query = new WP_Query();
        $pages_and_posts_types = $wp_query->query(array('post_type' => array('page','post')));
        
        // filter through all pages and find the page children's
        $array_subpages = get_page_children( $post_id, $pages_and_posts_types );
        
        echo $before_widget;
        
        // output our widget
        if ( 0 < count($array_subpages) ) {
            $this->_output_subpages_of_post($post_id, $array_subpages);
            
            // enqueue scripts needed for the widget to work properly
            wp_enqueue_script( 'jquery', plugin_dir_url( __FILE__ ) . '../thirdparty/jquery-1.11.3.min.js', array(), '1.11.3', true );
            wp_enqueue_script( $this->_identifier.'-subpages', plugin_dir_url( __FILE__ ) . '../static/js/subpages.js', array('jquery'), $this->_version, true );
            wp_enqueue_style( $this->_identifier.'-subpages', plugin_dir_url( __FILE__ ) . '../static/css/subpages.css', array(), $this->_version, 'all' ); 
            
        }
        
        echo $after_widget;
	}
    
    /**
     * Outputs a sortable list of subpages
     * 
     * @param integer $post_id        id of post
     * @param array   $array_subpages array of all available subpages
     */
    private function _output_subpages_of_post($post_id, $array_subpages)
    {
        
        // since we are using setup_postdata() on WP_Post objects 
        // we need to reference to the global $post variable, otherwise 
        // functions like the_title() don't work properly. 
        global $post;
        
        $first_children = $this->_first_children_of_post( $post_id, $array_subpages );

        include( plugin_dir_path( __FILE__ ) . 
                    '../templates/section-list-subpages-header.php' );
        
        // output our array of child posts, as an sortable list
        foreach($first_children as $post)
        {
            setup_postdata( $post );
            
            echo '<li>';
            
            include( plugin_dir_path( __FILE__ ) . 
                    '../templates/section-list-subpages-item.php' );
            
            // if the child has its own children, we output them as an sortable list aswell
            if ( $this->_has_children( $post->ID, $array_subpages ) ) {
                $this->_output_subpages_of_post( $post->ID, $array_subpages );
            }
            
            echo '</li>';
        }
        
        include( plugin_dir_path( __FILE__ ) . 
                    '../templates/section-list-subpages-footer.php' );
    }
    
    /**
     * Check if post has children in array_subpages
     * 
     * @param  integer $post_id        id of post
     * @param  array   $array_subpages array of subpages
     * @return boolean
     */
    private function _has_children($post_id, $array_subpages)
    {
        return count( $this->_first_children_of_post( $post_id, $array_subpages ) ) ? true: false;
    }
    
    /**
     * Return only subpages one level below the post_id
     * 
     * @param  integer $post_id        id of post
     * @param  array   $array_subpages array of subpages
     * @return array   array of subpages
     */
    private function _first_children_of_post($post_id, $array_subpages)
    {
        return array_filter($array_subpages, function($subpage) use ($post_id) {
            return ( $post_id == $subpage->post_parent ) ? true : false;
        });
    }
    
    /**
     * Register our widget on WordPress widgets_init
     *
     * This function creates a hook so that WordPress can recognize our widget.
     *
     * @since  1.0.0
     * @access private
     */
    private function _define_widget_hooks()
    {
        add_action( 'widgets_init' , function () {
            register_widget( __CLASS__ );
        });

    }
    
    /**
     * Register filters used by our plugin
     * 
     * @since  1.0.0
     * @access private
     */
    private function _define_widget_filters()
    {
        // Truncate our title to 20 characters.
        add_filter( 'the_title', array( Helper_Text, 'Truncate' ) );
    }
}