<?php

namespace EdgeCore\CPT\Testimonials\Shortcodes;


use EdgeCore\Lib;

/**
 * Class Testimonials
 * @package EdgeCore\CPT\Testimonials\Shortcodes
 */
class Testimonials implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edgtf_testimonials';

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
    	if(edgt_core_theme_installed()) {
        if(function_exists('vc_map')) {
            vc_map( array(
                'name' => 'Testimonials',
                'base' => $this->base,
                'category' => 'by EDGE',
                'icon' => 'icon-wpb-testimonials extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params'                    => array_merge(
                array(
                    array(
                        'type' => 'textfield',
						'admin_label' => true,
                        'heading' => 'Category',
                        'param_name' => 'category',
                        'value' => '',
                        'description' => 'Category Slug (leave empty for all)'
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Number',
                        'param_name' => 'number',
                        'value' => '',
                        'description' => 'Number of Testimonials'
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Skin',
                        'param_name' => 'skin',
                        'value' => array(
                            'Default' => '',
                            'Light' => 'light',
                            'Dark' => 'dark'
                        ),
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Title',
                        'param_name' => 'show_title',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
						'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => 'Title Tag',
                        'param_name' => 'title_tag',
                        'value'      => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'dependency' => array('element' => 'show_title', 'value' => array('yes')),
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Author',
                        'param_name' => 'show_author',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
						'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Author Job Position',
                        'param_name' => 'show_position',
                        'value' => array(
                            'Yes' => 'yes',
							'No' => 'no',
                        ),
						'save_always' => true,
                        'dependency' => array('element' => 'show_author', 'value' => array('yes')),
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Icon',
                        'param_name' => 'show_icon',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'save_always' => true,
                        'description' => ''
                    )),
                    oxides_edge_icon_collections()->getVCParamsArray(array('element' => 'show_icon', 'value' => array('yes'))),
                array(
                    array(
                        'type'       => 'attach_image',
                        'heading'    => 'Custom Icon',
                        'param_name' => 'custom_icon',
                        'dependency' => array('element' => 'show_icon', 'value' => array('yes')),
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Navigation',
                        'param_name' => 'show_navigation',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Pagination',
                        'param_name' => 'show_pagination',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Animation speed',
                        'param_name' => 'animation_speed',
                        'value' => '',
                        'description' => __('Speed of slide animation in miliseconds')
                    )
                ))
            ) );
        }
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
            'number' => '-1',
            'category' => '',
            'skin' => '',
            'show_title' => 'yes',
            'title_tag' => 'h6',
            'show_author' => 'yes',
            'show_position' => 'yes',
            'show_icon' => 'yes',
            'custom_icon' => '',
            'show_navigation' => 'yes',
            'show_pagination' => 'yes',
            'animation_speed' => ''
        );
        $args = array_merge($args, oxides_edge_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);

        $number = esc_attr($number);
        $category = esc_attr($category);
        $animation_speed = esc_attr($animation_speed);
		
		$data_attr = $this->getDataParams($params);
		$query_args = $this->getQueryParams($params);
        $holder_classes = $this->getTestimonialsHolder($params);
        $params['title_tag'] = $this->getTitleTag($params, $args);
        $params['icon_parameters']  = $this->getIconParameters($params);

		$html = '';
        $html .= '<div class="edgtf-testimonials-holder clearfix">';
        $html .= '<div class="edgtf-testimonials edgtf-container-inner '.esc_attr($holder_classes).' " '.$data_attr.' >';

        query_posts($query_args);
        if (have_posts()) :
            while (have_posts()) : the_post();
                $author = get_post_meta(get_the_ID(), 'edgtf_testimonial_author', true);
                $text = get_post_meta(get_the_ID(), 'edgtf_testimonial_text', true);
                $title = get_post_meta(get_the_ID(), 'edgtf_testimonial_title', true);
                $job = get_post_meta(get_the_ID(), 'edgtf_testimonial_author_position', true);

				$params['author'] = $author;
				$params['text'] = $text;
				$params['title'] = $title;
				$params['job'] = $job;
				$params['current_id'] = get_the_ID();				
				
				$html .= edgt_core_get_shortcode_module_template_part('testimonials','testimonials-template', '', $params);
				
            endwhile;
        else:
            $html .= esc_html__('Sorry, no posts matched your criteria.', 'edgt_core');
        endif;

        wp_reset_query();
        $html .= '</div>';
		$html .= '</div>';
		
        return $html;
    }
	/**
    * Generates testimonial data attribute array
    *
    * @param $params
    *
    * @return string
    */
	private function getDataParams($params){
		$data_attr = '';
		
		if(!empty($params['animation_speed'])){
			$data_attr .= ' data-animation-speed ="' . $params['animation_speed'] . '"';
		}
        if(!empty($params['show_navigation'])){
            $data_attr .= ' data-navigation ="' . $params['show_navigation'] . '"';
        }
        if(!empty($params['show_pagination'])){
            $data_attr .= ' data-pagination ="' . $params['show_pagination'] . '"';
        }

		
		return $data_attr;
	}
	/**
    * Generates testimonials query attribute array
    *
    * @param $params
    *
    * @return array
    */
	private function getQueryParams($params){
		
		$args = array(
            'post_type' => 'testimonials',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $params['number']
        );

        if ($params['category'] != '') {
            $args['testimonials_category'] = $params['category'];
        }
		return $args;
	}

    /**
     * Generates testimonials query attribute array
     *
     * @param $params
     *
     * @return array
     */

    private function getTestimonialsHolder($params)
    {
        $classes = '';

        if(!empty($params['skin'])){
            $classes .= $params['skin'];
        }

        if(!empty($params['show_icon']) && $params['show_icon'] !== 'no'){
            $classes .= ' edgtf-with-icon';
        }

        return $classes;
    }

    /**
     * Return Title Tag. If provided heading isn't valid get the default one
     *
     * @param $params
     *
     * @return string
     */

    private function getTitleTag($params, $args){
        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
        return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
    }

    /**
     * Returns parameters for icon shortcode
     *
     * @param $params
     *
     * @return array
     */
    private function getIconParameters($params) {
        $params_array = array();

        if(empty($params['custom_icon']) && $params['show_icon'] !== 'no') {
            $iconPackName = oxides_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

            $params_array['icon_pack']   = $params['icon_pack'];
            $params_array[$iconPackName] = $params[$iconPackName];
        }

        return $params_array;
    }
}