easySQL
=======

a database wrapper for easy read and write actions on a sql db (SQLite, MySQL, PostgreSQL, ...)

##Create Database/Table

	$array[0] = './path/to/sqliteDB.sql';
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

##Select

	$array[0] = './path/to/sqliteDB.sql';
	$array[1] = 'tablename';
	$array['id'] = '3';
	
	easysql_sqlite_select($array);

###Info

Demo: [here](http://simon.waldherr.eu/projects/easysql/)  
License: MIT  
Version: 0.1  
Date: June 2012
