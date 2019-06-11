<?php
/** @noinspection PhpMissingStrictTypesDeclarationInspection */
/** @noinspection PhpFullyQualifiedNameUsageInspection */

defined('TYPO3_MODE') or die();

if (TYPO3_MODE === 'BE') {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
        \Int\NewsRichteaser\Command\MigrateTeaserContentsCommand::class;
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry']['tx_newsrichteaser_inlinecontentautocreate'] = [
    'nodeName' => 'tx_newsrichteaser_inlinecontentautocreate',
    'class' => \Int\NewsRichteaser\InlineContentAutocreate\InlineControlContainer::class,
    'priority' => 50,
];

$tcaRecordConfig = &$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'];
$tcaRecordConfig[\Int\NewsRichteaser\InlineContentAutocreate\FormDataProvider::class] = [
    'depends' => [
        \TYPO3\CMS\Backend\Form\FormDataProvider\TcaInline::class,
    ],
];
unset($tcaRecordConfig);
