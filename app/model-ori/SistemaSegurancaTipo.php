<?php

class SistemaSegurancaTipo extends TRecord
{
    const TABLENAME  = 'sistema_seguranca_tipo';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $sistema_seguranca;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('sistema_seguranca_id');
        parent::addAttribute('descricao_tipo');
        parent::addAttribute('hint');
            
    }

    /**
     * Method set_sistema_seguranca
     * Sample of usage: $var->sistema_seguranca = $object;
     * @param $object Instance of SistemaSeguranca
     */
    public function set_sistema_seguranca(SistemaSeguranca $object)
    {
        $this->sistema_seguranca = $object;
        $this->sistema_seguranca_id = $object->id;
    }

    /**
     * Method get_sistema_seguranca
     * Sample of usage: $var->sistema_seguranca->attribute;
     * @returns SistemaSeguranca instance
     */
    public function get_sistema_seguranca()
    {
    
        // loads the associated object
        if (empty($this->sistema_seguranca))
            $this->sistema_seguranca = new SistemaSeguranca($this->sistema_seguranca_id);
    
        // returns the associated object
        return $this->sistema_seguranca;
    }

    /**
     * Method getPontoSistemaSegurancas
     */
    public function getPontoSistemaSegurancas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('sistema_seguranca_tipo_id', '=', $this->id));
        return PontoSistemaSeguranca::getObjects( $criteria );
    }

    
}

