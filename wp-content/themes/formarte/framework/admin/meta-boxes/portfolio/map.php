<?php

$edgt_pages = array();
$pages = get_pages(); 
foreach($pages as $page) {
	$edgt_pages[$page->ID] = $page->post_title;
}

global $oxides_edgeIconCollections;

//Portfolio Images

$edgtPortfolioImages = new EdgeOxidesMetaBox("portfolio-item", "Portfolio Images (multiple upload)");
$oxides_edgeFramework->edgtMetaBoxes->addMetaBox("portfolio_images",$edgtPortfolioImages);

	$edgt_portfolio_image_gallery = new EdgeOxidesMultipleImages("edgt_portfolio-image-gallery","Portfolio Images","Choose your portfolio images");
	$edgtPortfolioImages->addChild("edgt_portfolio-image-gallery",$edgt_portfolio_image_gallery);

//Portfolio Images/Videos 2

$edgtPortfolioImagesVideos2 = new EdgeOxidesMetaBox("portfolio-item", "Portfolio Images/Videos (single upload)");
$oxides_edgeFramework->edgtMetaBoxes->addMetaBox("portfolio_images_videos2",$edgtPortfolioImagesVideos2);

	$edgt_portfolio_images_videos2 = new EdgeOxidesImagesVideosFramework("Portfolio Images/Videos 2","ThisIsDescription");
	$edgtPortfolioImagesVideos2->addChild("edgt_portfolio_images_videos2",$edgt_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$edgtAdditionalSidebarItems = new EdgeOxidesMetaBox("portfolio-item", "Additional Portfolio Sidebar Items");
$oxides_edgeFramework->edgtMetaBoxes->addMetaBox("portfolio_properties",$edgtAdditionalSidebarItems);

	$edgt_portfolio_properties = new EdgeOxidesOptionsFramework("Portfolio Properties","ThisIsDescription");
	$edgtAdditionalSidebarItems->addChild("edgt_portfolio_properties",$edgt_portfolio_properties);

