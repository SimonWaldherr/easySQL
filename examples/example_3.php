<?php

/*
 *
 * easySQL
 * 
 * Repo: https://github.com/SimonWaldherr/easySQL
 * Demo: http://cdn.simon.waldherr.eu/projects/easySQL/
 * License: MIT
 * Version: 0.4.1
 *
 */


include_once ('./notsoimportant.php');
include_once ('./easysql_sqlite.php');
include_once ('./crypto.php');

$select[0] = './sqlite.sql';
$select[1] = 'tablename';
$select['id'] = rand(1,5).'||'.rand(11,15).'||'.rand(21,25).'||'.rand(31,35).'||'.rand(41,45);

$returnarray = easysql_sqlite_select($select, 5);

?><html>
<head>
<title>easySQL Example 3 (SQLite)</title>
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
    <td>Nr.</td>
    <td>Name</td>
    <td>Password</td>
    <td>eMail</td>
    <td>timestamp</td>
    <td>visits</td>
    <td>session id</td>
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
echo '</body></html>';

?>
