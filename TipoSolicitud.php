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


class TipoSolicitud {
    
     
     
       public function API(){
        header('Content-Type: application/JSON');                
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET'://consulta
            $this->obtnUsuarios();
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
    
      function obtnUsuarios(){
          $db = new BBDDaplicacion();
     if($_GET['action']=='usuarios'){ 
         if(isset($_GET['id'])){//muestra 1 solo registro si es que existiera ID                 
             $response = $db.obtenerPersonaID($_GET['id']);                
             echo json_encode($response,JSON_PRETTY_PRINT);
         }else{ //muestra todos los registros                   
             $response = $db.ObtenerPersonas();              
             echo json_encode($response,JSON_PRETTY_PRINT);
         }
      }
   }
       
    
}
