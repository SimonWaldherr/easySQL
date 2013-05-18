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
  include_once ('../easysql_mysql.php');
  include_once ('./crypto.php');
  include_once ('../mysql-config.php');

  $create = $mysqlarray;
  $create['id'] = 'integer NOT NULL AUTO_INCREMENT PRIMARY KEY';
  $create['username'] = 'varchar(255) NOT NULL';
  $create['password'] = 'varchar(255) NOT NULL';
  $create['emailadr'] = 'varchar(255) NOT NULL';
  $create['timestam'] = 'integer';
  $create['vcounter'] = 'smallint';
  $create['sessioni'] = 'varchar(255)';
  easysql_mysql_create($create);

  $sorted    = $mysqlarray;
  $lastrowid = easysql_mysql_getsorted($sorted, 'id', 1, true);
  $lastrowid = $lastrowid[0]['id'];
  
  $getsorted = easysql_mysql_getsorted($sorted, 'vcounter', 1, true);

  $select = $mysqlarray;
  $select['id'] = '>;'.($lastrowid-5);
  $returnarray = easysql_mysql_select($select, 6);

  $returnarray[] = $getsorted[0];


?><html>
<head>
<title>easySQL Example 6 (MySQL)</title>
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

echo ' <br><!--';
echo print_r($returnarray, 1);
echo print_r($getsorted, 1);
echo '-->';

?>
</body></html>
