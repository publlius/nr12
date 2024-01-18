<?php

class Prospeccao extends TRecord
{
    const TABLENAME  = 'prospeccao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $alterado_por_system_users;
    private $criado_por_system_users;
    private $cidade;
    private $estado;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('estado_id');
        parent::addAttribute('cidade_id');
        parent::addAttribute('empresa');
        parent::addAttribute('site');
        parent::addAttribute('ramo');
        parent::addAttribute('porte');
        parent::addAttribute('telefone');
        parent::addAttribute('data_contato');
        parent::addAttribute('retornar_em');
        parent::addAttribute('cor');
        parent::addAttribute('criado_em');
        parent::addAttribute('criado_por_system_users_id');
        parent::addAttribute('alterado_em');
        parent::addAttribute('alterado_por_system_users_id');
        parent::addAttribute('status');
        parent::addAttribute('observacao');
            
    }

    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_alterado_por_system_users(SystemUsers $object)
    {
        $this->alterado_por_system_users = $object;
        $this->alterado_por_system_users_id = $object->id;
    }

    /**
     * Method get_alterado_por_system_users
     * Sample of usage: $var->alterado_por_system_users->attribute;
     * @returns SystemUsers instance
     */
    public function get_alterado_por_system_users()
    {
    
        // loads the associated object
        if (empty($this->alterado_por_system_users))
            $this->alterado_por_system_users = new SystemUsers($this->alterado_por_system_users_id);
    
        // returns the associated object
        return $this->alterado_por_system_users;
    }
    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_criado_por_system_users(SystemUsers $object)
    {
        $this->criado_por_system_users = $object;
        $this->criado_por_system_users_id = $object->id;
    }

    /**
     * Method get_criado_por_system_users
     * Sample of usage: $var->criado_por_system_users->attribute;
     * @returns SystemUsers instance
     */
    public function get_criado_por_system_users()
    {
    
        // loads the associated object
        if (empty($this->criado_por_system_users))
            $this->criado_por_system_users = new SystemUsers($this->criado_por_system_users_id);
    
        // returns the associated object
        return $this->criado_por_system_users;
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
     * Method getProspeccaoContatos
     */
    public function getProspeccaoContatos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('prospeccao_id', '=', $this->id));
        return ProspeccaoContato::getObjects( $criteria );
    }

    
}

