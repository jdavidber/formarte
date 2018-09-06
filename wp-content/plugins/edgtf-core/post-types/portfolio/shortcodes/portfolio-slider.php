<?php
namespace EdgeCore\CPT\Portfolio\Shortcodes;

use EdgeCore\Lib;

/**
 * Class PortfolioSlider
 * @package EdgeCore\CPT\Portfolio\Shortcodes
 */
class PortfolioSlider implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edgtf_portfolio_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }


    /**
     * Maps shortcode to Visual Composer
     *
     * @see vc_map()
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map( array(
                'name' => 'Portfolio Slider',
                'base' => $this->base,
                'category' => 'by EDGE',
                'icon' => 'icon-wpb-portfolio-slider extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Portfolio Slider Template',
                        'param_name' => 'type',
                        'value' => array(
							'Standard' => 'standard',
                            'Gallery' => 'gallery'                           
                        ),
						'save_always' => true,
						'admin_label' => true,
                        'description' => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Enable Navigation',
                        'param_name' => 'slider_navigation',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'save_always' => true,
                        'description' => '',
                        'group'      => 'Slider Settings'
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Enable Pagination',
                        'param_name' => 'slider_pagination',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'save_always' => true,
                        'description' => '',
                        'group'      => 'Slider Settings'
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Image size',
                        'param_name' => 'image_size',
                        'value' => array(
                            'Default' => '',
                            'Original Size' => 'full',
                            'Square' => 'square',
                            'Landscape' => 'landscape',
                            'Portrait' => 'portrait'
                        ),
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        
                        'heading' => 'Order By',
                        'param_name' => 'order_by',
                        'value' => array(
                            '' => '',
                            'Menu Order' => 'menu_order',
                            'Title' => 'title',
                            'Date' => 'date'
                        ),
						'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',                        
                        'heading' => 'Order',
                        'param_name' => 'order',
                        'value' => array(
                            '' => '',
                            'ASC' => 'ASC',
                            'DESC' => 'DESC',
                        ),
						'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'textfield',                        
                        'heading' => 'Number',
                        'param_name' => 'number',
                        'value' => '-1',
						'admin_label' => true,
                        'description' => 'Number of portolios on page (-1 is all)'
                    ),
                    array(
                        'type' => 'dropdown',                        
                        'heading' => 'Number of Portfolios Shown',
                        'param_name' => 'portfolios_shown',
						'admin_label' => true,
                        'value' => array(
                            '' => '',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6'
                        ),
                        'description' => 'Number of portfolios that are showing at the same time in full width (on smaller screens is responsive so there will be less items shown)',
                        'group'      => 'Slider Settings'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => 'Category',
                        'param_name' => 'category',
                        'value' => '',
						'admin_label' => true,
                        'description' => 'Category Slug (leave empty for all)'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => 'Selected Projects',
                        'param_name' => 'selected_projects',
                        'value' => '',
						'admin_label' => true,
                        'description' => 'Selected Projects (leave empty for all, delimit by comma)'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Display Title',
                        'param_name' => 'display_title',
                        'value' => array(
                            'Yes'   => 'yes',
                            'No'    => 'no',
                        ),
                        'save_always' => true,
                        'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => 'Title Tag',
                        'param_name' => 'title_tag',
                        'value' => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'admin_label' => true,
                        'description' => '',
                        'dependency' => array('element' => 'display_title', 'value' => array('yes'))
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Display Excerpt',
                        'param_name' => 'display_excerpt',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'admin_label' => true,
                        'save_always' => true,
                        'description' => 'Default value is Yes',
                        'group' => 'Hover Design Options'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Display Separator',
                        'param_name' => 'display_separator',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'admin_label' => true,
                        'save_always' => true,
                        'description' => 'Default value is Yes',
                        'group' => 'Hover Design Options',
                        'dependency' => array('element' => 'type', 'value' => array('gallery')),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Display Category',
                        'param_name' => 'display_category',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'admin_label' => true,
                        'save_always' => true,
                        'description' => 'Default value is No',
                        'group' => 'Hover Design Options'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Display Icon for link',
                        'param_name' => 'display_link',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'admin_label' => true,
                        'save_always' => true,
                        'description' => 'Default value is No',
                        'group' => 'Hover Design Options'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Display Icon for lightbox',
                        'param_name' => 'display_lightbox',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'admin_label' => true,
                        'save_always' => true,
                        'description' => 'Default value is No',
                        'group' => 'Hover Design Options'
                    )
                )
            ) );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'type' => 'standard',
            'image_size' => 'full',
            'order_by' => 'date',
            'order' => 'ASC',
            'number' => '-1',
            'category' => '',
            'selected_projects' => '',
            'display_title' => 'yes',
            'title_tag' => 'h6',
			'portfolios_shown' => '3',
			'portfolio_slider' => 'yes',
            'slider_navigation' => 'no',
            'slider_pagination' => 'no',
            'display_excerpt' => 'yes',
            'display_separator' => 'yes',
            'display_category' => 'no',
            'display_link' => 'no',
            'display_lightbox' => 'no'
        );

        $args = array_merge($args, oxides_edge_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);
		
		extract($params);
		
		$html ='';
		$html .= oxides_edge_execute_shortcode('edgtf_portfolio_list', $params);
        return $html;
    }
	
	
}