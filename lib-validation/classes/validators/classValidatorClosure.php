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


class ValidatorClosure implements IValidator {
	
	const CODE = 1300;
	const TXT_ERROR = '[i18n=ValidatorClosure.invalidreturn]Value returned from closure is not ValidationError[/i18n]';
	
	/**
	 * @var Closure
	 */
	private $oFunction = null;
	
	//************************************************************************************
	public function __construct($oFunction) {
		if (!($oFunction instanceof Closure)) throw new InvalidArgumentException('oFunction is not Closure');
		$this->oFunction = $oFunction;
	}
	
	//************************************************************************************
	/**
	 * @param mixed $value
	 * @param ValidationProcessEntry $oEntry
	 * @param ValidationErrorsCollection $oErrors
	 */
	public function validate($value, $oEntry, $oErrors) {
		$func = $this->oFunction;
		if ($oError = $func($value)) {
			if (!($oError instanceof ValidationError)) {
				$oErrors->add(new ValidationError('', self::CODE, ComplexString::Create(self::TXT_ERROR)));
			} else {
				$oErrors->add($oError);
			}
		}
	}
	
}

?>