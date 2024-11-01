<?php
/*
Plugin Name: Share Buttons
Plugin URI: 
Description: Responsive social share buttons Contact me on Juliansentine@yahoo.com if you need help.
Author: wpcdeveloper
Author URI:
Version: 1.3
*/

/* 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Admin Menu Item
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(!class_exists('wssbs_Class'))
{
    class wssbs_Class
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
			add_action('admin_init', array(&$this, 'wssbs_admin_init'));
			add_action('admin_menu', array(&$this, 'wssbs_sidebar_menu'));
        } // END public function __construct
		
		/**
		 * hook into WP's admin_init action hook
		 */
		public function wssbs_admin_init()
		{
			// Set up the settings for this plugin
			$this->wssbs_sidebar_init();
			// Possibly do additional admin_init tasks
		} // END public static function activate
        /**
		 * Initialize some custom settings
		 */     
		public  function wssbs_sidebar_init()
		{
			// register the settings for this plugin
			register_setting('wssbs_sidebar_options','wssbs_active');
			register_setting('wssbs_sidebar_options','wssbs_position');
			register_setting('wssbs_sidebar_options','wssbs_btn_position');
			register_setting('wssbs_sidebar_options','wssbs_btn_text');
			register_setting('wssbs_sidebar_options','wssbs_fb_image');
			register_setting('wssbs_sidebar_options','wssbs_tw_image');
			register_setting('wssbs_sidebar_options','wssbs_li_image');	
			register_setting('wssbs_sidebar_options','wssbs_re_image');	
			register_setting('wssbs_sidebar_options','wssbs_st_image');	
			register_setting('wssbs_sidebar_options','wssbs_mail_image');	
			register_setting('wssbs_sidebar_options','wssbs_gp_image');	
			register_setting('wssbs_sidebar_options','wssbs_pin_image');
			register_setting('wssbs_sidebar_options','wssbs_yt_image');	
			register_setting('wssbs_sidebar_options','wssbs_fb_bg');
			register_setting('wssbs_sidebar_options','wssbs_tw_bg');
			register_setting('wssbs_sidebar_options','wssbs_li_bg');	
			register_setting('wssbs_sidebar_options','wssbs_mail_bg');	
			register_setting('wssbs_sidebar_options','wssbs_gp_bg');	
			register_setting('wssbs_sidebar_options','wssbs_pin_bg');	
			register_setting('wssbs_sidebar_options','wssbs_re_bg');	
			register_setting('wssbs_sidebar_options','wssbs_st_bg');
			register_setting('wssbs_sidebar_options','wssbs_yt_bg');	
			register_setting('wssbs_sidebar_options','wssbs_fpublishBtn');	
			register_setting('wssbs_sidebar_options','wssbs_tpublishBtn');	
			register_setting('wssbs_sidebar_options','wssbs_gpublishBtn');	
			register_setting('wssbs_sidebar_options','wssbs_ppublishBtn');	
			register_setting('wssbs_sidebar_options','wssbs_ytpublishBtn');
			register_setting('wssbs_sidebar_options','wssbs_republishBtn');
			register_setting('wssbs_sidebar_options','wssbs_stpublishBtn');	
			register_setting('wssbs_sidebar_options','wssbs_ytPath');	
			register_setting('wssbs_sidebar_options','wssbs_lpublishBtn');	
			register_setting('wssbs_sidebar_options','wssbs_mpublishBtn');	
			register_setting('wssbs_sidebar_options','wssbs_mailMessage');
			register_setting('wssbs_sidebar_options','wssbs_top_margin');
			register_setting('wssbs_sidebar_options','wssbs_delayTimeBtn');
			register_setting('wssbs_sidebar_options','wssbs_btn_display');
			/** Image Alt */
			register_setting('wssbs_sidebar_options','wssbs_fb_title');
			register_setting('wssbs_sidebar_options','wssbs_tw_title');
			register_setting('wssbs_sidebar_options','wssbs_li_title');
			register_setting('wssbs_sidebar_options','wssbs_pin_title');
			register_setting('wssbs_sidebar_options','wssbs_gp_title');
			register_setting('wssbs_sidebar_options','wssbs_mail_title');
			register_setting('wssbs_sidebar_options','wssbs_yt_title');
			register_setting('wssbs_sidebar_options','wssbs_re_title');
			register_setting('wssbs_sidebar_options','wssbs_st_title');
			register_setting('wssbs_sidebar_options','wssbs_page_fb_title');
			register_setting('wssbs_sidebar_options','wssbs_page_tw_title');
			register_setting('wssbs_sidebar_options','wssbs_page_li_title');
			register_setting('wssbs_sidebar_options','wssbs_page_pin_title');
			register_setting('wssbs_sidebar_options','wssbs_page_gp_title');
			register_setting('wssbs_sidebar_options','wssbs_page_mail_title');
			register_setting('wssbs_sidebar_options','wssbs_page_yt_title');
			register_setting('wssbs_sidebar_options','wssbs_page_re_title');
			register_setting('wssbs_sidebar_options','wssbs_page_st_title');
			register_setting('wssbs_sidebar_options','wssbs_auto_hide');
			//Options for post/pages
			register_setting('wssbs_sidebar_options','wssbs_buttons_active');
			register_setting('wssbs_sidebar_options','wssbs_page_hide_home');
			register_setting('wssbs_sidebar_options','wssbs_page_hide_post');
			register_setting('wssbs_sidebar_options','wssbs_page_hide_page');
			register_setting('wssbs_sidebar_options','wssbs_page_hide_archive');
			register_setting('wssbs_sidebar_options','wssbs_hide_home');
			register_setting('wssbs_sidebar_options','wssbs_page_fb_image');
			register_setting('wssbs_sidebar_options','wssbs_page_tw_image');
			register_setting('wssbs_sidebar_options','wssbs_page_li_image');	
			register_setting('wssbs_sidebar_options','wssbs_page_mail_image');	
			register_setting('wssbs_sidebar_options','wssbs_page_gp_image');	
			register_setting('wssbs_sidebar_options','wssbs_page_pin_image');
			register_setting('wssbs_sidebar_options','wssbs_page_re_image');
			register_setting('wssbs_sidebar_options','wssbs_page_st_image');
			register_setting('wssbs_sidebar_options','wssbs_page_yt_image');
			/** message content */	
			register_setting('wssbs_sidebar_options','wssbs_show_btn');	
			register_setting('wssbs_sidebar_options','wssbs_hide_btn');	
			register_setting('wssbs_sidebar_options','wssbs_share_msg');
			register_setting('wssbs_sidebar_options','wssbs_rmSHBtn');	
			register_setting('wssbs_sidebar_options','wssbs_featuredshrimg');	
			register_setting('wssbs_sidebar_options','wssbs_defaultfeaturedshrimg');
			register_setting('wssbs_sidebar_options','wssbs_deactive_for_mob');
		} // END public function init_custom_settings()
		/**
		 * add a menu
		 */     
		public function wssbs_sidebar_menu()
		{
			add_options_page('Social Share Buttons','Social Share Buttons','manage_options','wssbs-settings',array(&$this,'wssbs_sidebar_admin_option_page'));

		} // END public function add_menu()

		public function wssbs_sidebar_admin_option_page()
				{
					if(!current_user_can('manage_options'))
					{
						wp_die(__('You do not have sufficient permissions to access this page.'));
					}

					// Render the settings template
					include(sprintf("%s/lib/settings.php", dirname(__FILE__)));
					/** 
					 * REGISTER SCRIPT
					 * */
					 wp_enqueue_script('media-upload');
					 wp_enqueue_script('thickbox');
					 wp_register_script('wssbs-image-upload', plugins_url('/js/wssbs.js',__FILE__ ), array('jquery','media-upload','thickbox','wp-color-picker'));
					 wp_enqueue_script('wssbs-image-upload');
					/** 
					 * REGISTER STYLE
					 * */
					wp_register_style( 'wssbs_admin_style', plugins_url( 'css/admin-wssbs.css',__FILE__ ) );
					wp_enqueue_style( 'wssbs_admin_style' );
					wp_enqueue_style( 'wp-color-picker' ); 
					wp_enqueue_style('thickbox');

			 }// END public static function wssbs_sidebar_admin_option_page
        /**
		 * hook into WP's plugin_action_links_ action hook
		 */
      public static function wssbs_add_settings_link( $links ) {
            $settings_link = '<a href="options-general.php?page=wssbs-settings">' . __( 'Settings', 'wssbs' ) . '</a>';
            array_unshift( $links, $settings_link );
            return $links;
        }
        /**
         * uninstall the plugin
         */
        public function wssbs_uninstall()
        {
			delete_option('wssbs_active');
			delete_option('csbbuttons_active');
			delete_option('wssbs_position');
			delete_option('wssbs_btn_position');
			delete_option('wssbs_btn_text');
			delete_option('wssbs_fb_image');
			delete_option('wssbs_tw_image');
			delete_option('wssbs_li_image');
			delete_option('wssbs_re_image');
			delete_option('wssbs_st_image');
			delete_option('wssbs_mail_image');
			delete_option('wssbs_gp_image');
			delete_option('wssbs_pin_image');
			delete_option('wssbs_yt_image');
			delete_option('wssbs_re_image');
			delete_option('wssbs_st_image');	
			delete_option('wssbs_ytPath');
			delete_option('wssbs_fb_bg');
			delete_option('wssbs_tw_bg');
			delete_option('wssbs_li_bg');
			delete_option('wssbs_mail_bg');
			delete_option('wssbs_gp_bg');
			delete_option('wssbs_pin_bg');	
			delete_option('wssbs_yt_bg');
			delete_option('wssbs_fpublishBtn');
			delete_option('wssbs_tpublishBtn');
			delete_option('wssbs_gpublishBtn');	
			delete_option('wssbs_ppublishBtn');	
			delete_option('wssbs_lpublishBtn');	
			delete_option('wssbs_mpublishBtn');	
			delete_option('wssbs_republishBtn');	
			delete_option('wssbs_stpublishBtn');
			delete_option('wssbs_ytpublishBtn');	
			delete_option('wssbs_mailMessage');
			delete_option('wssbs_top_margin');
			delete_option('wssbs_page_hide_home');
			delete_option('wssbs_page_hide_post');
			delete_option('wssbs_page_hide_page');
			delete_option('wssbs_fb_title');
			delete_option('wssbs_tw_title');
			delete_option('wssbs_li_title');
			delete_option('wssbs_pin_title');
			delete_option('wssbs_gp_title');
			delete_option('wssbs_mail_title');
			delete_option('wssbs_yt_title');
			delete_option('wssbs_re_title');
			delete_option('wssbs_st_title');
			delete_option('wssbs_page_fb_image');
			delete_option('wssbs_page_tw_image');
			delete_option('wssbs_page_li_image');	
			delete_option('wssbs_page_re_image');	
			delete_option('wssbs_page_st_image');	
			delete_option('wssbs_page_mail_image');	
			delete_option('wssbs_page_gp_image');	
			delete_option('wssbs_page_pin_image');		
			delete_option('wssbs_page_yt_image');	
			delete_option('wssbs_rmSHBtn');
			delete_option('wssbs_featuredshrimg');	
			delete_option('wssbs_defaultfeaturedshrimg');
			delete_option('wssbs_deactive_for_mob');
            // Do nothing
        } // END public static function uninstall
        /**
         * Activate the plugin
         */
        public static function wssbs_activate()
        {
            // Do nothing
        } // END public static function activate
    
        /**
         * Deactivate the plugin
         */     
        public static function wssbs_deactivate()
        {
            // Do nothing
        } // END public static function deactivate
		
    } // END class wssbs_Class
} // END if(!class_exists('wssbs_Class'))

if(class_exists('wssbs_Class'))
{
   // Installation and uninstallation hooks
   register_activation_hook(__FILE__, array('wssbs_Class', 'wssbs_activate'));
   register_deactivation_hook(__FILE__, array('wssbs_Class', 'wssbs_deactivate'));
   register_uninstall_hook(__FILE__, array('wssbs_Class', 'wssbs_uninstall')); 
    // instantiate the plugin class
    $wssbs_plugin_template = new wssbs_Class();
	// Add a link to the settings page onto the plugin page
	if(isset($wssbs_plugin_template))
	{
		$plugin = plugin_basename(__FILE__); 
		add_filter("plugin_action_links_$plugin", array('wssbs_Class','wssbs_add_settings_link'));
	    require dirname(__FILE__).'/wssbs-class.php';
	}
	
	
}
?>
