<?php

class DisposicoesFinais extends TRecord
{
    const TABLENAME  = 'disposicoes_finais';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $apreciacao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('apreciacao_id');
        parent::addAttribute('manutencao_ph');
        parent::addAttribute('registro_manutencao');
        parent::addAttribute('acesso_rm');
        parent::addAttribute('manuais');
        parent::addAttribute('procedimento_ts');
        parent::addAttribute('capacitacao');
        parent::addAttribute('observacao');
            
    }

    /**
     * Method set_apreciacao
     * Sample of usage: $var->apreciacao = $object;
     * @param $object Instance of Apreciacao
     */
    public function set_apreciacao(Apreciacao $object)
    {
        $this->apreciacao = $object;
        $this->apreciacao_id = $object->id;
    }

    /**
     * Method get_apreciacao
     * Sample of usage: $var->apreciacao->attribute;
     * @returns Apreciacao instance
     */
    public function get_apreciacao()
    {
    
        // loads the associated object
        if (empty($this->apreciacao))
            $this->apreciacao = new Apreciacao($this->apreciacao_id);
    
        // returns the associated object
        return $this->apreciacao;
    }

    
}

