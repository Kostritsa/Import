<?php

namespace Likers\Import\Mapper;

class Mapper
{
    protected $_map;
    protected $_updateMap;
    protected $_uniqueCol;

    /**
     * @param array $map Keys in array represents iteraror's cols, values — driver fields. Values can be an array
     * @param array $uniqueCol Must have key and value from $map. Value can't be an array
     * @param array $updataMap Values from $map to be updated
     */
    function __construct( $map, $uniqueCol, $updateMap = array() )
    {
        $this->_map = $map;
        $this->_updateMap = $updateMap ? $updateMap : $map;
        $this->_uniqueCol = $uniqueCol;
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


    public function map4Add( $row )
    {
        return $this->_map( $row, $this->_map );
    }

    public function map4Update( $row )
    {
        return $this->_map( $row, $this->_map );
    }
}