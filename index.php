<?php

include_once ('./notsoimportant.php');
include_once ('./easysql_sqlite.php');
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

easysql_sqlite_insert($insert);


$select[0] = './sqlite.sql';
$select[1] = 'tablename';
$select['id'] = '>;0';


$returnarray = easysql_sqlite_select($select);

?><html>
<head>
<title>easySQL</title>
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

echo '</tbody></table></body></html>';

/*
var_dump($returnarray);

foreach($returnarray as $nr)
  {
    foreach($nr as $key => $value)
      {
	    if(is_string($key))
	      {
            if($key == 'emailadr')
              {
                echo $key.': '.easysql_decrypt(easysql_hex2raw($value), 'this is the secret to encrypt the string')."\n";
              }
            else
              {
	            echo $key.': '.$value."\n";
              }
          }
      }
  }

*/
?>