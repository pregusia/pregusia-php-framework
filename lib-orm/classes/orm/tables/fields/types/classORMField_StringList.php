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


class ORMField_StringList extends ORMField {
	
	private $value = array();
	
	//************************************************************************************
	public function set($v) {
		if ($v === null) {
			if ($this->getDefinition()->isNullable()) {
				if ($this->value !== null) {
					$this->value = null;
					$this->changed = true;
				}
				return true;
			}
		}
		if (is_array($v)) {
			$this->value = array();
			foreach($v as $i) {
				$this->value[] = trim(strval($i));
			}
			$this->changed = true;
		}
		if (is_string($v)) {
			$this->value = array();
			
			$arr = @json_decode($v);
			if (is_array($arr)) {
				foreach($arr as $i) {
					$this->value[] = trim(strval($i));
				}
			}
			
			$this->changed = true;
		}
		return true;
	}
	
	//************************************************************************************
	public function get() {
		return $this->value;
	}
	
	//************************************************************************************
	public function toSQL($oEscaper) {
		if ($this->value === null) {
			if ($this->getDefinition()->isNullable()) return 'NULL';
			return '""';
		}
		return '"' . $oEscaper->escapeString(json_encode($this->value)) . '"';
	}
	
	//************************************************************************************
	public function isNull() {
		return $this->value === null;
	}
	
	//************************************************************************************
	public function clear() {
		$this->set(array());
	}
	
	//************************************************************************************
	public function add($v) {
		$this->value[] = trim(strval($v));
		$this->changed = true;
	}
	
	//************************************************************************************
	public function addAll($v) {
		foreach($v as $i) {
			$this->add($i);
		}
	}
	
	//************************************************************************************
	public function has($v) {
		return in_array(strval($v), $this->value);
	}

}

?>