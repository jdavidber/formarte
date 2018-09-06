<?php

    // Load the embedded Redux Framework
    if ( file_exists( get_template_directory() . '/admin/redux-framework/framework.php' ) ) {
        require_once get_template_directory() . '/admin/redux-framework/framework.php';
    }

    // Load the theme/plugin options
    if ( file_exists( get_template_directory() . '/admin/options-init.php' ) ) {
        require_once get_template_directory() . '/admin/options-init.php';
    }