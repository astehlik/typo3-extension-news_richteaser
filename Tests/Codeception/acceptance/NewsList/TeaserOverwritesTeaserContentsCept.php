<?php
$listItemSelector = '.news-list-view .article:nth-child(3) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that teaser is used as teaser even if teaser contents are present');
$I->amOnPage('/');
$I->see('Teaser, bodytext, teaser and normal contents', $listItemSelector . '[itemprop="headline"]');
$I->see('Teasertext', $listItemSelector . '[itemprop="description"]');

