<?php
namespace EdgeOxidesfModules\Tabs;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */

class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'edgtf_tabs';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Edge Tabs', 'oxides'),
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'edgtf_tab'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-tabs extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin-label' => true,
					'heading' => 'Style',
					'param_name' => 'style',
					'value' => array(
						'Horizontal' => 'horizontal_tab',
						'Horizontal Boxed' => 'horizontal_tab_boxed',
						'Horizontal Full Width' => 'horizontal_tab_full_width',
						'Vertical' => 'vertical_tab'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'admin-label' => true,
					'heading' => 'Title Style',
					'param_name' => 'title_style',
					'value' => array(
						'Default' => '',
						'White' => 'edgtf-title-tab-white'
					),
					'description' => '',
					'dependency'  => array('element' => 'style', 'value' => array('horizontal_tab'))
				),
				array(
					'type' => 'dropdown',
					'admin-label' => true,
					'heading' => 'Title Layout',
					'param_name' => 'title_layout',
					'value' => array(
						'Without Icon' => 'without_icon',
						'With Icon' => 'with_icon',
						'Only Icon' => 'only_icon'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
                    'type'       => 'textfield',
                    'heading'    => 'Tab Area Title',
                    'param_name' => 'tab_area_title',
                    'description' => 'Default label for tab title area is SPECIAL PORTFOLIO DESIGN.',
                    'dependency'  => array('element' => 'style', 'value' => array('horizontal_tab_full_width'))
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Tab Area Title Font Size (px)',
                    'param_name' => 'tab_title_font_size',
                    'description' => '',
                    'group'      => 'Design Options',
                    'dependency'  => array('element' => 'style', 'value' => array('horizontal_tab_full_width'))
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => 'Tab Area Title Color',
                    'param_name' => 'tab_title_font_color',
                    'description' => '',
                    'group'      => 'Design Options',
                    'dependency'  => array('element' => 'style', 'value' => array('horizontal_tab_full_width'))
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Title Font Size (px)',
                    'param_name' => 'title_font_size',
                    'description' => '',
                    'group'      => 'Design Options'
                ),
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'style' => 'horizontal_tab',
			'title_style' => '',
			'title_layout' => 'without_icon',
			'title_font_size' => '',
			'tab_area_title' => 'SPECIAL PORTFOLIO DESIGN',
			'tab_title_font_size' => '',
			'tab_title_font_color' => ''
		);
		
		$args = array_merge($args, oxides_edge_icon_collections()->getShortcodeParams());
        $params  = shortcode_atts($args, $atts);
		
		extract($params);

		// Extract tab titles
		preg_match_all('/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 *
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['tabs_titles'] = $tab_title_array;
		$params['tab_class'] = $this->getTabClass($params);
		$params['tab_title_layout'] = $this->getTabTitleLayoutClass($params);
		$params['title_styles'] = $this->getTitleStyle($params);
		$params['title_class'] = $params['title_style'];
		$params['tab_title_styles'] = $this->getTabTitleStyle($params);
		$params['content'] = $content;
		
		$output = '';
		
		$output .= oxides_edge_get_shortcode_module_template_part('templates/tab-template','tabs', '', $params);
		
		return $output;
	}
		
	/**
	   * Generates tabs class
	   *
	   * @param $params
	   *
	   * @return string
	   */
	private function getTabClass($params){
		$tabStyle = $params['style'];
		$tabClass = '';
		
		switch ($tabStyle) {
			case 'vertical_tab':
				$tabClass = 'edgtf-vertical-tab';
				break;
			case 'horizontal_tab_boxed':
				$tabClass = 'edgtf-horizontal-tab edgtf-boxed-tab';
				break;	
			case 'horizontal_tab_full_width':
				$tabClass = 'edgtf-horizontal-tab edgtf-full-width-tab';
				break;	
			default :
				$tabClass = 'edgtf-horizontal-tab';
				break;
		}

		return $tabClass;
	}

	/**
	   * Generates tabs class when icon is enabled
	   *
	   * @param $params
	   *
	   * @return string
	   */
	private function getTabTitleLayoutClass($params){
		$tabTitleLayout = $params['title_layout'];
		$tabIconClass = '';

		switch ($tabTitleLayout) {
			case 'with_icon':
				$tabIconClass = 'edgtf-tab-with-icon';
				break;
			case 'only_icon':
				$tabIconClass = 'edgtf-tab-only-icon';
				break;
			default :
				$tabIconClass = 'edgtf-tab-without-icon';
				break;
		}

		return $tabIconClass;
	}

	/**
	 * Return tabs Title styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleStyle($params) {
		$titleStyle = array();

		if ($params['title_font_size'] !== '') {
			$titleStyle[] = 'font-size: '.oxides_edge_filter_px($params['title_font_size']).'px';
		}

		return implode(';', $titleStyle);
	}

	/**
	 * Return tab area Title styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTabTitleStyle($params) {
		$tabTitleStyle = array();

		if ($params['tab_title_font_size'] !== '') {
			$tabTitleStyle[] = 'font-size: '.oxides_edge_filter_px($params['tab_title_font_size']).'px';
		}

		if ($params['tab_title_font_color'] !== '') {
			$tabTitleStyle[] = 'color: '.$params['tab_title_font_color'];
		}

		return implode(';', $tabTitleStyle);
	}
}