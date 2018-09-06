<?php
class EdgefOxidesLike {

	private static $instance;

	private function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts'));
		add_action('wp_ajax_oxides_edge_like', array( $this, 'ajax'));
		add_action('wp_ajax_nopriv_oxides_edge_like', array( $this, 'ajax'));
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	}

	function enqueue_scripts() {

		wp_enqueue_script( 'edgtf-like', EDGE_ASSETS_ROOT . '/js/like.min.js', 'jquery', '1.0', TRUE );

		wp_localize_script( 'edgtf-like', 'edgtfLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}

	function ajax(){

		//update
		if( isset($_POST['likes_id']) ) {

			$post_id = str_replace('edgtf-like-', '', $_POST['likes_id']);
			$type    = isset($_POST['type']) ? $_POST['type'] : '';

			echo wp_kses($this->like_post($post_id, 'update', $type), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}

		//get
		else {
			$post_id = str_replace('edgtf-like-', '', $_POST['likes_id']);
			echo wp_kses($this->like_post($post_id, 'get'), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}
		exit;
	}

	public function like_post($post_id, $action = 'get', $type = ''){
		if(!is_numeric($post_id)) return;

		switch($action) {

			case 'get':
				$like_count = get_post_meta($post_id, '_edgt-like', true);
				
				$icon = '<i class="icon_profile" aria-hidden="true"></i>';

				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_edgt-like', $like_count, true);
				}

				if($like_count < 2) {
					$return_value = $icon . "<span>" . $like_count . "</span><span class='edgtf-like-text'>".esc_html__('Like','oxides')."</span>";
				} else {
					$return_value = $icon . "<span>" . $like_count . "</span><span class='edgtf-like-text'>".esc_html__('Likes','oxides')."</span>";	
				}

				return $return_value;
				break;

			case 'update':
				$like_count = get_post_meta($post_id, '_edgt-like', true);

				if(isset($_COOKIE['edgtf-like_'. $post_id])) {
					return $like_count;
				}

				$like_count++;

				update_post_meta($post_id, '_edgt-like', $like_count);
				setcookie('edgtf-like_'. $post_id, $post_id, time()*20, '/');

				if($like_count < 2) {
					$return_value = "<i class='icon_profile' aria-hidden='true'></i><span>" . $like_count . "</span><span class='edgtf-like-text'>".esc_html__('Like','oxides')."</span>";
				} else {
					$return_value = "<i class='icon_profile' aria-hidden='true'></i><span>" . $like_count . "</span><span class='edgtf-like-text'>".esc_html__('Likes','oxides')."</span>";	
				}

				return $return_value;

				break;
			default:
				return '';
				break;
		}
	}

	public function add_like() {
		global $post;

		$output = $this->like_post($post->ID);

		$class = 'edgtf-like';
		$title = esc_html__('Like this', 'oxides');
		if( isset($_COOKIE['edgtf-like_'. $post->ID]) ){
			$class = 'edgtf-like liked';
			$title = esc_html__('You already like this!', 'oxides');
		}

		return '<a href="#" class="'. $class .'" id="edgtf-like-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}
}

global $oxides_edge_like;
$oxides_edge_like = EdgefOxidesLike::get_instance();