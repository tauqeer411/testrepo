<?php

        // set up the connection variables
        $db_name  = 'angulartest';
        $hostname = '127.0.0.1';
        $username = 'root';
        $password = '';

        // connect to the database
        $dbh = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);
        if(isset($_GET['id']) ){
                $sql = 'insert into users ( name, email) values("'.uniqid().'", "'.uniqid().'@test.com")';     
                $stmt = $dbh->prepare( $sql );
                $stmt->execute();
                exit;   
        }

        // a query get all the records from the users table
        $sql = 'SELECT id, name, email FROM users';

        // use prepared statements, even if not strictly required is good practice
        $stmt = $dbh->prepare( $sql );

        // execute the query
        $stmt->execute();

        // fetch the results into an array
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );

        // convert to json
        $json = json_encode( $result );

        // echo the json string
        echo $json;
?>