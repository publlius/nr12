<?php

class Empresa extends TRecord
{
    const TABLENAME  = 'empresa';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $unit;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('unit_id');
        parent::addAttribute('razao_social');
        parent::addAttribute('nome_fantasia');
        parent::addAttribute('cnpj');
        parent::addAttribute('ie');
        parent::addAttribute('im');
        parent::addAttribute('cnae_principal');
        parent::addAttribute('cnae_secundario');
        parent::addAttribute('endereco');
        parent::addAttribute('cidade_id');
        parent::addAttribute('estado_id');
        parent::addAttribute('pais_id');
            
    }

    /**
     * Method set_system_unit
     * Sample of usage: $var->system_unit = $object;
     * @param $object Instance of SystemUnit
     */
    public function set_unit(SystemUnit $object)
    {
        $this->unit = $object;
        $this->unit_id = $object->id;
    }

    /**
     * Method get_unit
     * Sample of usage: $var->unit->attribute;
     * @returns SystemUnit instance
     */
    public function get_unit()
    {
        TTransaction::open('permission');
        // loads the associated object
        if (empty($this->unit))
            $this->unit = new SystemUnit($this->unit_id);
        TTransaction::close();
        // returns the associated object
        return $this->unit;
    }

    /**
     * Method getEmpresaUnidades
     */
    public function getEmpresaUnidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('empresa_id', '=', $this->id));
        return EmpresaUnidade::getObjects( $criteria );
    }

    
}

