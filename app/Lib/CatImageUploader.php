<?php

namespace App\Lib;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;


class CatImageUploader
{
    protected $remoteImageUrl;

    public function __construct($remoteImageUrl = null)
    {
        $this->remoteImageUrl = $remoteImageUrl;

        if(!$this->remoteImageUrl)
            $this->loadRemoteImageUrl();
    }

    protected function loadRemoteImageUrl()
    {
        $client = new Client([
            'base_uri' => 'https://api.thecatapi.com',
            'timeout' => 120.0,
        ]);

        $response = $client->request('GET', 'v1/images/search');

        if($response->getStatusCode() == 200) {
            $contents = $response->getBody()->getContents();
            $data = json_decode($contents);
            $this->remoteImageUrl = $data[0]->url;
        }
    }

    public function uploadImageToStorageFolder($folder) {
        if(!$this->remoteImageUrl)
            return null;

        $file = file_get_contents($this->remoteImageUrl);

        if($file) {
            $filePath = $folder . '/' . $this->getFileName();
            if(Storage::disk('public')->put($filePath, $file))
                return $filePath;
        }

        return null;
    }

    public function getRemoteImageUrl() {
        return $this->remoteImageUrl;
    }

    public function getFileName() {
        return basename($this->remoteImageUrl);
    }
}
