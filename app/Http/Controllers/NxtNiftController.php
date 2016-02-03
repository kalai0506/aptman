<?php

namespace App\Http\Controllers;

class NxtNiftController extends Controller {
  function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
  function parse_info() {
    $str = get_data('http://nxtnifty.com');
    $s = preg_replace([ '/\r?\n/', '/\s\s+/', '/<!--.*?-->/', '/style="[^"]+"/' ], [ '', ' ', '', '' ], $str);
    preg_match_all('/<li [^>]*>(.*?)<span [^>]*>(.*?)<\/span>\s*?<\/li>/', $s, $out, PREG_SET_ORDER);
    $data = array('swing' => 'UP');
    foreach ( $out as $match ) {
      print_r ($match);
      if ( preg_match('/<img/', $match[1]) ) {
        if ( preg_match('/spec-menu-arrow.png/', $match[1]) ) {
          $data['swing'] = 'DOWN';
        } else {
          $data['swing'] = 'UP';
        }
        $data['swing-value'] = trim($match[2]);
      } else {
        $data[trim($match[1])] = trim($match[2]);
      }
    }
    preg_match('/<input .*? value="([^"]+)"/', $s, $out);
    $data['index'] = $out[1];
    return $data;
  }
  public function index(){
    return json_encode(parse_info());
  }

}
