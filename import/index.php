<?php

include_once ('./../notsoimportant.php');
include_once ('./../easysql_sqlite.php');
include_once ('./../crypto.php');


$filenamedata = './../timeline.data.sqlite';

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
    //$twitteraccount = 81907376;
    $twitteraccount = $_GET['tweet'];
    $filename       = './../timeline.sqlite';
    importtweets($twitteraccount, $filename);
    
    $insertsource = 'twitter';
    $inserturl    = $_GET['tweet'];
  }
if($_GET['feed'] != '')
  {
    include ('./rss.php');
    //$rssfeed  = 'http://cdn.simon.waldherr.eu/projects/easySQL/iphoneblog.xml';
    //             http://startup.simon.waldherr.eu/feeds/posts/default
    
    //var_dump($_GET);
    
    $rssfeed  = urldecode($_GET['feed']);
    echo $rssfeed;
    $filename = './../timeline.sqlite';
    echo $filename;
    echo importarticles($rssfeed, $filename);
    
    $insertsource = 'rss';
    $inserturl    = $_GET['feed'];
    echo 'test';
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

?>
<a href="?tweet=81907376">import tweets</a><br>
<a href="?feed=<?php echo urlencode('http://cdn.simon.waldherr.eu/projects/easySQL/iphoneblog.xml') ?>">import feed iphoneblog</a><br>
<a href="?feed=<?php echo urlencode('http://startup.simon.waldherr.eu/feeds/posts/default') ?>">import feed</a><br>
