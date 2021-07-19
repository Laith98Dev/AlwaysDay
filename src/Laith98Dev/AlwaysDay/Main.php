<?php

namespace Laith98Dev\AlwaysDay;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\level\LevelLoadEvent;
use pocketmine\level\Level;

class Main extends PluginBase implements Listener 
{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->loadLevels();
	}
	
	public function loadLevels(){
		foreach (scandir($this->getServer()->getDataPath() . "worlds") as $name){
			if(in_array($name, [".", ".."]))
				continue;
			$this->getServer()->loadLevel($name);
		}
	}
	
	public function onLevelLoad(LevelLoadEvent $event){
		$level = $event->getLevel();
		$level->setTime(Level::TIME_DAY);
		$level->stopTime();
	}
}
