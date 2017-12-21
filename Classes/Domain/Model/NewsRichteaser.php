<?php
namespace Int\NewsRichteaser\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Extension "news_richteaser".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use GeorgRinger\News\Domain\Model\NewsDefault;

/**
 * News model for a news with teaser content elements
 */
class NewsRichteaser extends NewsDefault {

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\News\Domain\Model\TtContent>
	 * @lazy
	 */
	protected $teaserContentElements;

	/**
	 * Adds a content element to the record
	 *
	 * @param \GeorgRinger\News\Domain\Model\TtContent $contentElement
	 * @return void
	 */
	public function addTeaserContentElement(\GeorgRinger\News\Domain\Model\TtContent $contentElement) {
		$this->getTeaserContentElements()->attach($contentElement);
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
		if (!isset($this->teaserContentElements)) {
			$this->teaserContentElements = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		}
		return $this->teaserContentElements;
	}

	/**
	 * Returns the UID of the news item or the localized UID if it is set.
	 *
	 * @return int
	 */
	public function getUidLocalized() {
		$localizedUid = $this->_getProperty('_localizedUid');
		if ($localizedUid !== NULL) {
			return $localizedUid;
		} else {
			return $this->getUid();
		}
	}
}
