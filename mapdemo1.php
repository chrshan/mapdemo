<?php 
    $dbcMap = mysql_connect("localhost","root","admin");
    if (!$dbcMap)
    {
        die('Can not connect:' . mysql_error());
    }

    $dbconnect = mysql_select_db("map_db",$dbcMap);
    if (!$dbconnect)
    {
        die ("Can\'t use map_db : " . mysql_error());
    }
    
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