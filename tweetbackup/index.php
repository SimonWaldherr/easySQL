<?php

include_once ('./notsoimportant.php');
include_once ('./easysql_sqlite.php');
include_once ('./crypto.php');

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>Twitter Backup</title>
  <style>
    body{
      background: #fbfbfb;
      font-family: Menlo, Consolas, Monaco, "Lucida Console", monospace;
    }
    iframe{
      height: 160px;
      width: 920px;
      display: none;
      background: #ffffff;
      border-radius: 5px;
      -webkit-box-shadow: inset 0px 0px 10px 0px rgba(55, 55, 55, 1);
      box-shadow: inset 0px 0px 10px 0px rgba(55, 55, 55, 1);
    }
    .tuser{
      width: 930px;
      min-height: 60px;
      background: white;
      margin: auto;
      margin-top: 45px;
      padding: 15px;
      border-radius: 10px;
      background: #EEE;
      background: -moz-linear-gradient(top, #EEE 0%, #CCC 100%);
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#EEE), color-stop(100%,#CCC));
      background: -webkit-linear-gradient(top, #EEE 0%,#CCC 100%);
      background: -o-linear-gradient(top, #EEE 0%,#CCC 100%);
      background: -ms-linear-gradient(top, #EEE 0%,#CCC 100%);
      background: linear-gradient(to bottom, #EEE 0%,#CCC 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 );
      -webkit-box-shadow: 0px 0px 45px -5px rgba(255, 255, 255, 1);
      box-shadow: 0px 0px 45px -5px rgba(255, 255, 255, 1);
      text-align: center;
    }
    input[type="button"] {
      margin: 5px;
      padding: 5px;
      font-size: xx-large;
      font-weight: bolder;
    }
    .tuser a{
      display: none;
    }
    .info{
      min-height: 90px;
      padding: 40px;
      font-size: 16pt;
      border-radius: 25px;
    }
    .info a{
      display: inline;
    }
  </style>
</head>
<body>
  <div class="tuser info"><h1>easySQL powered Twitter Backup</h1><p>This page is a demopage for easySQL. The content on this site is the property of the respective owners. The Twitter accounts are in random order and a random selection of people I follow.</p>
  </div>
  
  <div class="tuser">Die Shownotes
    <input type="button" value="Download" onclick="window.location='./../timeline-DieShownotes.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('iDieShownotes').style.display = 'inline';">
    <iframe id="iDieShownotes" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=DieShownotes"></iframe><a href="./../timeline-DieShownotes.sqlite">Download @DieShownotes Twitter Backup</a>
  </div>
  
  <div class="tuser">Simon Waldherr
    <input type="button" value="Download" onclick="window.location='./../timeline-SimonWaldherr.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('iSimonWaldherr').style.display = 'inline';">
    <iframe id="iSimonWaldherr" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=SimonWaldherr"></iframe><a href="./../timeline-SimonWaldherr.sqlite">Download @SimonWaldherr Twitter Backup</a>
  </div>
  
  <div class="tuser">Tim Pritlove
    <input type="button" value="Download" onclick="window.location='./../timeline-timpritlove.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('itimpritlove').style.display = 'inline';">
    <iframe id="itimpritlove" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=timpritlove"></iframe><a href="./../timeline-timpritlove.sqlite">Download @timpritlove Twitter Backup</a>
  </div>
  
  <div class="tuser">Marina Weisband
    <input type="button" value="Download" onclick="window.location='./../timeline-afelia.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('iafelia').style.display = 'inline';">
    <iframe id="iafelia" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=afelia"></iframe><a href="./../timeline-afelia.sqlite">Download @afelia Twitter Backup</a>
  </div>
  
  <div class="tuser">Kevin Rose
    <input type="button" value="Download" onclick="window.location='./../timeline-kevinrose.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('ikevinrose').style.display = 'inline';">
    <iframe id="ikevinrose" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=kevinrose"></iframe><a href="./../timeline-kevinrose.sqlite">Download @kevinrose Twitter Backup</a>
  </div>
  
  <div class="tuser">Jeff Jarvis
    <input type="button" value="Download" onclick="window.location='./../timeline-jeffjarvis.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('ijeffjarvis').style.display = 'inline';">
    <iframe id="ijeffjarvis" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=jeffjarvis"></iframe><a href="./../timeline-jeffjarvis.sqlite">Download @jeffjarvis Twitter Backup</a>
  </div>
  
  <div class="tuser">Laura Dornheim
    <input type="button" value="Download" onclick="window.location='./../timeline-schwarzblond.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('ischwarzblond').style.display = 'inline';">
    <iframe id="ischwarzblond" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=schwarzblond"></iframe><a href="./../timeline-schwarzblond.sqlite">Download @schwarzblond Twitter Backup</a>
  </div>
  
  <div class="tuser">Rivva
    <input type="button" value="Download" onclick="window.location='./../timeline-rivva.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('irivva').style.display = 'inline';">
    <iframe id="irivva" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=rivva"></iframe><a href="./../timeline-rivva.sqlite">Download @rivva Twitter Backup</a>
  </div>
  
  <div class="tuser">Holger Klein
    <input type="button" value="Download" onclick="window.location='./../timeline-holgi.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('iholgi').style.display = 'inline';">
    <iframe id="iholgi" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=holgi"></iframe><a href="./../timeline-holgi.sqlite">Download @holgi Twitter Backup</a>
  </div>
  
  <div class="tuser">Tobias Baier
    <input type="button" value="Download" onclick="window.location='./../timeline-tobybaier.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('itobybaier').style.display = 'inline';">
    <iframe id="itobybaier" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=tobybaier"></iframe><a href="./../timeline-tobybaier.sqlite">Download @tobybaier Twitter Backup</a>
  </div>
  
  <div class="tuser">Christopher Lauer
    <input type="button" value="Download" onclick="window.location='./../timeline-schmidtlepp.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('ischmidtlepp').style.display = 'inline';">
    <iframe id="ischmidtlepp" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=schmidtlepp"></iframe><a href="./../timeline-schmidtlepp.sqlite">Download @schmidtlepp Twitter Backup</a>
  </div>
  
  <div class="tuser">TechCrunch
    <input type="button" value="Download" onclick="window.location='./../timeline-techcrunch.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('itechcrunch').style.display = 'inline';">
    <iframe id="itechcrunch" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=techcrunch"></iframe><a href="./../timeline-techcrunch.sqlite">Download @techcrunch Twitter Backup</a>
  </div>
  
  <div class="tuser">Wayra Deutschland
    <input type="button" value="Download" onclick="window.location='./../timeline-wayrade.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('iwayrade').style.display = 'inline';">
    <iframe id="iwayrade" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=wayrade"></iframe><a href="./../timeline-wayrade.sqlite">Download @wayrade Twitter Backup</a>
  </div>
  
  <div class="tuser">Matt Cutts
    <input type="button" value="Download" onclick="window.location='./../timeline-mattcutts.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('imattcutts').style.display = 'inline';">
    <iframe id="imattcutts" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=mattcutts"></iframe><a href="./../timeline-mattcutts.sqlite">Download @mattcutts Twitter Backup</a>
  </div>
  
  <div class="tuser">NASA
    <input type="button" value="Download" onclick="window.location='./../timeline-NASA.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('iNASA').style.display = 'inline';">
    <iframe id="iNASA" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=NASA"></iframe><a href="./../timeline-NASA.sqlite">Download @NASA Twitter Backup</a>
  </div>
  
  <div class="tuser">Google Ventures
    <input type="button" value="Download" onclick="window.location='./../timeline-GoogleVentures.sqlite'">
    <input type="button" value="Show" onclick="document.getElementById('iGoogleVentures').style.display = 'inline';">
    <iframe id="iGoogleVentures" src="http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?update=no&tweet=GoogleVentures"></iframe><a href="./../timeline-GoogleVentures.sqlite">Download @GoogleVentures Twitter Backup</a>
  </div>

<?php

$sorted[0] = './../timeline.data.sqlite';
$sorted[1] = 'data';

$getsorted = easysql_sqlite_getsorted($sorted, 'fetchtime', 1, true);

if($getsorted[0]['fetchtime'] < (time()-60*60*3))
  {
    echo '<iframe style="height:1px; width:1px;" src="http://cdn.simon.waldherr.eu/projects/easySQL/tweetbackup/update.html"></iframe>';
  }

?>

</body>
</html>
