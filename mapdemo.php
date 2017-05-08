<?php 
    $dbcMap = mysql_connect("localhost","root","admin");
    mysql_query('Set namea utf8',$dbcMap);
    if (!$dbcMap)
    {
        die('Can not connect:' . mysql_error());
    }
    //echo "here down";
    // // if (mysql_query("CREATE DATABASE map_db",$dbcMap))
    // // {
    // //     echo "Database created\n";
    // // }
    // // else
    // // {
    // //     echo "Error creating database : " . mysql_error();
    // // }
    // // {
    // //     echo "Database deleted";
    // // }
    // // else
    // // {
    // //     echo "Error creating database : " . mysql_error();
    // // }
    $dbconnect = mysql_select_db("map_db",$dbcMap);
    if (!$dbconnect)
    {
        die ("Can\'t use map_db : " . mysql_error());
    }
    $length = $_POST['length'];
    if ($length)
    {
        $trigger = 1;
    }
    else
    {
        $trigger = 0;
    }
    //get the last ID num of current db
    // $end_id = mysql_query("SELECT max(Id) From Pointsave",$dbcMap);
    // $result = mysql_fetch_array($end_id,MYSQL_ASSOC);
    if ($trigger == 1)
    {
        if ($length > 1)
        {
            //get the last ID num of current db
            // $end_id = mysql_query("SELECT max(Id) From Pointsave",$dbcMap);
            // $result = mysql_fetch_array($end_id,MYSQL_ASSOC);
            //ORDER BY Id DESC LIMIT 1
            $end_id = mysql_query("SELECT * FROM Pointsave ORDER BY Id DESC LIMIT 1",$dbconnect);
            $result_array = mysql_fetch_array($end_id);
            $result = $result_array['Id'];
            $linestring = "";
            for ($i=($result+1);$i<=($result+$length);$i++)
            {
                $linestring .= $i.",";
            }
            if ($linestring)
            {
                $is_ok = mysql_query("INSERT INTO linesave (Track) VALUES('$linestring')");
                if (!$is_ok)
                {
                    die("Can\'t add map_db : " . mysql_error());
                }
            }
            $length = 0;
        }
    }
    
    // for ($i=$length;$i>0;$i--)
    // {
    //     $longitude = $_POST['longitude'];
    //     $latitude = $_POST['latitude'];
    //     $is_ok = mysql_query("INSERT INTO Pointsave (Longitude,Latitude) VALUES($longitude,$latitude)");
    // //$is_ok = mysql_query("INSERT INTO Pointsave (Longitude,Latitude) VALUES(1991,4777)");
    //     if (!$is_ok)
    //     {
    //         die("Can\'t add map_db : " . mysql_error());
    //     }
    // }
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    if ($longitude)
    {
        $is_ok = mysql_query("INSERT INTO Pointsave (Longitude,Latitude) VALUES($longitude,$latitude)");
        if (!$is_ok)
        {
            die("Can\'t add map_db : " . mysql_error());
        }
    }



    mysql_close($dbcMap);          
 ?>