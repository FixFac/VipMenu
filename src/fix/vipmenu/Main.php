<?php

namespace fix\vipmenu;
###Plugin Creator FixFac## ###PROHIBIDO SU VENTA### 
###Plugin Dirigido a Todos Lo Usuarios, Cualquir Bug Informar Por Discord: ! FixFac#2849###
use fix\vipmenu\PluginUtils;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\entity\Entity;

use Vecnavium\FormsUI\Form;
use Vecnavium\FormsUI\FormAPI;
use Vecnavium\FormsUI\SimpleForm;

use pocketmine\player\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
#
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;
#
use pocketmine\level\sound\PopSound;
#
use fix\vipmenu\chatvip\ChatVipFix;
use fix\vipmenu\chatvip\ChatVipFixFac;
use fix\vipmenu\chatvip\ChatVipPlayer;
use fix\vipmenu\chatvip\ChatVipUtils;


class Main extends PluginBase implements Listener {
    ###
    public $chatcolor = [];
	###

	public function onEnable() : void
    {
        
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("VipMenu Activa, Discord Creator: ! FixFac#2849 ");    
        $this->registerListener([
            new ChatVipPlayer()
        ]); 
	}

    public function registerListener(array $listeners): void
    {
        foreach ($listeners as $listener){
            $this->getServer()->getPluginManager()->registerEvents($listener, $this);
        }
    }
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args): bool{
		switch($cmd->getName()){
			case "vipmenu":
			if(!$sender instanceof Player){
                 $this->vipform($sender);
                 PluginUtils::PlaySound($sender, "random.pop", 1, 1);
                }else{
                 $this->vipform($sender);
                 PluginUtils::PlaySound($sender, "random.pop", 1, 1);
              }
          }
		return true;
	}
	public function vipform(Player $sender){
        $form = new SimpleForm(function (Player $sender, $data) {
            $result = $data;
            if ($result == null){
			return true;
			}
			switch($result){
                case 0:
                PluginUtils::PlaySound($sender, "nrandom.enderchestclosed", 1, 1);
                break;
				case 1:
  				$this->SizeForm($sender);
  				PluginUtils::PlaySound($sender, "note.pling", 1, 1);
				break;
				case 2:
  				$this->FlyForm($sender);
  				PluginUtils::PlaySound($sender, "note.pling", 1, 1);
				break;
				case 3:
  				$this->ncolorsForm($sender);
  				PluginUtils::PlaySound($sender, "note.pling", 1, 1);
				break;
                case 4: 
                $this->ColorForm($sender);
                PluginUtils::PlaySound($sender, "note.pling", 1, 1);
                break;
                case 5: 
                $this->ChatVipForm($sender);
                PluginUtils::PlaySound($sender, "note.pling", 1, 1);
                break;
                case 6:
                PluginUtils::PlaySound($sender, "nrandom.enderchestclosed", 1, 1);
                break;
			}
		});	
		
		
		$form->setTitle("§8(§bMenu§eVip§8)");
        $form->addButton("§l§cFix§bFac");
 		$form->addButton("§l§2Size\n§r§7Click Para Usar",0,"textures/ui/FriendsDiversity");
 		$form->addButton("§l§2Fly\n§r§7Click Para Usar",0,"textures/items/feather");
 		$form->addButton("§l§eTag§bColor\n§r§7Click Para Usar",0,"textures/items/dye_powder_red");
        $form->addButton("§1C§2o§3l§4o§5r§6C§7h§8a§9t\n§r§7Click Para Usar",0,"textures/items/egg_npc");
        $form->addButton("§bChat§eVip\n§r§7Click Para Usar",0,"textures/ui/icon_staffpicks");
		$form->addButton("§l§cSALIR\n§r§8Salir");
		$sender->sendForm($form);
	}

	public function FlyForm(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $player->setFlying(true);
				    $player->setAllowFlight(true);
                    $player->sendMessage("§l§aHas Activado El Fly Usalo de Manera Responsable");
                    $player->sendTitle("§l§aTienes Fly");
                break;
                case 1:
                    $player->setFlying(false);
				    $player->setAllowFlight(false);
                    $player->sendMessage("§7Has Desactivado el Fly");
                    $player->sendTitle("§cFly Desactivado");
                break;
            }
        });
        $form->setTitle("§8(§bMenu§eVip§8)§7");
        $form->setContent("§7Aqui Podras Desactivar el Fly o Activarlo");
        $form->addButton("§l§aFly ON");
        $form->addButton("§l§cFly OFF");
        $form->addButton("Cerrar");
        $form->sendToPlayer($player);
    }

    public function SizeForm(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $player->sendMessage("§8(§bMenu§eVip§8) §r§l§7Eres un Bebe");
                    $player->sendTitle("§8(§bMenu§eVip§8)§7 §r§l§aEres Pequeño :3");
                    $player->setScale("0.3");
                break;
                case 1:
                    $player->sendMessage("§8(§bMenu§eVip§8)§r§l§7 Eres Tamaño Promedio");
                    $player->sendTitle("§aEstas en Tamaño Promedio");
                    $player->setScale("0.5");
                break;
                case 2:
                    $player->setScale("1.0");
                    $player->sendMessage("§8(§bMenu§eVip§8)§r §l§7Tamaño Normal");
                    $player->sendTitle("§a Eres Tamaño Normal");
                break;
                case 3:
                    $player->setScale("1.5");
                    $player->sendMessage("§8(§bMenu§eVip§8)§r §l§7Eres Tamñano MedioGigante" );
                    $player->sendTitle("§aTamaño MedioGigante");
                break;
                case 4:
                    $player->setScale("2.0");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 §l§7Eres Tamñano Gigante" );
                    $player->sendTitle("§aTamaño Gigante");
                break;
                case 5:
                    $player->setScale("2.8");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 §l§7Eres Tamñano MegaGigante" );
                    $player->sendTitle("§aTamaño MegaGigante");
                break;
                case 6:
                    $player->setScale("3.4");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 §l§7Eres Tamñano MegaSuperGigante" );
                    $player->sendTitle("§aTamaño MegaSuperGigante");
                break;
            }
        });
        $form->setTitle("§8(§bMenu§eVip§8)§7");
        $form->setContent("§7Selecciona Un Tamañp Para Usar");
        $form->addButton("§a§l§eTamaña §aMini");
        $form->addButton("§l§eTamaño §bMiniMediano");
        $form->addButton("§l§eTamaño §aNormal");
        $form->addButton("§l§eTamaño §aMedio§fGigante");
        $form->addButton("§l§eTamño §cGigante");
        $form->addButton("§l§eTamño §3Mega§fGigante");
        $form->addButton("§l§eTamaño §bSuper§eMega§fGigante");
        $form->addButton("Cerrar");
        $form->sendToPlayer($player);
    }

    public function ColorForm(Player $player){
        $form = new SimpleForm(function (Player $player, int $data = null) {
            $result = $data;
            if ($result === null) {
                return;
         }
            switch ($result) {
                case 0:
                if (!in_array ($player->getName(), $this->chatcolor))
                 {
                    $this->chatcolor[] = $player->getName();
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 Has Activado el §1C§2o§3l§4o§5r§6C§7h§8a§9t");
                } else {
                    $player->sendTitle("1C§2o§3l§4o§5r§6C§7h§8a§9t");
                }
                break;

                case 1:

                $player->sendMessage("§8(§bMenu§eVip§8)§7 Has Desactivado el §1C§2o§3l§4o§5r§6C§7h§8a§9t");

                if (in_array ($player->getName(), $this->chatcolor)) {
                    unset($this->chatcolor[array_search($player->getName(), $this->chatcolor)]);
                }
                break;
            }
        });
        $form->setTitle("§1C§2o§3l§4o§5r§6C§7h§8a§9t");
        $form->setContent("§7Aqui Podras Tener El Chat en Color");
        $form->addButton("§l§1C§2o§3l§4o§5r§6C§7h§8a§9t §aON");
        $form->addButton("§l§1C§2o§3l§4o§5r§6C§7h§8a§9t §cOFF");
        $form->addButton("Cerrar");
        $form->sendToPlayer($player);
    } 
    

    public function ChatColorEvento(PlayerChatEvent $event) {

        $player = $event->getPlayer();

        $msg = $event->getMessage();

        $vip = "";
        $fix = mb_strlen($msg) - 1;
        $colores = ["§1", "§2", "§3", "§4", "§5", "§6", "§7", "§8", "§9", "§a", "§b", "§c", "§d", "§e", "§f", "§g"];

        $fac = 0;
        $type = 0;

        while ($fac <= $fix)
         {
            $vip .= $colores[$type] . $msg[$fac];

            $fac++;

            $type++;

            if ($type == count($colores)) {
                $type = 0;
            }
        }
        if (in_array ($player->getName(), $this->chatcolor)) {
            $event->setMessage(str_replace($msg, "$vip", $msg));
        }    } 

    public function ChatVipForm(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0: #Otogar el Permiso chatvip.fixfac, alos Staff, Para que Puedan ver Lo que Dicen 
                if(!$player->hasPermission("chatvip.fixfac")){
                $player->sendMessage("§8(§bMenu§eVip§8)§7 No tienes Permisos para Usar este comando");
                return;
           }

        if(!ChatVipFix::getInstance()->iChatVip($player)){
            ChatVipFix::getInstance()->registerChat($player);

            $player->sendMessage("§8(§bMenu§eVip§8)§7 Estas en El ChatVip");

        }   
                break;
                case 1:
                if(ChatVipFix::getInstance()->unChatVip($player)){
                ChatVipFix::getInstance()->unregisterChat($player);
                $player->sendMessage("§8(§bMenu§eVip§8)§7 Has Salido del ChatVip, Ahora puedes Hablar con todo el mundo");

                }           
                break;
            }
        });
        $form->setTitle("§8(§bMenu§eVip§8)§7");
        $form->setContent("§7Aqui Podras Hablar Por Privado Con Demas Usuarios Con Rank.");
        $form->addButton("§l§bChat§eVip §aON");
        $form->addButton("§l§bChat§eVip §cOFF");
        $form->addButton("Cerrar");
        $form->sendToPlayer($player);
    }
    ##ncolors##

    public function ncolorsForm(Player $player){
        $form = new SimpleForm(function (Player $player, $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $player->setDisplayName("§f" . $player->getName() . "§r");
                    $player->setNameTag("§f" . $player->getName() . "§r");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 Tu nametag Ahora es  §fWhite!");
                break;

                case 1:
                    $player->setDisplayName("§c" . $player->getName() . "§r");
                    $player->setNameTag("§c" . $player->getName() . "§r");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 Tu nametag Ahora es §cRojo!");
                break;

                case 2:
                    $player->setDisplayName("§b" . $player->getName() . "§r");
                    $player->setNameTag("§b" . $player->getName() . "§r");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 Tu nametag Ahora es §bAzul!");
                break;

                case 3:
                    $player->setDisplayName("§e" . $player->getName() . "§r");
                    $player->setNameTag("§e" . $player->getName() . "§r");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 Tu nametag Ahora es §eAmarillo!");
                break;

                case 4:
                    $player->setDisplayName("§6" . $player->getName() . "§r");
                    $player->setNameTag("§6" . $player->getName() . "§r");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 Tu nametag Ahora es §6Naranga!");
                break;

                case 5:
                    $player->setDisplayName("§d" . $player->getName() . "§r");
                    $player->setNameTag("§d" . $player->getName() . "§r");
                    $player->sendMessage("§8(§bMenu§eVip§8)§7 Tu nametag Ahora es §dPurple!");
                break;
            }
        return true;
        });
        $form->setTitle("§8(§bMenu§eVip§8)§7");
        $form->setContent("§7 Selecciona Tu Color Favorito");
        $form->addButton("§fBlanco");
        $form->addButton("§l§cRojo");
        $form->addButton("§b§lAzul");
        $form->addButton("§e§lAmarillo");
        $form->addButton("§6§lNaranga");
        $form->addButton("§d§lMorado");
        $form->sendToPlayer($player);
        return $form;
    }
}

               