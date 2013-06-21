<?php

namespace Likers\Import\Mapper;

class Mapper
{
    protected $_map;
    protected $_updateMap;
    protected $_uniqueItrCol;
    protected $_uniqueDrvField;

    /**
     * @param array $map Keys in array represents iteraror's cols, values — driver fields. Values can be an array
     * @param int $uniqueItrCol unique col from iterator
     * @param text $uniqueDrvField [description] unique field from driver
     * @param array $updataMap Values from $map to be updated
     */
    function __construct( $map, $uniqueItrCol, $uniqueDrvField, $updateMap = array() )
    {
        $this->_map = $map;
        $this->_updateMap = $updateMap ? $updateMap : $map;
        $this->_uniqueItrCol = $uniqueItrCol;
        $this->_uniqueDrvField = $uniqueDrvField;
    }

    /**
     * @param array $row
     * @param array $map
     * @return array
     */
    protected function _map( $row, $map )
    {
        $ret = array();
        foreach( $row as $key => $value )
        {
            $ret[ $map[ $key ] ] = $value;
        }
        return $ret;
    }

    public function getUnique()
    {
        return $this->_uniqueDrvField;
    }

    public function map4Add( $row )
    {
        return $this->_map( $row, $this->_map );
    }

    public function map4Update( $row )
    {
        return $this->_map( $row, $this->_map );
    }
}