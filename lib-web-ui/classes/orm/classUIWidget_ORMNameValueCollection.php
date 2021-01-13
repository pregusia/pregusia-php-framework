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


class UIWidget_ORMNameValueCollection extends UIWidget_PropertiesMap {
	
	/**
	 * @var ORMTableRecordAdapter_NameValueCollection
	 */
	private $oAdapter = null;

	//************************************************************************************
	/**
	 * @return ORMTableRecordAdapter_NameValueCollection
	 */
	public function getAdapter() { return $this->oAdapter; }
	
	//************************************************************************************
	public function __construct($name, $caption, $oAdapter) {
		if (!($oAdapter instanceof ORMTableRecordAdapter_NameValueCollection)) throw new InvalidArgumentException('oAdapter is not ORMTableRecordAdapter_NameValueCollection');
		parent::__construct($name, $caption);
		$this->value = $oAdapter->getPropertiesMap();
		$this->oAdapter = $oAdapter;
	}
	
	//************************************************************************************
	protected function onRead($oRequest) {
		parent::onRead($oRequest);
		
		$this->getAdapter()->clear();
		$this->getAdapter()->setPropertiesMap($this->getValue());
	}
	
	//************************************************************************************
	public function uiRenderGetTemplateLocation($ctx=null) {
		return 'lib-web-ui:UIWidget.PropertiesMap';
	}
	
}

?>