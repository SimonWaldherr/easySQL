<?php

include_once ('./notsoimportant.php');
include_once ('./easysql_sqlite.php');
include_once ('./crypto.php');

?><html>
<head>
<title>easySQL Example 4</title>
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

$export[0] = './sqlite.sql';
$export[1] = 'tablename';

echo str_replace("\n", "<br>", easysql_sqlite_export($export, 'csv'));


echo ' <br><a href="./export.csv">open csv-file</a></p><!--';
echo '--></body></html>';

?>
