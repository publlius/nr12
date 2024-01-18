<?php

class EmpresaUnidade extends TRecord
{
    const TABLENAME  = 'empresa_unidade';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $cidade;
    private $estado;
    private $pais;
    private $empresa;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('empresa_id');
        parent::addAttribute('descricao_unidade');
        parent::addAttribute('pais_id');
        parent::addAttribute('estado_id');
        parent::addAttribute('cidade_id');
            
    }

    /**
     * Method set_cidade
     * Sample of usage: $var->cidade = $object;
     * @param $object Instance of Cidade
     */
    public function set_cidade(Cidade $object)
    {
        $this->cidade = $object;
        $this->cidade_id = $object->id;
    }

    /**
     * Method get_cidade
     * Sample of usage: $var->cidade->attribute;
     * @returns Cidade instance
     */
    public function get_cidade()
    {
    
        // loads the associated object
        if (empty($this->cidade))
            $this->cidade = new Cidade($this->cidade_id);
    
        // returns the associated object
        return $this->cidade;
    }
    /**
     * Method set_estado
     * Sample of usage: $var->estado = $object;
     * @param $object Instance of Estado
     */
    public function set_estado(Estado $object)
    {
        $this->estado = $object;
        $this->estado_id = $object->id;
    }

    /**
     * Method get_estado
     * Sample of usage: $var->estado->attribute;
     * @returns Estado instance
     */
    public function get_estado()
    {
    
        // loads the associated object
        if (empty($this->estado))
            $this->estado = new Estado($this->estado_id);
    
        // returns the associated object
        return $this->estado;
    }
    /**
     * Method set_pais
     * Sample of usage: $var->pais = $object;
     * @param $object Instance of Pais
     */
    public function set_pais(Pais $object)
    {
        $this->pais = $object;
        $this->pais_id = $object->id;
    }

    /**
     * Method get_pais
     * Sample of usage: $var->pais->attribute;
     * @returns Pais instance
     */
    public function get_pais()
    {
    
        // loads the associated object
        if (empty($this->pais))
            $this->pais = new Pais($this->pais_id);
    
        // returns the associated object
        return $this->pais;
    }
    /**
     * Method set_empresa
     * Sample of usage: $var->empresa = $object;
     * @param $object Instance of Empresa
     */
    public function set_empresa(Empresa $object)
    {
        $this->empresa = $object;
        $this->empresa_id = $object->id;
    }

    /**
     * Method get_empresa
     * Sample of usage: $var->empresa->attribute;
     * @returns Empresa instance
     */
    public function get_empresa()
    {
    
        // loads the associated object
        if (empty($this->empresa))
            $this->empresa = new Empresa($this->empresa_id);
    
        // returns the associated object
        return $this->empresa;
    }

    /**
     * Method getEquipamentos
     */
    public function getEquipamentos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('empresa_unidade_id', '=', $this->id));
        return Equipamento::getObjects( $criteria );
    }

    
}

