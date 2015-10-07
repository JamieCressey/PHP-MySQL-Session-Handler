<?php
    namespace Jayc89\SessionHandler;
    class SessionHandler implements \SessionHandlerInterface
    {
        private $savePath;

        /**
        * a database MySQLi connection resource
        * @var resource
        */
        protected $dbConnection;

        /**
        * the name of the DB table which handles the sessions
        * @var string
        */
        protected $dbTable;

        /**
        * Set db data if no connection is being injected
        * @param   string  $dbHost 
        * @param   string  $dbUser
        * @param   string  $dbPassword
        * @param   string  $dbDatabase
        */ 
        public function setDbDetails($dbHost, $dbUser, $dbPassword, $dbDatabase)
        {
            $this->dbConnection = new mysqli($dbHost, $dbUser, $dbPassword, $dbDatabase);

            if (mysqli_connect_error()) {
                throw new Exception('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
        }

        /**
        * Inject DB connection from outside
        * @param   object  $dbConnection   expects MySQLi object
        */
        public function setDbConnection($dbConnection)
        {
            $this->dbConnection = $dbConnection;
        }

        /**
        * Inject DB connection from outside
        * @param   object  $dbConnection   expects MySQLi object
        */
        public function setDbTable($dbTable)
        {
            $this->dbTable = $dbTable;
        }

        public function open($savePath, $sessionName)
        {
            $limit = time() - (3600 * 24);
            $sql = "DELETE FROM $this->dbTable WHERE timestamp < :ts";
            $params = array(
                "ts" => $limit
            );
            return $this->dbConnection->query($sql, $params);
        }

        public function close()
        {
            return $this->dbConnection->CloseConnection();
        }

        public function read($id)
        {
            $sql = "SELECT data FROM $this->dbTable WHERE id = :id";
            $params = array(
                "id" => $id
            );
            if ($result = $this->dbConnection->single($sql, $params)) {
                return (string)$result;
            } else {
                return false;
            }
        }

        public function write($id, $data)
        {
            $sql = "REPLACE INTO $this->dbTable (id, data, timestamp) VALUES(:id, :data, :timestamp)";
            $params = array(
                "id" => $id,
                "data" => $data,
                "timestamp" => time()
            );
            return $this->dbConnection->query($sql, $params);
        }

        public function destroy($id)
        {
            $sql = "DELETE FROM $this->dbTable WHERE id = :id";
            $params = array(
                "id"=>$id
            );
            return $this->dbConnection->query($sql, $params);
        }

        public function gc($maxlifetime)
        {
            $sql = "DELETE FROM $this->dbTable WHERE timestamp < :ts";
            $params = array(
                "ts" => time() - intval($maxlifetime)
            );
            return $this->dbConnection->query($sql, $params);
        }
    }
