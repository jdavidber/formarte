<?php

class EdgeOxidesSideAreaOpener extends EdgeOxidesWidget {
    public function __construct() {
        parent::__construct(
            'edgtf_side_area_opener', // Base ID
            'Edge Side Area Opener' // Name
        );

        $this->setParams();
    }

    protected function setParams() {

		$this->params = array(
			array(
				'name'			=> 'side_area_opener_icon_color',
				'type'			=> 'textfield',
				'title'			=> 'Icon Color',
				'description'	=> 'Define color for Side Area opener icon'
			),
			array(
				'name'			=> 'side_area_opener_background_color',
				'type'			=> 'textfield',
				'title'			=> 'Background Color',
				'description'	=> 'Define background-color for Side Area opener'
			)
		);
    }

    public function widget($args, $instance) {
		
    	$sidearea_icon_styles = array();

    	if ( !empty($instance['side_area_opener_icon_color']) ) {
    		$sidearea_icon_styles[] = 'border-color: ' . $instance['side_area_opener_icon_color'];
    	}

    	if ( !empty($instance['side_area_opener_background_color']) ) {
    		$sidearea_icon_styles[] = 'background-color: ' . $instance['side_area_opener_background_color'];
    	}
    	
    	?>
        <a class="edgtf-side-menu-button-opener" <?php oxides_edge_inline_style($sidearea_icon_styles) ?> href="javascript:void(0)">
         	<span class="lines-holder">
	         	<span class="first line" <?php oxides_edge_inline_style($sidearea_icon_styles) ?>></span>
	            <span class="second line" <?php oxides_edge_inline_style($sidearea_icon_styles) ?>></span>
	            <span class="third line" <?php oxides_edge_inline_style($sidearea_icon_styles) ?>></span>
        	</span>
        </a>
    <?php }
}