<?php
/**
 * Plugin class
 */
namespace Phile\Plugin\Phile\InlineImage;
use Phile\Exception;

/**
 * Add custom variables in your content before it is parsed.
 */
class Plugin extends \Phile\Plugin\AbstractPlugin implements \Phile\Gateway\EventObserverInterface {

	public function __construct() {
		\Phile\Event::registerEvent('after_parse_content', $this);
	}

	public function on($eventKey, $data = null) {
		if ($eventKey == 'after_parse_content') {
			// check and see if the folder exists
			if (!is_dir(ROOT_DIR . $this->settings['images_dir'])) {
				throw new Exception("The path ".$this->settings['images_dir']." in the PhileInlineImage config does not exists or is not a directory.");
			}
			// store the starting content
			$content = $data['content'];
			// find the path for images
			$path = \Phile\Utility::getBaseUrl() . '/' . $this->settings['images_dir'];
			// this parse happens after the markdown
			// which means that the potential image is wrapped
			// in p tags
			$regex = "/(<p>)(.*?)\.(jpg|jpeg|png|gif|webp|svg)+(<\/p>)/i";
			// main feature of the plugin, wrapping image names in HTML
			$replace = "\n" . '<' . $this->settings['wrap_element'] . ' class="' . $this->settings['wrap_class'] . '">' . "\n\t" . '<img src="' . $path . '$2.$3">' . "\n" . '</' . $this->settings['wrap_element'] . '>';
			// add the modified content back in the data
			$data['content'] = preg_replace($regex, $replace, $content);
		}
	}
}
