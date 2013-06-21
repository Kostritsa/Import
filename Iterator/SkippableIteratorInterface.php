<?php

namespace Likers\Import\Iterator;

interface SkippableIteratorInterface extends \Iterator
{
    /**
     * @param int $skipTo
     * @return bool
     */
    public function skipTo( $skipTo );
}