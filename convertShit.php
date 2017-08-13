<?php
        $dbname = 'bloge';
        if (!mysqli_connect('localhost', 'root', 'ilstenUnlock')) {
        print 'Could not connect to mysql';
        exit;
    }

    $result = mysql_list_tables($dbname);

    if (!$result) {
        print "DB Error, could not list tables\n";
        print 'MySQL Error: ' . mysql_error();
        exit;
    }

    while ($row = mysqli_fetch_row($result)) {
                $sql_s = "ALTER TABLE ".$row[0]." CONVERT TO CHARACTER SET utf8";
                mysqli_query($sql_s);
         $sql = "SELECT * FROM ".$row[0];
                 mysqli_query('SET NAMES latin1');
                 $res = mysqli_query($sql);
                 while($rows = mysqli_fetch_assoc($res))
                 {
                 $array_table[$row[0]][] = $rows;

                 $zapros = '';
                         foreach($rows as $key=>$value)
                         {
                                 $zapros .= ' , `'.$key.'` = "'.mysqli_real_escape_string($value).'" ';
                         }
                         $zapros = substr($zapros, 2);
                          $sql_a = "UPDATE ".$row[0]." SET  ".$zapros." WHERE id = ".$rows['id'];
                        mysqli_query('SET NAMES utf8');
                        mysqli_query($sql_a);
                 }
    }
?>