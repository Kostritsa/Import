<?php

namespace Likers\Import;
use Likers\Import\Iterator;
use Likers\Import\Driver;
use Likers\Import\Mapper;

abstract class Import
{
    protected $_iterator;
    protected $_driver;
    protected $_mapper;
    protected $_importId;

    /**
     * @param Iterator\SkippableIteratorInterface  $iterator
     * @param Driver\ImportDriverInterface $driver
     * @param Mapper\Mapper $mapper array( $iteratorKey => $driverKey, ... )
     * @param string  $importId
     */
    function __construct(
        Iterator\SkippableIteratorInterface $iterator,
        Driver\ImportDriverAbstract $driver,
        Mapper\Mapper $mapper,
        $importId
    )
    {
        $this->_importId = $importId ? $importId : (string) microtime( true );
        $this->_iterator = $iterator;
        $this->_driver = $driver;
        $this->_mapper = $mapper;
    }

    public function getId()
    {
        return $this->_importId;
    }
}