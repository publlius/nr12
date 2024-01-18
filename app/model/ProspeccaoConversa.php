<?php

class ProspeccaoConversa extends TRecord
{
    const TABLENAME  = 'prospeccao_conversa';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $prospeccao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('prospeccao_id');
        parent::addAttribute('resumo');
        parent::addAttribute('data_conversa');
            
    }

    /**
     * Method set_prospeccao
     * Sample of usage: $var->prospeccao = $object;
     * @param $object Instance of Prospeccao
     */
    public function set_prospeccao(Prospeccao $object)
    {
        $this->prospeccao = $object;
        $this->prospeccao_id = $object->id;
    }

    /**
     * Method get_prospeccao
     * Sample of usage: $var->prospeccao->attribute;
     * @returns Prospeccao instance
     */
    public function get_prospeccao()
    {
    
        // loads the associated object
        if (empty($this->prospeccao))
            $this->prospeccao = new Prospeccao($this->prospeccao_id);
    
        // returns the associated object
        return $this->prospeccao;
    }

    
}

