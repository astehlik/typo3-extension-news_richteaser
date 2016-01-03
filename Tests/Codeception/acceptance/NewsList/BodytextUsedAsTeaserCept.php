<?php
$listItemSelector = '.news-list-view .article:nth-child(1) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that bodytext is used as teaser if no teaser is present');
$I->amOnPage('/');
$I->see('Bodytext only', $listItemSelector . '[itemprop="headline"]');
$I->see('Bodytext', $listItemSelector . '[itemprop="description"]');

