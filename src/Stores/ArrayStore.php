<?php

declare(strict_types=1);

namespace Digitonma\LaravelSettings\Stores;

/**
 * Class     ArrayStore
 *
 * @author   digiton-ma <contact@digiton.ma>
 */
class ArrayStore extends AbstractStore
{
    /* -----------------------------------------------------------------
     |  Post-Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Fire the post options to customize the store.
     *
     * @param  array  $options
     */
    protected function postOptions(array $options)
    {
        // Do nothing...
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Read the data from the store.
     *
     * @return array
     */
    protected function read()
    {
        return $this->data;
    }

    /**
     * Write the data into the store.
     *
     * @param  array  $data
     */
    protected function write(array $data)
    {
        // Nothing to do...
    }
}
