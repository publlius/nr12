<?php

class StatusItem extends TRecord
{
    const TABLENAME  = 'status_item';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('status_item');
            
    }

    /**
     * Method getItemNormas
     */
    public function getItemNormas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('status_item_id', '=', $this->id));
        return ItemNorma::getObjects( $criteria );
    }

    
}

