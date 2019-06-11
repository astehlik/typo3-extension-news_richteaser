<?php
/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
/** @noinspection PhpFullyQualifiedNameUsageInspection */

declare(strict_types=1);

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
use GeorgRinger\News\Domain\Model\TtContent;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * News model for a news with teaser content elements
 */
class NewsRichteaser extends NewsDefault
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\News\Domain\Model\TtContent>
     * @lazy
     */
    protected $teaserContentElements;

    public function addTeaserContentElement(TtContent $contentElement)
    {
        $this->getTeaserContentElements()->attach($contentElement);
    }

    /**
     * A news item has a teaser if either the teaser field is not empty
     * of if it has any content elements.
     *
     * @return bool
     */
    public function getHasTeaser(): bool
    {
        if ($this->getHasTeaserFromField()) {
            return true;
        }

        $teaserContentElements = $this->getTeaserContentElements();
        if (isset($teaserContentElements) && $teaserContentElements->count()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns true if the teaser field is not empty
     */
    public function getHasTeaserFromField(): bool
    {
        $teaser = $this->getTeaser();

        if (!empty($teaser)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return TtContent[]|ObjectStorage
     */
    public function getTeaserContentElements(): ObjectStorage
    {
        if (!isset($this->teaserContentElements)) {
            $this->teaserContentElements = new ObjectStorage();
        }
        return $this->teaserContentElements;
    }

    /**
     * Returns the UID of the news item or the localized UID if it is set.
     *
     * @return int
     */
    public function getUidLocalized(): int
    {
        $localizedUid = $this->_getProperty('_localizedUid');
        if ($localizedUid !== null) {
            return (int)$localizedUid;
        } else {
            return (int)$this->getUid();
        }
    }
}
