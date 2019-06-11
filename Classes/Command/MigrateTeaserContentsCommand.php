<?php
declare(strict_types=1);

namespace Int\NewsRichteaser\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Extension "news_richteaser".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use GeorgRinger\News\Domain\Model\TtContent;
use GeorgRinger\News\Domain\Repository\TtContentRepository;
use Int\NewsRichteaser\Domain\Model\NewsRichteaser;
use Int\NewsRichteaser\Domain\Repository\NewsRichteaserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Controller for richteaser news related commands.
 */
class MigrateTeaserContentsCommand extends Command
{
    /**
     * @var TtContentRepository
     */
    protected $contentRepository;

    /**
     * @var NewsRichteaserRepository
     */
    protected $newsRepository;

    public function injectContentRepository(TtContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function injectNewsRepository(NewsRichteaserRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run(InputInterface $input, OutputInterface $output)
    {

        /** @var NewsRichteaser $news */
        $newsWithTeaserContent = $this->newsRepository->findByTeaserContentElement();
        foreach ($newsWithTeaserContent as $news) {

            /** @var TtContent $content */
            $contentUpdateCount = 0;
            $allContent = $news->getContentElements()->toArray();
            foreach ($allContent as $content) {
                if ($content->getCType() === NewsRichteaserRepository::CTYPE_NEWS_TEASER) {
                    $this->contentRepository->remove($content);
                    break;
                }
                $news->getTeaserContentElements()->attach($content);
                $contentUpdateCount++;
            }

            $this->newsRepository->update($news);
            $output->writeln(
                vsprintf('Migrated %d content elements in news %s', [$contentUpdateCount, $news->getTitle()])
            );
        }
    }

    protected function configure()
    {
        $this->setDescription('Migrates all news that use the old tx_news_teaser content element.');
    }
}
