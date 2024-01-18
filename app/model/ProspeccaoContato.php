<?php

class ProspeccaoContato extends TRecord
{
    const TABLENAME  = 'prospeccao_contato';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $alterado_por_system_users;
    private $criado_por_system_users;
    private $prospeccao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('cargo');
        parent::addAttribute('fone');
        parent::addAttribute('celular');
        parent::addAttribute('email');
        parent::addAttribute('prospeccao_id');
        parent::addAttribute('data_contato');
        parent::addAttribute('criado_por_system_users_id');
        parent::addAttribute('alterado_por_system_users_id');
        parent::addAttribute('resumo');
            
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

