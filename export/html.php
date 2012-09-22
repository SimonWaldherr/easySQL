<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>easySQL export demo</title>
    
    <link href="./style.css" rel="stylesheet" type="text/css">
    <style>
      body{
        font-family: "Lucida Grande", "Lucida Sans Unicode", Geneva, sans-serif;
      }
      a{
        color: #5eacff;
        text-decoration: none;
        font-weight: bold;
      }
      a:visited{
        color: #4975ff;
      }
      a:hover{
        color: #1968ff;
        font-weight: bolder;
      }
      .itemtype{
        height: 16px;
        width: 16px;
      }
      ul, .itemlist{
        list-style: none;
      }
    </style>
</head>
<body>
<?php

  include_once ('./../notsoimportant.php');
  include_once ('./../easysql_sqlite.php');
  include_once ('./../crypto.php');
  
  $filename = './../timeline.sqlite';
  
  $getsorted[0] = $filename;
  $getsorted[1] = 'timeline';
  
  $return = easysql_sqlite_getsorted($getsorted, $order = 'timestamp', $limit = 128, $direction = 1);
  echo '<ol class="itemlist">'."\n";
  
  foreach ($return as $item)
    {
      $source = explode('|', $item['source'], 2);
      echo '<li><a href="'.$item['sourceurl'].'"><img class="itemtype" src="./../img/'.$source[0].'.png"></a> ';
      if($item['title'] == 'tweet')
        {
          echo urldecode($item['text']);
        }
      else
        {
          echo $item['title'];
        }
      echo '</li>'."\n";
    }
  
  echo '<li><a href="?limit=no">load more ...</a></li>';
  echo '</ol>';

?>
</body>
</html>
