<?php
$listItemSelector = '.news-list-view .article:nth-child(2) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that teaser is used as teaser');
$I->amOnPage('/');
$I->see('Teaser and bodytext without contents', $listItemSelector . '[itemprop="headline"]');
$I->see('Teasertext', $listItemSelector . '[itemprop="description"]');

