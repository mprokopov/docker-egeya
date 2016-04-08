<?php

class NeasdenGroup_table implements NeasdenGroup {

  function __construct ($neasden) {

    $neasden->require_line_class ('hr');
    $neasden->define_line_class ('tr', '\|([^\|]+\|)+');
    
    $neasden->define_group ('table', '(-hr-)(-tr-)+(-hr-)?');
    
  }

  function render ($group, $myconf) {
  
    $result = '<div class="'. $myconf['css-class'] .'">' ."\n";
    $result .= '<table cellpadding="0" cellspacing="0" border="0">' ."\n";
    foreach ($group as $line) if ($line['class'] == 'tr') {
      $result .= "<tr>\n";
      $tr = explode ('|', trim ($line['content'], '|')); // usafe
      foreach ($tr as $td) {
        
        $lsp = (mb_substr ($td, 0, 1) == ' ');
        $rsp = (mb_substr ($td, -1)   == ' ');
        
        if     ($lsp and $rsp)  $alignment = 'center';
        elseif ($lsp)           $alignment = 'right';
        elseif ($rsp)           $alignment = 'left';
        else                    $alignment = '';
        
        if ($alignment) $alignment = ' style="text-align: '. $alignment .'"';
        
        $result .= "<td". $alignment .">". trim ($td) ."</td>\n"; // usafe
        
      }
      $result .= "</tr>\n";
    }
  
    $result .= "</table>\n";
    $result .= "</div>\n";
    
    return $result;
    
  }
  
}

?>