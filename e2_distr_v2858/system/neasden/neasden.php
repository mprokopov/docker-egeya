<?php

// Neasden v2.17

interface NeasdenGroup {
  function render ($group, $myconf);
}


class Neasden {
  
  const FRAG_STRENGTH_TEXT = 0; // grouped, typographed
  const FRAG_STRENGTH_OPAQUE = 7; // typographed
  const FRAG_STRENGTH_SACRED = 9; // returned as is

  const MAX_H_LEVEL = 6;
  const DEFAULT_GROUP = 'p';
  
  public $input = '';
  public $output = '';
  
  public $should_explain = false;
  public $profile_name = '';
  public $explanation = '';
  public $resources_detected = array ();  
  
  public $language_data = array (
  );
  
  private $groups = array (
    'empty'   => '(-empty-)+',
    'p'       => '(-p-)+',
    'h1'      => '(-h1-)+',
    'h2'      => '(-h2-)+',
    'h3'      => '(-h3-)+',
    'h4'      => '(-h4-)+',
    'h5'      => '(-h5-)+',
    'h6'      => '(-h6-)+',
  );

  private $line_classes = array ();
  private $required_line_classes = array ();
  private $saved_tags = array ();
  private $extensions = array ();
  private $stopwatch = 0;

  const RX_SPECIAL_CHAR = "\x1";
  const RX_SPECIAL_SEQUENCE_LENGTH = 6;

  private $rx_tags_regex;
  
  function __construct () {

    $this->resources_detected = array ();
    $this->links_required = array ();
    $this->groups_used = array ();
    
    $this->rx_tags_regex = (
      '(?:'. 
      '\\' . self::RX_SPECIAL_CHAR .'\d{'. self::RX_SPECIAL_SEQUENCE_LENGTH .'}\\' . self::RX_SPECIAL_CHAR.
      ')*'
    );

    $host_dir = dirname ($_SERVER['PHP_SELF']); # '/meanwhile'
    $host_dir = trim ($host_dir, '/').'/'; # 'meanwhile/' // usafe
    if ($host_dir == '/') $host_dir = '';
    
    $dir = rtrim (dirname (__FILE__), '/'). '/'; // usafe
    $dir = str_replace ($_SERVER['DOCUMENT_ROOT'] .'/'. $host_dir, '', $dir);
    
    $this->config = require ('config.php');
    
    $extensions_folders = array (
      $dir. 'extensions',
      $this->config['__overload']. 'extensions'
    );
    
    foreach ($extensions_folders as $extensions_folder) {
      if (is_array ($files = glob ($extensions_folder. '/*.php'))) {
        foreach ($files as $file) {
          // echo "<p>$file</p>";
          $this->load_extension ($file);
        }
      }
    }
    
  }
  
  
  function stopwatch () {
    list ($usec, $sec) = explode (' ', microtime ());
    return ((float) $usec + (float) $sec);
  }
  
  
  function load_extension ($file) {
    $name = basename ($file);
    if (substr ($name, -4) == '.php') $name = substr ($name, 0, strlen ($name) - 4); // usafe
    if (!array_key_exists ($name, $this->extensions)) {
      $NeasdenGroupClass = 'NeasdenGroup_' . $name;
      include_once $file;
      $this->extensions[$name] = array (
        'path' => dirname ($file) .'/'. $name .'/',
        'instance' => new $NeasdenGroupClass ($this),
      );
      return true;
    }
  }
  
  
  function require_line_class ($class) {
    $this->required_line_classes[$class] = true;
  }
  
  
  function define_line_class ($class, $regex) {
    $this->line_classes[$class] = $regex;
  }
    
  
  function define_group ($group, $regex) {
    $this->groups[$group] = $regex;
  }
    
  
  function resource_detected ($resource) {
    $this->resources_detected[] = $resource;
  }
  
  
  function require_link ($link) {
    $this->links_required[] = $link;
  }
  
  
  function special_sequence ($index) {
    return self::RX_SPECIAL_CHAR . str_pad ($index, self::RX_SPECIAL_SEQUENCE_LENGTH, '0', STR_PAD_LEFT) . self::RX_SPECIAL_CHAR; // usafe
  }


  function isolate ($tag) {
    $index = count ($this->saved_tags);
    if (is_array ($tag)) $tag = $tag[0];
    $this->saved_tags[$index] = $tag;
    return $this->special_sequence ($index);
  }
    
  
  function unisolate ($text) {
  
    foreach ($this->saved_tags as $index => $value) {
      $text = str_replace ($this->special_sequence ($index), $value, $text);
    }
    return $text;
  
  }
  
  
  // puts quotes, really
  function enclose_within_tagless ($text, $char, $enclosures) {
  
    if (count ($enclosures) == 0) return;
    if (count ($enclosures) == 1) $enclosures[1] = $enclosures[0];
    if (count ($enclosures) == 2) {
      $enclosures[3] = $enclosures[1];
      $enclosures[2] = $enclosures[1];
      $enclosures[1] = $enclosures[0];
    }
    if (count ($enclosures) == 3) $enclosures[3] = $enclosures[2];
  
    // obvious replacements
    if (1) {
      $text = preg_replace ( // usafe
        '/((?:^|\s|\-)'. $this->rx_tags_regex .')'.
        preg_quote ($char). // usafe
        '(?!'. $this->rx_tags_regex .'($|\-|\s))/m',
        '$1'. $enclosures[0],
        $text
      );
    }
  
    if (1) {
      $text = preg_replace ( // usafe
        '/(?<!^|\s|\-)('. $this->rx_tags_regex .')'.
        preg_quote ($char). // usafe
        '(?='. $this->rx_tags_regex ."(?:$|\-|\s))/m",
        '$1'. $enclosures[3],
        $text
      );
    }
  
    // remaining replacements
    if (1) {
      $len = mb_strlen ($enclosures[0]);
      $qdepth = 0;
      for ($i = 0; $i < mb_strlen ($text)-1; ++ $i) {
        $scan = mb_substr ($text, $i, $len);
        if ($scan == $enclosures[0]) {
          $qdepth ++;
          if ($qdepth > 1) $text = mb_substr ($text, 0, $i) . $enclosures[1] . mb_substr ($text, $i + $len);
          $i += $len;
        }
        if ($scan == $enclosures[3]) {
          if ($qdepth > 1) $text = mb_substr ($text, 0, $i) . $enclosures[2] . mb_substr ($text, $i + $len);
          $qdepth --;
          $i += $len;
        }
        if ($i > mb_strlen ($text)-1) break;
        if (mb_substr ($text, $i, 1) == $char) {
          if ($qdepth > 0) {
            if ($qdepth > 1)
              $text = mb_substr ($text, 0, $i) . $enclosures[2] . mb_substr ($text, $i + 1);
            else
              $text = mb_substr ($text, 0, $i) . $enclosures[3] . mb_substr ($text, $i + 1);
            -- $qdepth;
          } else {
            $text = mb_substr ($text, 0, $i) . $enclosures[0] . mb_substr ($text, $i + 1);
            ++ $qdepth;
          }
        }
      }
    }
  
    return $text;                                                
  
  }
  

  // 
  
  function process_double_brackets_contents_callback ($params) {
  
    $text = @$params[1] . @$params[2] . @$params[3] . @$params[4];
    @list ($href, $text) = explode (' ', $text, 2);

    $quotes = $this->language_data['quotes'];
    $quotes_left = array ('"', $quotes[0], $quotes[1]);
    $quotes_right = array ('"', $quotes[2], $quotes[3]);
    $hang_left = '';
    $hang_right = '';

    if (@$text) {
      $hang_left = mb_substr ($text, 0, 1);
      $hang_right = mb_substr ($text, -1);
    } else {
      // if no text is given, then the whole brackets contents should be the href,
      // it probably contains "//", and thus should be isolated
      $text = $this->isolate ($href);
    }
    
    $quotes_should_hang = (
      in_array ($hang_left, $quotes_left) and
      in_array ($hang_right, $quotes_right)
    );
  
    $rel_nofollow = '';
    if (@$this->config['typography.nofollowhrefs']) {
      $rel_nofollow = ' rel="nofollow"';
    }

    if ($quotes_should_hang)  {
      $text = mb_substr ($text, 1, mb_strlen ($text) - 2);
      $a_in = $this->isolate ('<a href="'. $href .'"'. $rel_nofollow .' class="nu">');
      $u_in = $this->isolate ('<u>');
      $u_out = $this->isolate ('</u>');
      $a_out = $this->isolate ('</a>');
      return $a_in . $hang_left . $u_in . $text . $u_out . $hang_right . $a_out;
    } else {
      $a_in = $this->isolate ('<a href="'. $href .'"'. $rel_nofollow .'>');
      $a_out = $this->isolate ('</a>');
      if (!@$text) $text = $href;
      return $a_in . $text . $a_out;
    }
  
  }
  

  // converts naked urls in text into working links
  
  function revive_naked_url_callback ($params) {
    
    $possible_space = $params[1];
    $url = $params[2];

    $rel_nofollow = '';
    if (@$this->config['typography.nofollowhrefs']) {
      $rel_nofollow = ' rel="nofollow"';
    }

    return (
      $possible_space .
      $this->isolate ('<a href="'. $url .'"'. $rel_nofollow .'>'. $url .'</a>')
    );

  }
  

  // replacements, quotes, dashes, no-break spaces
  // input text must be netto:
  // no html entities, just actual utf-8 chars
  
  function typography ($text) {
    
    $nbsp = " ";
  
    $quotes = $this->language_data['quotes'];
    $dash = $this->language_data['dash'];
  
    //$span_tsp = $this->isolate ('<span class=\"tsp\">'. $nbsp .'</span>');
    $nobr_in = $this->isolate ('<nobr>');
    $nobr_out = $this->isolate ('</nobr>');
  
    $text = preg_replace_callback ('/(?:\<[^\>]+\>)/isxu', array ($this, 'isolate'), $text); // usafe
  
    if (@$this->config['typography.markup']) {

      // double brackets
      $chars = array ('\\(', '\\)', '\\[', '\\]');
      $text = preg_replace_callback ( // usafe
        '/'.
        '(?:'. $chars[0].$chars[0] .'(?!'. $chars[0] .')(?=\S)(.*?)'.  $chars[1].$chars[1] .')'.
        '|'.
        '(?:'. $chars[0].$chars[0] .'(?!'. $chars[0] .')(.*?)(?<=\S)'. $chars[1].$chars[1] .')'.
        '|'.
        '(?:'. $chars[2].$chars[2] .'(?!'. $chars[2] .')(?=\S)(.*?)'.  $chars[3].$chars[3] .')'.
        '|'.
        '(?:'. $chars[2].$chars[2] .'(?!'. $chars[2] .')(.*?)(?<=\S)'. $chars[3].$chars[3] .')'.
        '/imu',
        array ($this, 'process_double_brackets_contents_callback'),
        $text
      );
  
      // naked urls in the text
      if (@$this->config['typography.autohref']) {
        $url_regex = (
          '/'.
          '(\s|^|'. $this->rx_tags_regex .')'.
          '((?:https?|ftps?)\:\/\/[\w\d\#\.\/&=%-_!\?\@\*]+)'.
          '/isu'
        );
        $text = preg_replace_callback (
          $url_regex,
          array ($this, 'revive_naked_url_callback'),
          $text
        );
      }

      // wiki stuff
      $duomap = array ('/' => 'i', '*' => 'b', '-' => 's');
      foreach ($duomap as $from => $to) {
        if (!@$t_in[$to]) $t_in[$to] = $this->isolate ('<'. $to .'>');
        if (!@$t_out[$to]) $t_out[$to] = $this->isolate ('</'. $to .'>');
        $char = '\\'. $from;
        $text = preg_replace ( // usafe
          '/'.
          '(?:'. $char.$char .'(?!'. $char .')(?=\S)(.*?)'. $char.$char .')'.
          '|'.
          '(?:'. $char.$char .'(?!'. $char .')(.*?)(?<=\S)'. $char.$char .')'.
          '/imu',
          $t_in[$to] . '$1$2' . $t_out[$to],
          $text
        );
      }
    }
  
    // replacements
    if (1) {
      if (array_key_exists ('replacements', $this->language_data)) {
        $text = str_replace (
          array_keys ($this->language_data['replacements']),
          array_values ($this->language_data['replacements']),
          $text
        );
      }
    }
  
    // quotes
    $text = $this->enclose_within_tagless ($text, '"', $quotes);
  
  
    // dash
    $text = preg_replace ( // usafe
      '/(?<=^| |'. preg_quote ($nbsp) .')('. $this->rx_tags_regex .')\-('. $this->rx_tags_regex .')(?= |$)/mu', // usafe
      '$1'. $dash .'$2',
      $text
    );
  
    // space before dash
    $text = preg_replace ( // usafe
      '/ ('. $this->rx_tags_regex .')'. preg_quote ($dash) .'/', $nbsp .'$1'. $dash, $text // usafe
    );
  
    // unions and prepositions
    if (1) {
      //die ($text);
      if ($nobreak_fw = $this->language_data['with-next']) {
        $text = preg_replace ( // usafe
          "/".
          "(?<!\pL|\-)".    // not-a—Unicode-letter-or-dash lookbehind
          $nobreak_fw .     // a preposition
          "(". $this->rx_tags_regex .")".
          " ".              // and a space
          "/isu",      
          '$1$2'. $nbsp,
          $text
        );
      }
  
      if ($nobreak_bw = $this->language_data['with-prev']) {
        $text = preg_replace ( // usafe
          "/".
          " ".             // a space
          "(". $this->rx_tags_regex .")".
          $nobreak_bw .    // a particle
          "(?!\pL|\-)".    // not-a—Unicode-letter-or-dash lookforward
          "/isu",      
          $nbsp .'$1$2',
          $text
        );
      }
    }
  
  
    return $text;
  
  }


  // any opaque fragment or a text fragment after formatting
  // should be typographed with this function
  
  private function process_opaque_fragment ($text) {
  
    // replace &laquo; with normal quote characters
    $text = str_replace (
      array_keys ($this->config['typography.cleanup']),
      array_values ($this->config['typography.cleanup']),
      $text
    );
  
    if ($this->config['typography.on']) {
      $text = $this->typography ($text);
    }
  
    $text = $this->unisolate ($text);
  
    return $text;
  
  }


  private function render_group ($class, $group) {
  
    if (!$class) return;
  
    $simple_group_classes = array (
      'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p'
    );
  
    if ($class == 'empty') {
  
      return '';
  
    } elseif (isset ($this->extensions[$class])) {
    
      return $this->extensions[$class]['instance']->render ($group, @$this->config['groups.classes'][$class]);
  
    } else {
  
      if (in_array ($class, $simple_group_classes)) {
        $ot = $ct = $class;
      } else {
        $ot = 'p neasden:class="'. $class .'"';
        $ct = 'p';
      }
  
      if (count ($group)) {

        $lines_content = array ();
        foreach ($group as $line) {
          $lines_content[] = $line['content'];
        }
        $lines_content = implode ('<br />'."\n", $lines_content);
    
        return "<". $ot .">". $lines_content ."</". $ct .">\n";

      } else {

        return '';

      }
  
  
    }
  
  }
    
  // return a group class by it’s current running definition
  private function matching_group ($rdef) {
    foreach ($this->groups as $group_class => $group_regex) {
      if (
        !@in_array ($group_class, $this->config['banned-groups']) and
        preg_match ('/^'. $group_regex .'$/', $rdef) // usafe
      ) {
        $this->groups_used[] = $group_class;
        return $group_class;
      }
    }
  }
  
  
  private function parse_group_line ($line) {
  
    $line = rtrim ($line); // usafe
  
    $result = array (
      'content' => $line,
      'quote-level' => 0,
      'class' => 'p',
      'class-data' => null,
    );
  
    if (strlen ($line) == 0) { // usafe
      $result['class'] = 'empty';
      return $result;
    }
  
    // headings
    $line_hashless = ltrim ($line, $this->config['groups.headings.char']); // usafe
    $heading_level = strlen ($line) - strlen ($line_hashless); // usafe
    if ($heading_level > 0 and $line_hashless[0] == ' ') {
      $result['content'] = ltrim ($line_hashless, ' '); // usafe
      $result['class'] = 'h'. min (
        ($heading_level + ((int) @$this->config['groups.headings.plus'])), self::MAX_H_LEVEL
      );
      return $result;
    }

    // echo '<pre>';
    // print_r( $this->line_classes);
    // die;
  
    // other classes
    foreach ($this->line_classes as $class => $regex) {
      $regex = '/^(?:'. $regex .')$/isu';
      if (preg_match ($regex, $line, $matches)) { // usafe
        if (
          !method_exists (@$this->extensions[$class]['instance'], 'detect_line')
          or $this->extensions[$class]['instance']->detect_line ($line, @$this->config['groups.classes'][$class])
        ) {
          $result['class'] = $class;
          $result['class-data'] = $matches;
          return $result;
        }
      }
    }
  
    return $result;
  
  }
  



  private function groups ($text) {
  
    $text = str_replace ("\r\n", "\n", $text); 
    $text = str_replace ("\r", "\n", $text); 
    $src_lines = explode ("\n", $text);
    $src_lines[] = '';
  
    $prev_quote_level = 0;
  
    $prev_spaceshift = 0;
    $depths_spaceshifts = array (0);
    $depth = 0;
  
    $list_levels = array ();
  
    $last_group_class = self::DEFAULT_GROUP;
  
    $groups = array ();
    $good_buffer = array ();
  
    $rdef = '';
  
    foreach ($src_lines as $src_line) {
  
      // quote level
      $line_quoteless = ltrim ($src_line, $this->config['groups.quotes.char']); // usafe
      $quote_level = strlen ($src_line) - strlen ($line_quoteless); // usafe
      $src_line = $line_quoteless;
      $quote_level_changed = ($prev_quote_level != $quote_level);
      $quote_level_inc = max (0, $quote_level - $prev_quote_level);
      $quote_level_dec = max (0, $prev_quote_level - $quote_level);
      $prev_quote_level = $quote_level;
  
      // analize spaceshifts and depth
      $line = ltrim ($src_line, ' '); // usafe
      $spaceshift = strlen ($src_line) - strlen ($line); // usafe
      if ($spaceshift > $prev_spaceshift) {
        $depth ++;
        $depths_spaceshifts[] = $spaceshift;
      }
      if ($spaceshift < $prev_spaceshift) {
        $new_depth = 0;
        foreach ($depths_spaceshifts as $depth_spaceshift) {
          if ($spaceshift > $depth_spaceshift) {
            $new_depth ++;
          } else {
            $spaceshift = $depth_spaceshift;
            break;
          }
        }
        while ($depth > $new_depth) {
          $depth --;
          array_pop ($depths_spaceshifts);
        }
      }
      $prev_spaceshift = $spaceshift;
  
      // parse and match line groups
  
      $line = $this->parse_group_line ($line);
      $line['result'] = '';
      $line['depth'] = $depth;
      $rdef .= '-'. $line['class'] .'-';
  
      $line['debug'] = implode ("-\n-", explode ('--', $rdef));
  
      $match_found = false;
  
      if ($group_class = $this->matching_group ($rdef) and !$quote_level_changed) {
        $last_group_class = $group_class;
        $match_found = true;
        $good_buffer[] = $line;
      }
  
      if ($quote_level_changed or !$match_found) {
  
        if ($quote_level_changed) {
          $line['debug'] .= "\n".'quotelevelchanged ';
        }
  
        if (!$match_found) {
          $line['debug'] .= "\n".'nomatch ';
        }

        $line['result'] = $this->render_group ($last_group_class, $good_buffer);
  
        for ($i=0; $i<$quote_level_inc; $i++) $line['result'] .= '<blockquote>'."\n";
        for ($i=0; $i<$quote_level_dec; $i++) $line['result'] .= '</blockquote>'."\n";
  
        // now the widow line should be processed as part of next group
  
        $good_buffer = array ($line);
        $rdef = '-'. $line['class'] .'-';
        $last_group_class = $this->matching_group ($rdef) or $last_group_class = self::DEFAULT_GROUP;
  
      }
  
      $groups[] = $line;
  
    }
  
    $another_line['result'] = $this->render_group ($last_group_class, $good_buffer);
    $groups[] = $another_line;
  
    return $groups;
  
  }
  

  // return a fragment strength for an html element
  
  private function element_strength ($element) {
    if (strstr (' '. $this->config['html.elements.sacred'] .' ', ' '. $element .' ')) {
      return self::FRAG_STRENGTH_SACRED;
    }
    if (strstr (' '. $this->config['html.elements.opaque'] .' ', ' '. $element .' ')) {
      return self::FRAG_STRENGTH_OPAQUE;
    }
    return self::FRAG_STRENGTH_TEXT;
  }
  
  
  // return a clean html element name given its html representation
  // e. g. '<P Class=some>' -> 'p'
  
  private function element_name ($text) {
    if ($text[0] != '<') return; // usafe
    if ($text[strlen ($text) - 1] != '>') return; // usafe
    $text = ltrim (substr ($text, 1, -1)) . ' '; // usafe: checked 128ness above
    $text = substr ($text, 0, strpos ($text, ' ')); // usafe: paired
    return strtolower (rtrim ($text)); // usafe: who cares
  }

  
  // splits the full text into fragments which can be treated
  // completely indepentenly, and then treats them so
  
  private function split_fragments ($text) {
      
    $machine = array (
      'text' => array (
        '<' => 'tag',
      ),
      'tag' => array (
        '<' => 'tag--oops-it-was-text-before',
        '>' => 'text',
        "'" => 'attr-s',
        '"' => 'attr-d',
      ),
      'attr-s' => array (
        "'" => 'tag',
      ),
      'attr-d' => array (
        '"' => 'tag',
      ),
      'comment' => array (),
      'code' => array (),
    );
  
    // raw length
    $l_raw = strlen ($text);
    $r = '';
    $state = 'text';
    $prevstate = 'text';
    $tagstack = array ();
    $fragments = array ();
    $thisfrag = array ('content' => '', 'strength' => -1);
    $current_el = '';
    $code_nesting = 0;
  
    // echo '='. (self::stopwatch () - $this->stopwatch)."<br>";
    
    for ($i = 0; $i < $l_raw; $i ++ ) {

      // next raw byte
      $c_el = $text[$i];
      $c = $c_el;
      
      // utf-8
      if (mb_internal_encoding () == 'UTF-8') {
        if (ord ($c_el) >= 192) {
          $c_el = $text[$i + 1];
          while ((ord ($c_el) >= 128) && (ord ($c_el) < 192)) {
            $i ++;
            $c .= $c_el;
            if ($i + 1 < $l_raw) {
              $c_el = $text[$i + 1];
            } else {
              break;
            }
          }
        }
      }

      $r .= $c;
  
      // auto manage state machine
      if (array_key_exists ($c, $machine[$state])) {
        $state = $machine[$state][$c];
      }
      
      if ($state == 'tag--oops-it-was-text-before') {
        $prevstate = 'text'; // boy is this dirty
        $state = 'tag';
      }
      
      // echo htmlspecialchars ('['.$r.'] ('.$c.') - '.$state).'<br>';

      // html comments: manually manage states
      if ($state == 'tag' and $r == '<!--') {
        $state = 'comment';
        if ($thisfrag['content']) {
          $fragments[] = $thisfrag;
        }
        $thisfrag = array ('content' => $r, 'strength' => -1);
        $r = '';
      }
      if ($state == 'comment' and mb_substr ($r, -3, 3) == '-->') { 
        $state = 'text';
        $thisfrag['content'] .= $r;
        $thisfrag['strength'] = self::FRAG_STRENGTH_SACRED;
        if ($thisfrag['content']) {
          $fragments[] = $thisfrag;
        }
        $thisfrag = array ('content' => '', 'strength' => -1);
        $r = '';
      }
    
      // code tag: manually manage states
      if (($state == 'text' or $state == 'code') and mb_substr ($r, -6, 6) == '<code>') {
        ++ $code_nesting;
        if ($code_nesting == 1) {
          $state = 'code';
          if ($thisfrag['content']) {
            $fragments[] = $thisfrag;
          }
          $thisfrag = array (
            'content' => '', // don’t put the very <code> tag here
            'strength' => self::FRAG_STRENGTH_SACRED,
            'code' => 1
          );
          $r = '';
        }
      }
      if ($state == 'code' and mb_substr ($r, -7, 7) == '</code>') { 
//        echo htmlspecialchars ($r);
//        die;
        -- $code_nesting;
        if ($code_nesting < 1) {
          $state = 'text';
          $r = substr ($r, 0, -7); // remove the closing </code> tag from here
          $r = trim ($r);
          $thisfrag['content'] = $r;
          if ($thisfrag['content']) {
            $fragments[] = $thisfrag;
          }
          $thisfrag = array ('content' => '', 'strength' => -1);
          $r = '';
        }
      }
  
      // state change
      if ($state != $prevstate) {
        if ($prevstate == 'text' and $state == 'tag') {
  
          // state changes from text to tag,
          // so commit all previous text to this fragment
          // start a new run with a '<'
          // and then just see how it goes from there
          $thisfrag['content'] .= mb_substr ($r, 0, -1);
  
          // set strength if not yet set
          if ($thisfrag['strength'] == -1) {
            $thisfrag['strength'] = $this->element_strength ($current_el);
          }
          
          $r = mb_substr ($r, -1, 1);
  
        } elseif ($prevstate == 'tag' and $state == 'text') {
  
          $tagname = $this->element_name ($r);
          
          if (substr ($tagname, 0, 1) != '/') { // usafe
  
            // open tag
  
            if (
              $this->element_strength ($tagname) > $thisfrag['strength']
            ) {
  
              // new fragment is stronger,
              // so commit this fragment to fragments, start a new fragment
              if ($thisfrag['content']) {
                $fragments[] = $thisfrag;
              }
              $thisfrag = array ('content' => $r, 'strength' => -1);
  
            } else {
  
              $thisfrag['content'] .= $r;
              //$thisfrag['content'] .= $this->isolate ($r);
  
            }
  
            $tagstack[] = $tagname;
            $current_el = $tagname;
            $r = '';
  
          } else {
  
            // close tag
            $tagname = substr ($tagname, 1); // usafe
            
            if (in_array ($tagname, $tagstack)) {

              // so tag is in stack, so we force close it
              $strength_before = $this->element_strength ($tagname);
              while (($popping_el = array_pop ($tagstack)) != $tagname) {
                $strength_before = max ($strength_before, $this->element_strength ($popping_el));
              };

              // if anything remains in the stack, that’s new current tag
              if (count ($tagstack) > 0) {
                $current_el = $tagstack [count ($tagstack) - 1];
              } else {
                $current_el = '';
              }

              if ($this->element_strength ($current_el) < $strength_before) {
  
                // so we are now off sacred elements, 
                // so finish and append this fragment, start new fragment
                $thisfrag['content'] .= $r ."\n";
                //$thisfrag['content'] .= $this->isolate ($r);
                $fragments[] = $thisfrag;
                $thisfrag = array ('content' => '', 'strength' => -1);
                $r = '';
  
              }
  
            } else {
  
              if (
                strstr (' '. $this->config['html.elements.sacred'] .' ', ' '. $tagname .' ') or
                strstr (' '. $this->config['html.elements.opaque'] .' ', ' '. $tagname .' ')
              ) {
  
                // closing tag makes no sense, it wasn’t open
  
                // so end whatever fragments we have
                if ($thisfrag['content']) {
                  $fragments[] = $thisfrag;
                }
  
                // make a new sacred fragment of this weird tag
                $fragments[] = array (
                  'content' => $r,
                  'strength' => self::FRAG_STRENGTH_SACRED,
                );
  
                // and start new fragment
                $thisfrag = array ('content' => '', 'strength' => -1);
                $r = '';
              }
            }
          }
  
        }
      }
  
      $prevstate = $state;
  
    }

    // echo '='. (self::stopwatch () - $this->stopwatch)."<br>";
  
    $thisfrag['content'] .= $r;
    if ($thisfrag['strength'] == -1) {
      $thisfrag['strength'] = $this->element_strength ($current_el);
    }
    $r = '';
  
    if ($thisfrag['content']) {
      $fragments[] = $thisfrag;
    }
  
    return $fragments;
  
  }


  private function formatted_fragments () {
    
    $text = $this->input;
    
    // remove html if necessary
    if (!$this->config['html.on']) {
      $text = str_replace ('<', '&lt;', $text);
      #$text = str_replace ('>', '&gt;', $text);
    }
    
    // dirty split
    // echo '1='. (self::stopwatch () - $this->stopwatch)."<br>";
    $initial_fragments = $this->split_fragments ($text);
    // echo '2='. (self::stopwatch () - $this->stopwatch)."<br>";
    
    // process initial fragments
    $resulting_fragments = array ();  
    foreach ($initial_fragments as $initial_fragment) {
    
      // if explaining, borough the initial
      // explanation to result
      if ($this->should_explain) {
        $resulting_fragment = $initial_fragment;
      }
    
      $resulting_fragment['result'] = $initial_fragment['content'];
    
      // text fragments should be formatted
      if (
        $this->config['groups.on'] and
        $initial_fragment['strength'] == self::FRAG_STRENGTH_TEXT
      ) {
    
        $resulting_fragment['result'] = '';
        $resulting_fragment['processing'] = array ();
    
        foreach ($this->groups ($initial_fragment['content']) as $group) {
          $resulting_fragment['processing'][] = $group;
          $resulting_fragment['result'] .= $group['result'];
        }
    
      }
    
      // opaque fragments should be typographed
      if ($initial_fragment['strength'] <= self::FRAG_STRENGTH_OPAQUE) {
        $resulting_fragment['result'] = $this->process_opaque_fragment ($resulting_fragment['result']);
      }
      
      // wrap the code into the real code tags
      if (array_key_exists ('code', $initial_fragment) and $initial_fragment['code']) {
        if ($this->config['html.code.on']) {
          $resulting_fragment['result'] = (
            $this->config['html.code.wrap'][0] .
            htmlspecialchars ($resulting_fragment['result']) .
            $this->config['html.code.wrap'][1]
          );
          if ($this->config['html.code.highlightjs']) {
            $this->links_required[] = @$this->config['library']. 'highlight/highlight.js';
            $this->links_required[] = @$this->config['library']. 'highlight/highlight.css';
          }
        } else {
          $resulting_fragment['result'] = '<code>'. $resulting_fragment['result'] .'</code>';
        }
      }
    
      $resulting_fragments[] = $resulting_fragment;
      // echo '['. substr (htmlspecialchars ($resulting_fragment['result']), 0, 30) .']<br>';
      // echo '0='. (self::stopwatch () - $this->stopwatch)."<br>";
    
    }
    
    // echo '3='. (self::stopwatch () - $this->stopwatch)."<br>";

    return $resulting_fragments;
    
  }  
  
  public function format ($input = null) {
  
    $this->stopwatch = self::stopwatch ();
    
    if ($input !== null) $this->input = $input;
    
    $last_mb_encoding = mb_internal_encoding ();
    mb_internal_encoding ('utf-8');

    $profile = $this->profile_name or $profile = '';
    
    if ($profile and $this->config['__profiles'][$profile]) {
      $this->config = array_merge ($this->config, $this->config['__profiles'][$profile]);
    }
    
    $this->language_data = require 'languages/'. $this->config['language'] .'.php';

    $this->output = '';
    
    if ($this->should_explain) {
      
      $this->explanation = '';
      $this->explanation .= '<style>';
      $this->explanation .= 'table.neasden-explanation { font-size: 85%; background: #f0f0f0 }';
      $this->explanation .= 'table.neasden-explanation td { border-top: 1px #ccc solid; padding: 2px 8px 2px 2px }';
      $this->explanation .= 'table.neasden-explanation tr.frag td { border-top: 2px #000 solid }';
      $this->explanation .= '</style>';
      $this->explanation .= '<table class="neasden-explanation" cellspacing="0" cellpadding="0" border="0">';
      $this->explanation .= '<tr valign="top">';
      $this->explanation .= '<td><tt><b>frags and groups</b></tt></td>';
      $this->explanation .= '<td><tt><b>processing</b></tt></td>';
      $this->explanation .= '<td><tt><b>result</b></tt></td>';
      $this->explanation .= '</tr>';
      
    }
    
    foreach ($this->formatted_fragments () as $frag) {
    
      $this->output .= $frag['result'];
    
      if ($this->should_explain) {
    
        $color = '#f00';
        if ($frag['strength'] == self::FRAG_STRENGTH_TEXT) $color = '#080';
        if ($frag['strength'] == self::FRAG_STRENGTH_OPAQUE) $color = '#00a';
        if ($frag['strength'] == self::FRAG_STRENGTH_SACRED) $color = '#000';

        $this->explanation .= '<tr valign="top" class="frag">';
        $this->explanation .= (
          '<td style="background: #ffc; color: '. $color .'"><tt>['.
          htmlspecialchars ($frag['content'], ENT_NOQUOTES, 'UTF-8') . // usafe
          ']</tt></td>'
        );
    
        if (is_array (@$frag['processing'])) {
          $this->explanation .= '<td><tt>see below ↓</tt></td>';
        } else {
          $this->explanation .= '<td><tt>['. @print_r ($frag['debug'], true) .']</tt></td>';
        }
        $this->explanation .= '<td><tt>['. htmlspecialchars ($frag['result'], ENT_NOQUOTES, 'UTF-8') .']</tt></td>'; // usafe
        $this->explanation .= '</tr>';
    
        if (is_array (@$frag['processing'])) {
          foreach ($frag['processing'] as $group) {
            $this->explanation .= '<tr valign="top">';
            $this->explanation .= '<td><tt>['. @htmlspecialchars  ($group['content'], ENT_NOQUOTES, 'UTF-8') .']</tt></td>'; // usafe
            $this->explanation .= '<td><tt>['. @str_repeat ('>', $group['depth']) .''. @$group['class'] .'<br />'. @print_r ($group['debug'], true) .']</tt></td>';
            $this->explanation .= '<td><tt>['. @htmlspecialchars  ($group['result'], ENT_NOQUOTES, 'UTF-8') .']</tt></td>'; // usafe
            $this->explanation .= '</tr>';
          }
        }
    
      }
    
    }
    
    if ($this->should_explain) {
      $this->explanation .= '</table>';
    }
    
    $preresult = '';
    
    $this->output = $preresult . $this->output;

    mb_internal_encoding ($last_mb_encoding);
    
    return $this->output;

  }
  
}


?>