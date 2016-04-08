<?php

global $settings, $full_blog_url;

return array (

  '__overload' => 'user/neasden/',
  
  '__profiles' => array (
    'full' => array (
      'html.on' => true,
      'groups.on' => true,
      'typography.markup' => true,
      'typography.autohref' => true,
      'banned-groups' => array (),
    ),
    'simple' => array (
      'html.on' => false,
      'groups.on' => true,
      'typography.markup' => true,
      'typography.autohref' => true,
      'typography.nofollowhrefs' => true,
      'banned-groups' => array (
        'picture', 'fotorama', 'audio', 'youtube', 'vimeo'
      ),
    ),
    'kavychki' => array (
      'html.on' => true,
      'html.code.on' => false,
      'groups.on' => false,
      'typography.markup' => false,
      'typography.autohref' => false,
    ),
 ),
    
  'library' => 'system/library/',
  
  'language' => 'ru',
  
  'html.on' => true,
  'html.elements.opaque' => 'div p ul ol li blockquote table pre textarea',
  'html.elements.sacred' => 'object embed iframe head link script style code',

  'html.code.on' => true,
  'html.code.wrap' => array ('<pre class="e2-text-code"><code>', '</code></pre>'),  
  'html.code.highlightjs' => true,

  'groups.on' => true,
  'groups.headings.char'  => '#',
  'groups.headings.plus'  => 1,
  'groups.quotes.char' => '>',
  'groups.lists.chars' => array ('-', '*'),
  'groups.generic-css-class' => 'e2-text-generic-object',
  'groups.classes' => array (
    'picture' => array (
      'src-prefix' => $full_blog_url .'/',
      'folder' => PICTURES_FOLDER,
      'css-class' => 'e2-text-picture', // see also var csscPrefix in scaleimage.js
      'max-width' => $settings['max-image-width'],
      'scaled-img-folder' => SCALED_IMAGES_FOLDER,
      'scaled-img-provider' => '?go=@scale-image:',
      'scaled-img-extension' => 'scaled.jpg',
      'scaled-img-link-to-original' => true,
      'scaled-img-link-to-original-class' => 'link-to-big-picture',
    ),
    'fotorama' => array (
      'src-prefix' => $full_blog_url .'/',
      'folder' => PICTURES_FOLDER,
      'css-class' => 'e2-text-picture', // see also var csscPrefix in scaleimage.js
      'max-width' => $settings['max-image-width'],
    ),
    'table' => array (
      'css-class' => 'e2-text-table',
    ),
    'youtube' => array (
      'css-class' => 'e2-text-video',
      'width' => $settings['max-image-width'],
      'height' => round ($settings['max-image-width'] / 1.6),
    ),
    'vimeo' => array (
      'css-class' => 'e2-text-video',
      'width' => $settings['max-image-width'],
      'height' => round ($settings['max-image-width'] / 1.6),
    ),
    'audio' => array (
      'css-class' => 'e2-text-audio',
      'src-prefix' => $full_blog_url .'/',
      'folder' => AUDIO_FOLDER,
    ),
  ),
  
  'typography.on' => true,
  'typography.markup' => true,
  'typography.autohref' => true,
  'typography.nofollowhrefs' => false,
  'typography.cleanup' => array (
    '&nbsp;' => ' ',
    '&laquo;' => '«',
    '&raquo;' => '»',
    '&bdquo;' => '„',
    '&ldquo;' => '“',
    '&rdquo;' => '”',
  ),

); ?>