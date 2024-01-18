<?php

class HrnFe extends TRecord
{
    const TABLENAME  = 'hrn_fe';
    const PRIMARYKEY = 'id_';
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

