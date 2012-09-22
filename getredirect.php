<?php

function get_redirect_location($url)
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $header = curl_exec($ch);
    curl_close($ch);
    preg_match('/Location: (.*)/', $header, $match);
    return sprintf(" %s ", ' '.trim($match[1]).' ');
  }

?>