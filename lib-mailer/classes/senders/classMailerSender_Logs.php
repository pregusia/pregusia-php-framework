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

class MailerSender_Logs implements IMailerSender {
	
	//************************************************************************************
	/**
	 * @param Configuration $oConfig
	 */
	public function onInit($oConfig) {
		
	}
	
	//************************************************************************************
	/**
	 * @param MailerMail $oMail
	 * @return bool
	 */
	public function sendSingle($oMail) {
		if (!($oMail instanceof MailerMail)) throw new InvalidArgumentException('oMail is not MailerMail');
		
		$attachments = array();
		foreach($oMail->getAttachments() as $oAttachment) {
			$attachments[] = sprintf('%s (%d bytes)', $oAttachment->getFileName(), $oAttachment->getContent()->getSize());
		}
		
		Logger::debug('[MailerSender_Logs::sendSingle] Sending mail', null, array(
			'toMail' => $oMail->getToMail(),
			'toName' => $oMail->getToName(),
			'fromMail' => $oMail->getFromMail(),
			'fromName' => $oMail->getFromName(),
			'subject' => $oMail->getSubject(),
			'contentType' => $oMail->getContentType(),
			'contentText' => $oMail->getContentText(),
			'attachments' => implode(' ',$attachments),
		));
		
		return true;
	}
	
	//************************************************************************************
	/**
	 * @param MailerMail[] $arr
	 * @return int
	 */
	public function sendMany($arr) {
		UtilsArray::checkArgument($arr, 'MailerMail');
		foreach($arr as $oMail) {
			$this->sendSingle($oMail);
		}
		return count($arr);
	}
	
	//************************************************************************************
	/**
	 * @param MailerMail $oMail
	 * @param string $templateID
	 * @param array $variables
	 * @param string[] $categories
	 */
	public function sendTemplate($oMail, $templateID, $variables, $categories) {
		if (!($oMail instanceof MailerMail)) throw new InvalidArgumentException('oMail is not MailerMail');

		$attachments = array();
		foreach($oMail->getAttachments() as $oAttachment) {
			$attachments[] = sprintf('%s (%d bytes)', $oAttachment->getFileName(), $oAttachment->getContent()->getSize());
		}		
		
		Logger::debug('[MailerSender_Logs::sendTemplate] Sending mail', null, array(
			'toMail' => $oMail->getToMail(),
			'toName' => $oMail->getToName(),
			'fromMail' => $oMail->getFromMail(),
			'fromName' => $oMail->getFromName(),
			'subject' => $oMail->getSubject(),
			'contentType' => $oMail->getContentType(),
			'contentText' => $oMail->getContentText(),
			'attachments' => implode(' ',$attachments),
			'templateID' => $templateID,
			'categories' => $categories,
			'variables' => $variables
		));		
		
	}
	
}

?>