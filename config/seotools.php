<?php
/**
 * @see https://github.com/artesaos/seotools
 */
$title = 'Geohomes Services Limited.';
$description = '';

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => $title,
            'titleBefore'  => false,
            'description'  => $description,
            'separator'    => ' | ',
            'keywords'     => [],
            'canonical'    => '',
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => $title,
            'description' => $description,
            'url'         => '',
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'        => 'summary',
            'site'        => '@geohomes',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => $title,
            'description' => $description,
            'url'         => '',
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
