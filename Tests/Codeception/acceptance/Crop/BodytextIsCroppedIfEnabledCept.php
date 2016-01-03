<?php
$listItemSelector = '.news-list-view .article:nth-child(1) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that bodytext is cropped if cropping is enabled');
$I->amOnPage('/?cropbody=1');
$I->see('Bodytext only', $listItemSelector . '[itemprop="headline"]');
$I->see('Bodyt...', $listItemSelector . '[itemprop="description"]');

