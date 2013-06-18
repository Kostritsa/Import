<?php

namespace Likers\Import;

class MultistepImport extends Import
{
    protected $_stepSize;

    /**
     * @param Iterator\ExtendedIteratorInterface     $iterator
     * @param Driver\ImportDriverInterface $driver
     * @param string $importId
     * @param int $stepSize
     */
    function __construct(
        Iterator\ExtendedIteratorInterface $iterator,
        Driver\ImportDriverInterface $driver,
        $importId,
        $stepSize = 1000
    )
    {
        $this->_stepSize = $stepSize;
        parent::__construct( $iterator, $driver, $importId );
    }

    /**
     * @param  int $skip How much to skip
     * @return int Successful imported lines
     */
    public function nextStep( $skip = 0 )
    {
        $this->_iterator->skipTo( $skip );
        $this->_driver->create();

        return 10;
    }
}