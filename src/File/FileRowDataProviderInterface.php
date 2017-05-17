<?php

namespace File;

interface FileRowDataProviderInterface
{
    /**
     * @return \Iterator
     */
    public function get();
}
