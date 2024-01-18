<?php

class Apreciacao extends TRecord
{
    const TABLENAME  = 'apreciacao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $equipamento;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('equipamento_id');
            
    }

    /**
     * Method set_equipamento
     * Sample of usage: $var->equipamento = $object;
     * @param $object Instance of Equipamento
     */
    public function set_equipamento(Equipamento $object)
    {
        $this->equipamento = $object;
        $this->equipamento_id = $object->id;
    }

    /**
     * Method get_equipamento
     * Sample of usage: $var->equipamento->attribute;
     * @returns Equipamento instance
     */
    public function get_equipamento()
    {
    
        // loads the associated object
        if (empty($this->equipamento))
            $this->equipamento = new Equipamento($this->equipamento_id);
    
        // returns the associated object
        return $this->equipamento;
    }

    /**
     * Method getPontoPerigos
     */
    public function getPontoPerigos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('apreciacao_id', '=', $this->id));
        return PontoPerigo::getObjects( $criteria );
    }
    /**
     * Method getPontoRiscos
     */
    public function getPontoRiscos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('apreciacao_id', '=', $this->id));
        return PontoRisco::getObjects( $criteria );
    }
    /**
     * Method getPontos
     */
    public function getPontos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('apreciacao_id', '=', $this->id));
        return Ponto::getObjects( $criteria );
    }

    
}

