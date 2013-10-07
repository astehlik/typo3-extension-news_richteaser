<?php
namespace Int\NewsRichteaser\Hooks;

/*                                                                        *
 * This script belongs to the TYPO3 extension "news_richteaser".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License as published by the Free   *
 * Software Foundation, either version 3 of the License, or (at your      *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        *
 * You should have received a copy of the GNU General Public License      *
 * along with the script.                                                 *
 * If not, see http://www.gnu.org/licenses/gpl.html                       *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Initializes the default values for automatically created news content elements
 */
class DataPreprocessor extends \TYPO3\CMS\Backend\Form\DataPreprocessor {

	/***********************************************
	 *
	 * Getting record content, ready for display in TCEforms
	 *
	 ***********************************************/
	/**
	 * A function which can be used for load a batch of records from $table into internal memory of this object.
	 * The function is also used to produce proper default data for new records
	 * Ultimately the function will call renderRecord()
	 *
	 * @param string $table Table name, must be found in $GLOBALS['TCA']
	 * @param string $idList Comma list of id values. If $idList is "prev" then the value from $this->prevPageID is used. NOTICE: If $operation is "new", then negative ids are meant to point to a "previous" record and positive ids are PID values for new records. Otherwise (for existing records that is) it is straight forward table/id pairs.
	 * @param string $operation If "new", then a record with default data is returned. Further, the $id values are meant to be PID values (or if negative, pointing to a previous record). If NOT new, then the table/ids are just pointing to an existing record!
	 * @return void
	 * @see renderRecord()
	 * @todo Define visibility
	 */
	public function fetchRecord($table, $idList, $operation) {
		$this->modifyDefValuesIfNewsAutcontentRecord();
		parent::fetchRecord($table, $idList, $operation);
	}

	/**
	 * Modifies the default values for a new tt_content record
	 */
	protected function modifyDefValuesIfNewsAutcontentRecord() {

		$ajaxArguments = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('ajax');

		if (!(isset($ajaxArguments) && is_array($ajaxArguments) && count($ajaxArguments))) {
			return;
		}

		if (!(isset($ajaxArguments[2]) && $ajaxArguments[2] === 'tx-news_autocontent-record')) {
			return;
		}

		if (!(isset($ajaxArguments[3]) && intval($ajaxArguments[3]))) {
			return;
		}

		if (strpos($ajaxArguments[1], 'teaser_content_elements') !== FALSE) {
			$this->defVals['tt_content']['header'] = 'Teasertext';
			$this->defVals['tt_content']['bodytext'] = '<p>Kurzer Anreißertext für die News.</p>';
		} else if (strpos($ajaxArguments[1], 'content_elements') !== FALSE) {
			$this->defVals['tt_content']['header'] = 'Haupttext';
			$this->defVals['tt_content']['bodytext'] = '<p>Hauptinhalt der News mit ausführlichen Informationen.</p>';
		}
	}
}