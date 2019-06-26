<?php
declare(strict_types=1);

use Int\NewsRichteaser\Command\MigrateInlineContentsCommand;
use Int\NewsRichteaser\Command\MigrateTeaserContentsCommand;

return [
    'commands' => [
        'newsrt:migrateinline' => ['class' => MigrateInlineContentsCommand::class],
        'newsrt:migrateteaser' => ['class' => MigrateTeaserContentsCommand::class],
    ],
];
