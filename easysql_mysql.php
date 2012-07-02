<?php

function easysql_mysql_create($array)
  {
    $db = new mysqli($array[0][0], $array[0][1], $array[0][2], $array[0][3]);
    $query = 'CREATE TABLE '.$array[1].' (';
    echo "demotime1 ".microtime()."\n"."<br>";
    foreach($array as $key => $value)
      {
        if(is_string($key))
          {
            $query .= ' `'.$key.'` '.$value.',';
          }
      }
    echo "demotime2 ".microtime()."\n"."<br>";
    if ($db->connect_errno)
      {
        printf("Connect failed: %s\n", $db->connect_error);
        exit();
      }
    echo "demotime3 ".microtime()."\n"."<br>";
    $query = str_replace(',,)', ')', $query.',)');
    echo "\n".$query."\n";
    return $db->exec($query);
  }

function easysql_mysql_insert($array)
  {
    $db = new mysqli($array[0][0], $array[0][1], $array[0][2], $array[0][3]);
    $query1 = 'INSERT INTO '.$array[1].' (';
    $query2 = 'VALUES (';
    foreach($array as $key => $value)
      {
        if(is_string($key))
          {
            $query1 .= '"'.$key.'",';
            $query2 .= '"'.$value.'",';
          }
      }
    $query = str_replace(',,)', ') ', $query1.',)').str_replace(',,)', ');', $query2.',)');
    //return $db->exec($query);
    if ($db->connect_errno)
      {
        printf("Connect failed: %s\n", $db->connect_error);
        exit();
      }
    $db->exec($query);
    return $db->lastInsertRowID();
  }

function easysql_mysql_update($array, $query='AND')
  {
    $db = new mysqli($array[0][0], $array[0][1], $array[0][2], $array[0][3]);
    if(($query=='AND')||($query=='OR'))
      {
        foreach($array[2] as $key => $value)
            {
              if(is_string($key))
                {
                  $valarray = explode(';', $value);
                  if(!isset($valarray[1]))
                    {
                      $query1array[] .= $key." = '".$value."'";
                    }
                  else
                    {
                      $query1array[] .= $key.' '.$valarray[0]." '".$valarray[1]."'";
                    }
                }
            }
          foreach($array[3] as $key => $value)
          {
            if(is_string($key))
              {
                $query2array[] = $key." = '".$value."' ";
              }
          }
          $query1 = 'UPDATE "'.$array[1].'" SET '.implode(', ', $query2array).' WHERE '.implode(' '.$query.' ', $query1array);
      }
    else
      {
        $query1 = $query;
      }
    if ($db->connect_errno)
      {
        printf("Connect failed: %s\n", $db->connect_error);
        exit();
      }
    $results = $db->exec($query1);
  }

function easysql_mysql_select($array, $limit='no', $query='AND')
  {
    $db = new mysqli($array[0][0], $array[0][1], $array[0][2], $array[0][3]);
    $query1 = '';
    if(($query=='AND')||($query=='OR'))
      {
        foreach($array as $key => $value)
            {
              if(is_string($key))
                {
                  $wherearray = explode('||', $value);
                  if(!isset($wherearray[1]))
                    {
                      $valarray = explode(';', $value);
                      if(!isset($valarray[1]))
                        {
                          $query1 .= $key." = '".$value."' ".$query.' ';
                        }
                      else
                        {
                          $query1 .= $key.' '.$valarray[0]." '".$valarray[1]."' ".$query.' ';
                        }
                    }
                  else
                    {
                      $query = 'OR';
                      foreach($wherearray as $where)
                        {
                          $valarray = explode(';', $where);
                          if(!isset($valarray[1]))
                            {
                              $query1 .= $key." = '".$where."' ".$query.' ';
                            }
                          else
                            {
                              $query1 .= $key.' '.$valarray[0]." '".$valarray[1]."' ".$query.' ';
                            }
                        }
                    }
                }
            }
          $query1 = 'SELECT * FROM '.$array[1].' WHERE '.str_replace($query.' ,)', ';', $query1.',)');
          if(is_int($limit))
            {
              $query1 .= ' LIMIT '.$limit.';';
            }
      }
    else
      {
        $query1 = $query;
      }
    //echo "\n".$query1."\n";
    if ($db->connect_errno)
      {
        printf("Connect failed: %s\n", $db->connect_error);
        exit();
      }
    $results = $db->query($query1);
    //var_dump ($results);
    $i = 0;
    
    
    while ($row = $results->fetchArray())
      {
        $return[$i] = $row;
        ++$i;
      }
    return $return;
  }

function easysql_mysql_export($array, $format='csv', $where='return')
  {
    $db = new mysqli($array[0][0], $array[0][1], $array[0][2], $array[0][3]);
    $query1 = 'SELECT * FROM '.$array[1];
    if ($db->connect_errno)
      {
        printf("Connect failed: %s\n", $db->connect_error);
        exit();
      }
    $results = $db->query($query1);
    $return = '';
    $i = 0;
    if($format == 'csv')
      {
        while ($row = $results->fetchArray())
          {
            //var_dump($row);
            foreach($row as $id => $result)
              {
                if(is_int($id))
                  {
                    if($id == 0)
                      {
                        ++$i;
                      }
                    $returnarray[$i][] = $result;
                    //echo 'i: '.$i.' id: '.$id.' result: '.$result."\n";
                  }
              }
          }
          //var_dump($returnarray);
        foreach ($returnarray as $line)
          {
            $return .= implode(";", $line)."\n";
          }
      }
    
    
    if($where == 'return')
      {
        return $return;
      }
    elseif($where == 'echo')
      {
        echo $return;
      }
    else
      {
        $success = true;
        if(!$handle = fopen($where, 'w'))
          {
            $success = false;
          }
        
        if(fwrite($handle, $return) === FALSE)
          {
            $success = false;
          }
        
        if(!fclose($handle))
          {
            $success = false;
          }
        return $success;
      }
  }

?>