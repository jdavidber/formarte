<?php
if (!function_exists ('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
class Edge_Import {

    public $message = "";
    public $attachments = false;
    function Edge_Import() {
        add_action('admin_menu', array(&$this, 'edgt_admin_import'));
        add_action('admin_init', array(&$this, 'oxides_edge_register_theme_settings'));

    }
    function oxides_edge_register_theme_settings() {
        register_setting( 'edgt_options_import_page', 'edgt_options_import');
    }

    function init_edgt_import() {
        if(isset($_REQUEST['import_option'])) {
            $import_option = $_REQUEST['import_option'];
            if($import_option == 'content'){
                $this->import_content('proya_content.xml');
            }elseif($import_option == 'custom_sidebars') {
                $this->import_custom_sidebars('custom_sidebars.txt');
            } elseif($import_option == 'widgets') {
                $this->import_widgets('widgets.txt','custom_sidebars.txt');
            } elseif($import_option == 'options'){
                $this->import_options('options.txt');
            }elseif($import_option == 'menus'){
                $this->import_menus('menus.txt');
            }elseif($import_option == 'settingpages'){
                $this->import_settings_pages('settingpages.txt');
            }elseif($import_option == 'complete_content'){
                $this->import_content('proya_content.xml');
                $this->import_options('options.txt');
                $this->import_widgets('widgets.txt','custom_sidebars.txt');
                $this->import_menus('menus.txt');
                $this->import_settings_pages('settingpages.txt');
                $this->message = esc_html__("Content imported successfully", "oxides");
            }
        }
    }

    public function import_content($file){
        if (!class_exists('WP_Importer')) {
            ob_start();
            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            require_once($class_wp_importer);
            require_once(EDGE_CORE_ABS_PATH . '/import/class.wordpress-importer.php');
            $edgt_import = new WP_Import();
            set_time_limit(0);

            $edgt_import->fetch_attachments = $this->attachments;
            $returned_value = $edgt_import->import($file);
            if(is_wp_error($returned_value)){
                $this->message = esc_html__("An Error Occurred During Import", "oxides");
            }
            else {
                $this->message = esc_html__("Content imported successfully", "oxides");
            }
            ob_get_clean();
        } else {
            $this->message = esc_html__("Error loading files", "oxides");
        }
    }

    public function import_widgets($file, $file2){
        $this->import_custom_sidebars($file2);
        $options = $this->file_options($file);
        foreach ((array) $options['widgets'] as $edgt_widget_id => $edgt_widget_data) {
            update_option( 'widget_' . $edgt_widget_id, $edgt_widget_data );
        }
        $this->import_sidebars_widgets($file);
        $this->message = esc_html__("Widgets imported successfully", "oxides");
    }

    public function import_sidebars_widgets($file){
        $edgt_sidebars = get_option("sidebars_widgets");
        unset($edgt_sidebars['array_version']);
        $data = $this->file_options($file);
        if ( is_array($data['sidebars']) ) {
            $edgt_sidebars = array_merge( (array) $edgt_sidebars, (array) $data['sidebars'] );
            unset($edgt_sidebars['wp_inactive_widgets']);
            $edgt_sidebars = array_merge(array('wp_inactive_widgets' => array()), $edgt_sidebars);
            $edgt_sidebars['array_version'] = 2;
            wp_set_sidebars_widgets($edgt_sidebars);
        }
    }

    public function import_custom_sidebars($file){
        $options = $this->file_options($file);
        update_option( 'edgt_sidebars', $options);
        $this->message = esc_html__("Custom sidebars imported successfully", "oxides");
    }

    public function import_options($file){
        $options = $this->file_options($file);
        update_option( 'edgtf_options_oxides', $options);
        $this->message = esc_html__("Options imported successfully", "oxides");
    }

    public function import_menus($file){
        global $wpdb;
        $edgt_terms_table = $wpdb->prefix . "terms";
        $this->menus_data = $this->file_options($file);
        $menu_array = array();
        foreach ($this->menus_data as $registered_menu => $menu_slug) {
            $term_rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $edgt_terms_table where slug=%s", $menu_slug), ARRAY_A);
            if(isset($term_rows[0]['term_id'])) {
                $term_id_by_slug = $term_rows[0]['term_id'];
            } else {
                $term_id_by_slug = null;
            }
            $menu_array[$registered_menu] = $term_id_by_slug;
        }
        set_theme_mod('nav_menu_locations', array_map('absint', $menu_array ) );

    }
    public function import_settings_pages($file){
        $pages = $this->file_options($file);
        foreach($pages as $edgt_page_option => $edgt_page_id){
            update_option( $edgt_page_option, $edgt_page_id);
        }
    }

    public function file_options($file){
        $file_content = "";
        $file_for_import = get_template_directory() . '/includes/import/files/' . $file;

        $file_content = $this->edgt_file_contents($file);
        if ($file_content) {
            $unserialized_content = unserialize(base64_decode($file_content));
            if ($unserialized_content) {
                return $unserialized_content;
            }
        }
        return false;
    }

    function edgt_file_contents( $path ) {
		$url      = "http://export.edge-themes.com/".$path;
		$response = wp_remote_get($url);
		$body     = wp_remote_retrieve_body($response);
		return $body;
    }

    function edgt_admin_import() {
        if(edgt_core_theme_installed()) {
	        global $oxides_edgeFramework;
	
			$slug = "_tabimport";
			$this->pagehook = add_submenu_page(
				'oxides_edge_theme_menu',
				'Edge Options - Edge Import',                   // The value used to populate the browser's title bar when the menu page is active
				'Import',                   // The text of the menu in the administrator's sidebar
				'administrator',                  // What roles are able to access the menu
				'edgt_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
				array($oxides_edgeFramework->getSkin(), 'renderImport')
			);
	
	        add_action('admin_print_scripts-'.$this->pagehook, 'oxides_edge_enqueue_admin_scripts');
	        add_action('admin_print_styles-'.$this->pagehook, 'oxides_edge_enqueue_admin_styles');
	        //$this->pagehook = add_menu_page('Edge Import', 'Edge Import', 'manage_options', 'edgt_options_import_page', array(&$this, 'edgt_generate_import_page'),'dashicons-download');
        }
    }

}

function edgt_init_import_object(){
	global $oxides_edge_import_object;
	$oxides_edge_import_object = new Edge_Import();
}

add_action('init', 'edgt_init_import_object');



if(!function_exists('edgt_dataImport')){
    function edgt_dataImport(){
        global $oxides_edge_import_object;

        if ($_POST['import_attachments'] == 1)
            $oxides_edge_import_object->attachments = true;
        else
            $oxides_edge_import_object->attachments = false;

        $folder = "bodega1/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $oxides_edge_import_object->import_content($folder.$_POST['xml']);

        die();
    }

    add_action('wp_ajax_edgt_dataImport', 'edgt_dataImport');
}

if(!function_exists('edgt_widgetsImport')){
    function edgt_widgetsImport(){
        global $oxides_edge_import_object;

        $folder = "bodega1/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $oxides_edge_import_object->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');

        die();
    }

    add_action('wp_ajax_edgt_widgetsImport', 'edgt_widgetsImport');
}

if(!function_exists('edgt_optionsImport')){
    function edgt_optionsImport(){
        global $oxides_edge_import_object;

        $folder = "bodega1/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $oxides_edge_import_object->import_options($folder.'options.txt');

        die();
    }

    add_action('wp_ajax_edgt_optionsImport', 'edgt_optionsImport');
}

if(!function_exists('edgt_otherImport')){
    function edgt_otherImport(){
        global $oxides_edge_import_object;

        $folder = "bodega1/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $oxides_edge_import_object->import_options($folder.'options.txt');
        $oxides_edge_import_object->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');
        $oxides_edge_import_object->import_menus($folder.'menus.txt');
        $oxides_edge_import_object->import_settings_pages($folder.'settingpages.txt');

        die();
    }

    add_action('wp_ajax_edgt_otherImport', 'edgt_otherImport');
}