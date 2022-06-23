<?php

//Chat.php

namespace App;

use ChatRooms;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use User;

require dirname(__DIR__) . "/includes/classes/User.php";
require dirname(__DIR__) . "/includes/classes/ChatRooms.php";
require dirname(__DIR__) . "/includes/classes/Security.php";
// require dirname(__DIR__) . "/database/ChatUser.php";
// require dirname(__DIR__) . "/database/ChatRooms.php";
// require dirname(__DIR__) . "/database/PrivateChat.php";

class Chat implements MessageComponentInterface
{
    protected $clients;
    private $dbcon;
    private $master_key;
    public function __construct($dbcon,$master_key)
    {
        $this->clients = new \SplObjectStorage;
        $this->dbcon = $dbcon;
        $this->master_key = $master_key;
        echo 'Server Started';
    }

    public function onOpen(ConnectionInterface $conn)
    {

        // Store the new connection to send messages to later
        echo 'Server Started';

        $this->clients->attach($conn);


        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {
            $userClass = new User($this->dbcon, '', $queryarray['token']);

            $t = $userClass->updateUserConnectionID($conn->resourceId);
            if ($t === true) {
                echo "New connection! ({$conn->resourceId})\n";
            } else {
                echo 'Failed';
            }
        }
        //     $user_object = new \ChatUser;

        //     $user_object->setUserToken($queryarray['token']);

        //     $user_object->setUserConnectionId($conn->resourceId);

        //     $user_object->update_user_connection_id();

        //     $user_data = $user_object->get_user_id_from_token();

        //     $user_id = $user_data['user_id'];

        //     $data['status_type'] = 'Online';

        //     $data['user_id_status'] = $user_id;

        //     // first, you are sending to all existing users message of 'new'
        //     foreach ($this->clients as $client)
        //     {
        //         $client->send(json_encode($data)); //here we are sending a status-message
        //     }
        // }

    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        $data = json_decode($msg, true);
        $user_id = \Security::int_only($data['fromUser']);
        $group_id = \Security::int_only($data['groupID']);
        $chatRoom = new ChatRooms($this->dbcon, $user_id);
        $e2e_key=\Security::aes_gcm_decrypt($chatRoom->getChatKey($group_id)['e2e_key'],$this->master_key);

        $msg = \Security::input_secure($data['msg']);

        $encrypted_msg=\Security::aes_gcm_encrypt($msg,$e2e_key);
        $myprofile = $chatRoom->getUserObject($user_id);
        $profile = $chatRoom->getChatUserProfile($group_id, $user_id);
        $message = $chatRoom->sendMessage($encrypted_msg, $group_id, $user_id);

        if ($message === true) {
            foreach ($this->clients as $client) {
                $data = [];
                if ($from == $client) {
                    $data['from'] = 'Me';
                    $data['profile_pic'] = $myprofile['profile_pic'];
                    $data['message'] = $msg;
                    $data['date'] = date('d-m-Y h:i a');
                } else {
                    $data['from'] = $myprofile['first_name'] . '' . $myprofile['last_name'];
                    $data['profile_pic'] = $myprofile['profile_pic'];
                    $data['message'] = $msg;
                    $data['date'] = date('d-m-Y h:i a');
                }
                if ($client->resourceId == $profile['connection_id'] || $from == $client) {
                    $client->send(json_encode($data));
                }
                // $client->send(json_encode($data));
            }
        }


      
    }

    public function onClose(ConnectionInterface $conn)
    {

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {
            $userClass = new User($this->dbcon, '', $queryarray['token']);

            $t = $userClass->updateUserConnectionID('');
            if ($t === true) {
                echo "New connection! ({$conn->resourceId})\n";
            } else {
                echo 'Failed';
            }
        }

        // if(isset($queryarray['token']))
        // {

        //     $user_id = $user_data['user_id'];

        //     $data['status_type'] = 'Offline';

        //     $data['user_id_status'] = $user_id;

        //     foreach($this->clients as $client)
        //     {
        //         $client->send(json_encode($data));
        //     }
        // }
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
