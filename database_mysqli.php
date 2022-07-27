<?php

$serverName = "127.0.0.1";
$username = "root";
$password = "coursera";
$dbname = "helloworldautos";

// try{

    $conn = new mysqli($serverName, $username, $password, $dbname);
    //echo "<h1>Databse Connection Started</h1>";
    if($conn -> connect_error){
        echo "<h1>Database Connection Failed $e</h1>";
    }else{
        $sql = "SELECT * FROM vehicle LEFT JOIN engine ON vehicle.engine_code=engine.engine_code";
        $result = $conn-> query($sql);
    }
    
// }catch( PDOException $e ){

    // echo "<h1>Database Connection Failed $e</h1>";

// }
//get all rows at once

// foreach($sql->fetchAll() as $row){
//     echo "<p>$row[make], $row[year], $row[mileage], $row[price], $row[image], $row[engine_code], $row[engine_type]</p>";
// }
while($row = $result -> fetch_assoc()){

    if($row["engine_code"]){
        //it a car
        array_push($vehicles, new Car($row["make"],$row["model"], $row["year"], $row["mileage"], $row["price"], $row["image"]));
    }else {
        # it a truck
        array_push($vehicles, new Truck($row["make"], $row["model"], $row["year"], $row["mileage"], $row["price"], $row["image"], $row["engine_type"]));
    }
}
$conn-> close(); //close connection

?>