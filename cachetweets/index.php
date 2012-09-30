<?php

include_once ('./../notsoimportant.php');
include_once ('./../easysql_sqlite.php');
include_once ('./../crypto.php');

$filenamedata = './../timeline.data.sqlite';

$twitteraccount = $_GET['tweet'];
$filename       = './../timeline-'.$_GET['tweet'].'.sqlite';

if(($_GET['update'] !== 'no')&&($_GET['update'] !== 'false')&&($_GET['update'] !== '0'))
  {
    if(!file_exists($filenamedata))
      {
        $create[0]           = $filenamedata;
        $create[1]           = 'data';
        $create['id']        = 'integer PRIMARY KEY AUTOINCREMENT';
        $create['source']    = 'varchar NOT NULL';
        $create['sourceurl'] = 'varchar NOT NULL';
        $create['fetchtime'] = 'integer';
        easysql_sqlite_create($create);
      }
    
    if($_GET['tweet'] != '')
      {
        include ('./twitter.php');
        
        importtweets($twitteraccount, $filename);
        
        $insertsource = 'twitter';
        $inserturl    = $_GET['tweet'];
      }
    
    if(isset($inserturl))
      {
        $rand = rand(1,50000);
        $insert[0]            = $filenamedata;
        $insert[1]            = 'data';
        $insert['source']     = $insertsource;
        $insert['sourceurl']  = $inserturl;
        $insert['fetchtime']  = time();
        
        
        $rowid = easysql_sqlite_insert($insert);
      }
  }

$getsorted[0] = $filename;
$getsorted[1] = 'timeline';
$limit = 32;
if(isset($_GET['limit']))
  {
    $limit = ($_GET['limit']+1-1);
  }

$return = easysql_sqlite_getsorted($getsorted, $order = 'timestamp', $limit, $direction = 1);
echo '<ol class="itemlist">'."\n";

foreach ($return as $item)
  {
    $source = explode('|', $item['source'], 2);
    echo '<li><a href="'.$item['sourceurl'].'"><img style="height:16px;" class="itemtype" src="./../img/'.$source[0].'.png"></a> ';
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

echo '</ol>';

?>
