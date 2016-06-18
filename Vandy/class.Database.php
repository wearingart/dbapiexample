<?php
/*
 * Page: class.database.php
 *
 * Description: This class is used to create a Database object.
 */
namespace Vandy;

class Database
{
    // The database connection is static so that it persists throughout the application and we only need to connect once
    protected static $connection;


    /**
     * Connect to the database
     * @return bool|\mysqli
     */
    public function connect()
    {
        if (!isset($settings) || !array($settings)) {
            $settings = parse_ini_file('/home/wearingart/vandy.ini', TRUE);
        }
        // Try and connect to the database
        if (!isset(self::$connection)) {
            // The slash in front of mysqli is needed due to use of namespaces
            self::$connection = new \mysqli($settings['database']['hostname'], $settings['database']['username'], $settings['database']['password'], $settings['database']['dbname']);
        }

        // If connection was not successful, handle the error
        if (self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }

    /**
     * Gets the connection
     * @return mixed
     */
    public static function getConnection()
    {
        return self::$connection;
    }
   
    /**
     * performs a query on the database
     * @param $query
     * @return mixed
     */
    public function dbQuery($query)
    {
        // Query the database
        $con = self::getConnection();
        $result = $con->query($query);
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     * @param $query
     * @return array|bool
     */
    public function select($query)
    {
        $rows = array();
        $result = $this->dbQuery($query);
        if ($result === false) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * @return string
     */
    public function error()
    {
        $connection = $this->connect();
        return $connection->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string
     * @return string
     */
    public function quote($value)
    {
        $connection = $this->connect();
        return "'" . $connection->real_escape_string($value) . "'";
    }
}