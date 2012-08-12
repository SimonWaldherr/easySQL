<?php

include_once ('./../notsoimportant.php');
include_once ('./../easysql_sqlite.php');
include_once ('./../crypto.php');

function loadarticles($rssfeed, $filename, $lastarticle = 'false')
  {
    $i = 0;
    if($xml = simplexml_load_file($rssfeed))
      {
        $xml = simplexml_load_file($rssfeed);
        //$xml = str_replace("content:encoded","content",$xml);
        foreach($xml->channel->item as $article)
          {
            $article_text = $article->description;
            //$article_text = $article->content;
            //$article_text = substr(strstr($article_text, ': '), 2, strlen($article_text));
            
            $article_text = str_replace(array('<![CDATA[', ']]>'), '', $article_text);
            
            $article_text = preg_replace( '@(?<![.*">])\b(?:(?:https?|ftp|file)://|[a-z]\.)[-A-Z0-9+&#/%=~_|$?!:,.]*[A-Z0-9+&#/%=~_|$]@i', '<a href="\0" target="_blank">\0</a>', $article_text );

            //$article_text = preg_replace('(@([a-zA-Z0-9_]+))', "<a href='http://www.twitter.com/\$1'>\$0</a>", $article_text);
            
            echo $article->title."\r\n<br>";
            $article_text = strip_tags(addslashes($article_text));
            if(strlen($article_text)>512)
              {
                $article_text = substr($article_text, 0, 509).'...';
              }
            echo $article_text."\r\n<br>";
            //$article_text = easysql_raw2hex(preg_replace('(#([a-zA-Z0-9_-äüöß-]+))', "<a href='http://search.twitter.com/search?q=%23\$1'>#\$1</a>", $article_text));
            
            $article_text = urlencode($article_text);
            
            $insert[0]           = $filename;
            $insert[1]           = 'timeline';
            $insert['source']    = 'rss|'.$rssfeed;
            $insert['title']     = $article->title;
            $insert['text']      = $article_text;
            
            echo $article_text."\r\n<br><hr>";
            
            $insert['sourceurl'] = $article->link;
            $insert['timestamp'] = strtotime($article->pubDate);
            $insert['fetchtime'] = time();
            
            if($insert['timestamp'] == $lastarticle)
              {
                return $i;
              }

            $i++;

            $rowid = easysql_sqlite_insert($insert);
          }
      }
    else
      {
        
      }
    return $i;
  }

$rssfeed  = 'http://cdn.simon.waldherr.eu/projects/easySQL/import/iphoneblog.xml';
$filename = './timeline.sqlite';

if(file_exists($filename))
  {
    $maxmin[0] = $filename;
    $maxmin[1] = 'timeline';
    $maxmin[2] = 'timestamp';
    $maxmin[3] = easysql_sqlite_maxmin($maxmin, "source =  'rss|".$rssfeed."'");
    echo 'Timestamp des letzten Eintrags: '.easysql_sqlite_maxmin($maxmin)."\n<br>";
    echo 'Datenbank enthält: '.easysql_sqlite_count(array($filename, 'timeline')).' Einträge'."\n<br>";
    echo 'Neu geladene Artikel: '.loadarticles($rssfeed, $filename, $maxmin[3]);
  }
else
  {
    $create[0]           = $filename;
    $create[1]           = 'timeline';
    $create['id']        = 'integer PRIMARY KEY AUTOINCREMENT';
    $create['source']    = 'varchar NOT NULL';
    $create['title']     = 'varchar NOT NULL';
    $create['text']      = 'varchar NOT NULL';
    $create['sourceurl'] = 'varchar NOT NULL';
    $create['timestamp'] = 'integer';
    $create['fetchtime'] = 'integer';
    
    easysql_sqlite_create($create);
    echo loadarticles($rssfeed, $filename);
  }

?>