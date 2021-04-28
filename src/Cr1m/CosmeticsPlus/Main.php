<?php

declare(strict_types=1);

namespace Cr1m\CosmeticsPlus;

use pocketmine\entity\Entity;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\scheduler\PluginTask;

USE Cr1m\CosmeticsPlus\Forms\FormUI;
use Cr1m\CosmeticsPlus\Forms\Form;
use Cr1m\CosmeticsPlus\EventListener;
use Cr1m\CosmeticsPlus\Pets;
use Cr1m\CosmeticsPlus\Particles;

class Main extends PluginBase implements Listener
{

    use FormUI, Pets, Particles;

    public $cpParticles = [];

    public $threeDimensionalPets = [
        "Wolf/wolf.png",
        "Wolf/wolf.json",
        "Caterpillar/caterpillar.json",
        "Caterpillar/caterpillar.png"
    ];

    public function onLoad()
    {
        self::setInstance($this);
        $this->saveDefaultConfig();
    }

    public function onEnable(): void
    {
        self::$instance = $this;
        Entity::registerEntity(Pet::class, true);

        foreach ($this->threeDimensionalPets as $file) {
            $this->saveResource($file);
        }

        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

}