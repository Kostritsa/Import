<?php

namespace Likers\Import\Iterator;
use Likers\Import\Exception as Exception;

class CSVIterator implements ExtendedIteratorInterface
{
    const ROW_SIZE = 4096;

    private $_filePointer;
    private $_currentElement;
    private $_rowCounter;
    private $_delimiter;
    private $_locale;
    private $_defaultLocale;

    public function __construct( $file, $delimiter = ',', $locale = 'en_US.utf8' )
    {
        $this->_filePointer = fopen( $file, 'r' );
        $this->_delimiter = $delimiter;
        $this->_locale = $locale;
        $this->_defaultLocale = setlocale( LC_ALL, 0 );
        $this->_setUp();
    }

    private function _setUp()
    {
        setlocale( LC_ALL, $this->_locale );
    }

    private function _tearDown()
    {
        setlocale( LC_ALL, $this->_defaultLocale );
    }

    public function rewind()
    {
        $this->_rowCounter = 0;
        rewind( $this->_filePointer );
    }

    public function current()
    {
        $this->_currentElement = fgetcsv( $this->_filePointer, self::ROW_SIZE, $this->_delimiter );
        $this->_rowCounter++;
        return $this->_currentElement;
    }

    public function key()
    {
        return $this->_rowCounter;
    }

    public function next()
    {
        return !feof( $this->_filePointer );
    }

    public function valid()
    {
        if( !$this->next() ){
            fclose( $this->_filePointer );
            return false;
        }
        return true;
    }

    public function skipTo( $skipTo )
    {
        $this->rewind();
        while( $this->_rowCounter < $skipTo ){
            if( !$this->next() ){
                return false;
            }
        }
        return true;
    }
}
