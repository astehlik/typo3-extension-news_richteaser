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

use \TYPO3\CMS\Backend\Form\Element\InlineElement;

/**
 * Renders the required JavaScript to the Backend Forms that will automatically
 * create some content elements in new news records.
 */
class FormEngine {


	/**
	 * @param string $table
	 * @param array $row
	 * @param \TYPO3\CMS\Backend\Form\FormEngine $formEngine
	 */
	public function getMainFields_postProcess($table, $row, $formEngine) {

		if ($table !== 'tx_news_domain_model_news') {
			return;
		}

		if (!strstr($row['uid'], 'NEW')) {
			return;
		}

		$script = '';

		$objectIdContentElements = $formEngine->prependFormFieldNames . InlineElement::Structure_Separator . $row['pid'] . InlineElement::Structure_Separator . $table . InlineElement::Structure_Separator . $row['uid'] . InlineElement::Structure_Separator . 'content_elements' . InlineElement::Structure_Separator . 'tt_content';
		$script .= $this->generateAutoContentCreationScript($objectIdContentElements);

		$objectIdTeaserContentElements = $formEngine->prependFormFieldNames . InlineElement::Structure_Separator . $row['pid'] . InlineElement::Structure_Separator . $table . InlineElement::Structure_Separator . $row['uid'] . InlineElement::Structure_Separator . 'teaser_content_elements' . InlineElement::Structure_Separator . 'tt_content';
		$script .= $this->generateAutoContentCreationScript($objectIdTeaserContentElements);

		$formEngine->additionalJS_post[] = $script;
	}

	/**
	 * Generates the JavaScript code that will execute ajax requests to automatically
	 * create a given number of content elements for the object with the given ID
	 *
	 * @param string $objectId
	 * @param int $numberOfRecords
	 * @return string
	 */
	protected function generateAutoContentCreationScript($objectId, $numberOfRecords = 1) {

		$script = '
			(function() {
				var txNewsAutocontentContentRecordCount = 1;
				var txNewsAutocontentMaxContentRecords = ' . $numberOfRecords . ';
				var txNewsAutocontentCreateContentRecord = function() {

					console.log("adding content");

					if (txNewsAutocontentContentRecordCount > txNewsAutocontentMaxContentRecords) {
						return;
					}

					if (!inline.lockedAjaxMethod["createNewRecord"]) {
						console.log("starting ajax request for creation new content");
						var objectId = "' . $objectId . '";
						var context = inline.getContext(objectId);
						inline.makeAjaxCall("createNewRecord", [inline.getNumberOfRTE(), objectId, "tx-news_autocontent-record", txNewsAutocontentContentRecordCount], true, context);
						txNewsAutocontentContentRecordCount++;
					} else {
						console.log("creating records is locked");
					}

					txNewsAutocontentScheduleCreateContentRecord();

				};
				var txNewsAutocontentScheduleCreateContentRecord = function() {
					console.log("initializing timeout for record creation");
					window.setTimeout(txNewsAutocontentCreateContentRecord, 100);
				}

				txNewsAutocontentCreateContentRecord();
			})();
		';

		return $script;
	}
}