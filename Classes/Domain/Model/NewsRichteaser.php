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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tx_News_Domain_Model_TtContent>
	 * @lazy
	 */
	protected $teaserContentElements;

	/**
	 * Adds a content element to the record
	 *
	 * @param \Tx_News_Domain_Model_TtContent $contentElement
	 * @return void
	 */
	public function addTeaserContentElement(\Tx_News_Domain_Model_TtContent $contentElement) {
		if ($this->getTeaserContentElements() === NULL) {
			$this->teaserContentElements = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		}
		$this->teaserContentElements->attach($contentElement);
	}

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

		$teaserContentElements = $this->getTeaserContentElements();
		if (isset($teaserContentElements) && $teaserContentElements->count()) {
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
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
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
		/** @var \Tx_News_Domain_Model_TtContent $contentElement */
		foreach ($this->getTeaserContentElements() as $contentElement) {
			$idList[] = $contentElement->getUid();
		}
		return implode(',', $idList);
	}
}