<?php
namespace Int\NewsRichteaser\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Extension "news_richteaser".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for richteaser news
 */
class NewsRichteaserRepository extends Repository {

	const CTYPE_NEWS_TEASER = 'tx_news_teaser';

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $db;

	/**
	 * Constructs a new Repository
	 *
	 * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
	 */
	function __construct(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager) {
		parent::__construct($objectManager);
		$this->db = $GLOBALS['TYPO3_DB'];
	}

	/**
	 * Finds all news that have a content element with type tx_news_teaser.
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByTeaserContentElement() {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->equals('contentElements.CType', static::CTYPE_NEWS_TEASER));
		return $query->execute();
	}

	/**
	 * Returns all records in the tx_news_richteaser_domain_model_news_teaser_ttcontent_mm table
	 *
	 * @return array
	 */
	public function findInlineContentsMmTeaser() {

		$inlineContents = array();
		$result = $this->db->exec_SELECTquery('*', 'tx_news_richteaser_domain_model_news_teaser_ttcontent_mm', '');

		while ($inlineContentRow = $this->db->sql_fetch_assoc($result)) {
			$inlineContents[] = $inlineContentRow;
		}

		return $inlineContents;
	}

	/**
	 * Returns all records in the tx_news_domain_model_news_ttcontent_mm table
	 *
	 * @return array
	 */
	public function findInlineContentsMm() {

		$inlineContents = array();
		$result = $this->db->exec_SELECTquery('*', 'tx_news_domain_model_news_ttcontent_mm', '');

		while ($inlineContentRow = $this->db->sql_fetch_assoc($result)) {
			$inlineContents[] = $inlineContentRow;
		}

		return $inlineContents;
	}

	/**
	 * Updates the foreign table fields in tt_content records.
	 *
	 * @param string $relatedField The related field (content_elements or teaser_content_elements)
	 * @param int $newsUid UID of the news
	 * @param int $contentUid UID of the content
	 * @param int $sorting The sorting value
	 */
	public function updateInlineContentRelation($relatedField, $newsUid, $contentUid, $sorting) {

		$this->db->exec_UPDATEquery(
			'tt_content',
			'tt_content.uid=' . intval($contentUid),
			array(
				'tx_news_related_news' => $newsUid,
				'tx_news_related_field' => $relatedField,
				'sorting' => $sorting,
			)
		);
	}
}