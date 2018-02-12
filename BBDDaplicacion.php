<?php


class BBDDaplicacion {
      protected $mysqli;
    const LOCALHOST = '127.0.0.1';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'AplicacionAndroid';
    const Puerto = 3306;
  
    
    /**
     * Constructor de clase
     */
    public function __construct() {           
        try{
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE, self::Puerto);
            
            
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
    public function obtenerPersonaID($id=""){      
        $stmt = $this->mysqli->prepare("SELECT correo,nombre FROM TablaUsuarios WHERE correo= ?");
      
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_array(MYSQLI_ASSOC); 
         $stmt->close();
        return $peoples;   
      
    }
    
    /**
     * obtiene todos los registros de la tabla "usuarios"
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function ObtenerPersonas(){        
        $result = $this->mysqli->query("SELECT nombre FROM TablaUsuarios"); 

        while($row = $result->fetch_assoc()){
            $gentecilla[] = $row;
        }

            $result->close();
            return $gentecilla;
             
  
    }
    
//    obtiene todos los deportes que esten registrados en la BBDD
     public function ObtenerDeportes(){        
        $result = $this->mysqli->query("SELECT nombreDeporte FROM TablaDeportes"); 

        while($row = $result->fetch_assoc()){
            $deportes[] = $row;
        }

            $result->close();
            return $deportes;
             
 
    }
    
    
//    obtiene las imagenes que pertenezcan al deporte seleccionado
     public function ObtenerFotosDeportes($id=""){        
        $stmt = $this->mysqli->prepare("SELECT fotoDeporte FROM TablaDeportes WHERE nombreDeporte = ?"); 

         $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $fotos = $result->fetch_array(); 
         $stmt->close();
        $fotito= base64_encode($fotos[0]);  
        header("Content-Type: text/html; charset=utf-8");
        echo '<img width="60" src="data:image/gif;base64,' . $fotito . '" />';
       
             
 
    }
     
    
    //obtiene los amigos del usuario que este iniciando sesion en ese momento
    //y le mostrara todos los amigos que tiene
    public function obtenerAmigos($id= 0){      
        $stmt = $this->mysqli->prepare("SELECT nombre FROM tablausuarios WHERE usuario = (SELECT id_relacion FROM 
            TablaAmigos_has_TablaUsuarios where TablaUsuarios_id_usuario = ?)");
      
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_array(MYSQLI_ASSOC); 
         $stmt->close();
        return $peoples;   
      
    }
      
    /**
     * añade un nuevo registro en la tabla Amigos
     * @param String $name nombre completo de persona
     * @return bool TRUE|FALSE 
     */
    public function insertarUsuario($idAmigo,$idUsuario){
        $stmt = $this->mysqli->prepare("INSERT INTO TablaAmigos_has_TablaUsuarios(
        TablaAmigos_id_relacion,TablaUsuarios_id_usuario) VALUES (?,?)");
        $stmt->bind_param('ii',$idAmigo,$idUsuario);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    
    
    
//    añade un nuevo evento en la Tabla Eventos con los parametros que le pasamos al llamar al metodo
      public function insertarEvento($nombreEvento='',$descripcion='',$deporte='',$N_jugadores=''){
        $stmt = $this->mysqli->prepare("INSERT INTO tablaeventos(nombreEvento,descripcion,deporte,N_jugadores) VALUES (?,?,?,?)");
        $stmt->bind_param('sssss',$nombreEvento,$descripcion,$deporte,$N_jugadores);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;     
        
        
    }
    
    
    
     public function insertarAmigos($correo='',$nombre='',$apellido='',$password='',$nacionalidad=''){
        $stmt = $this->mysqli->prepare("INSERT INTO tablausuarios(correo,nombre,apellidos,password,nacionalidad) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss',$correo,$nombre,$apellido,$password,$nacionalidad);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    /**
     * elimina un registro dado el ID
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
    public function updateNmobre($id, $nombreNuevo) {
        if($this->checkID($id)){
            $stmt = $this->mysqli->prepare("UPDATE tablausuarios SET nombre=? WHERE id_usuario = ? ; ");
            $stmt->bind_param('si', $nombreNuevo,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
//    /**
//     * verifica si un ID existe
//     * @param int $id Identificador unico de registro
//     * @return Bool TRUE|FALSE
//     */
//    public function compruebaExistenciaID($id){
//        $stmt = $this->mysqli->prepare("SELECT * FROM tablausuarios WHERE id_usuario=?");
//        $stmt->bind_param("i", $id);
//        if($stmt->execute()){
//            $stmt->store_result();    
//            if ($stmt->num_rows == 1){                
//                return true;
//            }
//        }        
//        return false;
//    }
    
   
      
}
