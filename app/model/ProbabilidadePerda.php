<?php

class ProbabilidadePerda extends TRecord
{
    const TABLENAME  = 'probabilidade_perda';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pontuacao');
        parent::addAttribute('probabilidade_perda');
            
    }

    
}

