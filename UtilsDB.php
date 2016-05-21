<?php

// This function used for wrapping tuples
function wrapper($field1,$field2){
    return array($field1,$field2);
}

class DB 
{
    
    function getCitiesByCountry($db,$country) {
        
        $qCountry = $db->quote($country);
            
        $sql = "SELECT cities.name AS city,cities.country_code AS code 
                FROM countries JOIN cities 
                ON countries.code=cities.country_code 
                WHERE countries.name LIKE $qCountry 
                ORDER BY cities.population DESC
                LIMIT 10";
        
        $cities =  DB::query($db,$sql)->fetchAll(PDO::FETCH_FUNC,'wrapper');
        return $cities;
    }
    
    function getCountries($db) {
            
        $sql = "SELECT countries.name 
                FROM countries";
        
        return DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN);
    }

    
    function similarity($w1,$w2) {
        
        return similar_text($w1,$w2);
        
    }
    
    function getCC($db,$country) {
        
        $qCountry = $db->quote($country);
            
        $sql = "SELECT code 
                FROM countries 
                WHERE name LIKE $qCountry";
        
        $res = DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN);
        return empty($res) ? null:$res[0];
    }
    
    function getCC2($db,$country) {
        
        $qCountry = $db->quote($country);
            
        $sql = "SELECT code2 
                FROM countries 
                WHERE name LIKE $qCountry";
        
        $res = DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN);
        return empty($res) ? null:$res[0];
    }
    
    function existsUser($email,$dbname="eFlights") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
        
        $sql = "SELECT COUNT(*) 
                FROM users
                WHERE email LIKE $qEmail";
        
        $res = DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0];
        
        return (0 != $res);
    }
    
     function getUserId($email,$dbname="eFlights") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
            
        $sql = "SELECT id 
                FROM users
                WHERE email LIKE $qEmail";
         
        $res = DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0];
         
        return $res;
        
    }
    
    function getBookedFlights($user_id,$dbname="eFlights") {
        
        $db = DB::connect($dbname);
        $user_id = $db->quote($user_id);
            
        $sql = "SELECT id,c_dep,c_arr,dep,arr,dateA,dateB,price,seats_left
                FROM bookings JOIN flights
                ON id_flight=id
                WHERE id_user=$user_id";
         
        $res = DB::query($db,$sql)->fetchAll();
        
        return $res;
        
    }
    
    function validateUser($email,$password,$dbname="eFlights") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
        $qPass = $db->quote($password);
            
        $sql = "SELECT COUNT(*) 
                FROM users
                WHERE email LIKE $qEmail
                AND
                password LIKE $qPass";
        
        return (0 != DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0]);
    }
    
    function createUser($name,$lastname,$id_number,$email,
                        $password,$birthday,$gender,$description,
                        $country,$city,
                        $dbname="eFlights") {
    
        $db = DB::connect($dbname);
        $qName = $db->quote($name);
        $qLastname = $db->quote($lastname);
        $qIdNumber = $db->quote($id_number);
        $qEmail = $db->quote($email);
        $qPass = $db->quote($password);
        $qBirthday = $db->quote($birthday);
        $qGender = $db->quote($gender);
        $qDescription = $db->quote($description);
        $qCountry = $db->quote($country);
        $qCity = $db->quote($city);
        
        $exists = DB::existsUser($email);
        
        $sql = "INSERT INTO users
                VALUES (
                        0,
                        $qName,
                        $qEmail,
                        $qPass,
                        $qLastname,
                        $qIdNumber,
                        $qBirthday,
                        $qGender,
                        $qDescription,
                        $qCity,
                        $qCountry
                        )";
        
        if($exists)
            return false;
        
        $db->exec($sql);
        
        return true;
    }
    
    function getUser($email,$dbname="eFlights") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
            
        $sql = "SELECT id
                FROM users
                WHERE email LIKE $qEmail";
        
        $id = DB::query($db,$sql)->fetch(PDO::FETCH_COLUMN,0);
        return $id;
    }
    
    function getUserById($id,$dbname="eFlights") {
        
        $db = DB::connect($dbname);
        $qId = $db->quote($id);
            
        $sql = "SELECT *
                FROM users
                WHERE id=$qId";
        
        $aux = DB::query($db,$sql)->fetchAll()[0];
        
        $store = array();
        
        for($i=1; $i<(count($aux)/2); $i++) {
            $store[$i-1] = $aux[$i];
        }
        
        return $store;
    }
    
    function removeUserByEmail($email,$dbname="eFlights") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
            
        $sql = "DELETE FROM users
                WHERE email LIKE $qEmail";
        
        $db->exec($sql);
    }
    
    function removeUserById($id,$dbname="eFlights") {
        
        $db = DB::connect($dbname);
        $qId = $db->quote($id);
            
        $sql = "DELETE FROM users
                WHERE id=$qId";
        
        try{
            $db->exec($sql);
        } catch(PDOException $ex){
            echo "<p>Error deleting the user!!</p>";
        }
    }
    
    
    function populateTableFlights ($num) {
        
        $dbname = "eFlights";
        $db = DB::connect($dbname);
        
        $countries = DB::getCountries($db);
        
        $citiesA = DB::getRndCities($countries,$num);
        $citiesB = DB::getRndCities($countries,$num);
        
        $now = date('Y-m-d');
        
        $flights = array();
        
        for($i=0; $i<$num; $i++){
            $c1 = $citiesA[rand(0,count($citiesA)-1)];
            $c2 = $citiesB[rand(0,count($citiesB)-1)];
            array_push($flights,array(
                                    $c1[1],
                                    $c2[1],
                                    $c1[0],
                                    $c2[0],
                                    $now,
                                    $now,
                                    rand(10,250),
                                    200
                                ));    
        }
        
        DB::createFlights($flights);  
    }
    
    function modifySeatsFlight($id,$add=true){
        
        $db = DB::connect("eFlights");
            
        $sql = "UPDATE flights SET seats_left = seats_left " . 
                        (($add)?'+':'-') . " 1 WHERE id = $id";
        
        try{
            $db->exec($sql);
        } catch(PDOException $ex){
            echo "<p>Error modifying the number of seats of the flight!!</p>";
        }
    }
    
    function createBooking ($user_id,$flight_id){
        
        $db = DB::connect("eFlights");
        $user_id = $db->quote($user_id);
        $flight_id = $db->quote($flight_id);
        
        $sql = "INSERT INTO bookings
                VALUES (
                        $user_id,
                        $flight_id
                        )";
        
        try{
            $db->exec($sql);
        } catch(PDOException $ex){
            echo "<p>Error CREATING the booking!!</p>";
            echo "<p>$ex</p>";
        }
        
        DB::modifySeatsFlight($flight_id, false);
        
        return true;
    }
    
    function cancelateBooking ($user_id,$flight_id) {
        
        $db = DB::connect("eFlights");
        $user_id = $db->quote($user_id);
        $flight_id = $db->quote($flight_id);
        
        $sql = "DELETE FROM bookings WHERE user_id=$user_id AND flight_id=$flight_id";
        
        try{
            $db->exec($sql);
        } catch(PDOException $ex){
            echo "<p>Error DELETING the booking!!</p>";
        }
        
        DB::modifySeatsFlight($flight_id, true);
        
        return true;
    }
    
    function getRndCities($countries,$num){
        
        $dbname="eFlights";
        $db=DB::connect($dbname);

        $cities = array();
        
        for($i=0; $i<$num; $i++){
            $country_cities = DB::getCitiesByCountry($db,$countries[array_rand($countries)]);
            $n = count($country_cities);
            if($n>0){
                array_push($cities,$country_cities[rand(0,($n-1))]);
            }
        }

        return $cities;
    }
    
    function getOffers($num)
    {
        
        $db = DB::connect("eFlights");
            
        $sql = "SELECT id FROM flights ORDER BY price asc LIMIT $num";
        
        $id = DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN,0);
        return $id;
    }
    
    function getAdditionalInfoJSON($id) 
    {
        
        $db = DB::connect("eFlights");
            
        $sql = "
                SELECT 
                    flights.id,
                    flights.seats_left,
                    (COUNT(DISTINCT users.id) + flights.seats_left) AS seats,
                    (SUM(CASE WHEN (users.gender LIKE 'Female') THEN 1 ELSE 0 END)) AS female_ratio, 
                    (SUM(CASE WHEN (users.gender LIKE 'Male') THEN 1 ELSE 0 END)) AS male_ratio
                FROM flights JOIN bookings JOIN users
                    ON flights.id=bookings.id_flight AND users.id=bookings.id_user
                    WHERE flights.id=$id
            ";
        
        $result = DB::query($db,$sql)->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    function getArrayJSONOffers($min, $max, $num)
    {
        
        $db = DB::connect("eFlights");
            
        $sql = "
        SELECT id, c_dep, c_arr, dep, arr, price 
        FROM flights 
        WHERE price BETWEEN $min AND $max 
        ORDER BY price ASC 
        LIMIT $num
        ";
        
        $res = DB::query($db,$sql)->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    function existsFlight($dep,$arrival,$depDate,$arrivalDate,$dbname="eFlights") 
    {
        
        $db = DB::connect($dbname);
        $dep = $db->quote($dep);
        $depDate = $db->quote($depDate);
        $arrival = $db->quote($arrival);
        $arrivalDate = $db->quote($arrivalDate);
        
        $sql = "SELECT COUNT(*) 
                FROM flights
                WHERE 
                dep LIKE $dep AND
                arr LIKE $arrival AND
                dateA = $depDate AND
                dateB = $arrivalDate
                ";
        
        $res = DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0];
        return (0 != $res);
        
    }
    
    function getFlightsBetweenCountries($countryA, $countryB, $search=null)
    {
        
        $db = DB::connect("eFlights");
        
        $departure = $db->quote(DB::getCC($db,$countryA));
        $arrival = $db->quote(DB::getCC($db,$countryB));
        
        $sql = "SELECT id FROM flights WHERE c_dep LIKE $departure AND c_arr LIKE $arrival";
        
        if ($search) {
            $sql .= " AND ( dep LIKE " . $db->quote($search) . " OR arr LIKE " . $db->quote($search) . " )";
        }
        
        $res = DB::query($db,$sql);
            
        if($res) {
            $res = $res->fetchAll(PDO::FETCH_COLUMN);   
        }
        
        return $res;
    }
    
    function getFlightById($id)
    {
        
        $db = DB::connect("eFlights");
        
        $sql = "SELECT * FROM flights WHERE id=$id";
        
        return DB::query($db,$sql)->fetch();
    }
    
    function getPossibleCountries($name,$maxItems)
    {
        
        if($name==""){
            return array();
        }
        
        $db = DB::connect("eFlights");
        
        $sql = "SELECT name FROM countries WHERE name LIKE '$name%' LIMIT $maxItems";
        
        return DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN,0);
    }
    
    // Create Tables
    function createCountriesTable() 
    {
        
        $db = DB::connect("eFlights");
        
       $sql = "CREATE TABLE IF NOT EXISTS countries (
                                            code CHAR(3) NOT NULL,
                                            code2 CHAR(2) NOT NULL,
                                            name CHAR(35) NOT NULL,
                                            local_name CHAR(45) NOT NULL,
                                            PRIMARY KEY (code)
                                         )";
        
        try{
            $db->exec($sql);   
        } catch(PDOExeception $ex){
            echo "<p>".$ex."</p>";
        }

    }
    
    function createCitiesTable() 
    {
        
        $db = DB::connect("eFlights");
        
        $sql = "CREATE TABLE IF NOT EXISTS cities (
                                            name CHAR(35) NOT NULL,
                                            country_code CHAR(3) NOT NULL,
                                            population INT(11) NOT NULL,
                                            PRIMARY KEY (name),
                                            FOREIGN KEY(country_code)
                                                REFERENCES countries(code)
                                                ON DELETE CASCADE
                                         )";

        try{
            $db->exec($sql);   
        } catch(PDOExeception $ex){
            echo "<p>".$ex."</p>";
        }
    }
    
    function createTableFlights() 
    {
        
        $db = DB::connect("eFlights");
        
        $exists = (count(DB::query($db,"SHOW TABLES LIKE 'flights'")->fetchAll())!=0);
        
        if(!$exists) {
            // Only one flight a day.
            $sql = "CREATE TABLE IF NOT EXISTS flights (
                                            id INTEGER NOT NULL AUTO_INCREMENT,
                                            c_dep VARCHAR(3) NOT NULL,
                                            c_arr VARCHAR(3) NOT NULL,
                                            dep VARCHAR(30) NOT NULL,
                                            arr VARCHAR(30) NOT NULL,
                                            dateA DATE NOT NULL,
                                            dateB DATE NOT NULL,
                                            price INTEGER NOT NULL,
                                            seats_left INTEGER NOT NULL,
                                            PRIMARY KEY (id)
                                         )";

            try{
                $db->beginTransaction();
                $db->exec($sql);
                $db->commit();
            }catch (PDOException $ex) {
                //echo "There was a problem: Probably table flights already exists (?)";
                echo $ex;
            }
            
            DB::populateTableFlights(500);
        }
    }
    
    function createUsersTable() 
    {
        
        $db = DB::connect("eFlights");
        
        $sql = "CREATE TABLE IF NOT EXISTS users (
                                            id INTEGER NOT NULL AUTO_INCREMENT,
                                            name VARCHAR(32) NOT NULL,
                                            email VARCHAR(32) NOT NULL,
                                            password VARCHAR(40) NOT NULL,
                                            lastname VARCHAR(32) NOT NULL,
                                            identification VARCHAR(15) NOT NULL,
                                            birthday DATE NOT NULL,
                                            gender VARCHAR(10) NOT NULL,
                                            description VARCHAR(200),
                                            city VARCHAR(32),
                                            country VARCHAR(32),
                                            PRIMARY KEY(id)
                                         )";

        try{
            $db->exec($sql);   
        } catch(PDOExeception $ex){
            echo "<p>".$ex."</p>";
        }
    }    
    
    function createBookingsTable() 
    {
        
        $db = DB::connect("eFlights");
        
        $sql = "CREATE TABLE IF NOT EXISTS bookings (
                                            id_user INTEGER NOT NULL,
                                            id_flight INTEGER NOT NULL,
                                            FOREIGN KEY(id_user) REFERENCES users(id)
                                            ON DELETE CASCADE,
                                            FOREIGN KEY(id_flight) REFERENCES flights(id)
                                            ON DELETE CASCADE
                                         )";

        try{
            $db->exec($sql);   
        } catch(PDOExeception $ex){
            echo "<p>".$ex."</p>";
        }
    }
    
    function createEFlightsDB() 
    {
        $db = DB::connect();
        
        $res = $db->query("SHOW DATABASES LIKE 'eFlights'")->fetchAll();
        
        if(empty($res)){
            $sql = "CREATE DATABASE IF NOT EXISTS eFlights";

            try{
                $db->exec($sql);   
            } catch(PDOExeception $ex){
                echo "<p>".$ex."</p>";
            }
            
            DB::createCountriesTable();
            DB::fillCountriesTable();
            DB::createCitiesTable();
            DB::fillCitiesTable();
            DB::createTableFlights();
            DB::createUsersTable();
            DB::fillStartingUsers();
            DB::createBookingsTable();
            DB::fillBookingsTable();
        }
        
    }
    
    
    // Fill Tables
    function fillCitiesTable() 
    {
        
        $db = DB::connect("eFlights");
        
        DB::index("world","cities","country_code",true);

        $sql = "INSERT INTO cities
                SELECT cities_aux.name,cities_aux.country_code,cities_aux.population
                FROM world.cities AS cities_aux JOIN eFlights.countries AS countries
                ON cities_aux.country_code LIKE countries.code
                WHERE cities_aux.population > 300000";

        try{
            $db->exec($sql);   
        } catch(PDOExeception $ex){
            echo "<p>".$ex."</p>";
        }
        
        DB::index("world","cities","country_code",false);
        
    }
    
    function fillCountriesTable() 
    {
        
        $db = DB::connect("eFlights");
        
       $sql = "INSERT INTO countries
                SELECT countries_aux.code,countries_aux.code2,countries_aux.name,countries_aux.local_name
                FROM world.countries AS countries_aux
                WHERE countries_aux.continent LIKE 'EUROPE'
                ORDER BY countries_aux.population DESC
                LIMIT 5";
        
        try{
            $db->exec($sql);   
        } catch(PDOExeception $ex){
            echo "<p>".$ex."</p>";
        }

    }
    
    function fillStartingUsers()
    {
        $doc = new DOMDocument();
        $doc->load("xml/test-users.xml");
        $users = $doc->getElementsByTagName("user");
        
        foreach($users as $user){
            $userData = array();
            foreach($user->childNodes as $node){
                if($node->nodeType !== 1){
                    continue;
                }
                $userData[$node->tagName] = $node->nodeValue;
            }
            
            DB::createUser(
                $userData["name"], 
                $userData["second-name"], 
                $userData["identification"], 
                $userData["email"],
                $userData["password"], 
                $userData["birthday"], 
                $userData["gender"], 
                $userData["description"],
                $userData["country"],
                $userData["city"]
            );
        }
    
    }
    
    function fillBookingsTable()
    {
        $db = DB::connect("eFlights");
        
        $maxUsers = DB::numUsers();
        $maxFlights = DB::numFlights();
        
        $numOfBookings = 100;
        $numOffers = 8;
        
        $offers = DB::getOffers($numOffers);
        
        for($i=0; $i<$numOfBookings; $i++) {
            $rnd = rand(0,10); // Randomize giving a hand to the cheaper ones
            if($rnd <= 2) {
                DB::createBooking(rand(1, $maxUsers),rand(1, $maxFlights));
            } else {
                $rnd_aux = rand(0, $numOffers-1);
                DB::createBooking(rand(1, $maxUsers),$offers[$rnd_aux]);
            }
        }
    }
    
    function numUsers () 
    {
                
        $db = DB::connect("eFlights");
        
        $sql = "SELECT COUNT(*) FROM users";
        $res = DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0];
        return $res;
    }
    
    function numFlights () 
    {
                
        $db = DB::connect("eFlights");
        
        $sql = "SELECT COUNT(*) FROM flights";
        $res = DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0];
        return $res;
    }
    
    function createFlight($dep,$arrival,$dep_cc,$arr_cc,$depDate,$arrivalDate,$price,$left,$dbname="eFlights") {

        $db = DB::connect($dbname);
        
        $dep_cc = $db->quote($dep_cc);
        $arr_cc = $db->quote($arr_cc);
        $dep = $db->quote($dep);
        $depDate = $db->quote($depDate);
        $arrival = $db->quote($arrival);
        $arrivalDate = $db->quote($arrivalDate);
        $price = $db->quote($price);
        $left = $db->quote($left);

        $exists = DB::existsFlight($id);

        $sql = "INSERT INTO flights
                VALUES (
                        0,
                        $dep_cc,
                        $arr_cc,
                        $dep,
                        $arrival,
                        $depDate,
                        $arrivalDate,
                        $price,
                        $left
                        )";

        if($exists) return false;
        
        try{
            $db->exec($sql);
        } catch (PDOException $ex) {
            echo "There was a problem: Probably this flight already exists (?)";
        }
        
        return true;
    }
    
    function createFlights($flights, $dbname="eFlights") {

        $db = DB::connect($dbname);

        $sql = "INSERT INTO flights
                VALUES "; 
        foreach($flights as $flight){
            
            $sql .= "(0,'". $flight[0] . "','" . $flight[1]. "','" . $flight[2]. "','" . $flight[3]. "','" . $flight[4] . "','" . $flight[5] . "'," . $flight[6] . "," . $flight[7] . "),";   
        }
        
        $sql = substr($sql,0,strlen($sql)-1);
        
        try{
            $db->exec($sql);
        } catch (PDOException $ex) {
            //echo "There was a problem: Probably this flight already exists (?)";
            echo "<p>" . $ex . "</p>\n";
        }
    }
    
    
    // Other Usages
    function connect($dbName=null, $u="root", $pass=""){
        
        try{
            $db = new PDO("mysql:host=localhost;". (($dbName) ?"dbname=".$dbName.";":"") . "charset=utf8","$u","$pass");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo "There was an error connecting to the DB...\n";
            echo $ex->getMessage();
            header("Location: index.php");
        }
        return $db;
    }
    function query($db, $sql) {
        
        $result = null;
        try{
            $result = $db->query($sql);   
        } catch (PDOException $ex) {
            echo "There was an error querying the DB...\n";
            echo $ex->getMessage();
        }
        return $result;
    }
    
    function index($dbname,$table,$field,$create=true) {
        
        $db = DB::connect($dbname);

        if($create){
            $sql = "CREATE INDEX $field ON $table ($field)";
        }else{
            $sql = "DROP INDEX $field ON $table";   
        }

        try{
            $db->exec($sql);   
        } catch(PDOExeception $ex){
            echo "<p>Probably the index/table/field name is not correct.</p>";
        }
    }

}

?>