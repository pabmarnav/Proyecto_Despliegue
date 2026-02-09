<?php

//Guardo los datos de conexión de la base de datos en un fichero YML
function getDBConfig()
{
    // Prioridad 1: Variables de Entorno (Producción / Docker)
    $envUser = getenv('MYSQL_USER');
    if ($envUser) {
        // En docker-compose.prod.yml pasaremos estas variables
        $dbName = getenv('MYSQL_DATABASE') ?: 'films';
        $dbHost = getenv('MYSQL_HOST') ?: 'backend-db-prod'; // Nombre del contenedor en prod
        $dbPass = getenv('MYSQL_PASSWORD');

        $cad = sprintf("mysql:dbname=%s;host=%s;charset=UTF8", $dbName, $dbHost);

        return array(
            "cad" => $cad,
            "user" => $envUser,
            "pass" => $dbPass
        );
    }

    // Prioridad 2: Archivo YAML (Desarrollo local)
    $dbFileConfig = dirname(__FILE__) . "/../../dbconfiguration.yml";

    // Si no existen variables de entorno ni archivo, fallará controladamente
    if (!file_exists($dbFileConfig)) {
        return null;
    }

    $configYML = yaml_parse_file($dbFileConfig);

    $cad = sprintf("mysql:dbname=%s;host=%s;charset=UTF8", $configYML["dbname"], $configYML["ip"]);

    $result = array(
        "cad" => $cad,
        "user" => $configYML["user"],
        "pass" => $configYML["pass"]
    );

    return $result;
}

function getDBConnection()
{
    try {
        $res = getDBConfig();

        $bd = new PDO($res["cad"], $res["user"], $res["pass"]);

        return $bd;
    } catch (PDOException $e) {
        return null;
    }
}

/* ------------ LOGIN --------------- */
function checkLogin($email, $password)
{
    try {
        $bd = getDBConnection();

        if (!is_null($bd)) {
            $sqlPrepared = $bd->prepare("SELECT email from user WHERE email = :email AND password = :password ");
            $params = array(
                ':email' => $email,
                ':password' => $password
            );
            $sqlPrepared->execute($params);

            return $sqlPrepared->rowCount() > 0 ? true : false;
        } else
            return $bd;

    } catch (PDOException $e) {
        return null;
    }
}


/* ------------ PELÍCULAS  --------------- */
function getFilmsDB()
{
    try {
        $bd = getDBConnection();

        if (!is_null($bd)) {
            $sqlPrepared = $bd->prepare("SELECT id,name, director, classification from film");
            $sqlPrepared->execute();

            return $sqlPrepared->fetchAll(PDO::FETCH_ASSOC);
        } else
            return $bd;

    } catch (PDOException $e) {
        return null;
    }
}

function getFilmDB($id)
{
    try {
        $bd = getDBConnection();

        if (!is_null($bd)) {
            $sqlPrepared = $bd->prepare("SELECT * from film WHERE id = :id");
            $params = array(
                ':id' => $id,
            );
            $sqlPrepared->execute($params);

            return $sqlPrepared->fetchAll(PDO::FETCH_ASSOC);
        } else
            return $bd;

    } catch (PDOException $e) {
        return null;
    }
}

function addFilmDB($data)
{
    try {
        $bd = getDBConnection();

        if (!is_null($bd)) {

            $sqlPrepared = $bd->prepare("
                INSERT INTO film (name,director,classification,img,plot)
                VALUES (:name,:director,:classification,:img,:plot)
            ");

            $params = array(
                ':name' => $data["name"],
                ':director' => $data["director"],
                ':classification' => $data["classification"],
                ':img' => $data["img"],
                ':plot' => $data["plot"]
            );

            return $sqlPrepared->execute($params);

            return $sqlPrepared->rowCount();// check affected rows using rowCount

        } else
            return $bd;

    } catch (PDOException $e) {
        return null;
    }
}


function updateFilmDB($data)
{
    try {
        $bd = getDBConnection();

        if (!is_null($bd)) {

            $sqlPrepared = $bd->prepare("
                UPDATE film
                SET name=:name,director=:director,classification=:classification,img=:img,plot=:plot
                WHERE id=:id
            ");

            $params = array(
                ':name' => $data["name"],
                ':director' => $data["director"],
                ':classification' => $data["classification"],
                ':img' => $data["img"],
                ':plot' => $data["plot"],
                ':id' => $data["id"]
            );

            return $sqlPrepared->execute($params);

            return $sqlPrepared->rowCount();// check affected rows using rowCount

        } else
            return $bd;

    } catch (PDOException $e) {
        return null;
    }
}

function deleteFilmDB($id)
{
    try {
        $bd = getDBConnection();

        if (!is_null($bd)) {

            $sqlPrepared = $bd->prepare("
                DELETE FROM film
                WHERE id=:id
            ");

            $params = array(
                ':id' => $id
            );

            return $sqlPrepared->execute($params);

            return $sqlPrepared->rowCount();// check affected rows using rowCount

        } else
            return $bd;

    } catch (PDOException $e) {
        return null;
    }
}