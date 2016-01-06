<?php
$listItemSelector = '.news-list-view .article:nth-child(5) ';
/** @noinspection PhpUndefinedVariableInspection */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that a new news record gets automatically created content elements');

$I->amOnPage('/typo3/');
$I->fillField('#t3-username', 'news-editor');
$I->fillField('#t3-password', 'news-editor');
$I->click('#t3-login-submit');

$I->waitForElement('#typo3-pagetree-tree ul li ul li div a span');
$I->click('#typo3-pagetree-tree ul li ul li div a span');

$I->switchToIFrame("content");

$I->waitForElement('#recordlist-tx_news_domain_model_news');
$I->click('#recordlist-tx_news_domain_model_news .icon-actions-add');
$I->waitForElement('#EditDocumentController');

$I->waitForElement('[data-title="Teaser content elements"] [name$="[header]"]');
$I->canSeeInField('[data-title="Teaser content elements"] [name$="[header]"]', 'Step 1: Enter teaser text');

$I->waitForElement('[data-title="Content elements"] [name$="[header]"]');
$I->canSeeInField('[data-title="Content elements"] [name$="[header]"]', 'Step 2: Enter main text');

