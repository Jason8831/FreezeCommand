<?php

namespace Jason8831\Freeze\Commands;

use Jason8831\Freeze\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class Freeze extends Command
{

    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);

        if($sender instanceof Player){
            if($sender->hasPermission("freeze.admin")){
                if(!isset($args[0])){
                    $sender->sendMessage($config->get("NoMentionPlayerFreeze"));
                }else{
                    $target = Server::getInstance()->getPlayerByPrefix($args[0]);
                    $target->setImmobile(true);
                    $messageTarget = str_replace(["{player}", "{staff}"], [$target->getName(), $sender->getName()],$config->get("FreezeMessageTarget"));
                    $target->sendMessage($messageTarget);
                    $messagestaff = str_replace(["{player}", "{staff}"], [$target->getName(), $sender->getName()],$config->get("FreezeMessageStaff"));
                    $sender->sendMessage($messagestaff);
                }
            }else{
                $sender->sendMessage($config->get("NoPermssionCommands"));
            }
        }
    }
}