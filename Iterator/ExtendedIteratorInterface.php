<?php

namespace Likers\Import\Iterator;

interface ExtendedIteratorInterface extends \Iterator
{
    /**
     * @param  int $skipTo
     * @return bool
     */
    public function skipTo( $skipTo );
}