<?php

$serverName = "127.0.0.1";
$username = "root";
$password = "coursera";
$dbname = "helloworldautos";

try{

    $conn = new PDO("mysql:host=$serverName;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "<h1>Databse Connection Started</h1>";

    $sql = $conn->prepare("SELECT * FROM vehicle LEFT JOIN engine ON vehicle.engine_code=engine.engine_code");
    $sql->execute();
}catch( PDOException $e ){

    echo "<h1>Database Connection Failed $e</h1>";

}
//get all rows at once

// foreach($sql->fetchAll() as $row){
//     echo "<p>$row[make], $row[year], $row[mileage], $row[price], $row[image], $row[engine_code], $row[engine_type]</p>";
// }
while($row = $sql->fetch(PDO::FETCH_ASSOC)){

    if($row["engine_code"]){
        //it a car
        array_push($vehicles, new Car($row["make"],$row["model"], $row["year"], $row["mileage"], $row["price"], $row["image"]));
    }else {
        # it a truck
        array_push($vehicles, new Truck($row["make"], $row["model"], $row["year"], $row["mileage"], $row["price"], $row["image"], $row["engine_type"]));
    }
}
$conn = null; //close connection

?>