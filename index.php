
        <?php
       require "./SolicitudUsuarios.php"; 
       require "./SolicitudAmigos.php";   
       require "./SolicitudEventos.php";  
       require './SolicitudDeportes.php';
    $SolicitudUsuarios = new SolicitudUsuarios();
    $SolicitudEventos = new SolicitudEvento();
    $SolicitudAmigos = new TipoAmigos();
    $SolicitudDeportes = new TiposDeportes();
    
    
    
    switch ($_GET['action']){
        
        case('usuarios'):
            
            $SolicitudUsuarios->API(); 
            break;
        case('eventos'):
            $SolicitudEventos->API();
             break;
        case('deportes'):
            
            $SolicitudDeportes->API();
            break;
        case('amigos'):
            
            $SolicitudAmigos->API();
            break;
        
    }
  
    
    

     

