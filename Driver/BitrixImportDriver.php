<?php

namespace Likers\Import\Driver;

/**
 * Requires Bitrix core to be included
 */
class BitrixImportDriver implements ImportDriverInterface
{
    function __construct()
    {
        \CModule::IncludeModule( 'iblock' );
    }

    public function create()
    {
        $obRes = \CIBlock::getList();
        while( $arIblock = $obRes->fetch() ){
            var_dump( $arIblock );
        }
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function cleanUp()
    {
    }
}