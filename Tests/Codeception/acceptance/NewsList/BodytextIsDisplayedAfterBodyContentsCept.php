<?php
$listItemSelector = '.news-list-view .article:nth-child(6) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that bodytext is displayed after the body content elements');
$I->amOnPage('/');
$I->see('Bodytext and body content element', $listItemSelector . '[itemprop="headline"]');
$teaserText = $I->grabTextFrom($listItemSelector . '[itemprop="description"]');
$I->seeMatches('/Body content element\s+Bodytext/', $teaserText);

