<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$newsColumns = [
	'content_elements' => [
		'exclude' => 1,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:news/Resources/Private/Language/locallang_db.xml:tx_news_domain_model_news.content_elements',
		'config' => [
			'type' => 'inline',
			'allowed' => 'tt_content',
			'foreign_table' => 'tt_content',
			'foreign_sortby' => 'sorting',
			'foreign_field' => 'tx_news_related_news',
			'foreign_match_fields' => [
				'tx_news_related_field' => 'content_elements',
			],
			'minitems' => 0,
			'maxitems' => 99,
			'appearance' => [
				'collapseAll' => 1,
				'expandSingle' => 1,
				'newRecordLinkTitle' => 'LLL:EXT:news_richteaser/Resources/Private/Language/locallang_db.xml:add_additional_content_element_main',
				'levelLinksPosition' => 'bottom',
				'useSortable' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showRemovedLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1,
				'showSynchronizationLink' => 1,
				'enabledControls' => [
					'info' => false,
				]
			]
		]
	],
	'teaser_content_elements' => [
		'exclude' => 1,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:news_richteaser/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.teaser_content_elements',
		'config' => [
			'type' => 'inline',
			'allowed' => 'tt_content',
			'foreign_table' => 'tt_content',
			'foreign_sortby' => 'sorting',
			'foreign_field' => 'tx_news_related_news',
			'foreign_match_fields' => [
				'tx_news_related_field' => 'teaser_content_elements',
			],
			'minitems' => 0,
			'maxitems' => 99,
			'appearance' => [
				'collapseAll' => 1,
				'expandSingle' => 1,
				'newRecordLinkTitle' => 'LLL:EXT:news_richteaser/Resources/Private/Language/locallang_db.xml:add_additional_content_element_teaser',
				'levelLinksPosition' => 'bottom',
				'useSortable' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showRemovedLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1,
				'showSynchronizationLink' => 1,
				'enabledControls' => [
					'info' => false,
				]
			]
		]
	],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $newsColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', '--div--;LLL:EXT:news_richteaser/Resources/Private/Language/locallang_db.xlf:content_elements_tab_heading,teaser_content_elements', '0', 'before:content_elements');

unset($newsColumns);