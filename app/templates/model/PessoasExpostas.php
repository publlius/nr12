<?php

class PessoasExpostas extends TRecord
{
    const TABLENAME  = 'pessoas_expostas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pontuacao');
        parent::addAttribute('faixa');
            
    }

    
}

