<?php

class Ponto extends TRecord
{
    const TABLENAME  = 'ponto';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $apreciacao;
    private $tipo_perigo;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('apreciacao_id');
        parent::addAttribute('vista_ponto');
        parent::addAttribute('localizacao_ponto');
        parent::addAttribute('severidade_ferimento');
        parent::addAttribute('tipo_perigo_id');
        parent::addAttribute('frequencia_exposicao');
        parent::addAttribute('possibilidade_evitar');
        parent::addAttribute('parecer_extra_norma');
        parent::addAttribute('possiveis_solucoes');
            
    }

    /**
     * Method set_apreciacao
     * Sample of usage: $var->apreciacao = $object;
     * @param $object Instance of Apreciacao
     */
    public function set_apreciacao(Apreciacao $object)
    {
        $this->apreciacao = $object;
        $this->apreciacao_id = $object->id;
    }

    /**
     * Method get_apreciacao
     * Sample of usage: $var->apreciacao->attribute;
     * @returns Apreciacao instance
     */
    public function get_apreciacao()
    {
    
        // loads the associated object
        if (empty($this->apreciacao))
            $this->apreciacao = new Apreciacao($this->apreciacao_id);
    
        // returns the associated object
        return $this->apreciacao;
    }
    /**
     * Method set_tipo_perigo
     * Sample of usage: $var->tipo_perigo = $object;
     * @param $object Instance of TipoPerigo
     */
    public function set_tipo_perigo(TipoPerigo $object)
    {
        $this->tipo_perigo = $object;
        $this->tipo_perigo_id = $object->id;
    }

    /**
     * Method get_tipo_perigo
     * Sample of usage: $var->tipo_perigo->attribute;
     * @returns TipoPerigo instance
     */
    public function get_tipo_perigo()
    {
    
        // loads the associated object
        if (empty($this->tipo_perigo))
            $this->tipo_perigo = new TipoPerigo($this->tipo_perigo_id);
    
        // returns the associated object
        return $this->tipo_perigo;
    }

    /**
     * Method getPontoPerigos
     */
    public function getPontoPerigos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ponto_id', '=', $this->id));
        return PontoPerigo::getObjects( $criteria );
    }
    /**
     * Method getPontoRiscos
     */
    public function getPontoRiscos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ponto_id', '=', $this->id));
        return PontoRisco::getObjects( $criteria );
    }
    /**
     * Method getPontoSistemaSegurancas
     */
    public function getPontoSistemaSegurancas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ponto_id', '=', $this->id));
        return PontoSistemaSeguranca::getObjects( $criteria );
    }
    /**
     * Method getPontoParecerTecnicos
     */
    public function getPontoParecerTecnicos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ponto_id', '=', $this->id));
        return PontoParecerTecnico::getObjects( $criteria );
    }

    
}

