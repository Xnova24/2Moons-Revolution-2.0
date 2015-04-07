<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kröpke
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.3 (2013-05-19)
 * @info $Id: class.ShowLogoutPage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */


class ShowLogoutPage extends AbstractPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show() 
	{
		global $USER, $LNG, $SESSION;
		
		$buddyNotif = $GLOBALS['DATABASE']->query("SELECT sender, owner FROM uni1_buddy WHERE sender = ".$USER['id']." or owner = ".$USER['id'].";");
		while($UserData = $GLOBALS['DATABASE']->fetch_array($buddyNotif)){
		if($UserData['sender'] == $USER['id']){
		$xxData = $UserData['owner'];
		$GLOBALS['DATABASE']->query("INSERT INTO uni1_buddy_notif VALUES ('".$xxData."', '0', ".$USER['id'].",'2');");	
		}
		}
		
		$buddyNotif = $GLOBALS['DATABASE']->query("SELECT sender, owner FROM uni1_buddy WHERE sender = ".$USER['id']." or owner = ".$USER['id'].";");
		while($UserData = $GLOBALS['DATABASE']->fetch_array($buddyNotif)){
		if($UserData['owner'] == $USER['id']){
		$xxData = $UserData['sender'];
		$GLOBALS['DATABASE']->query("INSERT INTO uni1_buddy_notif VALUES ('".$xxData."', '0', ".$USER['id'].",'2');");	
		}
		}
			
		$SESSION->DestroySession();
		$this->display('page.logout.default.tpl');
	}
}