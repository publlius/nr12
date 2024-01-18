<?php

class PontoPerigo extends TRecord
{
    const TABLENAME  = 'ponto_perigo';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $apreciacao;
    private $perigo;
    private $ponto;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('apreciacao_id');
        parent::addAttribute('ponto_id');
        parent::addAttribute('perigo_id');
            
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
     * Method set_perigo
     * Sample of usage: $var->perigo = $object;
     * @param $object Instance of Perigo
     */
    public function set_perigo(Perigo $object)
    {
        $this->perigo = $object;
        $this->perigo_id = $object->id;
    }

    /**
     * Method get_perigo
     * Sample of usage: $var->perigo->attribute;
     * @returns Perigo instance
     */
    public function get_perigo()
    {
    
        // loads the associated object
        if (empty($this->perigo))
            $this->perigo = new Perigo($this->perigo_id);
    
        // returns the associated object
        return $this->perigo;
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

