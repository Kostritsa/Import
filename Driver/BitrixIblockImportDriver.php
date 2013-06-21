<?php

namespace Likers\Import\Driver;
use \Likers\Import\Mapper;

/**
 * Requires Bitrix core to be included
 */
class BitrixIblockImportDriver extends ImportDriverAbstract
{
    protected $_iblockId;
    protected $_existingEls;
    protected $_element;

    /**
     * @param Mapper $mapper
     * @param int $iblockId
     */
    function __construct( Mapper\Mapper $mapper, $iblockId )
    {
        \CModule::IncludeModule( 'iblock' );
        $this->_existingEls = array();
        $this->_element = new \CIBlockElement;
        parent::__construct( $mapper );
    }

    /**
     * Get existing elements to make decisions for elements
     * @return bool
     *
     */
    public function prepare()
    {
        $uniqueField = $this->_mapper->getUnique();

        $result = \CIBlockElement::GetList(
            array(),
            array( 'IBLOCK_ID' => $this->_iblockId ),
            false, false,
            array( 'ID', 'XML_ID', 'ACTIVE' ) //TODO: сформировать $arSelect из обновляемых полей и уникального
        );

        while( $element = $result->fetch() ){
            $this->_existingEls[ $element[ $uniqueField ] ] = $element;
        }

        return true;
    }

    /**
     * @param array $row Row from iterator's current()
     * @return string Method name
     */
    public function decide( $row )
    {
        $uniqueCol = $this->_mapper->_uniqueIterCol;

        if( is_array( $this->_existingEls[ $row[ $uniqueCol ] ] ) ){
            $this->_update( $row[ $uniqueCol ], $row );
            return '_update';
        }
        else{
            $this->_create( $row );
            return '_create';
        }
    }

    public function cleanUp()
    {
    }

    protected function _create( $row )
    {
        return $this->_element->Add(
            $this->_mapper->map4Add( $row )
        );
    }

    protected function _update( $uniqueValue, $row )
    {
        $id = $this->_existingEls[ $uniqueValue ]['ID'];
        return $this->_element->Update(
            $id,
            $this->_mapper->map4Update( $row )
        );
    }

    protected function _delete( $uniqueValue )
    {
        $id = $this->_existingEls[ $uniqueValue ]['ID'];
        return $this->_element->Delete( $id );
    }
}