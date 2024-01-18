<?php

class DispositivoPe extends TRecord
{
    const TABLENAME  = 'dispositivo_pe';
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
        parent::addAttribute('vista_dispositivo');
        parent::addAttribute('dispositivo_seguranca');
        parent::addAttribute('dispositivo_seguranca_nr12');
        parent::addAttribute('dispositivo_usado_partida');
        parent::addAttribute('dispositivo_usado_partida_nr12');
        parent::addAttribute('acionado_outro_operador');
        parent::addAttribute('acionado_outro_operador_nr12');
        parent::addAttribute('passivel_burla');
        parent::addAttribute('passivel_burla_nr12');
        parent::addAttribute('identificado_ptbr');
        parent::addAttribute('identificado_ptbr_nr12');
        parent::addAttribute('rearme_manual');
        parent::addAttribute('rearme_manual_nr12');
        parent::addAttribute('apresenta_retencao');
        parent::addAttribute('apresenta_retencao_nr12');
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
     * Method getPeParecerTecnicos
     */
    public function getPeParecerTecnicos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('dispositivo_pe_id', '=', $this->id));
        return PeParecerTecnico::getObjects( $criteria );
    }

    
}

