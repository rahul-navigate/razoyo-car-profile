<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

/**
 * Class Data
 * @package Razoyo\CarProfile\Helper
 */
class Data extends AbstractHelper
{
    /**
     * API URL
     */
    public const API_URL = 'https://exam.razoyo.com/api/cars';

    /**
     * Data constructor
     * 
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Get car data
     * 
     * @return string
     */
    public function getCarData()
    {
        $url = self::API_URL;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}