<?php

class PontoParecerTecnico extends TRecord
{
    const TABLENAME  = 'ponto_parecer_tecnico';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $titulo_parecer_tecnico;
    private $item_norma;
    private $ponto;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('ponto_id');
        parent::addAttribute('titulo_parecer_tecnico_id');
        parent::addAttribute('item_norma_id');
            
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

