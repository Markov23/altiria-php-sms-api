<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/send-sms', function( Request $request, Response $response) {
    $telefono = $request->getParam('telefono');
    $mensaje = $request->getParam('mensaje');
    
    try {
        
        include('httpPHPAltiria.php');

        $altiriaSMS = new AltiriaSMS();

        $altiriaSMS->setLogin('luis.estrada.villegas@gmail.com');
        $altiriaSMS->setPassword('6bn2xsmb');

        $altiriaSMS->setDebug(true);

        $sDestination = $telefono;

        $response = $altiriaSMS->sendSMS($sDestination, $mensaje);

        if (!$response)
            echo "El envio ha terminado en error";
        else
            echo $response;

    } catch (Exception $th) {
        echo '{"error:" ' .$th->getMessage(). '}';
    }
});