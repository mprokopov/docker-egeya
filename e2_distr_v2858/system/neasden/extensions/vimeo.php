<?php

class NeasdenGroup_vimeo implements NeasdenGroup {

  function __construct ($neasden) {
  
    $neasden->define_line_class (
      'vimeo',
      'https?\:\/\/(?:www\.)?(?:(?:vimeo\.com\/))(\d+)'
    );
    $neasden->define_group ('vimeo', '(-vimeo-)(-p-)*');
  
  }
  
  function render ($group, $myconf) {
  
    $p = false;
  
    $result = '<div class="'. $myconf['css-class'] .'">'."\n";
    foreach ($group as $line) {
    
      if ($line['class'] == 'vimeo') {
      
        $id = $line['class-data'][1];
        $result .= (
          '<iframe width="'. $myconf['width'] .'" height="'. $myconf['height'] .'" '.
          'src="https://player.vimeo.com/video/'. $id .'?title=0&amp;byline=0&amp;portrait=0" '.
          'frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen>'.
          '</iframe>'.
          "\n"
        );
        
      } else {
      
        if (!$p) {
          $p = true;
          $result .= '<p>' . $line['content'];
        } else {
          $result .= '<br />' . "\n" . $line['content'];
        }
        
      }
      
    }
  
    $result .= '</div>'."\n";
  
    return $result;
    
  }
  
}

?>