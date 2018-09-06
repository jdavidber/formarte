<?php

namespace EdgeOxidesfModules\BlogList;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class BlogList
 */
class BlogList implements ShortcodeInterface {
	/**
	* @var string
	*/
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_blog_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Edge Blog List', 'oxides'),
			'base' => $this->base,
			'icon' => 'icon-wpb-blog-list extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Type',
						'param_name' => 'type',
						'value' => array(
							'Boxes' => 'boxes',
							'Checkered' => 'checkered'
						),
						'description' => '',
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Number of Posts',
						'param_name' => 'number_of_posts',
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Number of Columns',
						'param_name' => 'number_of_columns',
						'value' => array(
							'One' => '1',
							'Two' => '2',
							'Three' => '3',
							'Four' => '4'
						),
						'description' => '',
						'save_always' => true,
						'dependency' => Array('element' => 'type', 'value' => array('boxes'))
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Order By',
						'param_name' => 'order_by',
						'value' => array(
							'Date' => 'date',
							'Title' => 'title'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Order',
						'param_name' => 'order',
						'value' => array(
							'ASC' => 'ASC',
							'DESC' => 'DESC'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Category Slug',
						'param_name' => 'category',
						'description' => 'Leave empty for all or use comma for list'
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Image Size',
						'param_name' => 'image_size',
						'value' => array(
							'Original' => 'original',
							'Landscape' => 'landscape',
							'Square' => 'square'
						),
						'description' => '',
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Text length',
						'param_name' => 'text_length',
						'description' => 'Number of characters'
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
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Enable Post Info Section',
						'param_name' => 'post_info_section',
						'value' => array(
							'Yes' => 'yes',
							'No' => 'no'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Enable Post Info Category',
						'param_name' => 'post_info_category',
						'value' => array(
							'Yes' => 'yes',
							'No' => 'no'
						),
						'save_always' => true,
						'dependency' => Array('element' => 'post_info_section', 'value' => array('yes'))
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Enable Post Info Comments',
						'param_name' => 'post_info_comments',
						'value' => array(
							'Yes' => 'yes',
							'No' => 'no'
						),
						'save_always' => true,
						'dependency' => Array('element' => 'post_info_section', 'value' => array('yes'))
					),
				)
		) );
	}

	public function render($atts, $content = null) {
		
		$default_atts = array(
			'type' => 'boxes',
            'number_of_posts' => '',
            'number_of_columns' => '',
            'image_size' => 'original',
            'order_by' => 'date',
            'order' => 'ASC',
            'category' => '',
            'title_tag' => 'h6',
			'text_length' => '90',
			'post_info_section' => 'yes',
			'post_info_category' => 'yes',
			'post_info_comments' => 'yes'		
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		$params['holder_classes'] = $this->getBlogHolderClasses($params);
	
		$queryArray = $this->generateBlogQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;	
     
		
        $thumbImageSize = $this->generateImageSize($params);
		$params['thumb_image_size'] = $thumbImageSize;

		$html = '';
        $html .= oxides_edge_get_shortcode_module_template_part('templates/blog-list-holder', 'blog-list', '', $params);
		return $html;
		
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getBlogHolderClasses($params){
		$holderClasses = '';
		
		$columnNumber = $this->getColumnNumberClass($params);
		
		if(!empty($params['type'])){
			switch($params['type']){
				case 'checkered':
					$holderClasses = 'edgtf-checkered';
					break;
				case 'boxes' : 
					$holderClasses = 'edgtf-boxes';
					break;
				default: 
					$holderClasses = 'edgtf-boxes';
			}
		}
		
		$holderClasses .= ' '.$columnNumber;
		
		return $holderClasses;
		
	}

	/** 
	   * Generates column classes for boxes type
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getColumnNumberClass($params){
		
		$columnsNumber = '';
		$type = $params['type'];
		$columns = $params['number_of_columns'];
		
        if ($type == 'boxes') {
            switch ($columns) {
                case 1:
                    $columnsNumber = 'edgtf-one-column';
                    break;
                case 2:
                    $columnsNumber = 'edgtf-two-columns';
                    break;
                case 3:
                    $columnsNumber = 'edgtf-three-columns';
                    break;
                case 4:
                    $columnsNumber = 'edgtf-four-columns';
                    break;
                default:
					$columnsNumber = 'edgtf-one-column';
                    break;
            }
        }
		return $columnsNumber;
	}

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateBlogQueryArray($params){
		
		$queryArray = array(
			'orderby' => $params['order_by'],
			'order' => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'category_name' => $params['category']
		);
		return $queryArray;
	}

	/**
	   * Generates image size option
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function generateImageSize($params){
		$thumbImageSize = '';
		$imageSize = $params['image_size'];
		
		if ($imageSize !== '' && $imageSize == 'landscape') {
            $thumbImageSize .= 'portfolio-landscape';
        } else if($imageSize === 'square'){
			$thumbImageSize .= 'portfolio-square';
		} else if ($imageSize !== '' && $imageSize == 'original') {
            $thumbImageSize .= 'full';
        }
		return $thumbImageSize;
	}
}