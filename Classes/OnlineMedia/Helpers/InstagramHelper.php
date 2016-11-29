<?php

namespace GeorgRinger\Richmedia\OnlineMedia\Helpers;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\AbstractOEmbedHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class InstagramHelper extends AbstractOEmbedHelper
{
    protected function getOEmbedUrl($mediaId, $format = 'json')
    {
        return sprintf('https://api.instagram.com/oembed/?url=%s',
            urlencode(sprintf('http://instagram.com/p/%s/', $mediaId)),
            rawurlencode($format)
        );
    }

    public function transformUrlToFile($url, Folder $targetFolder)
    {
        $igRegExp = "/^(?:https?:\/\/)?(?:www\.)?instagram.com\/p\/(.[a-zA-Z0-9\_]*)/";
        preg_match($igRegExp, $url, $match);
        if ($match[1]) {
            $id = $match[1];
            return $this->transformMediaIdToFile($id, $targetFolder, $this->extension);
        }

        return null;
    }

    public function getPublicUrl(File $file, $relativeToCurrentScript = false)
    {
        $id = $this->getOnlineMediaId($file);
        return sprintf('http://instagram.com/p/%s/', $id);
    }

    public function getPreviewImage(File $file)
    {
        $videoId = $this->getOnlineMediaId($file);
        $temporaryFileName = $this->getTempFolderPath() . 'instagram_' . md5($videoId) . '.jpg';
        if (!file_exists($temporaryFileName)) {
            $information = json_decode(GeneralUtility::getUrl($this->getOEmbedUrl($videoId)), true);

            if (isset($information['thumbnail_url']) && !empty($information['thumbnail_url'])) {
                $previewImage = GeneralUtility::getUrl($information['thumbnail_url']);
                if ($previewImage !== false) {
                    file_put_contents($temporaryFileName, $previewImage);
                    GeneralUtility::fixPermissions($temporaryFileName);
                }
            }
        }

        return $temporaryFileName;
    }

    protected function transformMediaIdToFile($mediaId, Folder $targetFolder, $fileExtension)
    {
        $file = $this->findExistingFileByOnlineMediaId($mediaId, $targetFolder, $fileExtension);

        // no existing file create new
        if ($file === null) {
            $oEmbed = $this->getOEmbedData($mediaId);
            if (!empty($oEmbed)) {
                // todo short name but not md5 ;)
                $fileName = md5($oEmbed['title']) . '.' . $fileExtension;
            } else {
                $fileName = $mediaId . '.' . $fileExtension;
            }
            $file = $this->createNewFile($targetFolder, $fileName, $mediaId);
        }
        return $file;
    }
}
