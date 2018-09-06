<?php
use EdgeOxidesfModules\Header\Lib;

if(!function_exists('oxides_edge_set_header_object')) {
    function oxides_edge_set_header_object() {
        $header_type = 'header-standard';

        $object = Lib\HeaderFactory::getInstance()->build($header_type);

        if(Lib\HeaderFactory::getInstance()->validHeaderObject()) {
            $header_connector = new Lib\HeaderConnector($object);
            $header_connector->connect($object->getConnectConfig());
        }
    }

    add_action('wp', 'oxides_edge_set_header_object', 1);
}