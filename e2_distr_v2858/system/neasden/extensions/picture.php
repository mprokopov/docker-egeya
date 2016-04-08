<?php

class NeasdenGroup_picture implements NeasdenGroup {

  private $neasden = null;
  
  function __construct ($neasden) {
    $this->neasden = $neasden;

    $neasden->define_line_class ('picture', '.*\.(jpe?g|gif|png)(?: +(.+))?');
    $neasden->define_group ('picture', '(-picture-)(-p-)*');
  }
    
  function detect_line ($line, $myconf) {
    list ($filebasename, ) = explode (' ', $line, 2);  
    return is_file ($myconf['folder'] . $filebasename);
  }  
  
  function render ($group, $myconf) {
    $p = false;
  
    $result = '<div class="'. $myconf['css-class'] .'">'."\n";
    foreach ($group as $line) {
      @list ($filebasename, $alt) = explode (' ', $line['content'], 2);
      
      // check if alt start with an url
      @list ($link, $newalt) = explode (' ', $alt, 2);
      if (preg_match ('/[a-z]+\:.+/i', $link)) { // usafe
        $alt = $newalt;
      } else {
        $link = '';
      }
      
      if ($line['class'] == 'picture') {
  
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
  
        $filename_original = $filename;
        $width_original = $width;
        $is_scaled = false;
  
        // image too wide
        if ($width > $myconf['max-width']) {
  
          $is_scaled = true;
          $height = $height * ($myconf['max-width'] / $width);
          $width = $myconf['max-width'];
  
          // if scaled down images are or should be provided
          if (array_key_exists ('scaled-img-folder', $myconf)) {
          
            $scaled_filebasename = $filebasename;
  
            if (array_key_exists ('scaled-img-extension', $myconf)) {
              $basename_elements = explode ('.', $scaled_filebasename);
              if (count ($basename_elements) < 2) $basename_elements[] = '';
              $ext = array_pop ($basename_elements);
              $basename_elements[] = $myconf['scaled-img-extension'];
              $basename = implode ('.', $basename_elements);
              $path_elements[] = $basename;
              $scaled_filebasename = implode ('/', $path_elements);
            }
          
            $filename_scaled = $myconf['scaled-img-folder'] . $scaled_filebasename;
            
            if (is_file ($filename_scaled)) {
              // use the scaled file
              $filename = $filename_scaled;
              $size = getimagesize ($filename);
              list ($width, $height) = $size;
            } elseif (array_key_exists ('scaled-img-provider', $myconf)) {
              // call the provider
              $filename = $myconf['scaled-img-provider'] . $filebasename;
            }
  
            // otherwise leave the file as-is, browser will scale it
            
          }
  
        }
        
        $image_html = (
          '<img src="'. $myconf['src-prefix'] . $filename .'" '.
          'width="'. $width .'" height="'. $height.'" '.
          'alt="'. htmlspecialchars ($alt) .'" />'. "\n"
        );
        
        $cssc_zoomlink = $myconf['css-class'] .'-zoom-link';
        $cssc_zoomicon = $myconf['css-class'] .'-zoom-icon';
        $cssc_zoomable = $myconf['css-class'] .'-zoomable';
        $cssc_zoomin   = $myconf['css-class'] .'-zoom-in';
        $cssc_link     = $myconf['css-class'] .'-link';
  
        // wrap into a link to zoomed version if needed
        if (!$link and $myconf['scaled-img-link-to-original'] and $is_scaled) {
          
          $this->neasden->require_link (@$this->neasden->config['library']. 'jquery/jquery.js');
          $this->neasden->require_link (@$this->neasden->config['library']. 'scaleimage/scaleimage.js');
          
          $image_html = (
            '<a href="'. $myconf['src-prefix'] . $filename_original .'" class="'. $cssc_zoomlink .'" width="'. $width_original .'">' ."\n".
            '<div class="'. $cssc_zoomicon .'">'.
            '<div class="'. $cssc_zoomable .'"></div>'.
            '<div class="'. $cssc_zoomin .'"></div>'.
            '</div>' ."\n".
            $image_html .
            '</a>'
          );
          
        }
  
        // wrap into a link to URL if needed
        if ($link) {
          $image_html = (
            '<a href="'. $link .'" width="'. $width_original .'" class="'. $cssc_link .'">' ."\n".
            $image_html .
            '</a>'
          );
        }
        
        $result .= $image_html;
        
      } else {
        if (!$p) {
          $p = true;
          $result .= '<p>' . $line['content'];
        } else {
          $result .= '<br />' . "\n" . $line['content'];
        }
      }
    }
  
    if ($p) $result .= '</p>'."\n";
  
    $result .= '</div>'."\n";
    
    return $result;
    
  }
  
}

?>