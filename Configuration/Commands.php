<?php
declare(strict_types=1);

use Int\NewsRichteaser\Command\MigrateInlineContentsCommand;
use Int\NewsRichteaser\Command\MigrateTeaserContentsCommand;

return [
    'newsrt:migrateinline' => [
        'class' => MigrateInlineContentsCommand::class,
        'schedulable' => false,
    ],
    'newsrt:migrateteaser' => [
        'class' => MigrateTeaserContentsCommand::class,
        'schedulable' => false,
    ],
];
