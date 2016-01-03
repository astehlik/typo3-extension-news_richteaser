<?php
$listItemSelector = '.news-list-view .article:nth-child(5) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that bodytext is never cropped even if cropping is enabled');
$I->amOnPage('/?cropbody=1');
$I->see('Body content elements only', $listItemSelector . '[itemprop="headline"]');
$I->see('Body content element', $listItemSelector . '[itemprop="description"]');

