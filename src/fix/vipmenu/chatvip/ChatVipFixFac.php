<?php

namespace fix\vipmenu\chatvip;

use pocketmine\player\Player;

class ChatVipFixFac {

    public Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }
}