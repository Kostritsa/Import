<?php

namespace Likers\Import\Driver;

interface ImportDriverInterface
{
    public function create();
    public function update();
    public function delete();
    public function cleanUp();
}