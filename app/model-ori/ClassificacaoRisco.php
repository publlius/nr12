<?php

class ClassificacaoRisco extends TRecord
{
    const TABLENAME  = 'classificacao_risco';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('classificacao_risco');
        parent::addAttribute('faixa');
        parent::addAttribute('acao');
        parent::addAttribute('cor');
            
    }

    
}

