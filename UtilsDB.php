<?php

class DB 
{
    
    function connect($dbName, $u="root", $pass=""){
        
        try{
            $db = new PDO("mysql:host=localhost;dbname=$dbName;charset=utf8","$u","$pass");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo "There was an error connecting to the DB...\n";
            echo $ex->getMessage();
            header("Location: index.html");
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
    
    function getCitiesByCountry($db,$country) {
        
        $qCountry = $db->quote($country);
            
        $sql = "SELECT cities.name 
                FROM countries JOIN cities 
                ON countries.code=cities.country_code 
                WHERE countries.name LIKE $qCountry 
                ORDER BY cities.population DESC
                LIMIT 10";
        
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
        
        return DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN);
    }
    
    function getCC2($db,$country) {
        
        $qCountry = $db->quote($country);
            
        $sql = "SELECT code2 
                FROM countries 
                WHERE name LIKE $qCountry";
        
        return DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN);
    }
    
    function existsUser($email,$dbname="simpsons") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
            
        $sql = "SELECT COUNT(*) 
                FROM students
                WHERE email LIKE $qEmail";
        
        return (0 != DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0]);
        
    }
    
     function getUserId($email,$dbname="simpsons") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
            
        $sql = "SELECT id 
                FROM students
                WHERE email LIKE $qEmail";
         
        return DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0];
        
    }
    
    function validateUser($email,$password,$dbname="simpsons") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
        $qPass = $db->quote($password);
            
        $sql = "SELECT COUNT(*) 
                FROM students
                WHERE email LIKE $qEmail
                AND
                password LIKE $qPass";
        
        return (0 != DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN)[0]);
        
    }
    
    function createUser($name,$lastname,$id_number,$email,
                        $password,$birthday,$gender,$description,
                        $country,$city,
                        $dbname="simpsons") {
    
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
        
        $sql = "INSERT INTO students
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
    
    function getUser($email,$dbname="simpsons") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
            
        $sql = "SELECT *
                FROM students
                WHERE email LIKE $qEmail";
        
        $aux = DB::query($db,$sql)->fetchAll()[0];
        $store = array();
        
        for($i=1; $i<(count($aux)/2); $i++) {
            $store[$i-1] = $aux[$i];
        }
        
        return $store;
    }
    
    function getUserById($id,$dbname="simpsons") {
        
        $db = DB::connect($dbname);
        $qId = $db->quote($id);
            
        $sql = "SELECT *
                FROM students
                WHERE id=$qId";
        
        $aux = DB::query($db,$sql)->fetchAll()[0];
        $store = array();
        
        for($i=1; $i<(count($aux)/2); $i++) {
            $store[$i-1] = $aux[$i];
        }
        
        return $store;
    }
    
    function removeUserByEmail($email,$dbname="simpsons") {
        
        $db = DB::connect($dbname);
        $qEmail = $db->quote($email);
            
        $sql = "DELETE FROM students
                WHERE email LIKE $qEmail";
        
        $db->exec($sql);
    }
    
    function removeUserById($id,$dbname="simpsons") {
        
        $db = DB::connect($dbname);
        $qId = $db->quote($id);
            
        $sql = "DELETE FROM students
                WHERE id=$qId";
        
        var_dump($sql);
        
        $db->exec($sql);
    }
    
    function alterTableStudents() {
        
        $db = DB::connect('simpsons');
        
        $fields = count(DB::query($db,"SELECT * FROM students LIMIT 1")->fetchAll()[0])/2;
        
        if($fields <= 4){ // Fix cutre
        
            $db->beginTransaction();
            $db->exec("ALTER TABLE students modify id INT NOT NULL AUTO_INCREMENT");
            $db->exec("ALTER TABLE students ADD lastname VARCHAR(20)");
            $db->exec("ALTER TABLE students ADD id_number VARCHAR(10)");
            $db->exec("ALTER TABLE students ADD birthday DATE");
            $db->exec("ALTER TABLE students ADD gender VARCHAR(10)");
            $db->exec("ALTER TABLE students ADD description VARCHAR(250)");
            $db->exec("ALTER TABLE students ADD city VARCHAR(30)");
            $db->exec("ALTER TABLE students ADD country VARCHAR(30)");
            $db->commit();
            
        }
        
    }
    
    function createTableFlights($dbname"imdb_small") {
        
        $db = DB::connect($dbname);
        
        // Only one flight a day.
        $sql = "CREATE TABLE flights (
                                        dep VARCHAR(30) NOT NULL,
                                        arr VARCHAR(30) NOT NULL,
                                        dateA DATE NOT NULL,
                                        dateB DATE NOT NULL,
                                        PRIMARY KEY (dep,arr,dateA,dateB)
                                     )";
        
        $db->beginTransaction();
        $db->exec($sql);
        $db->commit();
    }
    
}

?>