<?php

class NeasdenGroup_list implements NeasdenGroup {

  function __construct ($neasden) {
  
    if (!($chars_ul_items = @$_neasden_config['groups.lists.chars'])) {
      $chars_ul_items = array ('-', '*');
    }
    
    $ul_item_regex = array ();
    foreach ($chars_ul_items as $item) {
      $ul_item_regex[] = '(\\'. $item .' (?:$|[^'. $item .'].*))';
    }
    $ul_item_regex = implode ('|', $ul_item_regex);
    
    $neasden->define_line_class ('ol-item', '[1234567890]+\.(?:$| +.*)');
    $neasden->define_line_class ('ul-item', $ul_item_regex);
    
    $neasden->define_group ('list', '(((-ol-item-)|(-ul-item-))(-p-)*)+');
    
  }
  
  function render ($group, $myconf) {

    $result = '';
    
    // depth from the engine can be anything, but
    // we assume the depth of first item as a base
    // and then is something is shallower
    // we just the base depth:
    $prevdepth = 0;
    $basedepth = $group[0]['depth'];
    
    // at each depth level we track list kind:
    $is_ordered_list[0] = ($group[0]['class'] == 'ol-item');
    
    if ($is_ordered_list[0]) {
      $result .= '<ol>'."\n";
    } else {
      $result .= '<ul>'."\n";
    }
    
    foreach ($group as $line_number => $line) {
      $depth = max (0, $line['depth'] - $basedepth);
      $depthsp = str_repeat (' ', $depth * 2);
    
      if ($line['class'] == 'empty') {
      } elseif ($line['class'] == 'p') {
    
        // it can’t be the first line of group per its regex
        // it’s just a text line, so add it after item
        $result .= $depthsp;
        $result .= '<br />' . "\n". $line['content'];
    
      } else {
      
        // manage depths
    
        if ($depth > $prevdepth) {
          $is_ordered_list[$depth] = ($line['class'] == 'ol-item');
        }
    
        $list_tag = ($is_ordered_list[$depth] ? 'ol' : 'ul');
        if ($depth > $prevdepth) $result .= "\n<". $list_tag .">\n";
    
        $list_tag = ($is_ordered_list[$prevdepth] ? 'ol' : 'ul');
        if ($depth < $prevdepth) $result .= $depthsp. "</". $list_tag .">\n</li>\n";
    
        $prevdepth = $depth;
        
        // switch list types at current depth level if necessary
        if ($is_ordered_list[$depth] and $line['class'] != 'ol-item') {
          $result .= "</ol>\n<ul>\n";
          $is_ordered_list[$depth] = false;
        }
        if (!$is_ordered_list[$depth] and $line['class'] != 'ul-item') {
          $result .= "</ul>\n<ol>\n";
          $is_ordered_list[$depth] = true;
        }
    
        // add item to result:
        $result .= $depthsp;
        $result .= '<li>';
    
        if ($line['class'] == 'ol-item') {
          $line_numberless = ltrim ($line['content'], '0123456789'); // usafe
          $result .= ltrim (mb_substr ($line_numberless, 1), ' '); // usafe
        }
    
        if ($line['class'] == 'ul-item') {
          $result .= ltrim (mb_substr ($line['content'], 1), ' ' . $line['content'][0]); // usafe
        }
        
      }
      
      // if it’s a last line close <li>;
      // we won’t close <li> if following line
      // is of class 'p' or if it’s deeper
    
      if (
        $line_number == count ($group) - 1
        or (
          $group[$line_number + 1]['class'] != 'p'
          and max (0, $group[$line_number + 1]['depth'] - $basedepth) <= $depth
        )
      ) {
    
        $result .= '</li>' . "\n";
    
      }
      
    }
    
    if ($is_ordered_list[0]) {
      $result .= '</ol>'."\n";
    } else {
      $result .= '</ul>'."\n";
    }
    
    
    return $result;

  }
  
}

?>