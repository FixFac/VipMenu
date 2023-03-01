<?php

namespace fix\vipmenu\chatvip;

use fix\vipmenu\Main;
use fix\vipmenu\chatvip\ChaVipFix;
use fix\vipmenu\chatvip\ChaVipUtils;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerChatEvent;

use pocketmine\event\player\PlayerKickEvent;
use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\player\Player;


class ChatVipPlayer implements Listener {


    public function Quit(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();

        if(ChatVipFix::getInstance()->unChatVip($player)){
           ChatVipFix::getInstance()->unregisterChat($player);
            }
    }

    public function Kick(PlayerKickEvent $event)
    {
        $player = $event->getPlayer();

        if(ChatVipFix::getInstance()->unChatVip($player)){
           ChatVipFix::getInstance()->unregisterChat($player);
            }
    }

    public function ChatVip(PlayerChatEvent $event)

    {
        $player = $event->getPlayer();

        $msg = $event->getMessage();

        if (ChatVipFix::getInstance()->iChatVip($player)) {
            foreach (ChatVipUtils::getTodos() as $vips) {
                if ($vips->hasPermission("chatvip.fixfac")) {

                    $vips->sendMessage("§8(§bChat§eVip§8)§c " . $player->getName() . " §7>> §7 " . $msg);
                    $event->cancel();
                }
            } } }
}