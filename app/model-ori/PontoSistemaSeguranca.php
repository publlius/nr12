<?php

class PontoSistemaSeguranca extends TRecord
{
    const TABLENAME  = 'ponto_sistema_seguranca';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $sistema_seguranca_tipo;
    private $sistema_seguranca;
    private $ponto;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('ponto_id');
        parent::addAttribute('sistema_seguranca_tipo_id');
        parent::addAttribute('sistema_seguranca_id');
            
    }

    /**
     * Method set_sistema_seguranca_tipo
     * Sample of usage: $var->sistema_seguranca_tipo = $object;
     * @param $object Instance of SistemaSegurancaTipo
     */
    public function set_sistema_seguranca_tipo(SistemaSegurancaTipo $object)
    {
        $this->sistema_seguranca_tipo = $object;
        $this->sistema_seguranca_tipo_id = $object->id;
    }

    /**
     * Method get_sistema_seguranca_tipo
     * Sample of usage: $var->sistema_seguranca_tipo->attribute;
     * @returns SistemaSegurancaTipo instance
     */
    public function get_sistema_seguranca_tipo()
    {
    
        // loads the associated object
        if (empty($this->sistema_seguranca_tipo))
            $this->sistema_seguranca_tipo = new SistemaSegurancaTipo($this->sistema_seguranca_tipo_id);
    
        // returns the associated object
        return $this->sistema_seguranca_tipo;
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
     * Method set_ponto
     * Sample of usage: $var->ponto = $object;
     * @param $object Instance of Ponto
     */
    public function set_ponto(Ponto $object)
    {
        $this->ponto = $object;
        $this->ponto_id = $object->id;
    }

    /**
     * Method get_ponto
     * Sample of usage: $var->ponto->attribute;
     * @returns Ponto instance
     */
    public function get_ponto()
    {
    
        // loads the associated object
        if (empty($this->ponto))
            $this->ponto = new Ponto($this->ponto_id);
    
        // returns the associated object
        return $this->ponto;
    }

    
}

