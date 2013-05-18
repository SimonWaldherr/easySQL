<?php

/*
 *
 * easySQL
 * 
 * Repo: https://github.com/SimonWaldherr/easySQL
 * Demo: http://cdn.simon.waldherr.eu/projects/easySQL/
 * License: MIT
 * Version: 0.5
 *
 */


include_once ('./notsoimportant.php');
include_once ('../easysql_sqlite.php');
include_once ('./crypto.php');

$create[0] = './sqlite.sql';
$create[1] = 'tablename';
$create['id'] = 'integer PRIMARY KEY AUTOINCREMENT';
$create['username'] = 'varchar NOT NULL UNIQUE';
$create['password'] = 'varchar NOT NULL';
$create['emailadr'] = 'varchar NOT NULL UNIQUE';
$create['timestam'] = 'integer';
$create['vcounter'] = 'smallint';
$create['sessioni'] = 'varchar';

easysql_sqlite_create($create);

$rand = rand(1,50000);
$insert[0] = './sqlite.sql';
$insert[1] = 'tablename';
$insert['username'] = 'John Doe '.$rand;
$insert['password'] = easysql_hashmix($rand);
$insert['emailadr'] = easysql_raw2hex(easysql_encrypt('john.doe.'.$rand.'@gmail.com', 'this is the secret to encrypt the string'));
$insert['timestam'] = time();
$insert['vcounter'] = $_SESSION['count'];
$insert['sessioni'] = session_id();

$rowid = easysql_sqlite_insert($insert);

$updaterow = ($rowid-rand(1,4));

$update[0] = './sqlite.sql';
$update[1] = 'tablename';
$update[2]['id'] = $updaterow;
$update[3]['password'] = easysql_hashmix(md5('new_password'.$update[2]['id'].rand(111,999)));
$update[3]['timestam'] = time();
$update[3]['vcounter'] = $_SESSION['count'];

easysql_sqlite_update($update);

$select[0] = './sqlite.sql';
$select[1] = 'tablename';
$select['id'] = '>;'.($rowid-5).'||'.($rowid-15);

$returnarray = easysql_sqlite_select($select, 6);

?><html>
<head>
<title>easySQL Example 1 (SQLite)</title>
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
echo '<p>the last inserted row is: '.$rowid.'; </p>';
echo '<p>the last updated row is: '.$updaterow.'; </p><p>';

if((!($rowid%10))OR($rowid<10))
  {
    $export[0] = './sqlite.sql';
    $export[1] = 'tablename';
    
    if(easysql_sqlite_export($export, 'csv', './export.csv'))
      {
        echo 'data export successfull';
      }
    else
      {
        echo 'error on data export';
      }
  }
else
  {
    echo 'export is not necessary';
  }

echo ' <br><a href="./export.csv">open csv-file</a></p><!--';
echo print_r($returnarray, 1);
echo '-->';

?>
</body></html>
