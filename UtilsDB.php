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
    
    function getCC($db,$country) {
        
        $qCountry = $db->quote($country);
            
        $sql = "SELECT code 
                FROM countries 
                WHERE name LIKE $qCountry";
        
        return DB::query($db,$sql)->fetchAll(PDO::FETCH_COLUMN);
    }
    
    function existsUser($email,$password,$dbname="simpsons") {
        
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
    
    function createUser($name,$email,$password,$dbname="simpsons") {
    
        $db = DB::connect($dbname);
        $qName = $db->quote($name);
        $qEmail = $db->quote($email);
        $qPass = $db->quote($password);
        
        $sql = "INSERT INTO students
                VALUES (
                        0,
                        $qName,
                        $qEmail,
                        $qPass
                        )";
        
        $db->exec($sql);
        
    }
    
    function alterTableStudents() {
        
        $db = DB::connect("simpsons");
        
        $db->beginTransaction();
        $db->exec("ALTER TABLE students modify id INT NOT NULL AUTO_INCREMENT");
        $db->commit();
        
    }
    
}

?>