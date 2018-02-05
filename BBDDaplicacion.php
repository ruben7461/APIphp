<?php


class BBDDaplicacion {
      protected $mysqli;
    const LOCALHOST = '127.0.0.1';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'AplicacionAndroid';
    const Puerto = 3306;
    public $conectado;
    
    /**
     * Constructor de clase
     */
    public function __construct() {           
        try{
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE, self::Puerto);
            $conectado = $this->mysqli;
            
        }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión
            http_response_code(500);
            exit;
        }     
       
    }  
    
    
    /**
     * obtiene un solo registro dado su ID
     *
     */
    public function obtenerPersonaID($id= 0){      
        $stmt = $this->mysqli->prepare("SELECT * FROM TablaUsuarios WHERE id_usuario= ?;");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_array(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    /**
     * obtiene todos los registros de la tabla "people"
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function ObtenerPersonas(){        
        $result = $this->mysqli->query("SELECT * FROM TablaUsuarios"); 
        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $result->close();
            return $peoples;
  
         
    }
    
    /**
     * añade un nuevo registro en la tabla tablausuarios
     * @param String $name nombre completo de persona
     * @return bool TRUE|FALSE 
     */
    public function insertarUsuario($correo='',$nombre='',$apellido='',$password='',$nacionalidad=''){
        $stmt = $this->mysqli->prepare("INSERT INTO tablausuarios(correo,nombre,apellidos,password,nacionalidad) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss',$correo,$nombre,$apellido,$password,$nacionalidad);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    
    /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function deleteUsuario($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM tablausuarios WHERE id = ? ; ");
        $stmt->bind_param('i', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    /**
     * Actualizar registro dado su ID
     * @param int $id Description
     */
    public function updateUsuario($id, $nombreNuevo) {
        if($this->checkID($id)){
            $stmt = $this->mysqli->prepare("UPDATE tablausuarios SET nombre=? WHERE id_usuario = ? ; ");
            $stmt->bind_param('si', $nombreNuevo,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * verifica si un ID existe
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function compruebaExistenciaID($id){
        $stmt = $this->mysqli->prepare("SELECT * FROM tablausuarios WHERE id_usuario=?");
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $stmt->store_result();    
            if ($stmt->num_rows == 1){                
                return true;
            }
        }        
        return false;
    }
    
   
      
}
