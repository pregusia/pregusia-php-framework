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


class UIWidget_TextInput extends UIWidgetWithValue {
	
	private $placeholder = '';
	
	//************************************************************************************
	public function getPlaceHolder() { return $this->placeholder; }
	public function setPlaceHolder($v) { $this->placeholder = $v; }
	
	//************************************************************************************
	/**
	 * @param WebRequest $oRequest
	 */
	protected function onRead($oRequest) {
		$this->value = $oRequest->getString($this->getName());
	}
	
	//************************************************************************************
	public function tplRender($key, $oContext) {
		switch($key) {
			case 'placeholder': return $this->getPlaceholder();
			default: return parent::tplRender($key, $oContext);
		}
	}		

	//************************************************************************************
	/**
	 * Zwraca lokacje szablonu uzywanego do wyrenderowania tego obiektu
	 * Moze zwrocic puste - wtedy przyjeta zostanie domyslna wartosc
	 * @return string
	 */
	public function uiRenderGetTemplateLocation($ctx=null) {
		if ($ctx instanceof TemplateRenderableProxyContext) {
			if ($ctx->getTag('mod.full2')) {
				return 'lib-web-ui:UIWidget.TextInput.full2';
			}
		}
		return 'lib-web-ui:UIWidget.TextInput.normal';
	}
	
}

?>