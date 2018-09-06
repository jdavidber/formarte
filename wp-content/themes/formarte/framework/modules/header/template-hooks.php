<?php

//top header bar
add_action('oxides_edge_before_page_header', 'oxides_edge_get_header_top');

//mobile header
add_action('oxides_edge_after_page_header', 'oxides_edge_get_mobile_header');