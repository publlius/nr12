<?php

class ProbabilidadeExposicao extends TRecord
{
    const TABLENAME  = 'probabilidade_exposicao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pontuacao');
        parent::addAttribute('probabilidade_exposicao');
            
    }

    /**
     * Method getProbabilidadeExposicaoDetalhes
     */
    public function getProbabilidadeExposicaoDetalhes()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('probabilidade_exposicao_id', '=', $this->id));
        return ProbabilidadeExposicaoDetalhe::getObjects( $criteria );
    }

    
}

