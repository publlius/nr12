<?php

class PapParecerTecnico extends TRecord
{
    const TABLENAME  = 'pap_parecer_tecnico';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $item_norma;
    private $titulo_parecer_tecnico;
    private $dispositivo_pap;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dispositivo_pap_id');
        parent::addAttribute('titulo_parecer_tecnico_id');
        parent::addAttribute('item_norma_id');
            
    }

    /**
     * Method set_item_norma
     * Sample of usage: $var->item_norma = $object;
     * @param $object Instance of ItemNorma
     */
    public function set_item_norma(ItemNorma $object)
    {
        $this->item_norma = $object;
        $this->item_norma_id = $object->id;
    }

    /**
     * Method get_item_norma
     * Sample of usage: $var->item_norma->attribute;
     * @returns ItemNorma instance
     */
    public function get_item_norma()
    {
    
        // loads the associated object
        if (empty($this->item_norma))
            $this->item_norma = new ItemNorma($this->item_norma_id);
    
        // returns the associated object
        return $this->item_norma;
    }
    /**
     * Method set_titulo_parecer_tecnico
     * Sample of usage: $var->titulo_parecer_tecnico = $object;
     * @param $object Instance of TituloParecerTecnico
     */
    public function set_titulo_parecer_tecnico(TituloParecerTecnico $object)
    {
        $this->titulo_parecer_tecnico = $object;
        $this->titulo_parecer_tecnico_id = $object->id;
    }

    /**
     * Method get_titulo_parecer_tecnico
     * Sample of usage: $var->titulo_parecer_tecnico->attribute;
     * @returns TituloParecerTecnico instance
     */
    public function get_titulo_parecer_tecnico()
    {
    
        // loads the associated object
        if (empty($this->titulo_parecer_tecnico))
            $this->titulo_parecer_tecnico = new TituloParecerTecnico($this->titulo_parecer_tecnico_id);
    
        // returns the associated object
        return $this->titulo_parecer_tecnico;
    }
    /**
     * Method set_dispositivo_pap
     * Sample of usage: $var->dispositivo_pap = $object;
     * @param $object Instance of DispositivoPap
     */
    public function set_dispositivo_pap(DispositivoPap $object)
    {
        $this->dispositivo_pap = $object;
        $this->dispositivo_pap_id = $object->id;
    }

    /**
     * Method get_dispositivo_pap
     * Sample of usage: $var->dispositivo_pap->attribute;
     * @returns DispositivoPap instance
     */
    public function get_dispositivo_pap()
    {
    
        // loads the associated object
        if (empty($this->dispositivo_pap))
            $this->dispositivo_pap = new DispositivoPap($this->dispositivo_pap_id);
    
        // returns the associated object
        return $this->dispositivo_pap;
    }

    
}

