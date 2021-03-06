<?php
/***
 *      __  __                       _      
 *     |  \/  |                     (_)     
 *     | \  / | __ ___   _____  _ __ _  ___ 
 *     | |\/| |/ _` \ \ / / _ \| '__| |/ __|
 *     | |  | | (_| |\ V / (_) | |  | | (__ 
 *     |_|  |_|\__,_| \_/ \___/|_|  |_|\___|
 *                                          
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Lesser General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 * 
 *  @author Bavfalcon9
 *  @link https://github.com/Olybear9/Mavoric                                  
 */

namespace Bavfalcon9\Mavoric\Events\player;

use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\item\EnderPearl;
use pocketmine\math\Vector3;
use Bavfalcon9\Mavoric\Mavoric;
use Bavfalcon9\Mavoric\Events\MavoricEvent;

/**
 * Called when a player Clicks/Taps something.
 * @deprecated Deprecated until api interaction is fixed.
 */
class PlayerClick extends MavoricEvent {
    /** @var Player */
    private $player;
    /** @var Item */
    private $item;
    /** @var Block */
    private $block;
    /** @var Vector3 */
    private $location;
    /** @var Bool */
    private $rightClick = false;
    /** @var Bool */
    private $leftClick = false;
    /** @var Bool */
    private $clickedAir = false;
    /** @var Bool */
    private $clickedEnt = false;
    /** @var Bool */
    private $clickedBlk = false;

    public function __construct($e, Mavoric $mavoric, Player $player, int $type, Item $item, Block $block, Vector3 $location, int $face) {
        parent::__construct($e, $mavoric, $player);
        $this->player = $player;
        $this->block = $block;
        $this->item = $item;
        $this->location = $location;
        $this->face = $face;

        switch ($type) {
            case 0:
                $this->leftClick = true;
                $this->clickedBlk = true;
                break;
            case 1:
                $this->rightClick = true;
                $this->clickedBlk = true;
                default;
                break;
            case 2:
                $this->leftClick = true;
                $this->clickedAir = true;
                break;
            case 3:
                $this->rightClick = true;
                $this->clickedAir = true;
                break;
            case 4:
                $this->clickedEnt = true;
                $this->leftClick = true;
                $this->rightClick = true;
                break;
        }
    }

    /**
     * Whether or not the player clicked a block
     * @return Bool
     */
    public function clickedBlock(): Bool {
        return $this->clickedBlk;
    }

    /**
     * Whether or not the player clicked air
     * @return Bool
     */
    public function isAir(): Bool {
        return $this->clickedAir;
    }

    /**
     * Whether or not the player clicked an entity
     * @return Bool
     */
    public function isEntity(): Bool {
        return $this->clickedEnt;
    }

    /**
     * Whether or not the player attacked
     * @return Bool
     */
    public function isLeftClick(): Bool {
        return $this->leftClick;
    }

    /**
     * Whether or not the player interacted with something
     * @return Bool
     */
    public function isRightClick(): Bool {
        return $this->rightClick;
    }

    /**
     * Get the block the player clicked
     * @return Bool
     */
    public function getBlock(): Block {
        return $this->block;
    }

    /**
     * Get the item the player used when clicking
     * @return Bool
     */
    public function getItem(): Item {
        return $this->item;
    }

    /**
     * Get the location of the click
     * @return Bool
     */
    public function getLocation(): Vector3 {
        return $this->location;
    }

    /**
     * Get the face of the block that was clicked
     * @return Bool
     */
    public function getFace(): int {
        return $this->face;
    }
}