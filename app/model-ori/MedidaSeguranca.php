<?php

class MedidaSeguranca extends TRecord
{
    const TABLENAME  = 'medida_seguranca';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('medida_seguranca');
            
    }

    
}

