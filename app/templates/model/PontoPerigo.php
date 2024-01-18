<?php

class PontoPerigo extends TRecord
{
    const TABLENAME  = 'ponto_perigo';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tipo_perigo;
    private $perigo;
    private $ponto;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('ponto_id');
        parent::addAttribute('tipo_perigo_id');
        parent::addAttribute('perigo_id');
            
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

