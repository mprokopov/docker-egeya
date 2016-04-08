<?php

  /**
  * Calliope Wiki Formatter
  * @version 0.73 beta
  * @author Konstatnin Savelyev <inferno@bugz.ru>
  */  

  include_once('WikiModifiers.php');
  
  define ('WF_FULL_MODE',   '0');
  define ('WF_SIMPLE_MODE', '1');
  define ('WF_BRIEF_MODE',  '2');
  define ('WF_AS_IS_MODE',  '3');
  
/*
  function arrayDump($array)
  {
    $content = print_r($array, true);
    $content = str_replace("\n", '<br />', $content);
    $content = str_replace(" ", '&nbsp;', $content);
    $content = str_replace('Array', '<b><font color=#009900>Array</font></b>', $content);
    $content = str_replace('=>', '<b><font color=#009900>=></font></b>', $content);
    $content = preg_replace('#\[[^\]]+\]#is', '<b><font color=#FF0000>\\0</font></b>', $content);
    echo('<code>'.$content.'</code>');
  }
  */
  
  class WikiFormatter extends WikiModifiers                                
  {

     function WikiFormatter($settings = NULL)
     {
       if ($settings) $this->configure($settings);
       
       $this->imgExtensions = implode('|',$this->imgExtensions);

     }

     function configure($settings)
     {
       foreach ($settings as $index => $value) $this->settings[$index] = $value;
     }

     function imageInfo($href)
     {

       ##BUGBUG how this works?
       if (preg_match('/^([^\\\\\/]*)\.(?:'.$this->imgExtensions.')((\@(\d+)x(\d+))?(\@(\w+))?)?$/is', $href, $found)) 
       {
          /*
         echo '<pre>';
         print_r ($found);
         echo '</pre>';
         */
         if (@$found[2] && $found[3]) 
         {
           if ($found[5]) $align = ' align="'.$found[5].'"';
           $image['size'] = ' width="'.$found[2].'" height="'.$found[3].'"'.$align.' ';
           $image['href'] = str_replace($found[1],'',$href);
         } else
         {
           $size = @getimagesize (
             $this->settings['localImgDir'] . $href . $this->settings['localImgPostfix']
           );
           $width = $size[0];
           $height = $size[1];
           $image['href'] = $href;
           if ($size) {
             $image['size'] = ' '. $size[3];
             if ($width > $this->settings['maxImgWidth']) {
             
                $image['size-too-big'] = true;
                $image['width-original'] = $width;

                // IMAGE SCALING
                $height = $height * ($this->settings['maxImgWidth'] / $width);
                $width = $this->settings['maxImgWidth'];
                $image['size'] = ' width="'. $width .'" height="'. $height .'"';

                $scaled_filebasename = $href . $this->settings['localImgPostfix'];
      
                $basename_elements = explode ('.', $scaled_filebasename);
                if (count ($basename_elements) < 2) $basename_elements[] = '';
                $ext = array_pop ($basename_elements);
                $basename_elements[] = 'jpg';
                $basename = implode ('.', $basename_elements);
                $path_elements[] = $basename;
                $scaled_filebasename = implode ('/', $path_elements);

                $filename_scaled = $this->settings['localImgDirScaled'] . $scaled_filebasename;
                if (is_file ($filename_scaled)) {
                  // use the scaled file
                  $image['href-original'] = $this->settings['localImgDir'] . $image['href'] . $this->settings['localImgPostfix'];
                  $image['href'] = $filename_scaled;
                } elseif (@$this->settings['localImgScalingProvider']) {
                  // call the provider
                  $image['href-original'] = $this->settings['localImgDir'] . $image['href'] . $this->settings['localImgPostfix'];
                  $image['href'] = $this->settings['localImgScalingProvider'] . $href;
                }
                #print_r ($image);
                #die;
             }
           }
         };
         $image['boolean'] = TRUE;
       } else 
       {
         $image['boolean'] = FALSE;
       };
#       echo '<pre>';
#         print_r ($image);
#       echo '</pre>';
       return($image); 
     }


     function makeSafeHref ($string) {
       #$string = str_replace ('\'', '&apos;', $string);
       #$string = str_replace ('"', '&quot;', $string);
       $string = htmlspecialchars ($string, ENT_COMPAT | ENT_HTML401, 'cp1251');
       foreach (array ('http', 'https', 'ftp', 'ftps') as $protocol) {
         $protocol .= '://';
         if (strcasecmp ($protocol, substr ($string, 0, strlen ($protocol))) === 0) {
           return $string;
         }
       }
       if (@$string[0] == '/') {
         return 'http://'. $_SERVER['HTTP_HOST'] . $string;
       } else {
         return 'http://'. $string;
       }
     }

     /**
     * Translate wiki commands into HTML
     */
     function cbCreateHref($found)
     {                  

       $found = str_replace ('&amp;', '&', $found);

       $first = $found[3];

       $found = explode (' ', ' '.$first, 5);
#       echo '<pre>';
#       print_r ($found);
#       echo '</pre>';
       $found = array_map("trim",$found);

       // is it a known ((syntax))?

       if (method_exists($this, 'm_'.$found[1])) 
       {
         return(@call_user_method('m_'.$found[1], $this, $found));
       };

       # AI
       $imageInfo = $this->imageInfo($found[1]);
       if ($imageInfo['boolean'])
       {
         # image AI
         if ($this->settings['mode'] == WF_SIMPLE_MODE || $this->explCheck($found[1])) return($found[0]);
         $found[1] = $imageInfo['href'];  
         if ($this->isLocal($found[1])) {

           $img = $this->settings['localImgDir'].$found[1].$this->settings['localImgPostfix'];

         } else {
           #ILYABIRMAN:
           if (@$found[1]{0} == '/') $found[1] = 'http://'.$_SERVER['HTTP_HOST'].$found[1];
           #/ILYABIRMAN:
           $img = $found[1];
         }
         if ($found[2]) $alt = $this->implodeArray(array_splice($found, 2));
         if (empty ($alt)) $alt = '';
         $compiledTag = '<img src="'.$img.'" alt="'.@htmlspecialchars ($alt, ENT_COMPAT | ENT_HTML401, 'cp1251').'"'.@$imageInfo['size'].' />';
         
         
         
         
         if ($imageInfo['size-too-big']) {
           $compiledTag = '<div class="txt-picture">'.
           '<a href="'. $imageInfo['href-original'] .'" class="txt-picture-zoom-link" width="'. $imageInfo['width-original'] .'">'.
           '<div class="txt-picture-zoom-icon"><div class="txt-picture-zoomable"></div><div class="txt-picture-zoom-in"></div></div>'.
           '<img src="'.$imageInfo['href'].'" alt="'.@htmlspecialchars ($alt, ENT_COMPAT | ENT_HTML401, 'cp1251').'"'.@$imageInfo['size'].' />'.
           '</a></div>';
         }
         
         
         
         /*
         

*/
         
       } else
       {                                                

         $imageInfo = $this->imageInfo($found[2]);
         if ($imageInfo['boolean'])
         { 
           # image link
           if ($this->settings['mode'] == WF_SIMPLE_MODE || $this->explCheck($found[1]) || $this->explCheck($found[2])) return($found[0]);
           $found[2] = $imageInfo['href']; 
           if ($this->isLocal($found[1])) 
             $img = $this->settings['localImgDir'].$found[2].$this->settings['localImgPostfix'];
           else {
             #ILYABIRMAN:
             if (@$found[2]{0} == '/') $found[2] = 'http://'.$_SERVER['HTTP_HOST'].$found[2];
             #/ILYABIRMAN:
             $img = $found[2];
           }
           if ($found[3]) $alt = $this->implodeArray(array_splice($found, 3));
           #ILYABIRMAN:
           $found[1] = $this->makeSafeHref ($found[1]);

           // do <a rel="nofollow"> in comments
           if ($this->settings['mode'] == WF_SIMPLE_MODE) $relnofollow = ' rel="nofollow"';

           #/ILYABIRMAN:
           $compiledTag = '<a href="'.$found[1].'"'.@$relnofollow.'><img src="'.$img.'" border="0" alt="'.@htmlspecialchars ($alt, ENT_COMPAT | ENT_HTML401, 'cp1251').'"'.@$imageInfo['size'].' /></a>';
         } else
         { 
#return $found[1];           
           # just link
           if (!$this->explCheck($found[1]) && (!$this->isLocal($found[1]) || strstr($found[1],"#"))) {
      #echo '<pre>';
      #print_r ($found);
      #echo '</pre>';
             #ILYABIRMAN:
             
             $found[1] = $this->makeSafeHref ($found[1]);
             #/ILYABIRMAN:

             if ($this->settings['enableTagIcons'] && $this->isOuterURL($found[1])) {
               $urlImg = $this->settings['urlIcon'];
             };

             if ($this->settings['outerUrlInNewWindow']) {
               $target = ' target="_blank"';
             }

             if ($found[2]) $hrefName = $this->implodeArray(array_splice($found, 2)); else $hrefName = $found[1];

             #ILYABIRMAN:
             if ($this->isOuterURL($found[1])) {
               if ($this->settings['linkredirValue']) {
                 $countclicks = ' linkredir="'. $this->settings['linkredirValue'] .'"';
               }
               
             }
             #/ILYABIRMAN


             #ILYABIRMAN:
             // <a rel="nofollow"> in comments
             if ($this->settings['mode'] == WF_SIMPLE_MODE) $relnofollow = ' rel="nofollow"';
             #/ILYABIRMAN

             $compiledTag = '<a href="'.$found[1].'"'.@$relnofollow.@$target.@$countclicks.'>'.@$urlImg.$hrefName.'</a>';
           } else {
             $compiledTag = $found[0];
           };
         };
       };
       return($compiledTag);
     }

     function isOuterURL($url)
     {
       if (strstr($url, 'http://www.bugz.ru') || $url[0]=='/' || !strstr($url, '://')) return(false); else return(true);
     }

     function pregQuote($regexp, $quotedChars)
     {
       for ($i=0;$i!=strlen($quotedChars);$i++)
       {
         $regexp = str_replace($quotedChars[$i],"\\".$quotedChars[$i],$regexp);
       };
       return($regexp);
     }

    function cbShrinkLongHref($result)
    {
      if ($this->explCheck($result[0])) return($result[0]);
      $result[3] = $result[2];
      if ($this->settings['enableShrinkLongHref'])
      {
        $hrefSize = strlen($result[2]);
        $shrinkSize = $hrefSize-$this->settings['hrefSize'];
        if ($shrinkSize>0)
        {
          $result[3] = substr_replace($result[2],"&#133;",round($hrefSize/2-$shrinkSize/2),$shrinkSize);
        };
      };

      if ($this->settings['enableTagIcons']) {
        $urlImg = $this->settings['urlIcon'];
      };

      $result[2] = $this->makeSafeHref ($result[2]);

      if ($this->isOuterURL($result[2])) 
      {
        #$countclicks = ' countclicks="true"';
        $countclicks = ' linkredir="'. $this->settings['extLinkHrefPrefix'] .'"';
        if ($this->settings['outerUrlInNewWindow']) $target = ' target="_blank"';
      };

      // <a rel="nofollow"> in comments
      if ($this->settings['mode'] == WF_SIMPLE_MODE) $relnofollow = ' rel="nofollow"';

      return($result[1].'<a href="'.$result[2].'"'.@$relnofollow.@$target.@$countclicks.'>'.@$urlImg.$result[3].'</a>');
    }

    function saveTag($found)
    {
      global $tagStack;
      $tagStack[] = $found[1];
      return("\x4_".(sizeof($tagStack)-1)."_\x4");
    }

    function saveASIS($found)
    {
      global $asisTagStack;
      $asisTagStack[] = htmlspecialchars ($found[2], ENT_NOQUOTES, 'cp1251');
      return(substr($found[1],2)."\x2_".(sizeof($asisTagStack)-1)."_\x2".substr($found[3],2));
    }

    // Save ((html)) tags for later use
    function saveHTML($found)
    {
      global $htmlTagStack;
#                 print_r ($found);  #         die;  
      if ($this->settings['mode'] != WF_SIMPLE_MODE)
      {
        if ( in_array($found[3]{0}, array('<','&')) ) 
          $tag = $this->implodeArray(array_splice($found, 3));
        else
          $tag = '<'.$found[3].'>'.$found[4].'</'.$found[3].'>';
      } else
      {
        // added in v1871; before was just htmlspecialchars
        if (preg_match ('/\&([a-zA-Z0-9\#]+)\;/', $found[3]))  {
          //print_r ($found[3]);
          $tag = $found[3];
        } else {
          $tag = htmlspecialchars ($found[0], ENT_NOQUOTES, 'cp1251');
        }
      }
      $htmlTagStack[] = $tag;
      #echo $tag;
        #         print_r ($this->htmlTagStack);  #         die;  
      return("\x1_".(sizeof($htmlTagStack)-1)."_\x1");
    }

    // Save %% in stack for later use
    function saveCodes($found)
    {
      global $codeTagStack;
      $found[2] = htmlspecialchars ($found[2], ENT_NOQUOTES, 'cp1251');
      $found[2] = str_replace(' ','&nbsp;', $found[2]);
      $found[2] = str_replace("\r\n",'<br />', $found[2]);
      $found[2] = str_replace("\n",'<br />', $found[2]);
      $codeTagStack[] = '<code>'.$found[2].'</code>';
      return(substr($found[1],2)."\x3_".(sizeof($codeTagStack)-1)."_\x3".substr($found[3],2));
    }

     function cbGetHeaderTag ($found)
    {
      $headerSize = strlen ($found[1]) + $this->settings['headersStartWith'];
      return('<h'.$headerSize.'>'.trim($found[2]).'</h'.$headerSize.'>');
    }


     function cbIsStringNotEmpty($item)
     {
       if ($item) return(true); else return(false);
     }

     function getListItemInfo($listItem)
     {


       preg_match ("/( +)(\*|\-|\d+\.|\#\.|a\.|A\.|i\.|I\.) (.*)/is", $listItem, $found);
       
       $start = '';
       $type = '';
       $found[2] = rtrim ($found[2], '.');
       if ($found[2] == '*' or $found[2] == '-') {
         $tag = 'ul'; 
       } else {
         $tag = 'ol';
         if (is_numeric ($found[2])) {
           $start = $found[2];
         } elseif ($found[2] == '#') {
           $start = $this->latest_list_number + 1;
           $type = '';
         } else {
           $type = $found[2];
         }
       };
       return(array ('size' => strlen($found[1]), 'tag' => $tag, 'type' => $type, 'item' => rtrim($found[3]), 'start' => $start));
     }

     function cbListReplace($found)
     {
#echo '<hr /><pre>';
#print_r ($found[0]);
#echo '</pre><hr />';
       #$list = explode("\r\n", rtrim($found[0]));
       $list = explode ("\r\n", trim ($found[0], "\r\n"));
//       $list = explode ("\n", trim ($found[0], "\n"));
       $first = $this->getListItemInfo($list[0]);
       $firstText = $first['item'];
       if (@$first['type']) $type = ' type="'. $first['type'] .'"'; else $type = '';
       if (@$first['start']) $start = ' start="'. $first['start'] .'"'; else $start = '';
       
       if ($start) {
         $this->latest_list_number = $first['start'] + sizeof ($list) - 1;
       } else {
         $this->latest_list_number += sizeof($list);
       }

       $stack[] = '</'.$first['tag'].'>';
       $first = '<'.$first['tag'].$type.$start.'>';
       if (sizeof($list) == 1)
       {
         return($first.'<li>'.$firstText.'</li>'.$stack[0]);
       };
       for ($i=0;$i!=sizeof($list)-1;$i++)
       {
         $currentItem = $this->getListItemInfo($list[$i]);
         $nextItem = $this->getListItemInfo($list[$i+1]);
         # Subitem
         if ($nextItem['size']>$currentItem['size']) 
         {
           if ($nextItem['type']) $type = ' type="'.$nextItem['type'].'"'; else $type = '';
           $list[$i] = '<li>'.$currentItem['item'].'</li><'.$nextItem['tag'].$type.'>';
           $stack[] = '</'.$nextItem['tag'].'>';
         } else if ($nextItem['size']<$currentItem['size'])
         {
           $shift = ($currentItem['size']-$nextItem['size'])/2;
           for ($j=0;$j!=$shift;$j++)
           {
             @$tags.= $stack[sizeof($stack)-1];
             array_pop($stack);
           };
           $list[$i] = '<li>'.$currentItem['item'].'</li>'.$tags;
           $tags = '';
         } else
         {
           $list[$i] = '<li>'.$currentItem['item'].'</li>';
         };
       };  
       # Last element
       arsort($stack);
       $list[$i] = '<li>'.$nextItem['item'].'</li>';
       if ($stack) $stack = implode('',$stack);
       $list = $first.implode('', $list).$stack;
       return($list);
     }
     
    function cbParseTable($found)
    {

      $found[0] = trim ($found[0]);
      $found[0] = preg_replace ('/^\|\|/sm','<tr><td>', $found[0]); 
      $found[0] = preg_replace ('/(\|\|)?(\r?\n|$)/','</td></tr>', $found[0]); 
      $found[0] = preg_replace ('#\|\|#', '</td><td>', $found[0]);
      return('<table class="'.$this->settings['simpleTableCSSClass'].'">'.$found[0].'</table>');


      #return('<div style="color: #f00">('.$found[0].')</div>');


    } 


     function Wiki2HTML($content)
     {
       global $tagStack, $codeTagStack, $asisTagStack, $htmlTagStack;
       $tagStack = $codeTagStack = $asisTagStack = $htmlTagStack = array ();
       
       if ($this->settings['mode'] == WF_AS_IS_MODE) return($content);

       # Save all in ""..."" in stack
       # Stuff link =""..."", is ignored
       $content = preg_replace_callback('#((?<!=)"{2,})(?! )(.+?)(?<! )("{2,})#is', array ($this, 'saveASIS'), $content);

       # Save and parse ((html ...))
       $content = preg_replace_callback (

#         '#  (?:  (\(\()  |  (\[\[)  )   \s* html \s* ([^ \s (?(1) \) ) (?(2) \] ) ]+) \s* (.*?)  \s* (?(1) \)\) )  (?(2) \]\] )  #isx',
         // v1487: was ^^^ now vvv
         '#  (?:  (\(\()  |  (\[\[)  )     \s* html \s* (.*?) \s*    (?(1) \)\) )  (?(2) \]\] )  #isx',

         
         #         '#(?:\(\(|\[\[) *html *([^ )]+) *(.*?)(?:\)\)|\]\])#is',
         array ($this, 'saveHTML'),
         $content
       );


       
       # Save %%
       $content = preg_replace_callback('#(%{2,})(?! )(.+?)(?<! )(%{2,})#is', array ($this, 'saveCodes'), $content);


       # Kill remaining HTML
       $content = htmlspecialchars ($content, ENT_NOQUOTES, 'cp1251');

       $content = preg_replace_callback(

         '#  (?:  (\(\()  |  (\[\[)  )     (.*?)     (?(1) \)\) )  (?(2) \]\] )  #isx',

#         '#(?:\(\(|\[\[)(.*?)(?:\)\)|\]\])#is',

#         '#(?:\(\(|\[\[)( *[^ )]+) *([^ )]*) *([^ )]*) *([^)]*)(?:\)\)|\]\])#is',
         array ($this, 'cbCreateHref'),
         $content
       );




       # simple links http://...
       $content = preg_replace_callback('#(\s|^)((?:http|https|ftp|ed2k)\:\/\/[\w\d\#\.\/&=%-_!\?\@\*]+)#is', array ($this, 'cbShrinkLongHref'),$content);
       
       //
       //  tables
       //

       if ($this->settings['enableTables']) { 
         $content = preg_replace_callback (
           '#((?<=^|\n)\|\|.+?(\r?\n|$))+#',
           array ($this, 'cbParseTable'),
           $content
         ); 

       }; 

       # save html tags
       $content = preg_replace_callback('#(<[^>]+>)#is', array ($this, 'saveTag'), $content);
       
       # formatters
       
       if ($this->settings['enableHr']) $content = preg_replace('#(\n|^)---(?:\n|$)#s','\\1<hr />', $content);
       
       # lists
       if ($this->settings['enableList'])  
       {                                     
         $content = preg_replace_callback (
           "/(?:\r\n|^)((?:  )+(?:\*|\-|\d+\.|\#\.|a\.|A\.|i\.|I\.) .*?(?:\r\n|$))+(?:\r\n)*/ism",
           #"/((?:  )+(?:\*|\-|\d+\.|\#\.|a\.|A\.|i\.|I\.) .*?(?:\r\n|$))+/ism",
           #"/((?:  )+(?:\*|\-|\d+\.|\#\.|a\.|A\.|i\.|I\.) *.*?(?:\r\n|$))+(?:\r\n)*/ism",
           array ($this, 'cbListReplace'), 
           $content
         );
         #$content = preg_replace_callback('#(  +(?:\*|a|A|\d|i|I)\.? *.*?(?:\r\n|$))+(?:\r\n)*#is',array ($this, 'cbListReplace'), $content);
#         $content = preg_replace_callback('#^(  +(?:\*|a|A|\d|i|I)\.? *.*?(?:\n|$))+(?:\n)*#mis', array ($this, 'cbListReplace'), $content); 
   
         # remove crlfs after lists
         $content = str_replace(array("</ul>\r\n", "</ul>\n"),'</ul>', $content); 
         $content = str_replace(array("</ol>\r\n", "</ol>\n"),'</ol>', $content); 
         $content = str_replace(array("\r\n<ul>", "\n<ul>"),'<ul>', $content); 
         $content = str_replace(array("\r\n<ol>", "\n<ol>"),'<ol>', $content); 
       } 

       # headings
       if ($this->settings['enableHeaders']) $content = preg_replace_callback ('#(?:\r\n)*=(={1,5})(.+?)=={1,6}(?:\r\n)*#s', array ($this, 'cbGetHeaderTag'), $content);
#       if ($this->settings['enableHeaders']) $content = preg_replace_callback ('#(?:\n)*=(={1,5})(.+?)=={1,6}(?:\n)*#s', array ($this, 'cbGetHeaderTag'), $content);
       
       # delimiters
       foreach ($this->replace as $index => $value) 
       { 
         $quotedValue = preg_quote($index, '#'); 
         $content = preg_replace_callback('#(?<!:)('.$quotedValue.'{2,})(?!\s)(.+?)(?<!\s)('.$quotedValue.'{2,})#s',array ($this, 'cbReplaceFormat'), $content); 
         #$content = preg_replace_callback('#(?<!:)('.$quotedValue.'{2,})(?! )(.+?)(?<! )('.$quotedValue.'{2,})#is',array ($this, 'cbReplaceFormat'), $content); 
       }; 

       # remove crlfs after quotes
       $content = str_replace(array("</blockquote>\r\n\r\n", "</blockquote>\n\n", "</blockquote>\r\n", "</blockquote>\n"),'</blockquote>', $content); 
       $content = str_replace(array("\r\n\r\n<blockquote>", "\n\n<blockquote>", "\r\n<blockquote>", "\n<blockquote>"),'<blockquote>', $content); 

       # do crlfs
       if ($this->settings['enableBr']) {
         $content = str_replace("\r\n",'<br />', $content);
         $content = str_replace("\n",'<br />', $content);
       }

       # restore saved
       $content = $this->retSavedElem("\x4", $tagStack, $content);
       $content = $this->retSavedElem("\x3", $codeTagStack, $content);
       $content = $this->retSavedElem("\x2", $asisTagStack, $content);
       $content = $this->retSavedElem("\x1", $htmlTagStack, $content);

       # pair
       $content = str_replace('</blockquote><br />','</blockquote>', $content);
       $content = str_replace('<blockquote><br />','<blockquote>', $content);

       return($content);
     }

     /*
     function cbCutMe($found)
     {
       if ($this->settings['mode'] == WF_FULL_MODE) return($found[2]);
       if (!$found[1]) $found[1] = $this->settings['defaultCutText'];
       return($this->saveTag(array('','<a href="'.$this->settings['fullVersionURL'].'">'.$found[1].'</a>')));
     }
     */

     function cbReplaceFormat($found)
     {

       #echo '<pre>';
       #print_r ($found);
       #echo '</pre>';
       if (strlen ($found[1]) > 2) {
         $found[2] = substr ($found[1], 2) . $found[2];
         $found[1] = substr ($found[1], 0, 2);
       }
       if (strlen ($found[3]) > 2) {
         $found[2] = $found[2] . substr ($found[3], 0, -2);
         $found[3] = substr ($found[1], -2);
       }
       #echo '<pre>';
       #print_r ($found);
       #echo '</pre>';
       return (
         substr($found[1],2).'<'.$this->replace[$found[1][0]].'>'.$found[2].'</'.$this->replace[$found[1][0]].'>'.substr($found[3],2)
       );
     }

     function retSavedElem($delimiter, $stack, $content)
     {
       if ($stack)
       foreach ($stack as $index => $item)
       {
         $content = str_replace($delimiter.'_'.$index.'_'.$delimiter, $item, $content);
       };
       return($content);
     }

  }

?>