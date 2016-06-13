<?php 
function datadump($table, $drop = true, $stripapos = true)
{
  $result     = "# Dump of $table \n";
  $result    .= "# Dump DATE : " . date("d-M-Y") ."\n\n";
  if ( $drop ) {
    if ( $stripapos ) {
      $result    .= "DROP TABLE IF EXISTS $table;\n";
      // dump create table
      $createTableQuery = mysql_query("SHOW CREATE TABLE ".$table.";");
      $createTable      = mysql_fetch_row($createTableQuery);
      $result          .= str_replace('`', '', $createTable[1]).";\n\n\n\n";  
    } else {
      $result    .= "DROP TABLE IF EXISTS `$table`;\n";
      // dump create table
      $createTableQuery = mysql_query("SHOW CREATE TABLE ".$table.";");
      $createTable      = mysql_fetch_row($createTableQuery);
      $result          .= $createTable[1].";\n\n\n\n";    
    }
  } else {
    $result    .= "TRUNCATE TABLE $table;\n";
  }
   
  $query      = mysql_query("SELECT * FROM $table");
  $num_fields = @mysql_num_fields($query);
  $numrow     = mysql_num_rows($query);
  
  $columnsRes = mysql_query("SHOW COLUMNS FROM $table;");
  $columns = array();
  
  while ( $row = mysql_fetch_assoc($columnsRes) ) {
    $columns[$row['Field']] = $row;
  }
  
  while ( $row = mysql_fetch_assoc($query) ) {
    $result .= "INSERT INTO ".$table." VALUES(";
  
    $fields = array();
  
    foreach ( $row as $field => $data ) {
      if ( strpos(strtolower($columns[$field]['Type']), 'int') !== false 
        || strpos(strtolower($columns[$field]['Type']), 'float') !== false
        || strpos(strtolower($columns[$field]['Type']), 'tinyint') !== false ) {
        if ( strlen($data) > 0 ) {
          $fields[] = $data;
        } else {
          if ( strtolower($columns[$field]['Null']) == 'no' ) {
            $fields[] = 0;
          } else {
            $fields[] = "NULL";
          }        
        }
      } elseif ( strpos(strtolower($columns[$field]['Type']), 'datetime') !== false ) {
        if ( strlen($data) > 0 ) {       
          $fields[] = "\"".$data."\"" ;
        } else {
          if ( strtolower($columns[$field]['Null']) == 'no' ) {
            $fields[] = '""';
          } else {
            $fields[] = "NULL";
          }
        }
      } elseif ( strpos(strtolower($columns[$field]['Type']), 'time') !== false ) {
        if ( strlen($data) > 0 ) {
          $fields[] = "\"".$data."\"" ;
        } else {
          if ( strtolower($columns[$field]['Null']) == 'no' ) {
            $fields[] = '""';
          } else {
            $fields[] = "NULL";
          }
        }        
      } elseif ( strpos(strtolower($columns[$field]['Type']), 'varchar') !== false
       || strpos(strtolower($columns[$field]['Type']), 'text') !== false
       || strpos(strtolower($columns[$field]['Type']), 'longtext') !== false
       || strpos(strtolower($columns[$field]['Type']), 'mediumtext') !== false ) {
        $data = addslashes($data);
        //$data = trim(ereg_replace("\n", "\\n", $data));
        if ( strlen($data) > 0 ) {
          $fields[] = "\"".$data."\"" ;
        } else {
          if ( strtolower($columns[$field]['Null']) == 'no' ) {
            $fields[] = '""';
          } else {
            $fields[] = "NULL";
          }
        }        
      } else {
        // $columns[$field]['Type'] will contain the datatype
        if ( strlen($data) > 0 ) {
          $fields[] = "\"".$data."\"" ;
        } else {
          if ( strtolower($columns[$field]['Null']) == 'no' ) {
            $fields[] = '""';
          } else {
            $fields[] = "NULL";
          }
        }        
      }
    }
    $result .= implode(',', $fields);
    $result .= ");\n";
  }
  return $result . "\n\n\n";
}