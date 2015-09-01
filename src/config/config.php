<?php

return array(

    // Get your API key here:
    // https://sketchfab.com/settings/password
    'api_key' => env('YOUR_API_KEY', ''),

    // Default settings for embeds
    'default_settings' => [
        'width'       => 640,
        'height'      => 480,
        'ui_infos'    => 0,
        'ui_controls' => 1,
        'ui_stop'     => 0,
        'autostart'   => 0,
    ],

    // File formats supported by Sketchfab
    // https://sketchfab.com/faq/upload#which-formats-are-supported
    'supported_formats' => [
        '3dc',
        '3ds',
        'ac',
        'blend',
        'bvh',
        'dae',
        'dw',
        'dwf',
        'fbx',
        'flt',
        'geo',
        'gta',
        'iv',
        'ive',
        'kmz',
        'lwo',
        'lws',
        'obj',
        'osg',
        'osgb',
        'osgt',
        'ply',
        'shp',
        'stl',
        'vpk',
        'wrl',
        'x',
    ],

);
