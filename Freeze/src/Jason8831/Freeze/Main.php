<?php

namespace Jason8831\Freeze;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{


    public Config $config;

    /**
     * @var Main
     */
    private static $instance;

    public function onEnable(): void
    {
        self::$instance = $this;
        $this->getLogger()->info("§f[§l§4FreezeCommands§r§f]: activée");
        $this->saveResource("config.yml");

        $this->getServer()->getCommandMap()->registerAll("AllCommands", [
            new Commands\Freeze(name: "freeze", description: "permet de freeze un joueur", usageMessage: "freeze", aliases: ["frozen"]),
            new Commands\UnFreeze(name: "unfreeze", description: "permet de unfreeze un joueur", usageMessage: "unfreeze", aliases: ["unfrozen"])
        ]);
    }

    public static function getInstance(): self{
        return self::$instance;
    }

}