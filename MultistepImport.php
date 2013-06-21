<?php

namespace Likers\Import;
use Likers\Import\Iterator;
use Likers\Import\Driver;
use Likers\Import\Mapper;

class MultistepImport extends Import
{
    protected $_stepSize;

    /**
     * @param SkippableIteratorInterface $iterator
     * @param ImportDriverInterface $driver
     * @param Mapper $mapper array( $iteratorKey => $driverKey, ... )
     * @param string $importId
     * @param int $stepSize
     */
    function __construct(
        Iterator\SkippableIteratorInterface $iterator,
        Driver\ImportDriverAbstract $driver,
        Mapper\Mapper $mapper,
        $importId,
        $stepSize = 1000
    )
    {
        $this->_stepSize = $stepSize;
        parent::__construct( $iterator, $driver, $mapper, $importId );
    }

    /**
     * @param int $skip How much rows to skip
     * @return int Successful imported lines
     */
    public function nextStep( $skip = 0 )
    {
        $this->_iterator->skipTo( $skip );
        $this->_driver->prepare( $this->_mapper );

        print 'hello';

        $linesDone = 0;
        while( $linesDone < $this->_stepSize && $this->_iterator->next() ){
            print $this->_driver->decide(
                $this->_iterator->current(),
                $this->_mapper
            );
            $linesDone++;
        }
        return $linesDone;
    }
}