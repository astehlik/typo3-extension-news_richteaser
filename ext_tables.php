<?php
/** @noinspection PhpMissingStrictTypesDeclarationInspection */
/** @noinspection PhpFullyQualifiedNameUsageInspection */

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript',
    'News rich teaser'
);
