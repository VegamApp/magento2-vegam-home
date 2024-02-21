<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Ui\Component\Listing\Columns;

use Magento\Ui\Component\Listing\Columns\Column;

class Status extends Column
{
    /**
     * Prepare Data Source
     *
     * @param  array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                if ($items['status'] == 0) {
                    $items['status'] = "Disabled";
                } else {
                    $items['status'] = "Enabled";
                }
                if ($items['mobile_status'] == 0) {
                    $items['mobile_status'] = "Disabled";
                } else {
                    $items['mobile_status'] = "Enabled";
                }
                if ($items['block_status'] == 0) {
                    $items['block_status'] = "Disabled";
                } else {
                    $items['block_status'] = "Enabled";
                }
            }
        }
        return $dataSource;
    }
}
