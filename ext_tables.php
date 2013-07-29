<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'News rich teaser');

$columns = array(
	'teaser_content_elements' => array(
		'exclude' => 1,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:news_richteaser/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.teaser_content_elements',
		'config' => array(
			'type' => 'inline',
			'allowed' => 'tt_content',
			'foreign_table' => 'tt_content',
			'MM' => 'tx_news_richteaser_domain_model_news_teaser_ttcontent_mm',
			'minitems' => 0,
			'maxitems' => 99,
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

?>