<?php

namespace File;

use Entity\RestaurantInterface;

interface FileRowToRestaurantConverterInterface
{
    /**
     * @param array $row
     *
     * @return RestaurantInterface|null
     */
    public function convert(array $row);
}
