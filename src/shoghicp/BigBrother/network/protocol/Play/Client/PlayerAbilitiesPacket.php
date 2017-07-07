<?php
/**
 *  ______  __         ______               __    __
 * |   __ \|__|.-----.|   __ \.----..-----.|  |_ |  |--..-----..----.
 * |   __ <|  ||  _  ||   __ <|   _||  _  ||   _||     ||  -__||   _|
 * |______/|__||___  ||______/|__|  |_____||____||__|__||_____||__|
 *             |_____|
 *
 * BigBrother plugin for PocketMine-MP
 * Copyright (C) 2014-2015 shoghicp <https://github.com/shoghicp/BigBrother>
 * Copyright (C) 2016- BigBrotherTeam
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @author BigBrotherTeam
 * @link   https://github.com/BigBrotherTeam/BigBrother
 *
 */

namespace shoghicp\BigBrother\network\protocol\Play\Client;

use shoghicp\BigBrother\network\Packet;

class PlayerAbilitiesPacket extends Packet{

	public $damageDisabled;
	public $canFly;
	public $isFlying = false;
	public $isCreative;

	public $flyingSpeed;
	public $walkingSpeed;

	public function pid(){
		return 0x13;
	}

	public function encode(){
	}

	public function decode(){
		$flags = base_convert($this->getByte(), 10, 2);
		if(strlen($flags) !== 8){
			$flags = str_repeat("0", 8 - strlen($flags)).$flags;
		}
		$flags = intval($flags);

		if(($flags & 0x08) !== 0){
			$this->damageDisabled = true;
		}else{
			$this->damageDisabled = false;
		}

		if(($flags & 0x04) !== 0){
			$this->canFly = true;
		}else{
			$this->canFly = false;
		}

		if(($flags & 0x02) !== 0){
			$this->isFlying = true;
		}else{
			$this->isFlying = false;
		}

		if(($flags & 0x01) !== 0){
			$this->isCreative = true;
		}else{
			$this->isCreative = false;
		}

		$this->flyingSpeed = $this->getFloat();
		$this->walkingSpeed = $this->getFloat();
	}
}
