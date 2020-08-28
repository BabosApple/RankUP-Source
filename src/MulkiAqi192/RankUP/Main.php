<?php

namespace MulkiAqi192\RankUP;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use onebone\economyapi\EconomyAPI;

class main extends PluginBase implements Listener {

	public function onEnable(){

	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "rankup":
			 if($sender instanceof Player){
			 	$this->rank($sender);
			 }
		}
	return true;
	}

	public function rank($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$papi = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
		$crank = $papi->getUserDataMgr()->getGroup($player)->getName();
		$money = EconomyAPI::getInstance()->myMoney($player);
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					$papi = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
					$a = $papi->getGroup("A");
					$b = $papi->getGroup("B");
					$c = $papi->getGroup("C");
					$guest = $papi->getGroup("Guest");
					$crank = $papi->getUserDataMgr()->getGroup($player)->getName();
					$money = EconomyAPI::getInstance()->myMoney($player);
					if($crank == "Guest"){
						if($money > 3000){
							EconomyAPI::getInstance()->reduceMoney($player, "3000");
							$ppapi->setGroup($player, $a);
							$player->sendMessage("§bYour rank has been upgraded to §6A");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money == 3000){
							EconomyAPI::getInstance()->reduceMoney($player, "3000");
							$papi->setGroup($player, $a);
							$player->sendMessage("§bYour rank has been upgraded to §6A");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money < 3000){
							$player->sendMessage("§cYou dont have enough money!");
							return true;
						}
					}
					if($crank == "A"){
						if($money > 6000){
							EconomyAPI::getInstance()->reduceMoney($player, "6000");
							$papi->setGroup($player, $b);
							$player->sendMessage("§bYour rank has been upgraded to §6B");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money == 6000){
							EconomyAPI::getInstance()->reduceMoney($player, "6000");
							$papi->setGroup($player, $b);
							$player->sendMessage("§bYour rank has been upgraded to §6B");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money < 6000){
							$player->sendMessage("§cYou dont have enough money!");
							return true;
						}
					}
					if($crank == "B"){
						if($money > 9000){
							EconomyAPI::getInstance()->reduceMoney($player, "9000");
							$papi->setGroup($player, $c);
							$player->sendMessage("§bYour rank has been upgraded to §6C");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money == 9000){
							EconomyAPI::getInstance()->reduceMoney($player, "9000");
							$papi->setGroup($player, $c);
							$player->sendMessage("§bYour rank has been upgraded to §6C");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money < 9000){
							$player->sendMessage("§cYou dont have enough money!");
							return true;
						}
					}
					if($crank == "C"){
						$player->sendMessage("§cYou already have the higher rank!");
						return true;
					}
				break;

				case 1:

				break;
			}
		});
		$form->setTitle("§l§bRank§6UP");
		$form->setContent("§aWelcome to §bRank§6UP\n§bYour rank §7[§e" . $crank . "§7]\n§bYour money: §e$" . $money . "");
		$form->addButton("§bUpgrade Rank");
		$form->addButton("Close");
		$form->sendToPlayer($player);
		return $form;
	}

}