<?php

class DispositivoPap extends TRecord
{
    const TABLENAME  = 'dispositivo_pap';
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
        parent::addAttribute('vista_dispositivo_pap');
        parent::addAttribute('tipo_dispositivo');
        parent::addAttribute('instalado');
        parent::addAttribute('instalado_nr12');
        parent::addAttribute('zona_segura');
        parent::addAttribute('zona_segura_nr12');
        parent::addAttribute('acionamento_acidental');
        parent::addAttribute('acionamento_acidental_nr12');
        parent::addAttribute('identificado_ptbr');
        parent::addAttribute('identificado_ptbr_nr12');
        parent::addAttribute('acionado_ebt');
        parent::addAttribute('acionado_ebt_nr12');
        parent::addAttribute('parecer_extra_norma');
            
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

    /**
     * Method getPapParecerTecnicos
     */
    public function getPapParecerTecnicos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('dispositivo_pap_id', '=', $this->id));
        return PapParecerTecnico::getObjects( $criteria );
    }

    
}

