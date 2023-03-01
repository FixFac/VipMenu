<?php

namespace fix\vipmenu\chatvip;

use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;

use fix\vipmenu\chatvip\ChatVipFixFac;


class ChatVipFix {
    use SingletonTrait;

    private $chat = [];

    public function __construct()
    {
        self::setInstance($this);
    }


    public function iChatVip(Player $player)
    {
        return isset($this->chat[$player->getName()]);
    }

    public function unChatVip(Player $player): void
    {
        unset($this->chat[$player->getName()]);
    }

    public function registerChat(Player $player)
    {
        return $this->chat[$player->getName()] = new ChatVipFixFac($player);
    }

     public function unregisterChat(Player $player): void
    {
        unset($this->chat[$player->getName()]);
    }
}