Import
======

Universal PHP import class. In development.

Usage
-----
This example shows how to work with driver for Bitrix CMS.

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include.php';

use Likers\Import;
use Likers\Import\Iterator;
use Likers\Import\Driver;
use Likers\Import\Mapper;

// Iteration over csv file
$iterator = new Iterator\CSVIterator( $_SERVER['DOCUMENT_ROOT'] . '/upload/test.csv', ',' );

// Mapper sets a relation between iterator and driver fields
$mapper = new Mapper\Mapper(
    array(
        0 => 'XML_ID',
        1 => array( 'CODE', 'NAME' ),
        2 => 'PROPERTY_COLOR',
        3 => 'PROPERTY_SIZE',
        4 => 'PROPERTY_QUANTITY',
        5 => 'PROPERTY_PRICE'
    ),
    array( 0 => 'XML_ID' ), // Unique field
    array( 4 => 'PROPERTY_QUANTITY', 5 => 'PROPERTY_PRICE', ) // Update fields
);

// Driver for import Bitrix iblock elements
$driver = new Driver\BitrixIblockImportDriver( $mapper, 15 );

// Lets party!
$importId = $_GET['importId'] ? $_GET['importId'] : microtime( true );

$multistepImport = new Import\MultistepImport( $iterator, $driver, $mapper, $importId );
$multistepImport->nextStep();
```
