<?php
/**
 *  This file is part of PREGUSIA-PHP-FRAMEWORK.
 *  PREGUSIA-PHP-FRAMEWORK is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU Lesser General Public License as published by
 *  the Free Software Foundation; either version 2.1 of the License, or
 *  (at your option) any later version.
 *  
 *  PREGUSIA-PHP-FRAMEWORK is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU Lesser General Public License for more details.
 *  
 *  You should have received a copy of the GNU Lesser General Public License
 *  along with PREGUSIA-PHP-FRAMEWORK; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *  
 *  @author pregusia
 *
 */


class Events {
	
	private $events = array();
	
	//************************************************************************************
	public function add($e) {
		if (!($e instanceof Closure)) throw new InvalidArgumentException('$e is not Closure');
		$this->events[] = $e;
	}
	
	//************************************************************************************
	public function call() {
		$args = func_get_args();
		foreach($this->events as $e) {
			call_user_func_array($e, $args);
		}
	}
	
	//************************************************************************************
	/**
	 * Wywoluje kazda z funkcji, jesli jakas zwroci cos nie pustego to jest to zwracane i wywolywanie jest przerywane
	 */
	public function callReturn() {
		$args = func_get_args();
		foreach($this->events as $e) {
			$res = call_user_func_array($e, $args);
			if ($res) return $res;
		}		
		return null;
	}
	
}

?>