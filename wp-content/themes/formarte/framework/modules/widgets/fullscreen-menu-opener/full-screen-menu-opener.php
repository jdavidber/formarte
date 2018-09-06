<?php

class EdgeOxidesOxidesFullScreenMenuOpener extends EdgeOxidesWidget {
    public function __construct() {
        parent::__construct(
            'edgtf_full_screen_menu_opener', // Base ID
            'Edge Full Screen Menu Opener' // Name
        );

		$this->setParams();
    }

	protected function setParams() {

		$this->params = array(
			array(
				'name'			=> 'fullscreen_menu_opener_icon_color',
				'type'			=> 'textfield',
				'title'			=> 'Icon Color',
				'description'	=> 'Define color for Side Area opener icon'
			)
		);

	}

    public function widget($args, $instance) {
		global $oxides_edge_options;

		$fullscreen_icon_styles = array();

		if ( !empty($instance['fullscreen_menu_opener_icon_color']) ) {
			$fullscreen_icon_styles[] = 'background-color: ' . $instance['fullscreen_menu_opener_icon_color'];
		}

		?>
        <a href="javascript:void(0)" class="edgtf-fullscreen-menu-opener">
            <span class="edgtf-fullscreen-menu-opener-outer">
	            <span class="edgtf-fullscreen-menu-opener-inner">
	                <i class="edgtf-line" <?php oxides_edge_inline_style($fullscreen_icon_styles); ?>>&nbsp;</i>
	            </span>
	        </span>    
        </a>
    <?php }
}