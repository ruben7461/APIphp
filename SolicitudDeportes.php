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

class TiposDeportes {
    
     
     
       public function API(){
        header('Content-Type: application/JSON');                
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET'://consulta
            $this->obtnDeportes();
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
    
   
      function obtnDeportes(){

           
          $db = new BBDDaplicacion();
         if(isset($_GET['categoria'])){                 
             $response = $db->ObtenerFotosDeportes($_GET['categoria']);  
             echo json_encode($response);
            //echo $response;
                //header("Content-type:image/png");
         }else{ //muestra todos los registros                   
             $response = $db->ObtenerDeportes(); 
             echo json_encode($response,JSON_PRETTY_PRINT);
             
             
      }
        
   }
       
}
