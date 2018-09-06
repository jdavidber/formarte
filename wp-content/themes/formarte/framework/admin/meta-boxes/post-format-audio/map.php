<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = oxides_edge_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Audio Post Format',
		'name' 	=> 'post-format-audio-meta'
	)
);

oxides_edge_add_meta_box_field(
	array(
		'name'        => 'edgtf_post_audio_link_meta',
		'type'        => 'text',
		'label'       => 'Link',
		'description' => 'Enter audion link',
		'parent'      => $audio_post_format_meta_box,

	)
);
