<?php

class NeasdenGroup_youtube implements NeasdenGroup {

  function __construct ($neasden) {
  
    $neasden->define_line_class (
      'youtube',
      'https?\:\/\/(?:www\.)?(?:(?:youtube\.com\/watch\/?\?v\=)|(?:youtu\.be\/))(.{11})([&#?].*)?'
    );
    $neasden->define_group ('youtube', '(-youtube-)(-p-)*');
  
  }
  
  function render ($group, $myconf) {
  
    $p = false;
  
    $result = '<div class="'. $myconf['css-class'] .'">'."\n";
    foreach ($group as $line) {
    
      if ($line['class'] == 'youtube') {
      
        $id = $line['class-data'][1];
        $result .= (
          '<iframe width="'. $myconf['width'] .'" height="'. $myconf['height'] .'" '.
          'src="https://www.youtube.com/embed/'. $id .'" frameborder="0" allowfullscreen>'.
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