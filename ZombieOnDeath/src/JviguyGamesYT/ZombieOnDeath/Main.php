<?php

declare(strict_types=1);

namespace JviguyGamesYT\ZombieOnDeath;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\entity\Zombie;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginManager;
use pocketmine\Server;
use pocketmine\entity\Monster;
use JviguyGamesYT\ZombieOnDeath\Entity;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
class Main extends PluginBase implements Listener
{
    //TO-DO for the author: get a LICENSE


    const NETWORK_ID = 32;
    public $width = 0.6;
    public $height = 1.8;
    public $eyeHeight = 1.62;

    public function getNameTag(): string
    {
        return "Zombie";
    }
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        // not important$this->getLogger()->Info('ZombieOnDeath Has Been Enabled');
    }
    /**
    * @param PlayerDeathEvent $e
    */
    public function onDeath(playerDeathEvent $e)
    {
        $player = $e->getPlayer();
        $pos = $player->getPosition();
        $name = $player->getName();
        if ($this->getConfig()->get("CustomDeathMessage") == true)
        {                                                        
            $e->setDeathMessage("{$name} has been turned!");     
        } else {
            //do nothing, if this doesn't cause errors then remove this:
            $this->getLogger()->info("CustomDeathMessages have been turned off in config.yml");
        }
        $zombie = new Zombie($pos->getLevel(), Zombie::createBaseNBT($pos, new Vector3(0,0,0)));
        $zombie->spawnTo($player);
    }
}

