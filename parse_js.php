<?php

class JsParserException extends Exception {}
function parse_jsobj($str, &$data) {
    $str = trim($str);
    if(strlen($str) < 1) return;

    if($str{0} != '{') {
        throw new JsParserException('The given string is not a JS object');
    }
    $str = substr($str, 1);

    /* While we have data, and it's not the end of this dict (the comma is needed for nested dicts) */
    while(strlen($str) && $str{0} != '}' && $str{0} != ',') { 
        /* find the key */
        if($str{0} == "'" || $str{0} == '"') {
            /* quoted key */
            list($str, $key) = parse_jsdata($str, ':');
        } else {
            $match = null;
            /* unquoted key */
            if(!preg_match('/^\s*[a-zA-z_][a-zA-Z_\d]*\s*:/', $str, $match)) {
            throw new JsParserException('Invalid key ("'.$str.'")');
            }   
            $key = $match[0];
            $str = substr($str, strlen($key));
            $key = trim(substr($key, 0, -1)); /* discard the ':' */
        }

        list($str, $data[$key]) = parse_jsdata($str, '}');
    }
    "Finshed dict. Str: '$str'\n";
    return substr($str, 1);
}

function comma_or_term_pos($str, $term) {
    $cpos = strpos($str, ',');
    $tpos = strpos($str, $term);
    if($cpos === false && $tpos === false) {
        throw new JsParserException('unterminated dict or array');
    } else if($cpos === false) {
        return $tpos;
    } else if($tpos === false) {
        return $cpos;
    }
    return min($tpos, $cpos);
}

function parse_jsdata($str, $term="}") {
    $str = trim($str);


    if(is_numeric($str{0}."0")) {
        /* a number (int or float) */
        $newpos = comma_or_term_pos($str, $term);
        $num = trim(substr($str, 0, $newpos));
        $str = substr($str, $newpos+1); /* discard num and comma */
        if(!is_numeric($num)) {
            throw new JsParserException('OOPSIE while parsing number: "'.$num.'"');
        }
        return array(trim($str), $num+0);
    } else if($str{0} == '"' || $str{0} == "'") {
        /* string */
        $q = $str{0};
        $offset = 1;
        do {
            $pos = strpos($str, $q, $offset);
            $offset = $pos;
        } while($str{$pos-1} == '\\'); /* find un-escaped quote */
        $data = substr($str, 1, $pos-1);
        $str = substr($str, $pos);
        $pos = comma_or_term_pos($str, $term);
        $str = substr($str, $pos+1);        
        return array(trim($str), $data);
    } else if($str{0} == '{') {
        /* dict */
        $data = array();
        $str = parse_jsobj($str, $data);
        return array($str, $data);
    } else if($str{0} == '[') {
        /* array */
        $arr = array();
        $str = substr($str, 1);
        while(strlen($str) && $str{0} != $term && $str{0} != ',') {
            $val = null;
            list($str, $val) = parse_jsdata($str, ']');
            $arr[] = $val;
            $str = trim($str);
        }
        $str = trim(substr($str, 1));
        return array($str, $arr);
    } else if(stripos($str, 'true') === 0) {
        /* true */
        $pos = comma_or_term_pos($str, $term);
        $str = substr($str, $pos+1); /* discard terminator */
        return array(trim($str), true);
    } else if(stripos($str, 'false') === 0) {
        /* false */
        $pos = comma_or_term_pos($str, $term);
        $str = substr($str, $pos+1); /* discard terminator */
        return array(trim($str), false);
    } else if(stripos($str, 'null') === 0) {
        /* null */
        $pos = comma_or_term_pos($str, $term);
        $str = substr($str, $pos+1); /* discard terminator */
        return array(trim($str), null);
    } else if(strpos($str, 'undefined') === 0) {
        /* null */
        $pos = comma_or_term_pos($str, $term);
        $str = substr($str, $pos+1); /* discard terminator */
        return array(trim($str), null);
    } else {
        throw new JsParserException('Cannot figure out how to parse "'.$str.'" (term is '.$term.')');
    }
}

function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}

// // $data = '{fu:"bar",baz:["bat"]}';    
// $parsed = array();    
// // parse_jsobj($data, $parsed);    
// // var_export($parsed);

// $contents = file_get_contents('http://a0.awsstatic.com/pricing/1/ec2/pricing-data-transfer-with-regions.min.js');

// $contents = delete_all_between('/*', '*/', $contents);


// $contents = str_replace('callback(', '', $contents);
// $contents = str_replace(');', '', $contents);
// $contents = str_replace('vers:0.01,', '', $contents);
// $contents = str_replace('{config:{currencies:["USD"],valueColumns:["pricing"],rate:"perGB"', '', $contents);
// $contents[1] = '{';
// $contents = substr($contents, 0, -1);

// // $contents = json_encode($contents);

// // $contents = str_replace('\"', '', $contents);
// // $contents = str_replace('"\n', '', $contents);



// $json = ($contents);
// $json = json_encode($json);
// echo '<pre>';
// print_r($json);

// foreach($json as $v){
//     print_r($v);
// }
// echo '</pre>';

// parse_jsobj($json, $parsed);    


?>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
</head>
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">

function callback(data){
    // var regions = JSON.stringify(data.config.regions);
    var itemReg =  $.map(data.config.regions, function(value){
        return value;
    });

    // console.log(itemReg);
    // var itemReg = '';
    // $.each(data.config.regions, function (index, value) {
    //     // console.log(value);

    //     itemReg += '<pre>'+value.region+'</pre>';
    //     $.each(value.types, function (i2, v2) {
    //        $.each(value.types, function (i3, v3) {
    //             console.log(v3);
    //             // itemReg += '<pre>'+v2.region+'</pre>';
    //         });
    //         // itemReg += '<pre>'+v2.region+'</pre>';
    //     });
    // });

    // $('#regions').html(itemReg);
   $('#regions').html(JSON.stringify(itemReg));
}

$(document).ready(function(){
    $.ajax({
      url: 'http://a0.awsstatic.com/pricing/1/ec2/pricing-data-transfer-with-regions.min.js',
      dataType: 'jsonp',
      jsonpCallback: 'callback', // specify the callback name if you're hard-coding it
      success: function(data){
        // callback(data);
        // $.each(data.response.venue.tips.groups, function (index, value) {
        //     $.each(this.items, function () {
        //         console.log(this.text);
        //     });
        // });
      }
    });

});
</script>

<div id="regions"></div>

