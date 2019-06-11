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

use Int\NewsRichteaser\Domain\Repository\NewsRichteaserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Controller for richteaser news related commands.
 */
class MigrateInlineContentsCommand extends Command
{
    /**
     * @var NewsRichteaserRepository
     */
    private $newsRepository;

    public function injectNewsRepository(NewsRichteaserRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $this->initDependencies();

        $inlineTeaserContents = $this->newsRepository->findInlineContentsMmTeaser();
        $counter = 0;
        foreach ($inlineTeaserContents as $inlineTeaserContentMm) {
            $this->newsRepository->updateInlineContentRelation(
                'teaser_content_elements',
                $inlineTeaserContentMm['uid_local'],
                $inlineTeaserContentMm['uid_foreign'],
                $inlineTeaserContentMm['sorting']
            );
            $counter++;
        }
        $output->writeln(vsprintf('Updated %d teaser content elements.', [$counter]));

        $counter = 0;
        $inlineContents = $this->newsRepository->findInlineContentsMm();
        foreach ($inlineContents as $inlineContentMm) {
            $this->newsRepository->updateInlineContentRelation(
                'content_elements',
                $inlineContentMm['uid_local'],
                $inlineContentMm['uid_foreign'],
                $inlineContentMm['sorting']
            );
            $counter++;
        }
        $output->writeln(vsprintf('Updated %d content elements.', [$counter]));
    }

    protected function configure()
    {
        $this->setName('Update inline content elemens');
        $this->setDescription('Converts the inline news content elements from a m:m to a 1:n relation');
    }

    private function initDependencies()
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);

        $newsRepository = $objectManager->get(NewsRichteaserRepository::class);
        $this->injectNewsRepository($newsRepository);
    }
}
