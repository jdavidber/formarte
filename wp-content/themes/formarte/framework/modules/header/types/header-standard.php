<?php
namespace EdgeOxidesfModules\Header\Types;

use EdgeOxidesfModules\Header\Lib\HeaderType;

/**
 * Class that represents Header Standard layout and option
 *
 * Class HeaderStandard
 */
class HeaderStandard extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-standard';

        if(!is_admin()) {

            $menuAreaHeight       = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('menu_area_height_header_standard'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 88;
            $this->initialMenuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 88;

            $fixedAreaHeight       = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('menu_area_height_fixed_header'));
            $this->fixedAreaHeight = $fixedAreaHeight !== '' ? $fixedAreaHeight : 60;

            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('oxides_edge_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('oxides_edge_per_page_js_vars', array($this, 'getPerPageJSVariables'));

        }
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['menu_area_in_grid'] = oxides_edge_options()->getOptionValue('menu_area_in_grid_header_standard') == 'yes' ? true : false;

        $parameters = apply_filters('oxides_edge_header_standard_parameters', $parameters);

        oxides_edge_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->heightOfTransparency         = $this->calculateHeightOfTransparency();
        $this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
        $this->headerHeight                 = $this->calculateHeaderHeight();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $id = oxides_edge_get_page_id();
        $transparencyHeight = 0;

        if(get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true) !== ''){
            $menuAreaTransparent = get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true) !== '' &&
                                   get_post_meta($id, 'edgtf_menu_area_background_transparency_header_standard_meta', true) !== '1';
        } elseif(oxides_edge_options()->getOptionValue('menu_area_background_color_header_standard') == '') {
            $menuAreaTransparent = oxides_edge_options()->getOptionValue('menu_area_grid_background_color_header_standard') !== '' &&
                                   oxides_edge_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') !== '1';
        } else {
            $menuAreaTransparent = oxides_edge_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
                                   oxides_edge_options()->getOptionValue('menu_area_background_transparency_header_standard') !== '1';
        }

        if($menuAreaTransparent) {
            $transparencyHeight = $this->menuAreaHeight;
        }

        return $transparencyHeight;
    }

    /**
     * Returns height of completely transparent header parts
     *
     * @return int
     */
    public function calculateHeightOfCompleteTransparency() {
        $id = oxides_edge_get_page_id();
        $transparencyHeight = 0;

        if(get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true) !== ''){
            $menuAreaTransparent = get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true) !== '' &&
                                   get_post_meta($id, 'edgtf_menu_area_background_transparency_header_standard_meta', true) === '0';
        } elseif(oxides_edge_options()->getOptionValue('menu_area_background_color_header_standard') == '') {
            $menuAreaTransparent = oxides_edge_options()->getOptionValue('menu_area_grid_background_color_header_standard') !== '' &&
                                   oxides_edge_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') === '0';
        } else {
            $menuAreaTransparent = oxides_edge_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
                                   oxides_edge_options()->getOptionValue('menu_area_background_transparency_header_standard') === '0';
        }

        if($menuAreaTransparent) {
            $transparencyHeight = $this->menuAreaHeight;
        }

        return $transparencyHeight;
    }


    /**
     * Returns total height of header
     *
     * @return int|string
     */
    public function calculateHeaderHeight() {
        $headerHeight = $this->menuAreaHeight;
        if(oxides_edge_is_top_bar_enabled()) {
            $headerHeight += oxides_edge_get_top_bar_height();
        }

        return $headerHeight;
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['edgtfLogoAreaHeight'] = 0;
        $globalVariables['edgtfMenuAreaHeight'] = $this->headerHeight;
        $globalVariables['edgtfFixedAreaHeight'] = $this->fixedAreaHeight;
        $globalVariables['edgtfInitialMenuAreaHeight'] = $this->initialMenuAreaHeight;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {
        //calculate transparency height only if header has no sticky behaviour
        if(!in_array(oxides_edge_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            $perPageVars['edgtfHeaderTransparencyHeight'] = $this->headerHeight - (oxides_edge_get_top_bar_height() + $this->heightOfCompleteTransparency);
        }else{
            $perPageVars['edgtfHeaderTransparencyHeight'] = 0;
        }

        return $perPageVars;
    }
}