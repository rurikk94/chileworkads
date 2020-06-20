<?php
class Db
{
    private $_host;
    private $_username;
    private $_password;
    private $_database;

    public $_connection;

    public function __construct()
    {
        global $site_config;
        require_once($site_config['SITE']['base'] . "//config.php");  //están las variables del sitio ($site_config)

        $this->_host = $site_config['PDO']['server'];
        $this->_database = $site_config['PDO']['db'];
        $this->_username = $site_config['PDO']['user'];
        $this->_password = $site_config['PDO']['pass'];

        if (!isset($this->_connection)) {
            return $this->conectar();

        }
    }
    private function conectar(){
            $this->_connection = mysqli_connect($this->_host, $this->_username, $this->_password, $this->_database);
            if (!$this->_connection)
            {
                echo("Connection failed: " . mysqli_connect_error());
                echo "Error: Fallo al conectarse a MySQL debido a: \n";
                echo "Errno: " . $this->_connection->connect_errno . "\n";
                echo "Error: " . $this->_connection->connect_error . "\n";
                return FALSE;
                die();
            }
            return TRUE;
    }
    public function desconectar()
    {
        $this->_connection->close();
    }

    /** ejecuta una query y puede mandar parametros a  */
    public function update($query = null, $datos = null)
    {
        $this->conectar();
        if (mysqli_query($this->_connection, $query)) {
            //$last_id = $this->_connection->insert_id;
            //$this->desconectar();
            return TRUE;
            //echo "New record created successfully";
          } else {
            echo "Error: " . $query . "<br>" . mysqli_error($this->_connection);
            //$this->desconectar();
            RETURN FALSE;
          }
        //$this->desconectar();
        return NULL;
    }

    /** ejecuta una query y puede mandar parametros a  */
    public function execute($sql = null, $datos = null)
    {
        try {
            $insertStatement  =  $this->_connection->prepare($sql);
            $resultado = $insertStatement->execute($datos);
            $resultado = $this->_connection->lastInsertId();
            //$this->desconectar();
            return $resultado;
        } catch (PDOException $e) {

            if (!$this->_connection) {
                print "¡Error! (" . $e->getCode() . "): " . $e->getMessage() . "<br/>";
                //$this->desconectar();
                return FALSE;
                die();
                exit;
            }
            return NULL;
        }
    }

    /** selecciona devuelve array dependiendo de cant resultados */
    function seleccionar($query = NULL)
    {
        $this->conectar();
        $result = $this->_connection->query($query);
        if ($result->num_rows > 0) {
            $array = [];
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $array[] = $row;
            //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          }
          return $array;
    }
}

    /**
     * inserta una query, no param
     */
    function insertar($query = NULL)
    {
        $this->conectar();
        if (mysqli_query($this->_connection, $query)) {
            $last_id = $this->_connection->insert_id;
            return $last_id;
            //echo "New record created successfully";
          } else {
            echo "Error: " . $query . "<br>" . mysqli_error($this->_connection);
          }
        $this->desconectar();
    }
    function validar($value)
    {
        return mysqli_real_escape_string($this->_connection,$value);
    }
}
