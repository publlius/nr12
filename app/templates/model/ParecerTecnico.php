<?php

class ParecerTecnico extends TRecord
{
    const TABLENAME  = 'parecer_tecnico';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('parecer_tecnico');
            
    }

    
}

