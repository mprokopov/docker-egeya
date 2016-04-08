<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?= $content['meta']['output-charset'] ?>" />

<style type="text/css">

*           { font-family: "Consolas", "Courier New", monospace; line-height: 1.2em }
body        { background: #fff; font-size: 80% }
blockquote  { margin: 0 .67em 0 3.33em }
p           { margin: .5em 0 }
body        { color: #999 }
b           { color: #000; font-weight: normal }
.s          { color: #060; font-style:  normal }
.o          { color: #009; font-style:  normal }
.t          { color: #069; font-style:  normal }
.flip       { border-bottom: 1px #999 dashed; cursor: pointer; cursor: hand }
small       { color: #900 }
.hr         { height: .3em; margin-left: 3.00em; margin-right: 0em; border: #999 solid }
.thr        { border-width: 1px 1px 0 1px }
.bhr        { border-width: 0 1px 1px 1px }

/*
div .hr { border-color: #c00 }
div div .hr { border-color: #090 }
div div div .hr { border-color: #00f }
div div div div .hr { border-color: #f90 }
div div div div div .hr { border-color: #c0c }
div div div div div div .hr { border-color: #09c }
*/

div .hr { border-style: solid }
div div .hr { border-style: dotted }
div div div .hr { border-style: dashed }
div div div div .hr { border: none }

</style>

<script type="text/javascript">
function flip (n) {
if (document.getElementById ('id-' + n).style.display == 'none') {
  document.getElementById ('id-' + n).style.display = 'inline'
  document.getElementById ('id-' + n + '-b').style.display = 'none'
} else {
  document.getElementById ('id-' + n).style.display = 'none'
  document.getElementById ('id-' + n + '-b').style.display = 'inline'
}
}
</script>

<e2:head-data />

</head>

<body>

<p><b>Structure and contents of $content</b></p>
<p></p>

<?php 

  $_global_flipid = 0;
  
  function _rawtmpl_list ($what) {
    global $_global_flipid;
    foreach ($what as $k => $v) {
      echo '<p>';
      echo '<b>'. htmlspecialchars (var_export ($k, true), ENT_NOQUOTES, HSC_ENC) .'</b>&nbsp;= ';
      ++ $_global_flipid;
      if (is_array ($v)) {
        if (
          count ($v) == 2 and
          is_integer ($v[0]) and
          is_array ($v[1]) and
          count ($v[1]) == 2 and
          array_key_exists ('offset', $v[1]) and
          is_integer ($v[1]['offset']) and
          array_key_exists ('is_dst', $v[1]) and
          is_bool ($v[1]['is_dst'])
        ) {
          // e2time
          echo '<span class="flip" onclick="flip ('. $_global_flipid .')">e2 time</span> ';
          echo '<span id="id-'. $_global_flipid .'" style="display: inline"><span class="t">'.
               _DT ('j {month-g} Y, H:i, {zone}', $v) .'</span></span>';
        } else {
          // just an array
          echo '<span class="flip" onclick="flip ('. $_global_flipid .')">array</span> ';
          echo '<span id="id-'. $_global_flipid .'" style="display: inline"><small>'.
               count ($v) .'</small></span>';
        }
        
        echo '<div id="id-'. $_global_flipid .'-b" style="display: none">';
        //echo '(';
        echo '<div class="hr thr"></div>';
        echo '<blockquote>';
        echo _rawtmpl_list ($v);
        echo '</blockquote>';
        echo '<div class="hr bhr"></div>';
        //echo ')';
        echo '</div>';
        
      } elseif (is_string ($v)) {
        if (strip_tags ($v) != $v or strlen ($v) > 1024) {
          echo '<span class="flip" onclick="flip ('. $_global_flipid .')">html string</span> ';
          echo '<span id="id-'. $_global_flipid .'" style="display: inline"><small>'.
               strlen ($v) .' bytes</small></span>';
          echo '<div id="id-'. $_global_flipid .'-b" style="display: none">';

          //echo '(';
          echo '<div class="hr thr"></div>';
          echo '<blockquote>';
          #echo '<span>'. highlight_string ($v, true) .'</span>';
          echo $v;
          echo '</blockquote>';
          echo '<div class="hr bhr"></div>';
          //echo ')';

          echo '</div>';
        } else {
          echo '<span class="s">'. htmlspecialchars (var_export ($v, true), ENT_NOQUOTES, HSC_ENC) .'</span>';
        }
      } else {
        echo '<span class="o">'. htmlspecialchars (var_export ($v, true), ENT_NOQUOTES, HSC_ENC) .'</span>';
      }
      echo '</p>';
    }
  }
  
 _rawtmpl_list ($content);
 
?>

</body>

</html>