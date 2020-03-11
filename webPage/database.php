<?php

$db = array();

    $db['host'] = "localhost";
    $db['user'] = "root";
    $db['pass'] = "";
    $db['name'] = "thePriceIsRight";

    function connect(){
        global $db;
        $link = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
        if  ($link->connect_errno) {
            die("Failed to connect to MySQL: " . $link->connect_error);
        }

        return $link;
    }
    function insert($link, $data) {
    
        // first we create the statement
        $stmt = $link->prepare("insert into houseData(LotArea, Street, LotShape, Neighborhood) values (?,?,?,?)");
        if ( !$stmt ) {
            die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
        }
    
        // then we bind the parameters
        $result = $stmt->bind_param("isss", $data['LotArea'], $data['Street'], $data['LotShape'], $data['Neightborhood']);
        if ( !$result ) { die("could not bind params: " . $stmt->error); }
    
        // finally, execute
        if ( !$stmt->execute() ) { die("couldn't execute statement"); }
    
    }
    function retrieve($link) {
        $records = array();
    
        $results = $link->query("SELECT * FROM houseData");
    
        if ( !$results ) {return records;}
    
        while ( $row = $results->fetch_assoc() ) {
            $records[] = $row;
        }
        
        return $records;
    }
    function clearDB($link){
        $query = "delete from housedata;";
        mysqli_query($link, $query);
        // echo mysqli_num_rows($result);
        // return $result;
    }

?>