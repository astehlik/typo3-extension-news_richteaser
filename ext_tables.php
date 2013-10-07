<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'News rich teaser');

$columns = array(
	'content_elements' => array(
		'exclude' => 1,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:news/Resources/Private/Language/locallang_db.xml:tx_news_domain_model_news.content_elements',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tt_content',
			'foreign_sortby' => 'sorting',
			'foreign_field' => 'tx_news_related_news',
			'foreign_match_fields' => array(
				'tx_news_related_field' => 'content_elements',
			),
			'appearance' => array(
				'collapseAll' => 1,
				'expandSingle' => 1,
				'levelLinksPosition' => 'bottom',
				'useSortable' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showRemovedLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1,
				'showSynchronizationLink' => 1,
				'enabledControls' => array(
					'info' => FALSE,
				)
			)
		)
	),
	'teaser_content_elements' => array(
		'exclude' => 1,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:news_richteaser/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.teaser_content_elements',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tt_content',
			'foreign_sortby' => 'sorting',
			'foreign_field' => 'tx_news_related_news',
			'foreign_match_fields' => array(
				'tx_news_related_field' => 'teaser_content_elements',
			),
			'appearance' => array(
				'collapseAll' => 1,
				'expandSingle' => 1,
				'levelLinksPosition' => 'bottom',
				'useSortable' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showRemovedLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1,
				'showSynchronizationLink' => 1,
				'enabledControls' => array(
					'info' => FALSE,
				)
			)
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', '--div--;LLL:EXT:news_richteaser/Resources/Private/Language/locallang_db.xlf:content_elements_tab_heading,teaser_content_elements', '0', 'before:content_elements');