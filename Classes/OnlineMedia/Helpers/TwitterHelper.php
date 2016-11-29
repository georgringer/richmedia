<?php

namespace GeorgRinger\Richmedia\OnlineMedia\Helpers;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\AbstractOEmbedHelper;

class TwitterHelper extends AbstractOEmbedHelper
{
    protected function getOEmbedUrl($mediaId, $format = 'json')
    {
        return sprintf('https://api.twitter.com/1.1/statuses/oembed.json?id=%s', $mediaId);
    }

    public function transformUrlToFile($url, Folder $targetFolder)
    {
        $regex = '/https?:\/\/twitter.com\/[a-zA-Z_]{1,20}\/status\/([0-9]*)/';
        preg_match($regex, $url, $match);
        $id = $match[1];
        if ($id) {
            return $this->transformMediaIdToFile($id, $targetFolder, $this->extension);
        }
        return null;
    }

    public function getPublicUrl(File $file, $relativeToCurrentScript = false)
    {
        $id = $this->getOnlineMediaId($file);
        return sprintf('https://twitter.com/statuses/%s', $id);
    }

    public function getPreviewImage(File $file)
    {
        return '';
    }
}
