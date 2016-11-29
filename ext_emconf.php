<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Richmedia',
    'description' => 'Richmedia support',
    'category' => 'frontend',
    'author' => 'Georg Ringer',
    'author_email' => 'mail@ringer.it',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' =>
        [
            'depends' => [
                'typo3' => '7.6.0-8.9.99'
            ],
            'conflicts' => [],
            'suggests' => [],
        ]
];
