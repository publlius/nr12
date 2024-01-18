<?php

class HrnPe extends TRecord
{
    const TABLENAME  = 'hrn_pe';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('valor');
        parent::addAttribute('descricao');
        parent::addAttribute('dica');
            
    }

    
}

