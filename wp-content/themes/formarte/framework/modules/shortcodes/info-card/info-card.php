<?php
namespace EdgeOxidesfModules\Shortcodes\InfoCard;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

class InfoCard implements ShortcodeInterface{

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_info_card';

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
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 */
	public function vcMap() {

		$info_card_initial_icons_array = array();
		$info_card_initial_IconCollections = oxides_edge_icon_collections()->iconCollections;
		foreach($info_card_initial_IconCollections as $collection_key => $collection) {

			$info_card_initial_icons_array[] = array(
				'type' => 'dropdown',
				'heading' => 'Initial Icon',
				'param_name' => 'initial_'.$collection->param,
				'value' => $collection->getIconsArray(),
				'save_always' => true,
				'dependency' => Array('element' => 'initial_icon_pack', 'value' => array($collection_key))
			);
		}

		$info_card_hover_icons_array = array();
		$info_card_hover_IconCollections = oxides_edge_icon_collections()->iconCollections;
		foreach($info_card_hover_IconCollections as $collection_key => $collection) {

			$info_card_hover_icons_array[] = array(
				'type' => 'dropdown',
				'heading' => 'Hover Icon',
				'param_name' => 'hover_'.$collection->param,
				'value' => $collection->getIconsArray(),
				'save_always' => true,
				'dependency' => Array('element' => 'hover_icon_pack', 'value' => array($collection_key))
			);
		}

		vc_map(array(
			'name' => esc_html__('Edge Info Card', 'oxides'),
			'base' => $this->getBase(),
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-info-card extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'dropdown',
						'heading' => 'Initial Icon Pack',
						'param_name' => 'initial_icon_pack',
						'value' => array_merge(array('No Icon' => ''),oxides_edge_icon_collections()->getIconCollectionsVC()),
						'save_always' => true
					)
				),
				$info_card_initial_icons_array,
				array(
					array(
						'type' => 'colorpicker',
						'heading' => 'Initial Icon Color',
						'param_name' => 'initial_icon_color',
						'description' => '',
						'group' => 'Design Options'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Initial Icon Size (px)',
						'param_name' => 'initial_icon_size',
						'description' => '',
						'group' => 'Design Options'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Initial Title',
						'param_name' => 'initial_title',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Initial Title Color',
						'param_name' => 'initial_title_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "initial_title", 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Initial Text',
						'param_name' => 'initial_text',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Initial Text Color',
						'param_name' => 'initial_text_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "initial_text", 'not_empty' => true)
					),
					array(
						'type'          => 'dropdown',
						'heading'       => 'Enable Initial Separator',
						'param_name'    => 'initial_separator',
						'value'         => array(
							'Yes'       => 'yes',
							'No'        => 'no'
						),
						'save_always'	=> true,
						'description'   => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Initial Separator Width (%)',
						'param_name' => 'initial_separator_width',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => array('element' => 'initial_separator', 'value' => 'yes')
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Initial Separator Color',
						'param_name' => 'initial_separator_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => array('element' => 'initial_separator', 'value' => 'yes')
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Initial Box Background Color',
						'param_name' => 'initial_background_color',
						'description' => '',
						'group' => 'Design Options'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Hover Icon Pack',
						'param_name' => 'hover_icon_pack',
						'value' => array_merge(array('No Icon' => ''),oxides_edge_icon_collections()->getIconCollectionsVC()),
						'save_always' => true
					),
				),
				$info_card_hover_icons_array,
				array(
					array(
						'type' => 'colorpicker',
						'heading' => 'Hover Icon Color',
						'param_name' => 'hover_icon_color',
						'description' => '',
						'group' => 'Design Options'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Hover Icon Size (px)',
						'param_name' => 'hover_icon_size',
						'description' => '',
						'group' => 'Design Options'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Hover Title',
						'param_name' => 'hover_title',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Hover Title Color',
						'param_name' => 'hover_title_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "initial_title", 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Hover Text',
						'param_name' => 'hover_text',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Hover Text Color',
						'param_name' => 'hover_text_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "initial_text", 'not_empty' => true)
					),
					array(
						'type'          => 'dropdown',
						'heading'       => 'Enable Hover Separator',
						'param_name'    => 'hover_separator',
						'value'         => array(
							'Yes'       => 'yes',
							'No'        => 'no'
						),
						'save_always'	=> true,
						'description'   => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Hover Separator Width (%)',
						'param_name' => 'hover_separator_width',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => array('element' => 'hover_separator', 'value' => 'yes')
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Hover Separator Color',
						'param_name' => 'hover_separator_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => array('element' => 'hover_separator', 'value' => 'yes')
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Hover Box Background Color',
						'param_name' => 'hover_background_color',
						'description' => '',
						'group' => 'Design Options'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Elements Text Align',
						'param_name' => 'text_align',
						'value' => array(
							'Center' => 'center',
							'Left' => 'left',
							'Right' => 'right'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Link',
						'param_name' => 'link',
						'description' => '',
						'admin_label' 	=> true
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Target',
						'param_name' => 'target',
						'value' => array(
							'Self' => '_self',
							'Blank' => '_blank'
						),
                        'save_always'	=> true,
						'description' => '',
						'dependency' => Array('element' => "link", 'not_empty' => true)
					)
				)
			)
		));

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$default_atts = array(
			'initial_icon_pack' => '',
			'initial_icon_color' => '',
			'initial_icon_size' => '',
			'initial_title' => '',
			'initial_title_color' => '',
			'initial_text' => '',
			'initial_text_color' => '',
			'initial_separator' => '',
			'initial_separator_width' => '',
			'initial_separator_color' => '',
			'initial_background_color' => '',
			'hover_icon_pack' => '',
			'hover_icon_color' => '',
			'hover_icon_size' => '',
			'hover_title' => '',
			'hover_title_color' => '',
			'hover_text' => '',
			'hover_text_color' => '',
			'hover_separator' => '',
			'hover_separator_width' => '',
			'hover_separator_color' => '',
			'hover_background_color' => '',
			'text_align' => 'center',
			'link' => '',
			'target' => '_self'
		);

		$info_card_initial_icon_fields = array();

		foreach (oxides_edge_icon_collections()->iconCollections as $collection_key => $collection) {
			$info_card_initial_icon_fields['initial_' . $collection->param ] = '';
		}

		$info_card_hover_icon_fields = array();

		foreach (oxides_edge_icon_collections()->iconCollections as $collection_key => $collection) {
			$info_card_hover_icon_fields['hover_' . $collection->param ] = '';
		}

		$default_atts = array_merge($default_atts, oxides_edge_icon_collections()->getShortcodeParams(), $info_card_initial_icon_fields, $info_card_hover_icon_fields);
        $params = shortcode_atts($default_atts, $atts);

		$params['icon_initial_params'] = $this->generateIconInitialParams($params);
		$params['title_initial_styles'] = $this->getTitleInitialStyle($params);
		$params['text_initial_styles'] = $this->getTextInitialStyle($params);
		$params['separator_initial_styles'] = $this->getSeparatorInitialStyle($params);

		$params['icon_hover_params'] = $this->generateIconHoverParams($params);
		$params['title_hover_styles'] = $this->getTitleHoverStyle($params);
		$params['text_hover_styles'] = $this->getTextHoverStyle($params);
		$params['separator_hover_styles'] = $this->getSeparatorHoverStyle($params);

		$params['content_styles'] = $this->getContentStyle($params);
		$params['content_initial_styles'] = $this->getContentInitialStyle($params);
		$params['content_hover_styles'] = $this->getContentHoverStyle($params);

		$html = oxides_edge_get_shortcode_module_template_part('templates/info-card-template', 'info-card', '', $params);

		return $html;
	}

	/**
     * Generates initial icon parameters array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconInitialParams($params) {
        $iconStyles = array();

		$iconStyles['icon_attributes']['style'] = $this->generateInitialIconStyles($params);
		$iconStyles['icon_attributes']['class'] = 'edgtf-info-card-icon edgtf-info-card-initial-icon';

		if($params['initial_icon_pack'] !== '') {
			$iconPackName = oxides_edge_icon_collections()->getIconCollectionParamNameByKey($params['initial_icon_pack']);
			$params['initial_icon'] = $params['initial_'.$iconPackName];
		}

		$info_card_initial_icon = '';
		if(!empty($params['initial_icon'])){			
			$info_card_initial_icon = oxides_edge_icon_collections()->renderIcon( $params['initial_icon'], $params['initial_icon_pack'], $iconStyles );
		}

		return $info_card_initial_icon;
    }

    /**
     * Generates icon initial styles array
     *
     * @param $params
     *
     * @return string
     */
    private function generateInitialIconStyles($params) {
        $iconInitialStyles = array();

        if(!empty($params['initial_icon_color'])) {
            $iconInitialStyles[] = 'color: '.$params['initial_icon_color'];
        }

        if(!empty($params['initial_icon_size'])) {
            $iconInitialStyles[] = 'font-size:'.oxides_edge_filter_px($params['initial_icon_size']).'px';
        }

        return implode(';', $iconInitialStyles);
    }
	
	/**
     * Generates hover icon parameters array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconHoverParams($params) {
        $iconStyles = array();

		$iconStyles['icon_attributes']['style'] = $this->generateHoverIconStyles($params);
		$iconStyles['icon_attributes']['class'] = 'edgtf-info-card-icon edgtf-info-card-hover-icon';

		if($params['hover_icon_pack'] !== '') {
			$iconPackName = oxides_edge_icon_collections()->getIconCollectionParamNameByKey($params['hover_icon_pack']);
			$params['hover_icon'] = $params['hover_'.$iconPackName];
		}

		$info_card_hover_icon = '';
		if(!empty($params['hover_icon'])){			
			$info_card_hover_icon = oxides_edge_icon_collections()->renderIcon( $params['hover_icon'], $params['hover_icon_pack'], $iconStyles );
		}

		return $info_card_hover_icon;
    }

    /**
     * Generates icon hover styles array
     *
     * @param $params
     *
     * @return string
     */
    private function generateHoverIconStyles($params) {
        $iconHoverStyles = array();

        if(!empty($params['hover_icon_color'])) {
            $iconHoverStyles[] = 'color: '.$params['hover_icon_color'];
        }

        if(!empty($params['hover_icon_size'])) {
            $iconHoverStyles[] = 'font-size:'.oxides_edge_filter_px($params['hover_icon_size']).'px';
        }

        return implode(';', $iconHoverStyles);
    }

	/**
	 * Return Info Card Title initial styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleInitialStyle($params) {
		$titleInitialStyle = array();

		if ($params['initial_title_color'] !== '') {
			$titleInitialStyle[] = 'color: ' . $params['initial_title_color'];
		}

		return implode(';', $titleInitialStyle);
	}

	/**
	 * Return Info Card Text initial styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextInitialStyle($params) {
		$textInitialStyle = array();

		if ($params['initial_text_color'] !== '') {
			$textInitialStyle[] = 'color: ' . $params['initial_text_color'];
		}

		return implode(';', $textInitialStyle);
	}

	/**
	 * Return Info Card Separator initial styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getSeparatorInitialStyle($params) {
		$separatorInitialStyle = array();

		if ($params['initial_separator_width'] !== '') {
			$separatorInitialStyle[] = 'width: ' . $params['initial_separator_width'] . '%';
		}

		if ($params['initial_separator_color'] !== '') {
			$separatorInitialStyle[] = 'background-color: ' . $params['initial_separator_color'];
		}

		return implode(';', $separatorInitialStyle);
	}

	/**
	 * Return Info Card Title hover styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleHoverStyle($params) {
		$titleHoverStyle = array();

		if ($params['hover_title_color'] !== '') {
			$titleHoverStyle[] = 'color: ' . $params['hover_title_color'];
		}

		return implode(';', $titleHoverStyle);
	}

	/**
	 * Return Info Card Text hover styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextHoverStyle($params) {
		$textHoverStyle = array();

		if ($params['hover_text_color'] !== '') {
			$textHoverStyle[] = 'color: ' . $params['hover_text_color'];
		}

		return implode(';', $textHoverStyle);
	}

	/**
	 * Return Info Card Separator hover styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getSeparatorHoverStyle($params) {
		$separatorHoverStyle = array();

		if ($params['hover_separator_width'] !== '') {
			$separatorHoverStyle[] = 'width: ' . $params['hover_separator_width'] . '%';
		}

		if ($params['hover_separator_color'] !== '') {
			$separatorHoverStyle[] = 'background-color: ' . $params['hover_separator_color'];
		}

		return implode(';', $separatorHoverStyle);
	}

	/**
	 * Return Info Card content styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentStyle($params) {
		$contentStyle = array();

		if ($params['text_align'] !== '') {
			$contentStyle[] = 'text-align: ' . $params['text_align'];
		}

		return implode(';', $contentStyle);
	}

	/**
	 * Return Info Card content styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentInitialStyle($params) {
		$contentStyle = array();

		if ($params['initial_background_color'] !== '') {
			$contentStyle[] = 'background-color: ' . $params['initial_background_color'];
		}

		return implode(';', $contentStyle);
	}

	/**
	 * Return Info Card content styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentHoverStyle($params) {
		$contentStyle = array();

		if ($params['hover_background_color'] !== '') {
			$contentStyle[] = 'background-color: ' . $params['hover_background_color'];
		}

		return implode(';', $contentStyle);
	}
}