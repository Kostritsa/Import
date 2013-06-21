<?php

namespace Likers\Import\Driver;
use Likers\Import\Mapper;

abstract class ImportDriverAbstract
{
    protected $_mapper;

    function __construct( Mapper\Mapper $mapper )
    {
        $this->_mapper = $mapper;
    }

    /**
     * @return boolead Success or not
     */
    public function prepare()
    {}

    /**
     * @param array $row From iterator's current()
     * @return string Method name
     */
    public function decide( $row )
    {}

    /**
     * @return boolean Success or not
     */
    public function cleanUp()
    {}
}