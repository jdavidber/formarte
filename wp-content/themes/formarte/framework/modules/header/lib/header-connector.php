<?php
namespace EdgeOxidesfModules\Header\Lib;
/**
 * Class EdgeHeaderConnector
 *
 * Connects header module with other modules
 */
class HeaderConnector {
    /**
     * @param HeaderType $object
     */
    public function __construct(HeaderType $object) {
        $this->object = $object;
    }

    /**
     * Connects given object with other modules based on pased config
     *
     * @param array $config
     */
    public function connect($config = array()) {
        do_action('oxides_edge_pre_header_connect');

        $defaultConfig = array(
            'affect_content' => true,
            'affect_title'   => true
        );

        if(is_array($config) && count($config)) {
            $config = array_merge($defaultConfig, $config);
        }

        if(!empty($config['affect_content'])) {
            add_filter('oxides_edge_content_elem_style_attr', array($this, 'contentMarginFilter'));
        }

        if(!empty($config['affect_title'])) {
            add_filter('oxides_edge_title_content_padding', array($this, 'titlePaddingFilter'));
        }

        do_action('oxides_edge_after_header_connect');
    }

    /**
     * Adds margin-top property to content element based on height of transparent parts of header
     *
     * @param $styles
     *
     * @return array
     */
    public function contentMarginFilter($styles) {
        $id = oxides_edge_get_page_id();
        $marginTopValue = $this->object->getHeightOfTransparency();

        if(get_post_meta($id, 'edgtf_page_slider_meta', true) !== '' && get_post_meta($id, 'edgtf_page_slider_meta_position', true) === 'yes') {
            $marginTopValue = $this->object->getHeaderHeight();
        }

        if(!empty($marginTopValue)) {
            $styles[] = 'margin-top: -'.$marginTopValue.'px';
        }

        return $styles;
    }

    /**
     * Returns padding value calculated from transparent header parts.
     *
     * Hooks to oxides_edge_title_content_padding filter
     *
     * @return int
     */
    public function titlePaddingFilter() {
        $heightOfTransparency = $this->object->getHeightOfTransparency();

        return !empty($heightOfTransparency) ? $heightOfTransparency : '';
    }
}