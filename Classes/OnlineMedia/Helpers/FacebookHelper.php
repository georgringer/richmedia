<?php

namespace GeorgRinger\Richmedia\OnlineMedia\Helpers;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\AbstractOEmbedHelper;
use TYPO3\CMS\Core\Utility\StringUtility;

class FacebookHelper extends AbstractOEmbedHelper
{
    protected function getOEmbedUrl($mediaId, $format = 'json')
    {
        return sprintf('https://www.facebook.com/plugins/post/oembed.json/?url=%s',
            urlencode($mediaId)
        );
    }

    public function transformUrlToFile($url, Folder $targetFolder)
    {
        if (StringUtility::beginsWith($url, 'https://www.facebook.com/')) {
            return $this->transformMediaIdToFile($url, $targetFolder, $this->extension);
        }
        return null;
    }

    public function getPublicUrl(File $file, $relativeToCurrentScript = false)
    {
        $id = $this->getOnlineMediaId($file);
        return $id;
    }

    public function getPreviewImage(File $file)
    {

        // todo return FB dummy img
        return null;
    }

    protected function transformMediaIdToFile($mediaId, Folder $targetFolder, $fileExtension)
    {
        $file = $this->findExistingFileByOnlineMediaId($mediaId, $targetFolder, $fileExtension);

        // no existing file create new
        if ($file === null) {
            $oEmbed = $this->getOEmbedData($mediaId);
            if (!empty($oEmbed)) {
                // todo short name but not md5 ;)
                $fileName = md5($oEmbed['author_name']) . '.' . $fileExtension;
            } else {
                $fileName = $mediaId . '.' . $fileExtension;
            }
            $file = $this->createNewFile($targetFolder, $fileName, $mediaId);
        }
        return $file;
    }
}
