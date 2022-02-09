<?php

namespace hdvinnie\LaravelJoyPixels;

use JoyPixels\Client;
use JoyPixels\Ruleset;

class LaravelJoyPixels
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(new Ruleset());

        $this->client->emojiSize = \config('joypixels.emojiSize');
        $this->client->sprites = \config('joypixels.sprites');
        $this->client->spriteSize = \config('joypixels.spriteSize');
        $this->client->emojiVersion = \config('joypixels.emojiVersion');

        if (\config('joypixels.imagePathPNG')) {
            $this->client->imagePathPNG = \url(\config('joypixels.imagePathPNG')) . '/';
        }
        else {
            // Use the CDN if 'imagePathPNG' config is not set
            $this->client->imagePathPNG = 'https://cdn.jsdelivr.net/joypixels/assets' . '/' . $this->client->emojiVersion . '/png/unicode/' . $this->client->emojiSize . '/';
        }

        // config ascii option
        $this->client->ascii = \config('joypixels.ascii');

    }

    public function toImage($str)
    {
        return $this->client->toImage($str);
    }

    public function toShort($str)
    {
        return $this->client->toShort($str);
    }

    public function shortnameToImage($str)
    {
        return $this->client->shortnameToImage($str);
    }

    public function unicodeToImage($str)
    {
        return $this->client->unicodeToImage($str);
    }

    public function getClient()
    {
        return $this->client;
    }
}
