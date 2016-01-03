<?php
$listItemSelector = '.news-list-view .article:nth-child(4) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that teaser content elements are used as teaser');
$I->amOnPage('/');
$I->see('Content elements only', $listItemSelector . '[itemprop="headline"]');
$I->see('Teaser content element', $listItemSelector . '[itemprop="description"]');
