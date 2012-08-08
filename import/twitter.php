<?php

include_once ('./../notsoimportant.php');
include_once ('./../easysql_sqlite.php');
include_once ('./../crypto.php');

function loadtweets($twitteraccount, $filename, $lasttweet = 'false')
  {
    if($xml = simplexml_load_file('http://twitter.com/statuses/user_timeline/'.$twitteraccount.'.rss'))
      {
        $tweet_array = array();
        $lasttweetcheck = 0;
        $complete = 0;
        $i_feed = 1;
        $i = 0;
        while($complete == 0)
          {
            $xml = simplexml_load_file('http://twitter.com/statuses/user_timeline/'.$twitteraccount.'.rss?count=200&page='.$i_feed);
            $i_before = $i;
            foreach($xml->channel->item as $tweet)
              {
                $tweet_text = $tweet->description;
                $tweet_text = substr(strstr($tweet_text, ': '), 2, strlen($tweet_text));
                $tweet_text = preg_replace( '@(?<![.*">])\b(?:(?:https?|ftp|file)://|[a-z]\.)[-A-Z0-9+&#/%=~_|$?!:,.]*[A-Z0-9+&#/%=~_|$]@i', '<a href="\0" target="_blank">\0</a>', $tweet_text );

                $tweet_text = preg_replace('(@([a-zA-Z0-9_]+))', "<a href='http://www.twitter.com/\$1'>\$0</a>", $tweet_text);
                $tweet_text = easysql_raw2hex(preg_replace('(#([a-zA-Z0-9_-äüöß-]+))', "<a href='http://search.twitter.com/search?q=%23\$1'>#\$1</a>", $tweet_text));

                $insert[0]           = $filename;
                $insert[1]           = 'timeline';
                $insert['source']    = 'twitter';
                $insert['title']     = 'tweet';
                $insert['text']      = $tweet_text;
                $insert['sourceurl'] = $tweet->link;
                $insert['timestamp'] = strtotime($tweet->pubDate);
                $insert['fetchtime'] = time();
                
                if($insert['timestamp'] == $lasttweet)
                  {
                    $lasttweetcheck = 1;
                    return $i;
                  }

                $i++;

                $rowid = easysql_sqlite_insert($insert);
              }
            $complete = 1;
            if($i%200 == 0)
              {
                $i_feed++;
                $complete = 0;
                if($i_feed > 20)
                  {
                    $complete = 1;
                  }
              }
            if(($i_before == $i)||($lasttweetcheck == 1))
              {
                $complete = 1;
              }
          }
      }
    else
      {
        
      }
    return $i;
  }

$twitteraccount = 81907376;
$filename       = './timeline.sqlite';

if(file_exists($filename))
  {
    $maxmin[0] = $filename;
    $maxmin[1] = 'timeline';
    $maxmin[2] = 'timestamp';
    $maxmin[3] = easysql_sqlite_maxmin($maxmin);
    echo 'Timestamp des letzten Eintrags: '.easysql_sqlite_maxmin($maxmin)."\n<br>";
    echo 'Datenbank enthält: '.easysql_sqlite_count(array($filename, 'timeline')).' Einträge'."\n<br>";
    echo 'Neu geladene Tweets: '.loadtweets($twitteraccount, $filename, $maxmin[3]);
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
    echo loadtweets($twitteraccount, $filename);
  }

?>