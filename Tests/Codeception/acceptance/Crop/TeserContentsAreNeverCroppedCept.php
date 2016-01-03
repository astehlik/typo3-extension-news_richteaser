<?php
$listItemSelector = '.news-list-view .article:nth-child(4) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that teaser contents are never cropped even if cropping is enabled');
$I->amOnPage('/?cropteaser=1');
$I->see('Content elements only', $listItemSelector . '[itemprop="headline"]');
$I->see('Teaser content element', $listItemSelector . '[itemprop="description"]');

