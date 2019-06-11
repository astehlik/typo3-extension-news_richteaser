<?php
declare(strict_types=1);

namespace Int\NewsRichteaser\Tests\Unit\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Extension "news_richteaser".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Int\NewsRichteaser\Domain\Model\NewsRichteaser;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Unit tests for the NewsRichteaser domain model.
 */
class NewsRichteaserTest extends UnitTestCase
{
    /**
     * @var NewsRichteaser
     */
    protected $subject;

    /**
     * Initializes the test subject.
     */
    public function setUp()
    {
        $this->subject = new NewsRichteaser();
    }

    /**
     * @test
     */
    public function getHasTeaserReturnsTrueIfTeaserExists()
    {
        $this->subject->setTeaser('Testteaser');
        $this->assertTrue($this->subject->getHasTeaser());
    }
}
