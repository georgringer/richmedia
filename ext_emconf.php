<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Richmedia',
    'description' => 'Embed rich media item like instagram posts, facebook posts, twitter posting and flickr images by using oembed.',
    'category' => 'frontend',
    'author' => 'Georg Ringer',
    'author_email' => 'mail@ringer.it',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '2.0.0',
    'constraints' =>
        [
            'depends' => [
                'typo3' => '8.7.0-9.3.99'
            ],
            'conflicts' => [],
            'suggests' => [],
        ]
];
