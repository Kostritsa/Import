<?php

namespace Likers\Import;

abstract class Import
{
    protected $_iterator;
    protected $_driver;
    protected $_importId;

    /**
     * @param Iterator\ExtendedIteratorInterface  $iterator
     * @param Driver\ImportDriverInterface $driver
     * @param string  $importId
     */
    function __construct(
        Iterator\ExtendedIteratorInterface $iterator,
        Driver\ImportDriverInterface $driver,
        $importId
    )
    {
        $this->_importId = $importId ? $importId : (string) microtime( true );
        $this->_iterator = $iterator;
        $this->_driver = $driver;
    }
}