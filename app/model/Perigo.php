<?php

class Perigo extends TRecord
{
    const TABLENAME  = 'perigo';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tipo_perigo;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_perigo_id');
        parent::addAttribute('perigo');
            
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
        $criteria->add(new TFilter('perigo_id', '=', $this->id));
        return PontoPerigo::getObjects( $criteria );
    }

    
}

