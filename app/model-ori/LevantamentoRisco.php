<?php

class LevantamentoRisco extends TRecord
{
    const TABLENAME  = 'levantamento_risco';
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

    
}

