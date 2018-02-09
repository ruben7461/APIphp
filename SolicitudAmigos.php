<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoSolicitud
 *
 * @author ruben
 */

require_once './BBDDaplicacion.php';

class TipoAmigos {
    
     
     
       public function API(){
        header('Content-Type: application/JSON');                
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET'://consulta
            $this->obtnAmigos();
            break;     
        case 'POST'://inserta
            echo 'POST';
            break;                
        case 'PUT'://actualiza
            echo 'PUT';
            break;      
        case 'DELETE'://elimina
            echo 'DELETE';
            break;
        default://metodo NO soportado
            echo 'METODO NO SOPORTADO';
            break;
        }
        
        
     
    }
    
   
      function obtnAmigos(){
         
     if($_GET['action']=='amigos'){ 
          $db = new BBDDaplicacion();
         if(isset($_GET['id'])){//muestra 1 solo registro si es que existiera ID                 
             //$response = $db->obtenerAmigos($_GET['id']);                
             //echo json_encode($response,JSON_PRETTY_PRINT);
         }else{ //muestra todos los registros                   
             $response = $db->obtenerAmigos(); 
             echo json_encode($response,JSON_OBJECT_AS_ARRAY);
         }
      }
   }
       
    
}
