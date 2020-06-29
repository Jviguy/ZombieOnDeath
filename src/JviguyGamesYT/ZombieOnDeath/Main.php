<?php

declare(strict_types=1);

namespace JviguyGamesYT\ZombieOnDeath;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\Entity\Zombie;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginManager;
use JviguyGamesYT\ZombieOnDeath\Entity;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\entity\Monster;

class Main extends PluginBase implements Listener
{

    const NETWORK_ID = 32;
    public $width = 0.6;
    public $height = 1.8;
    public $eyeHeight = 1.62;

    public function getNameTag(): string
    {
        $nametag = $this->getConfig()->get("NameTag");
        return "$nametag";
    }


    public function onDeath(playerDeathEvent $e)
    {
        $deathmessages = $this->getConfig()->get("CustomDeathMessage");
        $namespace1 = $this->getConfig()->get("firstnamespace");
        $namespace2 = $this->getConfig()->get("secondnamespace");
        $namespace3 = $this->getConfig()->get("thirdnamespace");
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
        /** @var \pocketmine\level\Position $pos */
        $zombie = new Zombie($pos->getLevel(), Zombie::createBaseNBT($pos, new Vector3(0,0,0)));
        $zombie->spawnTo($player);
    }
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        // not important$this->getLogger()->Info('ZombieOnDeath Has Been Enabled');
        $this->getConfig()->save();
    }
    /**
     * @param PlayerDeathEvent $e
     */

}
    
