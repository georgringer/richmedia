<?php

$rendererRegistry = \TYPO3\CMS\Core\Resource\Rendering\RendererRegistry::getInstance();
$rendererRegistry->registerRendererClass(\GeorgRinger\Richmedia\Rendering\InstagramRenderer::class);
$rendererRegistry->registerRendererClass(\GeorgRinger\Richmedia\Rendering\TwitterRenderer::class);
$rendererRegistry->registerRendererClass(\GeorgRinger\Richmedia\Rendering\FacebookRenderer::class);
$rendererRegistry->registerRendererClass(\GeorgRinger\Richmedia\Rendering\FlickrRenderer::class);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['instagram'] = \GeorgRinger\Richmedia\OnlineMedia\Helpers\InstagramHelper::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['twitter'] = \GeorgRinger\Richmedia\OnlineMedia\Helpers\TwitterHelper::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['facebook'] = \GeorgRinger\Richmedia\OnlineMedia\Helpers\FacebookHelper::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['flickr'] = \GeorgRinger\Richmedia\OnlineMedia\Helpers\FlickrHelper::class;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['instagram'] = 'image/instagram';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['twitter'] = 'image/twitter';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['facebook'] = 'image/facebook';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['flickr'] = 'image/flickr';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',instagram,twitter,facebook,flickr';
