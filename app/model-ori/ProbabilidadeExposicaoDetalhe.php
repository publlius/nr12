<?php

class ProbabilidadeExposicaoDetalhe extends TRecord
{
    const TABLENAME  = 'probabilidade_exposicao_detalhe';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $probabilidade_exposicao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('probabilidade_exposicao_detalhe');
        parent::addAttribute('probabilidade_exposicao_id');
            
    }

    /**
     * Method set_probabilidade_exposicao
     * Sample of usage: $var->probabilidade_exposicao = $object;
     * @param $object Instance of ProbabilidadeExposicao
     */
    public function set_probabilidade_exposicao(ProbabilidadeExposicao $object)
    {
        $this->probabilidade_exposicao = $object;
        $this->probabilidade_exposicao_id = $object->id;
    }

    /**
     * Method get_probabilidade_exposicao
     * Sample of usage: $var->probabilidade_exposicao->attribute;
     * @returns ProbabilidadeExposicao instance
     */
    public function get_probabilidade_exposicao()
    {
    
        // loads the associated object
        if (empty($this->probabilidade_exposicao))
            $this->probabilidade_exposicao = new ProbabilidadeExposicao($this->probabilidade_exposicao_id);
    
        // returns the associated object
        return $this->probabilidade_exposicao;
    }

    
}

