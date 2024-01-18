<?php

class FrequenciaExposicao extends TRecord
{
    const TABLENAME  = 'frequencia_exposicao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('frequencia_exposicao');
        parent::addAttribute('pontucao');
            
    }

    
}

