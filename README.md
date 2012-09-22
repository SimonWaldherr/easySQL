#[easySQL](https://github.com/SimonWaldherr/easySQL)

a php database wrapper for easy read and write actions on a sql db (SQLite, MySQL, PostgreSQL, ...)

##Create Database/Table

	//sqlite:
		$array[0] = './path/to/sqliteDB.sql';
		$array[1] = 'tablename';
	
	//mysql:
		$array[0][0] = 'server.tld';
		$array[0][1] = 'username';
		$array[0][2] = 'password';
		$array[1] = 'tablename';
	
	$array['id'] = 'integer PRIMARY KEY AUTOINCREMENT';
	$array['username'] = 'varchar NOT NULL UNIQUE';
	$array['password'] = 'varchar NOT NULL';
	$array['column'] = '...'; // constraints
	
	easysql_sqlite_create($array);

##Insert

	$array[0] = './path/to/sqliteDB.sql';
	$array[1] = 'tablename';
	$array['username'] = 'John Doe';
	$array['password'] = 'lorem ipsum';
	$array['column'] = '...';
	
	easysql_sqlite_create($array);

##Update

	$array[0] = './path/to/sqliteDB.sql';
	$array[1] = 'tablename';
	$array[2]['id'] = 1337;
	$array[3]['password'] = 'new_password';
	
	easysql_sqlite_update($array);

##Select

	$array[0] = './path/to/sqliteDB.sql';
	$array[1] = 'tablename';
	$array['id'] = '3';
	
	var_dump(easysql_sqlite_select($array));

##Export

	$array[0] = './path/to/sqliteDB.sql';
	$array[1] = 'tablename';
	
	easysql_sqlite_export($export, 'csv', './file.csv');

###Info

Demo: [here](http://cdn.simon.waldherr.eu/projects/easySQL/)  
License: MIT  
Version: 0.3  
Date: September 2012
