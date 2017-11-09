<?php
declare(strict_types=1);

namespace Ttree\Eel\Media;

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Media\Domain\Model\Image;
use Neos\Media\Domain\Model\ThumbnailConfiguration;
use Neos\Media\Domain\Service\AssetService;

class MediaHelper implements ProtectedContextAwareInterface
{
    /**
     * @var AssetService
     * @Flow\Inject
     */
    protected $assetService;

    public function imageUri(Image $asset, $width = null, $maximumWidth = null, $height = null, $maximumHeight = null, $allowCropping = false, $allowUpScaling = false) :string
    {
        $thumbnailConfiguration = new ThumbnailConfiguration($width, $maximumWidth, $height, $maximumHeight, $allowCropping, $allowUpScaling);
        $thumbnailData = $this->assetService->getThumbnailUriAndSizeForAsset($asset, $thumbnailConfiguration);
        if ($thumbnailData === null) {
            return '';
        }
        return $thumbnailData['src'];
    }

    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
