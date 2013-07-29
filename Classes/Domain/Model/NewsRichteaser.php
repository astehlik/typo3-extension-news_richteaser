<?php
namespace Int\NewsRichteaser\Domain\Model;

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
 * News model for a news with teaser content elements
 */
class NewsRichteaser extends \Tx_News_Domain_Model_NewsDefault {

	/**
	 * @var \Tx_Extbase_Persistence_ObjectStorage<Tx_News_Domain_Model_TtContent>
	 * @lazy
	 */
	protected $teaserContentElements;

	/**
	 * A news item has a teaser if either the teaser field is not empty
	 * of if it has any content elements.
	 *
	 * @return bool
	 */
	public function getHasTeaser() {

		if ($this->getHasTeaserFromField()) {
			return TRUE;
		}

		$contentElements = $this->getContentElements();
		if (isset($contentElements) && $contentElements->count()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Returns true if the teaser field is not empty
	 */
	public function getHasTeaserFromField() {

		$teaser = $this->getTeaser();

		if (!empty($teaser)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * @return \Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getTeaserContentElements() {
		return $this->teaserContentElements;
	}

	/**
	 * Get id list of content elements
	 *
	 * @return string
	 */
	public function getTeaserContentElementIdList() {
		$idList = array();
		foreach ($this->getTeaserContentElements() as $contentElement) {
			$idList[] = $contentElement->getUid();
		}
		return implode(',', $idList);
	}

}
?>