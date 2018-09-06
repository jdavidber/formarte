<?php
if(!defined('ABSPATH')) exit;

class EdgeOxidesOxidesLatestPosts extends EdgeOxidesWidget {
	protected $params;
	public function __construct() {
		parent::__construct(
			'edgtf_latest_posts_widget', // Base ID
			'Edge Latest Post', // Name
			array( 'description' => esc_html__( 'Display posts from your blog', 'oxides' ), ) // Args
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
                'name' => 'widget_title',
                'type' => 'textfield',
                'title' => 'Widget Title'
            ),
			array(
				'name' => 'number_of_posts',
				'type' => 'textfield',
				'title' => 'Number of posts'
			),
			array(
				'name' => 'order_by',
				'type' => 'dropdown',
				'title' => 'Order By',
				'options' => array(
					'title' => 'Title',
					'date' => 'Date'
				)
			),
			array(
				'name' => 'order',
				'type' => 'dropdown',
				'title' => 'Order',
				'options' => array(
					'ASC' => 'ASC',
					'DESC' => 'DESC'
				)
			),
			array(
				'name' => 'category',
				'type' => 'textfield',
				'title' => 'Category Slug'
			),
			array(
				'name' => 'text_length',
				'type' => 'textfield',
				'title' => 'Number of characters'
			),
			array(
				'name' => 'title_tag',
				'type' => 'dropdown',
				'title' => 'Title Tag',
				'options' => array(
					""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",
					"h5" => "h5",
					"h6" => "h6"
				)
			),
			array(
				'name' => 'post_info_section',
				'type' => 'dropdown',
				'title' => 'Enable Post Info Section',
				'options' => array(
					'no' => 'No',
					'yes' => 'Yes'
				)
			)		
		);
	}

	public function getParams() {
		return $this->params;
	}

	public function widget($args, $instance) {
		extract($args);

		//prepare variables
		$content        = '';
		$params         = array();
		$params['type'] = 'boxes';
		$params['number_of_columns'] = '1';
		//is instance empty?
		if(is_array($instance) && count($instance)) {
			//generate shortcode params
			foreach($instance as $key => $value) {
				$params[$key] = $value;
			}
		}
		if(empty($params['title_tag'])){
			$params['title_tag'] = 'h6';
		}
		echo '<div class="widget edgtf-latest-posts-widget">';

		if(!empty($params['widget_title']) && $params['widget_title'] != '') {
			echo '<h6>'.$params['widget_title'].'</h6>';
		}
		
		echo oxides_edge_execute_shortcode('edgtf_blog_list', $params);

		echo '</div>'; //close edgtf-latest-posts-widget
	}
}