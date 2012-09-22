<?php

include_once ('./notsoimportant.php');
include_once ('./easysql_sqlite.php');
include_once ('./crypto.php');


$create[0] = './analytics.sql';
$create[1] = 'analytics';
if(!file_exists($create[0]))
  {
    
    $create['id']             = 'integer PRIMARY KEY AUTOINCREMENT';
    $create['timestam']       = 'integer';
    $create['browser']        = 'varchar';
    $create['browserversion'] = 'integer';
    $create['platform']       = 'varchar';
    $create['cssversion']     = 'smallint';
    $create['javascript']     = 'bit';
    $create['java']           = 'bit';
    $create['activex']        = 'bit';
    $create['crawler']        = 'bit';
    
    easysql_sqlite_create($create);
  }

echo $_SERVER['HTTP_USER_AGENT'];
$browserinfo = get_browser($_SERVER['HTTP_USER_AGENT'], true);

var_dump($browserinfo);

$insert[0]                = $create[0];
$insert[1]                = $create[1];
$insert['timestam']       = time();
$insert['browser']        = $browserinfo['browser'];
$insert['browserversion'] = $browserinfo['version'];
$insert['platform']       = $browserinfo['platform'];
$insert['cssversion']     = $browserinfo['cssversion'];
$insert['javascript']     = $browserinfo['javascript'];
$insert['java']           = $browserinfo['javaapplets'];
$insert['activex']        = $browserinfo['activexcontrols'];
$insert['crawler']        = $browserinfo['crawler'];

$rowid = easysql_sqlite_insert($insert);

$select[0] = $create[0];
$select[1] = $create[1];

$returnarray = easysql_sqlite_getsorted($select, $order = 'timestam', $limit = 'no', $direction = 1);

?><html>
<head>
<title>easySQL Example 1</title>
<style>
thead{
  background: #ccc;
}
td{
  padding: 8px;
  background: #aaa;
  overflow: hidden;
}

.esql2{
  width:50px;
}
.esql6{
  max-width: 360px;
}
.esql14{
  max-width: 500px;
}
</style>
</head>
<body>
  <table>
  <thead>
    <tr>
      <td>id</td>
      <td>timestam</td>
      <td>browser</td>
      <td>browserversion</td>
      <td>platform</td>
      <td>cssversion</td>
      <td>javascript</td>
      <td>java</td>
      <td>activex</td>
      <td>crawler</td>
    </tr>
  </thead>
  <tbody>
<?php

foreach($returnarray as $nr)
  {
  echo '<tr>';
  $classcount = 1;
  foreach($nr as $key => $value)
    {
    if(is_string($key))
      {
      //echo '<tr>';
      if($key == 'emailadr')
        {
        echo '<td class="esql'.$classcount.'">'.easysql_decrypt(easysql_hex2raw($value), 'this is the secret to encrypt the string').'</td>'."\n";
        }
      else
        {
        echo '<td class="esql'.$classcount.'">'.$value.'</td>'."\n";
        }
      }
    $classcount++;
    }
  echo '</tr>';
  }

echo '</tbody></table>';
echo '<p>the last inserted row is: '.$rowid.'; </p>';

echo '</body></html>';

?>
