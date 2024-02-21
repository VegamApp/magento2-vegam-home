<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Asset\Repository;

class BannerTemplate implements OptionSourceInterface
{
    /**
     * @var Repository
     */
    private $assetRepo;
    /**
     * Template constructor.
     *
     * @param Repository $assetRepo
     */
    public function __construct(Repository $assetRepo)
    {
        $this->assetRepo = $assetRepo;
    }
    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => '',
                'label' => __('Select Template')
            ],
            [
                'value' => 'with_title',
                'label' => __('Banner With Title')
            ],
            [
                'value' => 'without_title',
                'label' => __(' Banner Without Title')
            ],
        ];
        return $options;
    }
}
