<?php

class SistemaSeguranca extends TRecord
{
    const TABLENAME  = 'sistema_seguranca';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tipo_sistema_seguranca;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_sistema_seguranca_id');
        parent::addAttribute('sistema_seguranca');
        parent::addAttribute('hint');
            
    }

    /**
     * Method set_tipo_sistema_seguranca
     * Sample of usage: $var->tipo_sistema_seguranca = $object;
     * @param $object Instance of TipoSistemaSeguranca
     */
    public function set_tipo_sistema_seguranca(TipoSistemaSeguranca $object)
    {
        $this->tipo_sistema_seguranca = $object;
        $this->tipo_sistema_seguranca_id = $object->id;
    }

    /**
     * Method get_tipo_sistema_seguranca
     * Sample of usage: $var->tipo_sistema_seguranca->attribute;
     * @returns TipoSistemaSeguranca instance
     */
    public function get_tipo_sistema_seguranca()
    {
    
        // loads the associated object
        if (empty($this->tipo_sistema_seguranca))
            $this->tipo_sistema_seguranca = new TipoSistemaSeguranca($this->tipo_sistema_seguranca_id);
    
        // returns the associated object
        return $this->tipo_sistema_seguranca;
    }

    /**
     * Method getPontoSistemaSegurancas
     */
    public function getPontoSistemaSegurancas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('sistema_seguranca_id', '=', $this->id));
        return PontoSistemaSeguranca::getObjects( $criteria );
    }

    
}

