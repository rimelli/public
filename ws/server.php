<?php

//server.php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Chat;

    require dirname(__DIR__) . '/vendor/autoload.php';
    require dirname(__DIR__).'/config/config.php';

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat($con,$master_key)
            )
        ),
        8080
    );

    $server->run();


?>