<?php

namespace EdgeOxidesfModules\Shortcodes\Lib;

use EdgeOxidesfModules\CallToAction\CallToAction;
use EdgeOxidesfModules\Counter\Countdown;
use EdgeOxidesfModules\Counter\Counter;
use EdgeOxidesfModules\ElementsHolder\ElementsHolder;
use EdgeOxidesfModules\ElementsHolderItem\ElementsHolderItem;
use EdgeOxidesfModules\GoogleMap\GoogleMap;
use EdgeOxidesfModules\Separator\Separator;
use EdgeOxidesfModules\PieCharts\PieChartBasic\PieChartBasic;
use EdgeOxidesfModules\Shortcodes\CarouselWithImageAndText\CarouselWithImageAndText;
use EdgeOxidesfModules\Shortcodes\CarouselWithImageAndTextSingle\CarouselWithImageAndTextSingle;
use EdgeOxidesfModules\Shortcodes\Icon\Icon;
use EdgeOxidesfModules\Shortcodes\IconWithSeparator\IconWithSeparator;
use EdgeOxidesfModules\Shortcodes\ImageGallery\ImageGallery;
use EdgeOxidesfModules\Shortcodes\SingleProduct\SingleProduct;
use EdgeOxidesfModules\SocialShare\SocialShare;
use EdgeOxidesfModules\Team\Team;
use EdgeOxidesfModules\OrderedList\OrderedList;
use EdgeOxidesfModules\UnorderedList\UnorderedList;
use EdgeOxidesfModules\Message\Message;
use EdgeOxidesfModules\ProgressBar\ProgressBar;
use EdgeOxidesfModules\IconListItem\IconListItem;
use EdgeOxidesfModules\Tabs\Tabs;
use EdgeOxidesfModules\Tab\Tab;
use EdgeOxidesfModules\PricingTables\PricingTables;
use EdgeOxidesfModules\PricingTable\PricingTable;
use EdgeOxidesfModules\Accordion\Accordion;
use EdgeOxidesfModules\AccordionTab\AccordionTab;
use EdgeOxidesfModules\BlogList\BlogList;
use EdgeOxidesfModules\Shortcodes\Button\Button;
use EdgeOxidesfModules\Blockquote\Blockquote;
use EdgeOxidesfModules\CustomFont\CustomFont;
use EdgeOxidesfModules\Highlight\Highlight;
use EdgeOxidesfModules\VideoButton\VideoButton;
use EdgeOxidesfModules\Dropcaps\Dropcaps;
use EdgeOxidesfModules\Shortcodes\IconWithText\IconWithText;
use EdgeOxidesfModules\Shortcodes\CircleCarousel\CircleCarousel;
use EdgeOxidesfModules\Shortcodes\InfoCard\InfoCard;
use EdgeOxidesfModules\Shortcodes\FlyingDeck\FlyingDeck;
use EdgeOxidesfModules\Shortcodes\ScrollingImage\ScrollingImage;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader
{
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new Team());
		$this->addShortcode(new Icon());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new Message());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Separator());
		$this->addShortcode(new VideoButton());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new IconWithText());
        $this->addShortcode(new IconWithSeparator());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new CarouselWithImageAndText());
		$this->addShortcode(new CarouselWithImageAndTextSingle());
		$this->addShortcode(new CircleCarousel());
		$this->addShortcode(new InfoCard());
		$this->addShortcode(new SingleProduct());
		$this->addShortcode(new FlyingDeck());
		$this->addShortcode(new ScrollingImage());
	}
	
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();