<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "nightly_mobile";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => $opt_name,
        'dev_mode' => false,
        'disable_tracking' => true,
        'display_name' => esc_html( 'Formarte Mobile' ),
        'display_version' => NIGHTLY_VERSION,
        'use_cdn' => TRUE,
        'page_title' => esc_html__( 'Formarte Mobile Theme Options', 'nightly-mobile' ),
        'update_notice' => FALSE,
        'menu_type' => 'submenu',
        'menu_title' => esc_html( 'Formarte Mobile' ),
        'allow_sub_menu' => FALSE,
        'page_priority' => '31',
        'default_mark' => '*',
        'class' => 'nightly-admin',
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
                'style' => 'youtube',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
        'menu_icon' => 'dashicons-menu',
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.

    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/lukepostulka/',
        'title' => 'Like me on Facebook',
        'img'   => NIGHTLY_THEMEROOT . '/assets/images/facebook-icon.png'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/lukepostulka',
        'title' => 'Follow me on Twitter',
        'img'   => NIGHTLY_THEMEROOT . '/assets/images/twitter-icon.png'
    );
		$args['share_icons'][] = array(
		    'url'   => 'http://themeforest.net/user/lukepostulka',
		    'title' => 'Visit me on ThemeForest',
		    'img'   => NIGHTLY_THEMEROOT . '/assets/images/envato-icon.png'
		);
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */

    // Theme settings section below

    $opt_options = array();

    $opt_options[] = array(
          'id'       => 'nightly_swipe_gestures',
          'type'     => 'switch',
          'title'    => esc_html__('Disable swipe gestures', 'nightly-mobile'),
          'subtitle' => esc_html__('Disable opening and closing sidebars with swipe gestures', 'nightly-mobile'),
          'default'  => false,
    );

    $opt_options[] = array(
          'id'       => 'nightly_contact_form_email',
          'type'     => 'text',
          'title'    => esc_html__('Contact form email', 'nightly-mobile'),
          'subtitle' => esc_html__('Send all messages from contact form to this email', 'nightly-mobile'),
          'validate' => 'email',
          'msg'      => 'Enter valid email address',
          'default'  => 'test@test.com'
    );

    $opt_options[] = array(
          'id'=>'nightly_contact_form_map_src',
          'type' => 'textarea',
          'title' => esc_html__('Contact form map src', 'nightly-mobile'),
          'subtitle' => esc_html__('URL address for iframe map', 'nightly-mobile'),
          'desc' => esc_html__('Input custom URL address from Google Maps.', 'nightly-mobile'),
          'validate' => 'html_custom',
          'default' => 'http://maps.google.ca/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=New+York&amp;sll=49.891235,-97.15369&amp;sspn=47.259509,86.923828&amp;ie=UTF8&amp;hq=&amp;hnear=New+York,+United+States&amp;ll=40.714867,-74.005537&amp;spn=0.019517,0.018797&amp;z=14&amp;iwloc=near&amp;output=embed',
          'allowed_html' => array(
              'a' => array( 'href' => array(), 'title' => array() ),
              'br' => array(),
              'em' => array(),
              'strong' => array()
           )
    );

    $opt_options[] = array(
					'id'       => 'nightly_ad',
					'type'     => 'switch',
					'title'    => esc_html__('Show custom ad', 'nightly-mobile'),
					'subtitle' => esc_html__('You can create ad space between your blog posts and search results', 'nightly-mobile'),
					'default'  => false,
					"on"  		=> "Yes",
					"off"  		=> "No"
    );

    $opt_options[] = array(
            'id'       => 'nightly_ad_post_num',
            'type'     => 'text',
            'title'    => esc_html__( 'How many posts between ads', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Ad will be places below post', 'nightly-mobile' ),
            'desc'     => esc_html__( 'Number of posts', 'nightly-mobile' ),
            'default'  => 5,
            'required' => array('nightly_ad', '=', 1),
            'validate' => 'numeric'
    );

    $opt_options[] = array(
          'id'=> 'nightly_ad_text',
          'type' => 'textarea',
          'title' => esc_html__('Ad text', 'nightly-mobile'),
          'subtitle' => esc_html__('You can use HTML in this field', 'nightly-mobile'),
          'desc' => esc_html__('For fullscreen wrap in class fullscreen.', 'nightly-mobile'),
          'validate' => 'html_custom',
          'default' => '',
          'allowed_html' => array(
              'a' => array( 'href' => array(), 'title' => array() ),
              'br' => array(),
              'img' => array(),
              'em' => array(),
              'strong' => array()
           ),
           'required' => array('nightly_ad', '=', 1)
    );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Theme Settings', 'nightly-mobile' ),
        'id'     => 'nightly_admin_theme_settings',
        'icon'   => 'el el-home',
        'fields' => $opt_options )
    );

    // End of theme setting section
    // Start of Header section

    $opt_options = array();

    $opt_options[] = array(
          'id'       => 'nightly_custom_header_title',
          'type'     => 'switch',
          'title'    => esc_html__('Custom header title', 'nightly-mobile'),
          'subtitle' => esc_html__('If set to off the title shows blog name', 'nightly-mobile'),
          'default'  => false,
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Header title', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Title shown in header instead of page name', 'nightly-mobile' ),
            'desc'     => esc_html__('Insert header text or logo common for every page', 'nightly-mobile'),
            'required' => array('nightly_custom_header_title', '=', 1),
            'validate' => 'html_custom',
            'allowed_html' => array(
                'a' => array( 'href' => array(), 'title' => array() ),
                'br' => array(),
                'img' => array(),
                'em' => array( 'class' => array() ),
                'strong' => array()
             ),
            'default'  => get_bloginfo('name')
    );

    $opt_options[] = array(
          'id'       => 'nightly_custom_header_logo',
          'type'     => 'switch',
          'title'    => esc_html__('Custom header logo', 'nightly-mobile'),
          'subtitle' => esc_html__('If set to on header will show logo instead of title automatically', 'nightly-mobile'),
          'default'  => false,
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_logo',
            'type'     => 'text',
            'title'    => esc_html__( 'Header logo', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Logo shown in header instead of title', 'nightly-mobile' ),
            'desc'     => esc_html__('Insert src of the logo (ideal 160x65)', 'nightly-mobile'),
            'required' => array('nightly_custom_header_logo', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_sidebar_left_custom_url',
            'type'     => 'text',
            'title'    => esc_html__( 'Menu icon URL', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'You can insert custom URL for left sidebar icon', 'nightly-mobile' ),
            'desc'     => esc_html__('Insert URL, "#", or leave blank', 'nightly-mobile'),
            'validate' => 'url'
    );

    $opt_options[] = array(
    				'id'       => 'nightly_header_left_sidebar_hide_icon',
    				'type'     => 'switch',
    				'title'    => esc_html__('Hide left icon', 'nightly-mobile'),
    				'subtitle' => esc_html__('Hide left sidebar icon', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No"
    );

    $opt_options[] = array(
    				'id'       => 'nightly_header_right_sidebar_hide_icon',
    				'type'     => 'switch',
    				'title'    => esc_html__('Hide right icon', 'nightly-mobile'),
    				'subtitle' => esc_html__('Hide right sidebar or search icon', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No"
    );

    $opt_options[] = array(
    				'id'       => 'nightly_header_fixed',
    				'type'     => 'switch',
    				'title'    => esc_html__('Fixed header', 'nightly-mobile'),
    				'subtitle' => esc_html__('Display header in fixed position all the time', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No"
    );

    $opt_options[] = array(
    				'id'       => 'nightly_header_thinline',
    				'type'     => 'switch',
    				'title'    => esc_html__('Thinline header', 'nightly-mobile'),
    				'subtitle' => esc_html__('Height of header is reduced in order to increase readability', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No"
    );

    $opt_options[] = array(
    				'id'       => 'nightly_header_thinline_auto',
    				'type'     => 'switch',
    				'title'    => esc_html__('Auto thinline header', 'nightly-mobile'),
    				'subtitle' => esc_html__('Change header if the device is in landscape mode automatically', 'nightly-mobile'),
    				'default'  => true,
    				"on"  		=> "Yes",
    				"off"  		=> "No"
    );

    $opt_options[] = array(
          'id'       => 'nightly_header_custom_bg',
          'type'     => 'switch',
          'title'    => esc_html__('Custom background', 'nightly-mobile'),
          'subtitle' => esc_html__( 'Click if you want to set custom background for header', 'nightly-mobile' ),
          'default'  => false,
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_bg',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Background for header', 'nightly-mobile' ),
            'required' => array('nightly_header_custom_bg', '=', 1),
            'output'	 => array(
            	'background' => '
            		.sidebar-style-nightly .main-header,
            		.sidebar-style-light .main-header,
            		.sidebar-style-banana .main-header,
            		.sidebar-style-sky-blue .main-header,
            		.sidebar-style-deep-sea .main-header,
            		.sidebar-style-breathe .main-header,
            		.sidebar-style-space-myst .main-header'
            )
    );

    $opt_options[] = array(
        'id'       => 'nightly_header_text_color',
        'type'     => 'color',
        'title'    => esc_html__('Text color', 'nightly-mobile'),
        'subtitle' => esc_html__('Custom text color for header, including title and icon colors', 'nightly-mobile'),
          'transparent' => false,
          'output'    => array(
          		'color' => '
          			.sidebar-style-nightly .main-header .header-title,
          			.sidebar-style-nightly .main-header #header-search-icon,
          			.sidebar-style-nightly .main-header #a-right-sidebar:before,
          			.sidebar-style-light .main-header .header-title,
          			.sidebar-style-light .main-header #header-search-icon,
          			.sidebar-style-light .main-header #a-right-sidebar:before,
          			.sidebar-style-banana .main-header .header-title,
          			.sidebar-style-banana .main-header #header-search-icon,
          			.sidebar-style-banana .main-header #a-right-sidebar:before,
          			.sidebar-style-sky-blue .main-header .header-title,
          			.sidebar-style-sky-blue .main-header #header-search-icon,
          			.sidebar-style-sky-blue .main-header #a-right-sidebar:before,
          			.sidebar-style-deep-sea .main-header .header-title,
          			.sidebar-style-deep-sea .main-header #header-search-icon,
          			.sidebar-style-deep-sea .main-header #a-right-sidebar:before,
          			.sidebar-style-breathe .main-header .header-title,
          			.sidebar-style-breathe .main-header #header-search-icon,
          			.sidebar-style-breathe .main-header #a-right-sidebar:before,
          			.sidebar-style-space-myst .main-header .header-title,
          			.sidebar-style-space-myst .main-header #header-search-icon,
          			.sidebar-style-space-myst .main-header #a-right-sidebar:before',
          		'border-color' => '
          			.sidebar-style-nightly .main-header #a-sidebar,
          			.sidebar-style-nightly .main-header #a-sidebar:before,
          			.sidebar-style-nightly .main-header #a-sidebar:after,
          			.sidebar-style-nightly .main-header #a-right-sidebar,
          			.sidebar-style-nightly .main-header #a-right-sidebar:before,
          			.sidebar-style-nightly .main-header #a-right-sidebar:after,
          			.sidebar-style-light .main-header #a-sidebar,
          			.sidebar-style-light .main-header #a-sidebar:before,
          			.sidebar-style-light .main-header #a-sidebar:after,
          			.sidebar-style-light .main-header #a-right-sidebar,
          			.sidebar-style-light .main-header #a-right-sidebar:before,
          			.sidebar-style-light .main-header #a-right-sidebar:after,
          			.sidebar-style-banana .main-header #a-sidebar,
          			.sidebar-style-banana .main-header #a-sidebar:before,
          			.sidebar-style-banana .main-header #a-sidebar:after,
          			.sidebar-style-banana .main-header #a-right-sidebar,
          			.sidebar-style-banana .main-header #a-right-sidebar:before,
          			.sidebar-style-banana .main-header #a-right-sidebar:after,
          			.sidebar-style-sky-blue .main-header #a-sidebar,
          			.sidebar-style-sky-blue .main-header #a-sidebar:before,
          			.sidebar-style-sky-blue .main-header #a-sidebar:after,
          			.sidebar-style-sky-blue .main-header #a-right-sidebar,
          			.sidebar-style-sky-blue .main-header #a-right-sidebar:before,
          			.sidebar-style-sky-blue .main-header #a-right-sidebar:after,
          			.sidebar-style-deep-sea .main-header #a-sidebar,
          			.sidebar-style-deep-sea .main-header #a-sidebar:before,
          			.sidebar-style-deep-sea .main-header #a-sidebar:after,
          			.sidebar-style-deep-sea .main-header #a-right-sidebar,
          			.sidebar-style-deep-sea .main-header #a-right-sidebar:before,
          			.sidebar-style-deep-sea .main-header #a-right-sidebar:after,
          			.sidebar-style-breathe .main-header #a-sidebar,
          			.sidebar-style-breathe .main-header #a-sidebar:before,
          			.sidebar-style-breathe .main-header #a-sidebar:after,
          			.sidebar-style-breathe .main-header #a-right-sidebar,
          			.sidebar-style-breathe .main-header #a-right-sidebar:before,
          			.sidebar-style-breathe .main-header #a-right-sidebar:after,
          			.sidebar-style-space-myst .main-header #a-sidebar,
          			.sidebar-style-space-myst .main-header #a-sidebar:before,
          			.sidebar-style-space-myst .main-header #a-sidebar:after,
          			.sidebar-style-space-myst .main-header #a-right-sidebar,
          			.sidebar-style-space-myst .main-header #a-right-sidebar:before,
          			.sidebar-style-space-myst .main-header #a-right-sidebar:after'
          )
    );

    $opt_options[] = array(
    				'id'       => 'nightly_show_header_info_bar',
    				'type'     => 'switch',
    				'title'    => esc_html__('Show header info bar', 'nightly-mobile'),
    				'subtitle' => esc_html__('Display small info bar above header', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No"
    );

    $opt_options[] = array(
    				'id'       => 'nightly_header_info_bar_fixed',
    				'type'     => 'switch',
    				'title'    => esc_html__('Fixed position', 'nightly-mobile'),
    				'subtitle' => esc_html__('Display header info bar in fixed position all the time', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No",
    				'required' => array('nightly_show_header_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_info_bar_phone',
            'type'     => 'text',
            'title'    => esc_html__( 'Call button', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter phone number', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'required' => array('nightly_show_header_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_info_bar_sign',
    				'type'     => 'switch',
    				'title'    => esc_html__('Show sign in button', 'nightly-mobile'),
    				'subtitle' => esc_html__('Shows button for signing in with WordPress', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No",
    				'required' => array('nightly_show_header_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_info_bar_desktop',
            'type'     => 'text',
            'title'    => esc_html__( 'Show desktop version', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter URL for desktop version of the site', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'validate' => 'url',
            'required' => array('nightly_show_header_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_info_bar_twitter_name',
            'type'     => 'text',
            'title'    => esc_html__( 'Twitter name', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter Twitter name', 'nightly-mobile' ),
            'default'  => "Twitter",
            'required' => array('nightly_show_header_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_info_bar_twitter_link',
            'type'     => 'text',
            'title'    => esc_html__( 'Twitter page URL', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter URL of your Twitter page', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'validate' => 'url',
            'required' => array('nightly_show_header_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_info_bar_facebook_name',
            'type'     => 'text',
            'title'    => esc_html__( 'Facebook name', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter Facebook name', 'nightly-mobile' ),
            'default'  => "Facebook",
            'required' => array('nightly_show_header_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_header_info_bar_facebook_link',
            'type'     => 'text',
            'title'    => esc_html__( 'Facebook page URL', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter URL of your Facebook page', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'validate' => 'url',
            'required' => array('nightly_show_header_info_bar', '=', 1)
    );

    $opt_options[] = array(
    				'id'       => 'nightly_header_hide',
    				'type'     => 'switch',
    				'title'    => esc_html__('Hide header', 'nightly-mobile'),
    				'subtitle' => esc_html__('Hide whole header', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No"
    );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header', 'nightly-mobile' ),
        'id'     => 'nightly_admin_header',
        'icon'   => 'fa fa-header',
        'fields' => $opt_options )
    );

    // End of header section
    // Start of slider section

    /*
    * This section is only available when Luke Slider plugin is activated
    */

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'luke-slider/luke-slider.php' ) ) :

    $opt_options = array();

    $opt_options[] = array(
        'id'       => 'nightly_slider_bg',
        'type'     => 'background',
        'title'    => esc_html__('Slider background', 'nightly-mobile'),
        'subtitle' => esc_html__('Choose background color/image for homepage carousel', 'nightly-mobile'),
        'desc'     => esc_html__('This is common background for all slides', 'nightly-mobile'),
        'output'	 => array(
        	'background' => '#main-home-slider .item'
        )
    );

    $opt_options[] = array(
                'id'       => 'nightly_slider_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Slider text color', 'nightly-mobile' ),
                'subtitle' => esc_html__( 'Choose text color for homepage carousel including button', 'nightly-mobile' ),
                'transparent' => false,
                'output'    => array(
                	'color' => '
                		#main-home-slider .item .text,
                		#main-home-slider .item button
                	',
                	'border-color' => '
                		#main-home-slider .item button
                	'
                )
        );

        Redux::setSection( $opt_name, array(
            'title'  => esc_html__( 'Slider', 'nightly-mobile' ),
            'id'     => 'nightly_slider',
            'icon'   => 'fa fa-image',
            'fields' => $opt_options )
        );

    endif;

    // End of slider section
    // Start of footer section

    $opt_options = array();

    $opt_options[] = array(
            'id'       => 'nightly_footer_text',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Footer text', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Text shown in footer', 'nightly-mobile' ),
            'desc'     => esc_html__('HTML allowed in this field.', 'nightly-mobile'),
            'validate' => 'html_custom',
            'allowed_html' => array(
                'a' => array( 'href' => array(), 'title' => array() ),
                'br' => array(),
                'img' => array(),
                'em' => array( 'class' => array() ),
                'strong' => array(),
                'div' => array( 'class' => array() )
             ),
            'default'  => "&copy; " . date("Y") . " " . get_bloginfo('name')
    );

    $opt_options[] = array(
    				'id'       => 'nightly_footer_fixed',
    				'type'     => 'switch',
    				'title'    => esc_html__('Fixed footer', 'nightly-mobile'),
    				'subtitle' => esc_html__('Display footer in fixed position all the time', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No"
    );

    $opt_options[] = array(
    				'id'       => 'nightly_show_footer_info_bar',
    				'type'     => 'switch',
    				'title'    => esc_html__('Show footer info bar', 'nightly-mobile'),
    				'subtitle' => esc_html__('Display small footer info bar', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No",
    );

    $opt_options[] = array(
    				'id'       => 'nightly_footer_info_bar_fixed',
    				'type'     => 'switch',
    				'title'    => esc_html__('Fixed position', 'nightly-mobile'),
    				'subtitle' => esc_html__('Display footer info bar in fixed position all the time', 'nightly-mobile'),
    				'default'  => false,
    				"on"  		=> "Yes",
    				"off"  		=> "No",
    				'required' => array('nightly_show_footer_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_footer_info_bar_map',
            'type'     => 'text',
            'title'    => esc_html__( 'Show location button', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter redirect Google Maps URL', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'validate' => 'url',
            'required' => array('nightly_show_footer_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_footer_info_bar_phone',
            'type'     => 'text',
            'title'    => esc_html__( 'Call button', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter phone number', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'required' => array('nightly_show_footer_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_footer_info_bar_email',
            'type'     => 'text',
            'title'    => esc_html__( 'Show email button', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter email address', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'validate' => 'email',
            'required' => array('nightly_show_footer_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_footer_info_bar_twitter_name',
            'type'     => 'text',
            'title'    => esc_html__( 'Twitter name', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter Twitter name', 'nightly-mobile' ),
            'default'  => "Twitter",
            'required' => array('nightly_show_footer_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_footer_info_bar_twitter_link',
            'type'     => 'text',
            'title'    => esc_html__( 'Twitter page URL', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter URL of your Twitter page', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'validate' => 'url',
            'required' => array('nightly_show_footer_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_footer_info_bar_facebook_name',
            'type'     => 'text',
            'title'    => esc_html__( 'Facebook name', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter Facebook name', 'nightly-mobile' ),
            'default'  => "Facebook",
            'required' => array('nightly_show_footer_info_bar', '=', 1)
    );

    $opt_options[] = array(
            'id'       => 'nightly_footer_info_bar_facebook_link',
            'type'     => 'text',
            'title'    => esc_html__( 'Facebook page URL', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter URL of your Facebook page', 'nightly-mobile' ),
            'desc'     => esc_html__('Leave empty for no display', 'nightly-mobile'),
            'default'  => "",
            'validate' => 'url',
            'required' => array('nightly_show_footer_info_bar', '=', 1)
    );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer', 'nightly-mobile' ),
        'id'     => 'nightly_admin_footer',
        'icon'   => 'fa fa-sort-amount-desc',
        'fields' => $opt_options )
    );

    // End of footer
    // Start of navigation section

    $opt_options = array();

    $opt_options[] = array(
        'id'       => 'nightly_navigation_style',
        'type'     => 'radio',
        'title'    => esc_html__('Navigation style', 'nightly-mobile'),
        'subtitle' => esc_html__('You can choose navigation style for Nightly Menu', 'nightly-mobile'),
        'desc'		 => esc_html__('If disabed the menu icon stays in header (in case you want to use it for home page etc.)', 'nightly-mobile'),
        'options'  => array(
            'sidebar' => 'Sidebar',
            'dropdown' => 'Dropdown',
            'disabled' => 'Disabled'
        ),
        'default' => 'sidebar'
    );

    // Dropdown section

    $opt_options[] = array(
          'id'       => 'nightly_dropdown_custom_bg',
          'type'     => 'switch',
          'title'    => esc_html__('Custom background', 'nightly-mobile'),
          'subtitle' => esc_html__( 'Click if you want to set custom background for dropdown navigation', 'nightly-mobile' ),
          'required' => array('nightly_navigation_style', '=', 'dropdown'),
          'default'  => false,
    );

    $opt_options[] = array(
            'id'       => 'nightly_dropdown_bg',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Background for dropdown navigation', 'nightly-mobile' ),
            'required' => array('nightly_dropdown_custom_bg', '=', 1),
            'transparent' => false,
            'output'	 => array(
            	'background' => '
            		.main-navigation-dropdown #navi-dropdown'
            )
    );

    $opt_options[] = array(
        'id'       => 'nightly_dropdown_text_color',
        'type'     => 'color',
        'title'    => esc_html__('Text color', 'nightly-mobile'),
        'subtitle' => esc_html__('You can choose own text color for dropdown navigation', 'nightly-mobile'),
          'required' => array('nightly_navigation_style', '=', 'dropdown'),
          'transparent' => false,
          'output'    => array(
          		'color' => '
          			.main-navigation-dropdown .navigation ul li a,
          			.main-navigation-dropdown #navi-dropdown .navigation li a,
          			.main-navigation-dropdown .widget *',
          		'background-color' => '
          			.main-navigation-dropdown .navi-dropdown-header .navi-icon-close:before,
          			.main-navigation-dropdown .navi-dropdown-header .navi-icon-close:after'
          )
    );

    // Sidebar section

    $opt_options[] = array(
        'id'       => 'nightly_sidebar_style',
        'type'     => 'image_select',
        'title'    => esc_html__('Sidebar style', 'nightly-mobile'),
        'subtitle' => esc_html__('Select sidebar navigation style (you can edit colors below).', 'nightly-mobile'),
        'width'		 => 150,
        'height'		 => 150,
        'required' => array('nightly_navigation_style', '=', 'sidebar'),
        'options'  => array(
            '1'      => array(
                'alt'   => 'Nightly',
                'img'   => ReduxFramework::$_url.'assets/img/nav1.png'
            ),
            '2'      => array(
                'alt'   => 'Light',
                'img'   => ReduxFramework::$_url.'assets/img/nav2.png'
            ),
            '3'      => array(
                'alt'   => 'Banana',
                'img'   => ReduxFramework::$_url.'assets/img/nav3.png'
            ),
            '4'      => array(
                'alt'   => 'Deep sea',
                'img'  => ReduxFramework::$_url.'assets/img/nav4.png'
            ),
            '5'      => array(
                'alt'   => 'Sky blue',
                'img'   => ReduxFramework::$_url.'assets/img/nav5.png'
            ),
            '6'      => array(
                'alt'   => 'Breathe',
                'img'   => ReduxFramework::$_url.'assets/img/nav6.png'
            ),
            '7'      => array(
                'alt'   => 'Space Myst',
                'img'   => ReduxFramework::$_url.'assets/img/nav7.png'
            )
        ),
        'default' => '1'
    );

    $opt_options[] = array(
        'id'       => 'nightly_sidebar_transition',
        'type'     => 'radio',
        'title'    => esc_html__('Sidebar transition', 'nightly-mobile'),
        'subtitle' => esc_html__('You can choose one blog listing style for posts/search/archives', 'nightly-mobile'),
        'required' => array('nightly_navigation_style', '=', 'sidebar'),
        'options'  => array(
            'push' => 'Push',
            'reveal' => 'Reveal',
            'overlay' => 'Overlay'
        ),
        'default' => 'push'
    );

    $opt_options[] = array(
          'id'       => 'nightly_sidebar_custom_bg',
          'type'     => 'switch',
          'title'    => esc_html__('Custom background', 'nightly-mobile'),
          'subtitle' => esc_html__( 'Click if you want to set custom background for navigation sidebar', 'nightly-mobile' ),
          'required' => array('nightly_navigation_style', '=', 'sidebar'),
          'default'  => false,
    );

    $opt_options[] = array(
            'id'       => 'nightly_sidebar_bg',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Background for navigation sidebar', 'nightly-mobile' ),
            'required' => array('nightly_sidebar_custom_bg', '=', 1),
            'output'	 => array(
            	'background' => '
            		.sidebar-style-nightly #left-sidebar,
            		.sidebar-style-banana #left-sidebar,
            		.sidebar-style-sky-blue #left-sidebar,
            		.sidebar-style-deep-sea #left-sidebar,
            		.sidebar-style-breathe #left-sidebar,
            		.sidebar-style-space-myst #left-sidebar'
            )
    );

    $opt_options[] = array(
        'id'       => 'nightly_sidebar_text_color',
        'type'     => 'color',
        'title'    => esc_html__('Text color', 'nightly-mobile'),
        'subtitle' => esc_html__('You can choose own text color for sidebar navigation', 'nightly-mobile'),
	      'desc'		=> esc_html__('*Not every navigation style supports changing text colors', 'nightly-mobile'),
	      'required' => array('nightly_navigation_style', '=', 'sidebar'),
	      'transparent' => false,
	      'output'    => array(
	      		'color' => '
	      			.sidebar-style-nightly #left-sidebar ul li a,
	      			.sidebar-style-banana #left-sidebar ul li,
	      			.sidebar-style-banana #left-sidebar ul li a,
	      			.sidebar-style-sky-blue #left-sidebar ul li a,
	      			.sidebar-style-deep-sea #left-sidebar ul li a,
	      			.sidebar-style-breathe #left-sidebar ul li a,
	      			.sidebar-style-space-myst #left-sidebar ul li a,
	      			#left-sidebar .widget *,
	      			#left-sidebar .widget h4,
	      			#left-sidebar .nightly-searchform .nightly-button',
	      		'border-color' => '
	      			#left-sidebar .nightly-searchform .nightly-input,
	      			#left-sidebar .woocommerce-product-search input[type=search]'
	      )
    );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Navigation', 'nightly-mobile' ),
        'id'     => 'nightly_admin_navigation',
        'icon'   => 'fa fa-list',
        'fields' => $opt_options )
    );

    // End of sidebar navigation section
    // Start of blog section

    $opt_options = array();

    $opt_options[] = array(
        'id'       => 'nightly_blog_style',
        'type'     => 'radio',
        'title'    => esc_html__('Blog style', 'nightly-mobile'),
        'subtitle' => esc_html__('You can choose one blog listing style for posts/search/archives', 'nightly-mobile'),
        'options'  => array(
            'normal' => 'Normal',
            'excerpt' => 'Excerpt with thumbnails',
        ),
        'default' => 'normal'
    );

    $opt_options[] = array(
            'id'       => 'nightly_blog_post_excerpt',
            'type'     => 'text',
            'title'    => esc_html__( 'Blog post excerpt length', 'nightly-mobile' ),
            'subtitle' => esc_html__( 'Enter number of words or 0 for non', 'nightly-mobile' ),
            'default'  => "5",
            'validate' => 'numeric',
            'required' => array('nightly_blog_style', '=', 'excerpt')
    );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Blog', 'nightly-mobile' ),
        'id'     => 'nightly_admin_blog',
        'icon'   => 'fa fa-pencil',
        'fields' => $opt_options )
    );

    // End of blog section
    // Start of shop settings

    $opt_options = array();

    $opt_options[] = array(
    				'id'       => 'nightly_shop_show_search_bar',
    				'type'     => 'switch',
    				'title'    => esc_html__('Search bar', 'nightly-mobile'),
    				'subtitle' => esc_html__('Show search bar on home page above listed products', 'nightly-mobile'),
    				'default'  => true,
    				"on"  		=> "Show",
    				"off"  		=> "Hide",
    );

    $opt_options[] = array(
    				'id'       => 'nightly_shop_show_buy_now',
    				'type'     => 'switch',
    				'title'    => esc_html__('Buy now button', 'nightly-mobile'),
    				'subtitle' => esc_html__('Show buy now button below each listed product', 'nightly-mobile'),
    				'default'  => true,
    				"on"  		=> "Show",
    				"off"  		=> "Hide",
    );

    $opt_options[] = array(
    				'id'       => 'nightly_shop_show_rating',
    				'type'     => 'switch',
    				'title'    => esc_html__('Product list rating', 'nightly-mobile'),
    				'subtitle' => esc_html__('Show rating below each listed product', 'nightly-mobile'),
    				'default'  => true,
    				"on"  		=> "Show",
    				"off"  		=> "Hide",
    );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Shop settings', 'nightly-mobile' ),
        'id'     => 'nightly_admin_shop',
        'icon'   => 'fa fa-shopping-cart',
        'fields' => $opt_options )
    );

    // End of shop settings

     /*
      * <--- END SECTIONS
      */
