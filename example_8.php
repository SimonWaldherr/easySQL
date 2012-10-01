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

  function PrintCurrentLine($line) 
    { 
      echo "\nThe interpreter is currently in line ".$line."  <br>\n"; 
    } 
  

  include_once ('./notsoimportant.php');
  include_once ('./easysql_mysql.php');
  include_once ('./easysql_sqlite.php');
  include_once ('./crypto.php');
  include_once ('./mysql-config.php');
  
  $mysqlarray[1] = '`db00046793`.`db00046796`';
  
  ############# CREATE #############
  
  $create             = $mysqlarray;
  $create['id']       = 'integer NOT NULL AUTO_INCREMENT PRIMARY KEY';
  $create['username'] = 'varchar(255) NOT NULL';
  $create['password'] = 'varchar(255) NOT NULL';
  $create['emailadr'] = 'varchar(255) NOT NULL';
  $create['timestam'] = 'integer';
  $create['vcounter'] = 'smallint';
  $create['sessioni'] = 'varchar(255)';
  $easysql_info['create_mysql'] = print_r(easysql_mysql_create($create), 1);
  unset($create);
  PrintCurrentLine(__LINE__);
  
  $create[0]          = './sqlite.sqlite';
  $create[1]          = 'easysql';
  $create['id']       = 'integer PRIMARY KEY AUTOINCREMENT';
  $create['username'] = 'varchar NOT NULL UNIQUE';
  $create['password'] = 'varchar NOT NULL';
  $create['emailadr'] = 'varchar NOT NULL UNIQUE';
  $create['timestam'] = 'integer';
  $create['vcounter'] = 'smallint';
  $create['sessioni'] = 'varchar';
  $easysql_info['create_sqlite'] = print_r(easysql_sqlite_create($create), 1);
  unset($create);
  PrintCurrentLine(__LINE__);
  
  ############# INSERT #############
  
  $random = rand(1,50000);
  $timestamp = time();
  $sessionid = session_id();
  $insert             = $mysqlarray;
  $insert['username'] = 'John Doe '.$random;
  $insert['password'] = easysql_hashmix($random);
  $insert['emailadr'] = easysql_raw2hex(easysql_encrypt('john.doe.'.$random.'@gmail.com', 'this is the secret to encrypt the string'));
  $insert['timestam'] = $timestamp;
  $insert['vcounter'] = $_SESSION['count'];
  $insert['sessioni'] = $sessionid;
  $easysql_info['insert_mysql'] = print_r(easysql_mysql_insert($insert), 1);
  unset($insert);
  PrintCurrentLine(__LINE__);
  
  $insert[0] = './sqlite.sqlite';
  $insert[1] = 'easysql';
  $insert['username'] = 'John Doe '.$random;
  $insert['password'] = easysql_hashmix($random);
  $insert['emailadr'] = easysql_raw2hex(easysql_encrypt('john.doe.'.$random.'@gmail.com', 'this is the secret to encrypt the string'));
  $insert['timestam'] = $timestamp;
  $insert['vcounter'] = $_SESSION['count'];
  $insert['sessioni'] = $sessionid;
  $easysql_info['insert_sqlite'] = print_r(easysql_sqlite_insert($insert), 1);
  unset($insert);
  PrintCurrentLine(__LINE__);
  
  ############# UPDATE #############
  
  $updaterow = ($rowid-rand(1,4));
  $update = $mysqlarray;
  $update[2]['id'] = $updaterow;
  $update[3]['password'] = easysql_hashmix(md5('new_password'.$update[2]['id'].$random));
  $update[3]['timestam'] = $timestamp;
  $update[3]['vcounter'] = $_SESSION['count'];
  $easysql_info['update_mysql'] = print_r(easysql_mysql_update($update), 1);
  unset($update);
  PrintCurrentLine(__LINE__);
  
  $update[0] = './sqlite.sqlite';
  $update[1] = 'easysql';
  $update[2]['id'] = $updaterow;
  $update[3]['password'] = easysql_hashmix(md5('new_password'.$update[2]['id'].$random));
  $update[3]['timestam'] = $timestamp;
  $update[3]['vcounter'] = $_SESSION['count'];
  $easysql_info['update_sqlite'] = print_r(easysql_sqlite_update($update), 1);
  unset($update);
  PrintCurrentLine(__LINE__);
  
  ############# SELECT #############
  
  $select = $mysqlarray;
  $select['id'] = '1';
  $easysql_info['select_mysql'] = print_r(easysql_mysql_select($select, 1), 1);
  unset($select);
  PrintCurrentLine(__LINE__);
  
  $select[0] = './sqlite.sqlite';
  $select[1] = 'easysql';
  $select['id'] = '1';
  $easysql_info['select_sqlite'] = print_r(easysql_sqlite_select($select, 1), 1);
  unset($select);
  PrintCurrentLine(__LINE__);
  
  ############# END #############

?><html>
<head>
<title>easySQL Example 5 (MySQL)</title>
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

<?php

print_r($easysql_info);
PrintCurrentLine(__LINE__);
echo $easysql_info;
PrintCurrentLine(__LINE__);
foreach($easysql_info as $info => $data)
  {
    echo $info.' = '.md5($data)."<br> \n";
  }

?>
</body></html>
