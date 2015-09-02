<?php namespace Manulith\SketchfabPhp;

use Config;
use GuzzleHttp;
use GuzzleHttp\Post\PostFile;

class SketchfabPhp
{
    public static function upload($file, $params=array())
    {
        // Check the file is a Sketchfab-supported type
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (!in_array($ext, Config::get('sketchfab-php::supported_formats')) ) return;

        $client = new GuzzleHttp\Client();

        $data = array(
            'multipart' => [
                [
                    'name'     => 'private',
                    'contents' => 'true'
                ],
                [
                    'name'     => 'file',
                    'contents' => fopen($file, 'r'),
                    'filename' => $file->name
                ]
            ]
        );

        $response = $client->post('https://api.sketchfab.com/v2/models', $data);

        return $response->json();
    }

    public static function status($uid)
    {
        $client = new GuzzleHttp\Client();
        $url = sprintf('https://api.sketchfab.com/v2/models/%s/status', $uid);
        $response = $client->get($url);

        return $response->json();
    }

    public static function info($uid)
    {
        $client = new GuzzleHttp\Client();
        $url = sprintf('https://sketchfab.com/oembed?url=https://sketchfab.com/models/%s', $uid);
        $response = $client->get($url);

        return $response->json();
    }

    public static function embed($uid, $options=array())
    {
        $options = array_replace(Config::get('sketchfab-php::default_settings'), $options);
        $querystring = http_build_query($options);
        $url = sprintf('https://sketchfab.com/models/%s/embed?%s', $uid, $querystring);

        return sprintf(
            '<iframe width="%s" height="%s" src="%s" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" onmousewheel=""></iframe>',
            $options['width'],
            $options['height'],
            $url
        );
    }

}
