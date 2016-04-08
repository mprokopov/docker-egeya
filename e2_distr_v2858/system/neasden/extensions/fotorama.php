<?php

class NeasdenGroup_fotorama implements NeasdenGroup {

  private $neasden = null;
  
  function __construct ($neasden) {
    $this->neasden = $neasden;

    $neasden->require_line_class ('picture');
    $neasden->define_line_class ('fotorama-settings', '\[thumbs\]|\[fotorama .*\]');

    $neasden->define_group ('fotorama', '(-picture-){2,}(-fotorama-settings-)?(-p-)*');
  }

  function render ($group, $myconf) {
    
    $this->neasden->require_link (SYSTEM_LIBRARY_FOLDER .'fotorama/fotorama.css');
    $this->neasden->require_link (SYSTEM_LIBRARY_FOLDER .'fotorama/fotorama.js');
    
    $result = '<div class="'. $myconf['css-class'] .'">'."\n";
    $p_opened = false;
    $div_opened = false;

    foreach ($group as $line) {

      if ($line['class'] == 'picture') {
    
        list ($filebasename, $alt) = explode (' ', $line['content'].' ', 2);
        $alt = trim ($alt); // usafe
        
        $this->neasden->resource_detected ($filebasename);
        
        $filename = $myconf['folder'] . $filebasename;

        $size = getimagesize ($filename);
        list ($width, $height) = $size;

        if (substr ($filebasename, strrpos ($filebasename, '.') - 3, 3) == '@2x') {
          if (! ($width%2 or $height%2)) {
            $width /= 2;
            $height /= 2;
          }
        }  
    
        if ($width > $myconf['max-width']) {
          $height = $height * ($myconf['max-width'] / $width);
          $width = $myconf['max-width'];
        }
    
        $image_html = (
          '<img src="'. $myconf['src-prefix'] . $filename .'" '.
          'width="'. $width .'" height="'. $height.'" '.
          'data-caption="'. $alt.'" '.
          'alt="'. $alt .'" />'. "\n"
        );
        
        if (!$div_opened) {
          $result .= (
            '<div class="fotorama" '.
              'data-width="'. $width .'" '.
              'data-ratio="'. ($width / $height) .'"'.
            '>'."\n"
          );
          $div_opened = true;
        }
    
        $result .= $image_html;

      } elseif ($line['class'] == 'fotorama-settings') {

        $settings = substr ($line['content'], 1, -1);
        if ($settings == 'thumbs') {
          $settings = 'data-nav="thumbs"';
        } else {
          $settings = str_replace ('fotorama ', '', $settings);
        }

        $result = str_replace ('class="fotorama"', 'class="fotorama" '.$settings, $result);

      } else {
        if (!$p_opened) {
          $p_opened = true;
          if ($div_opened) {
            $result .= '</div>' . "\n";
            $div_opened = false;
          }
          $result .= '<p>' . $line['content'];
        } else {
          $result .= '<br />' . "\n" . $line['content'];
        }
      }

    }
    
    if ($p_opened) {
      $result .= '</p>'."\n";
      $p_opened = false;
    }
    
    if ($div_opened) {
      $result .= '</div>'."\n";
      $div_opened = false;
    }

    $result .= '</div>'."\n";
    
    return $result;
      
  }
  
}


?>