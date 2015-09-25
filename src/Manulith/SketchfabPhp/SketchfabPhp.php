<?php

namespace Manulith\SketchfabPhp;

use GuzzleHttp;
use GuzzleHttp\Post\PostFile;

class SketchfabPhp
{
    public static function upload($filepath, $params=array())
    {
        // Check the file is a Sketchfab-supported type
        $ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
        if (!in_array($ext, config('sketchfab.supported_formats')) ) return;

        $filename = pathinfo($filepath, PATHINFO_FILENAME);
        
        $params = array(
            "name" => $filename,
            "modelFile" => new \CurlFile($filepath),
            "token" => config('services.sketchfab.api_key'),
            "private" => 1
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, "https://api.sketchfab.com/v2/models");
        $result = curl_exec($ch);

        if($result === false)
            dd(curl_error($ch));
        else
            return $result;
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
        $options = array_replace(config('sketchfab.default_settings'), $options);
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
