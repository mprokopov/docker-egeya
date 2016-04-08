<?php 
 
  class WikiServices
  {
    var $latest_list_number = 0;
    var $imgExtensions = array ('gif','png','bmp','jpg','jpeg','jpe','pcx','wbmp','ico','xbm');
    var $replace = array ();
    var $settings = array ();
    /*
    var $replace = array (
                               '/' => 'i',
                               '+' => 'small', 
                               '-' => 'strike',
                               '*' => 'b',
                               '^' => 'sup',
                               'v' => 'sub',
                               '!' => 'blockquote',
                               '_' => 'u');

    var $settings = array ( 'hrefSize'              => 50,
                                'localImgDir'             => '',
                                'mode'                    => WF_FULL_MODE,
                                'enableShrinkLongHref'    => 1,
                                'enableHr'                => 1,
                                'enableBr'                => 1,
                                'enableHeaders'           => 1,
                                'enableAutoAcronymEngine' => 1,
                                'enableAcronym'           => 1,
                                'acronymBase'             => 'acronym.dat',
                                'enableList'              => 1,
                                'mailSafe'                => "{icon}<a href=\"\" onmouseover=\"this.href='mailto:'+{email}\"><script language=\"JavaScript\">document.write({name});</script></a>",
                                'fullVersionURL'          => 'http://www.bugz.ru/sdf',
                                'urlIcon'                 => '<img src="extlink.gif" />&nbsp;',
                                'mailIcon'                => '<img src="mail.gif" />&nbsp;',
                                'ljUserIcon'              => '<img src="ui.gif" border="0" align="bottom">',
                                'ljUserTag'               => '{icon}<a href="http://livejournal.com/users/{name}/">{name}</a>',
                                'enableTagIcons'          => 1,
                                'defaultLJUser'           => 'Inferno',
                                'defaultCutText'          => 'Read more...',
                                'outerUrlInNewWindow'     => 1,
                                'enableTables'            => 1,
                                'localImgPostfix'         => '', 
                                'simpleTableCSSClass'     => 'simpleTable', 
                              );
     */
     var $htmlTagStack = array ();
     var $asisTagStack = array ();
     var $codeTagStack = array ();
     var $tagStack     = array ();
     var $acronyms     = array ();
     var $backAcronyms = array ();

     function implodeArray($parts)
     {
       return(rtrim(implode(" ",$parts)));
     }

     function isLocal($href)
     {
       if (strstr($href,"/")) return(false); else return(true);
     }

     function explCheck($string)
     {
       #if (preg_match('#(javascript:|on\w+[^=]+=)#is', $string)) return true ; else return false;
       #if (preg_match('#(\bjavascript:|\bon\w+\=)#is', $string)) return true ; else return false;
       if (preg_match('#\bjavascript\:#is', $string)) return true ; else return false;
     }

  
  }

  class WikiModifiers extends WikiServices
  {
     
    function m_noindex($input)
    {
      if ($input[2])
        return('<noindex>'.$this->implodeArray(array_splice($input, 2)).'</noindex>');
      else
        return($found[0]);
    }

    function m_img($found)
    {
      if ($this->settings['mode'] == WF_SIMPLE_MODE || $this->explCheck($found[2])) return($found[0]);
      if ($found[2])
      { 
        if ($this->isLocal($found[2])) {
          $img = $this->settings['localImgDir'].$found[2].$this->settings['localImgPostfix'];
        } else {
          #ILYABIRMAN:
          if (@$found[2]{0} == '/') $found[2] = 'http://'.$_SERVER['HTTP_HOST'].$found[2];
          #/ILYABIRMAN:
          $img = $found[2]; 
        }
        if ($found[3]) $alt = $this->implodeArray(array_splice($found, 3));
        if (empty ($alt)) $alt = $img;
        $compiledTag = '<img src="'.$img.'" alt="'.htmlspecialchars ($alt).'" />';
                
      } else
      {
        $compiledTag = $found[0];
      };
      return($compiledTag);
    }

    function m_mail($found)
    {
      if ($this->settings['mode'] == WF_SIMPLE_MODE ) return($found[0]);
      # safe email
      $found[2] = str_replace('.',".'+'",$found[2]);
      $found[2] = "'".str_replace('@',"'+'@",$found[2])."'";

      $compiledTag = str_replace('{email}',$found[2], $this->settings['mailSafe']);
      if ($found[3]) 
      {
        $name = str_replace ("'", '&#146;', $this->implodeArray(array_splice($found, 3)));
        $name = str_replace ('"', '&quot;', $name);
        $compiledTag = str_replace('{name}',"'".$name."'", $compiledTag);
      } else
      {
        $compiledTag = str_replace('{name}',$found[2], $compiledTag);
      }
      if ($this->settings['enableTagIcons']) 
      {
        $compiledTag = str_replace('{icon}', $this->settings['mailIcon'], $compiledTag);      
      } else {
        $compiledTag = str_replace('{icon}', '', $compiledTag);      
      };
     # echo $compiledTag;
     # die;
      return($compiledTag);
    }

    function m_link($found)
    {
      if ($found[2] && !$this->explCheck($found[2]))
      {

        if ($found[3]) {
          $hrefName = $this->implodeArray(array_splice($found, 3)); 
        } else {
          $hrefName = $found[2];
        }

        if ($this->settings['enableTagIcons'])  {
          $urlImg = $this->settings['urlIcon'];
        }

        if ($this->isOuterURL($found[2]))  {
          #ILYABIRMAN:
          if (@$found[2]{0} == '/') $found[2] = 'http://'.$_SERVER['HTTP_HOST'].$found[2];
          #/ILYABIRMAN:

          #ILYABIRMAN:
          /* v1703
          $found[2] = $this->settings['extLinkHrefPrefix'].$found[2];
          */
          /* v1717
          $onclick = ' onclick="window.location.href= \''. ($this->settings['extLinkHrefPrefix'] . $found[1]) .'\'; return false"';
          */
          #$countclicks = ' countclicks="true"';
          $countclicks = ' linkredir="'. $this->settings['linkRedirValue'] .'"';
          #/ILYABIRMAN

          #ILYABIRMAN:
          if ($this->settings['outerUrlInNewWindow']) {
            $target = ' target="_blank"';
          }
          #/ILYABIRMAN

        };

        // <a rel="nofollow"> in comments
        if ($this->settings['mode'] == WF_SIMPLE_MODE) $relnofollow = ' rel="nofollow"';

        $found[2] = $this->makeSafeHref ($found[2]);

        $compiledTag = '<a href="'.$found[2].'"'.@$relnofollow.@$target.@$countclicks.'>'.@$urlImg.$hrefName.'</a>';
      } else
      {
        $compiledTag = $found[0];
      };
      return($compiledTag);
    }





    function m_play ($found) {

      // 2 - filename
      // 3 - alt text

      if ($found[2] && !$this -> explCheck ($found[2])) {

        if ($found[3]) {
          $hrefName = $this -> implodeArray (array_splice ($found, 3)); 
        } else {
          $hrefName = $found[2];
        }
        
        if ($this -> isOuterURL ($found[2]))  {
          $countclicks = ' linkredir="' . $this -> settings['linkRedirValue'] .'"';
        }

        // <a rel="nofollow"> in comments
        if ($this -> settings['mode'] == WF_SIMPLE_MODE) $relnofollow = ' rel="nofollow"';

        $found[2] = $this->makeSafeHref ($found[2]);

        $compiledTag = (
          '<a href="'. $found[2] .'"'. @$relnofollow . @$countclicks .' class="e2-inline-player">'.
          @$urlImg . $hrefName.
          '</a>'
        );
        
      } else {
      
        $compiledTag = $found[0];
        
      }
      
      return $compiledTag;
      
    }
    
    
    
    
    
    

    function m_imglink($found)
    {
      if ($this->settings['mode'] == WF_SIMPLE_MODE || $this->explCheck($found[2]) || $this->explCheck($found[3])) return($found[0]);
      if ($found[2] && $found[3])
      {
        #ILYABIRMAN:
        $found[2] = $this->makeSafeHref ($found[2]);
        #/ILYABIRMAN:
        
        if ($this->isLocal($found[3])) 
          $img = $this->settings['localImgDir'].$found[3];
        else {
          #ILYABIRMAN:
          #/ILYABIRMAN:
          $img = $found[3];
        }

        if ($found[4]) $alt = $this->implodeArray(array_splice($found, 4));
        if (empty ($alt)) $alt = $img;

        // <a rel="nofollow"> in comments
        if ($this->settings['mode'] == WF_SIMPLE_MODE) $relnofollow = ' rel="nofollow"';

        $compiledTag = '<a href="'.$found[2].'"'.@$relnofollow.'><img src="'.$img.'" border="0" alt="'.htmlspecialchars ($alt).'" /></a>';
      } else
      {
        $compiledTag = $found[0];
      };
      return($compiledTag);
    }

    function m_ljuser($found)
    {
      #if (!$found[2]) $found[2] = $this->settings['defaultLJUser'];    
      $compiledTag = str_replace('{name}', $found[2],  $this->settings['ljUserTag']);
      #$compiledTag = str_replace('{icon}', $this->settings['ljUserIcon'], $compiledTag);
       
      return($compiledTag);
    }

/*
    function m_char ($found)
      ## X PERI MENT
    {
      if (count ($found) == 3) {
        return '&'. $found[2] .';';
      } else {
        return $found[0];
      }
    }
  */  
    /*
    function m_x ($found)
    {
      if (count ($found) == 2) return '<span class="times">&times;</span>';
      else return $found[0];
    }
    */
/*
       $content = str_replace (
          '((x))',
          '<span class="times">&times;</span>',
          $content
       );
       */
  }

?>