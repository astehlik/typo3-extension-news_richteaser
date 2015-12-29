<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'News rich teaser',
    'description' => 'Allows TYPO3 content elments in news teasers.',
    'category' => 'fe',
    'state' => 'beta',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'author' => 'Alexander Stehlik',
    'author_email' => 'astehlik@intera.de',
    'author_company' => '',
    'version' => '4.0.0-dev',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-7.99.99',
            'news' => '4.0.0-4.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];