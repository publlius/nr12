<?php

class ItemNorma extends TRecord
{
    const TABLENAME  = 'item_norma';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $titulo;
    private $status_item;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('codigo_item_norma');
        parent::addAttribute('descricao_item_norma');
        parent::addAttribute('titulo_id');
        parent::addAttribute('status_item_id');
        parent::addAttribute('observacao');
            
    }

    /**
     * Method set_titulo_parecer_tecnico
     * Sample of usage: $var->titulo_parecer_tecnico = $object;
     * @param $object Instance of TituloParecerTecnico
     */
    public function set_titulo(TituloParecerTecnico $object)
    {
        $this->titulo = $object;
        $this->titulo_id = $object->id;
    }

    /**
     * Method get_titulo
     * Sample of usage: $var->titulo->attribute;
     * @returns TituloParecerTecnico instance
     */
    public function get_titulo()
    {
    
        // loads the associated object
        if (empty($this->titulo))
            $this->titulo = new TituloParecerTecnico($this->titulo_id);
    
        // returns the associated object
        return $this->titulo;
    }
    /**
     * Method set_status_item
     * Sample of usage: $var->status_item = $object;
     * @param $object Instance of StatusItem
     */
    public function set_status_item(StatusItem $object)
    {
        $this->status_item = $object;
        $this->status_item_id = $object->id;
    }

    /**
     * Method get_status_item
     * Sample of usage: $var->status_item->attribute;
     * @returns StatusItem instance
     */
    public function get_status_item()
    {
    
        // loads the associated object
        if (empty($this->status_item))
            $this->status_item = new StatusItem($this->status_item_id);
    
        // returns the associated object
        return $this->status_item;
    }

    /**
     * Method getPontoParecerTecnicos
     */
    public function getPontoParecerTecnicos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('item_norma_id', '=', $this->id));
        return PontoParecerTecnico::getObjects( $criteria );
    }

    
}

