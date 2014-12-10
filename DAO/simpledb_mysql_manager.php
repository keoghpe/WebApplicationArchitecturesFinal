<?php
/**
 * @author luca
 * @description This is a very simple and basic DB manager
 */
include_once ("conf/config.inc.php");
class DBManager {
    private $db_link, $hostname, $username, $password, $dbname, $port;
    function __construct($dbname = DB_NAME) {
        $this->hostname = DB_HOST;
        $this->username = DB_USER;
        $this->password = DB_PASS;
        $this->dbname = $dbname;
        $this->port = DB_PORT;
    }
    function openConnection() {
        $this->db_link = mysqli_connect ( $this->hostname, $this->username, $this->password, $this->dbname, $this->port ) or die ( "Cannot connect to DB" );
    }
    function executeSelectQuery($query) {
        $result;

        if (!empty($this->db_link))
            $result = mysqli_query($this->db_link, $query) or die ("Cannot execute query");

        if (!empty($result)) {
            $rows = array();
            while ( $row = $result->fetch_array( MYSQLI_ASSOC ))
                $rows[] = $row;
        }
        return $rows;
    }

    function executeQuery($query) {
        $result;

        if (!empty($this->db_link)){
            $result = mysqli_query($this->db_link, $query) or die ("Cannot execute query");
        }


        if (!empty($result) && is_array($result)) {
            $rows = array();
            while ( $row = $result->fetch_array( MYSQLI_ASSOC ))
                $rows[] = $row;

            return $rows;
        }
    }

    function closeConnection() {
        if (! empty ( $this->db_link ))
            $this->db_link->close ();
    }
}
?>
