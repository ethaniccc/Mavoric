<?php

namespace Bavfalcon9\Mavoric\Cheats;

use Bavfalcon9\Mavoric\Main;
use Bavfalcon9\Mavoric\Mavoric;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;

use pocketmine\event\entity\{
    EntityDamageByEntityEvent,
    EntityDamageByChildEntityEvent
};
use pocketmine\{
    Player,
    Server
};

/* API CHANGE (Player) */

class Reach implements Listener {
    private $mavoric;
    private $plugin;

    public function __construct(Main $plugin, Mavoric $mavoric) {
        $this->plugin = $plugin;
        $this->mavoric = $mavoric;
    }

    public function onDamage(EntityDamageByEntityEvent $event) {
        $entity = $event->getEntity();
        $damager = $event->getDamager();

        // Do player check.
        //if (!$entity instanceof Player) return;
        if ($event instanceof EntityDamageByChildEntityEvent) return;
        if (!$damager instanceof Player) return;

        /* Reach Check */
        if ($this->checkReach($damager, $entity) === true) {
            if (!$damager->isCreative()) {
                if ($damager->getPing() > 180) {
                    $this->mavoric->getFlag($damager)->addViolation(Mavoric::Reach);
                    $this->mavoric->messageStaff('detection', $damager, 'Reach [High Ping]');
                } else {
                    $this->mavoric->getFlag($damager)->addViolation(Mavoric::Reach);
                    $this->mavoric->messageStaff('detection', $damager, 'Reach');
                }
            }
        }
    }

    private function checkReach($dam, $p) {
        $dx = $dam->getX();
        $dy = $dam->getY();
        $dz = $dam->getZ();
        $px = $p->getX();
        $py = $p->getY();
        $pz = $p->getZ();

        $distanceX = sqrt(pow(($px - $dx), 2) + pow(($py - $dy), 2));
        $distanceZ = sqrt(pow(($pz - $dz), 2) + pow(($py - $dy), 2));

        if ($dam->isCreative()) return false;
        if ($distanceX >= 7.7 || $distanceZ >= 7.7) return true;
        if ($distanceX <= -7.7 || $distanceZ <= -7.7) return true;
        return false;
    }
}