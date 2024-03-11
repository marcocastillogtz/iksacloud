<?php

namespace App;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . "/entidades/Usuario.php";
require dirname(__DIR__) . "/entidades/Login.php";

class Login implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        echo "Server started \n";
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Nueva Conexion del usuario: {$conn->resourceId} \n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'Connection %d sending order' . "\n" . ' "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        $data = json_decode($msg, true);

        $user_object = new \Usuario;
        $user_object->setId($from->resourceId);
        $user_object->setName($data['name']);
        $user_object->setMiddleName($data['mname']);
        $user_object->setLastName($data['lname']);
        $user_object->setEmail($data['email']);
        $user_object->setPhone($data['phone']);

        $user = $user_object->saveUser();

        $login_object = new \Login;
        $login_object->setUsuario($data['user']);
        $login_object->setcontrasena(md5($data['password']));
        $login_object->setFK_User($from->resourceId);

        $login = $login_object->saveLog();

        foreach ($this->clients as $value) {

            if ($user && $login) {
                $data['validation'] = 'success';
            } else {
                $data['validation'] = 'danger';
            }
            $value->send(json_encode($data));
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Conexion Cerrada para el usuario : {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Ocurrio un problema en el servidor: {$e->getMessage()}\n";
        $conn->close();
    }
}
