<?php require_once __DIR__ . '/../controllers/load.php'; // Include the load.php file from the controllers directory



class Database
{
    public static $conn;

    public static function connection()
    {
        if (self::$conn === null) {
            try {
                $set = "ConfigLoader::setconfig";
                $get = "ConfigLoader::getconfig";

                $set(__DIR__ . '/config/config.json');

                $server = $get('server');
                $username = $get('username');
                $password = $get('password');
                $dbname = $get('dbname');

                self::$conn = new mysqli($server, $username, $password, $dbname);

                if (self::$conn->connect_error) {
                    throw new Exception("Connection failed: " . self::$conn->connect_error);
                }
            } catch (Exception $e) {
                die("Database Error: " . $e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function checkconnection()
    {
        $conn = Database::connection();
        if (!$conn) {
            die("Connection failed: Unable to establish a database connection.");
        }
        return $conn;
    }

    public static function paramtype($param)
    {
        if (is_int($param)) return 'i';
        if (is_double($param)) return 'd';
        if (is_string($param)) return 's';
        return 'b';
    }

    public static function query($sql, $params = [])
    {
        $stmt = self::checkconnection()->prepare($sql);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . self::$conn->error);
        }

        $placeholderCount = substr_count($sql, '?');

        if ($placeholderCount !== count($params)) {
            throw new Exception("Mismatch between number of placeholders ($placeholderCount) and parameters (" . count($params) . ")");
        }

        if (!empty($params)) {
            $types = implode('', array_map([self::class, 'paramtype'], $params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;
    }

    public static function fetchResult($sql, $params = [])
    {
        $stmt = self::query($sql, $params);
        return $stmt->get_result();
    }

    public static function fetchAll($sql, $params = [])
    {
        $stmt = self::query($sql, $params);
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function fetchOne($sql, $params = [])
    {
        $stmt = self::query($sql, $params);
        return $stmt->get_result()->fetch_assoc();
    }

    public static function insert($sql, $params = [])
    {
        $stmt = self::query($sql, $params);
        return self::$conn->insert_id;
    }

    public static function update($sql, $params = [])
    {
        $stmt = self::query($sql, $params);
        return $stmt->affected_rows;
    }


    // public static function delete($sql, $params = []) {
    //     $stmt = self::query($sql, $params);
    //     return $stmt->affected_rows;
    // }

    // public static function beginTransaction() {
    //     self::$conn->begin_transaction();
    // }

    // public static function commit() {
    //     self::$conn->commit();
    // }

    // public static function rollback() {
    //     self::$conn->rollback();
    // }

    public static function close()
    {
        if (self::$conn !== null) {
            self::$conn->close();
            self::$conn = null;
        }
    }
}
// check database connection
// $db = Database::checkconnection();
// if (!$db) {
//     die("Connection failed: Unable to establish a database connection.");
// } else {
//     die("Connected successfully");
// }
