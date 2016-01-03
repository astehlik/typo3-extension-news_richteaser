<?php
$listItemSelector = '.news-list-view .article:nth-child(5) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that body content elements are used as teaser if no teaser is present');
$I->amOnPage('/');
$I->see('Body content elements only', $listItemSelector . '[itemprop="headline"]');
$I->see('Body content element', $listItemSelector . '[itemprop="description"]');

