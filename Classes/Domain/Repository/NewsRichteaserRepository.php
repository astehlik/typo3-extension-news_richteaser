<?php
declare(strict_types=1);

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

use Doctrine\DBAL\FetchMode;
use PDO;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for richteaser news
 */
class NewsRichteaserRepository extends Repository
{
    const CTYPE_NEWS_TEASER = 'tx_news_teaser';

    /**
     * Finds all news that have a content element with type tx_news_teaser.
     *
     * @return array|QueryResultInterface
     */
    public function findByTeaserContentElement()
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->equals('contentElements.CType', static::CTYPE_NEWS_TEASER));
        return $query->execute();
    }

    /**
     * Returns all records in the tx_news_domain_model_news_ttcontent_mm table
     *
     * @return array
     */
    public function findInlineContentsMm()
    {
        $table = 'tx_news_domain_model_news_ttcontent_mm';
        return $this->fetchAllAssociativeFromTable($table);
    }

    /**
     * Returns all records in the tx_news_richteaser_domain_model_news_teaser_ttcontent_mm table
     *
     * @return array
     */
    public function findInlineContentsMmTeaser()
    {
        $table = 'tx_news_richteaser_domain_model_news_teaser_ttcontent_mm';
        return $this->fetchAllAssociativeFromTable($table);
    }

    /**
     * Updates the foreign table fields in tt_content records.
     *
     * @param string $relatedField The related field (content_elements or teaser_content_elements)
     * @param int $newsUid UID of the news
     * @param int $contentUid UID of the content
     * @param int $sorting The sorting value
     */
    public function updateInlineContentRelation($relatedField, $newsUid, $contentUid, $sorting)
    {
        $builder = $this->getQueryBuilderForTable('tt_content');
        $builder->update('tt_content');
        $builder->where(
            $builder->expr()->eq(
                'uid',
                $builder->createNamedParameter((int)$contentUid, PDO::PARAM_INT)
            )
        );
        $builder->set('tx_news_related_news', $newsUid);
        $builder->set('tx_news_related_field', $relatedField);
        $builder->set('sorting', $sorting);
        $builder->execute();
    }

    /**
     * @param string $table
     * @return array
     */
    private function fetchAllAssociativeFromTable(string $table): array
    {
        $queryBuilder = $this->getQueryBuilderForTable($table);
        $queryBuilder->from($table);
        $result = $queryBuilder->execute();
        return $result->fetchAll(FetchMode::ASSOCIATIVE);
    }

    private function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }

    private function getQueryBuilderForTable(string $table): QueryBuilder
    {
        return $this->getConnectionPool()->getQueryBuilderForTable($table);
    }
}
