<?php

namespace fix\vipmenu\chatvip;

use pocketmine\player\Player;

use pocketmine\Server;

class ChatVipUtils {


    public static function getTodos()
    {
        return Server::getInstance()->getOnlinePlayers();
    }

    public static function getPlayer(string $name)
    {
        return Server::getInstance()->getPlayerExact($name);
    }


    public static function sendMessage(string $message)
    {
        return Server::getInstance()->broadcastMessage($message);
    }
}