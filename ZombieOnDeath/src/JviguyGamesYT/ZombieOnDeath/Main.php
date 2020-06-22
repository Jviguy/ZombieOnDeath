<?php

declare(strict_types=1);

namespace JviguyGamesYT\ZombieOnDeath;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\Entity\Zombie;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginManager;
use pocketmine\server;
use pocketmine\Entity\Monster;
use JviguyGamesYT\ZombieOnDeath\Entity;

class Main extends PluginBase implements Listener
{


    const NETWORK_ID = 32;
    public $width = 0.6;
    public $height = 1.8;
    public $eyeHeight = 1.62;

    public function getNameTag(): string
    {
        return "Zombie";
    }


    public function onDeath(playerDeathEvent $e)
    {
        $player = $e->getPlayer ();
        $pos = $player->getPosition ();
        $name = $player->getname ();
         if ($this->getConfig()->get("CustomDeathMessage") = 'On')
 {                                                        
            $e->setDeathMessage("{$name} Has Been Turned!");     
 }                                                       
        /** @var \pocketmine\level\Position $pos */
        $zombie = new \pocketmine\entity\Zombie($pos->getLevel(), \pocketmine\entity\Zombie::createBaseNBT($pos, new \pocketmine\math\Vector3(0,0,0)));
        $zombie->spawnTo($player);



    }

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->Info('ZombieOnDeath Has Been Enabled');
    }
}

