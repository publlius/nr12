<?php

class PontoRisco extends TRecord
{
    const TABLENAME  = 'ponto_risco';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tipo_perigo;
    private $risco;
    private $ponto;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('ponto_id');
        parent::addAttribute('tipo_perigo_id');
        parent::addAttribute('risco_id');
            
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
     * Method set_risco
     * Sample of usage: $var->risco = $object;
     * @param $object Instance of Risco
     */
    public function set_risco(Risco $object)
    {
        $this->risco = $object;
        $this->risco_id = $object->id;
    }

    /**
     * Method get_risco
     * Sample of usage: $var->risco->attribute;
     * @returns Risco instance
     */
    public function get_risco()
    {
    
        // loads the associated object
        if (empty($this->risco))
            $this->risco = new Risco($this->risco_id);
    
        // returns the associated object
        return $this->risco;
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

