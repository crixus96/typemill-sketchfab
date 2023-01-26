<?php

namespace Plugins\sketchfab;

use \Typemill\Plugin;
use \Typemill\Events\OnShortcodeFound;

class sketchfab extends Plugin
{

  protected $settings;

  # listen to the shortcode event
  public static function getSubscribedEvents()
  {
    return array(
      'onShortcodeFound' => 'onShortcodeFound'
    );
  }

  # if typemill found a shortcode and fires the event
  public function onShortcodeFound($shortcode)
  {
    # read the data of the shortcode
    $shortcodeArray = $shortcode->getData();

    # check if it is the shortcode name that we where looking for
    if(is_array($shortcodeArray) && $shortcodeArray['name'] == 'sketchfab')
    {
      # we found our shortcode, so stop firing the event to other plugins
      $shortcode->stopPropagation();

	  $htmltitle = isset($shortcodeArray['params']['title']) ? $shortcodeArray['params']['title'] : '';
      $htmlwidth = isset($shortcodeArray['params']['width']) ? $shortcodeArray['params']['width'] : '';
	  $htmlheight = isset($shortcodeArray['params']['height']) ? $shortcodeArray['params']['height'] : '';
	  $htmlsource = isset($shortcodeArray['params']['source']) ? $shortcodeArray['params']['source'] : '';
	  $html = '<div class="sketchfab-embed-wrapper"> <iframe title="' . $htmltitle . '" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share width="' . $htmlwidth . '" height="' . $htmlheight . '" src="' . $htmlsource . '/embed"> </iframe> </div>';

      # and return a html-snippet that replaces the shortcode on the page.
      $shortcode->setData($html); 
	  
    }
  }
}