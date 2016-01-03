<?php
$listItemSelector = '.news-list-view .article:nth-child(2) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that teaser text is cropped if cropping is enabled');
$I->amOnPage('/?cropteaser=1');
$I->see('Teaser and bodytext without contents', $listItemSelector . '[itemprop="headline"]');
$I->see('Tease...', $listItemSelector . '[itemprop="description"]');

