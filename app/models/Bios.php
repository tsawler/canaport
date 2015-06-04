<?php

class Bios extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bios';

    /**
     * Get the unique identifier for the menu item.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
}