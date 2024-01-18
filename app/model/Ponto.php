<?php

class Ponto extends TRecord
{
    const TABLENAME  = 'ponto';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $hrn_fe;
    private $hrn_np;
    private $hrn_pe;
    private $hrn_pmp;
    private $f_exposicao;
    private $s_ferimento;
    private $p_evitar_perigo;
    private $apreciacao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('apreciacao_id');
        parent::addAttribute('vista_ponto');
        parent::addAttribute('localizacao_ponto');
        parent::addAttribute('p_evitar_perigo_id');
        parent::addAttribute('s_ferimento_id');
        parent::addAttribute('f_exposicao_id');
        parent::addAttribute('parecer_extra_norma');
        parent::addAttribute('possiveis_solucoes');
        parent::addAttribute('hrn_pmp_id');
        parent::addAttribute('hrn_pe_id');
        parent::addAttribute('hrn_np_id');
        parent::addAttribute('hrn_fe_id');
            
    }

    /**
     * Method set_hrn_fe
     * Sample of usage: $var->hrn_fe = $object;
     * @param $object Instance of HrnFe
     */
    public function set_hrn_fe(HrnFe $object)
    {
        $this->hrn_fe = $object;
        $this->hrn_fe_id = $object->id;
    }

    /**
     * Method get_hrn_fe
     * Sample of usage: $var->hrn_fe->attribute;
     * @returns HrnFe instance
     */
    public function get_hrn_fe()
    {
    
        // loads the associated object
        if (empty($this->hrn_fe))
            $this->hrn_fe = new HrnFe($this->hrn_fe_id);
    
        // returns the associated object
        return $this->hrn_fe;
    }
    /**
     * Method set_hrn_np
     * Sample of usage: $var->hrn_np = $object;
     * @param $object Instance of HrnNp
     */
    public function set_hrn_np(HrnNp $object)
    {
        $this->hrn_np = $object;
        $this->hrn_np_id = $object->id;
    }

    /**
     * Method get_hrn_np
     * Sample of usage: $var->hrn_np->attribute;
     * @returns HrnNp instance
     */
    public function get_hrn_np()
    {
    
        // loads the associated object
        if (empty($this->hrn_np))
            $this->hrn_np = new HrnNp($this->hrn_np_id);
    
        // returns the associated object
        return $this->hrn_np;
    }
    /**
     * Method set_hrn_pe
     * Sample of usage: $var->hrn_pe = $object;
     * @param $object Instance of HrnPe
     */
    public function set_hrn_pe(HrnPe $object)
    {
        $this->hrn_pe = $object;
        $this->hrn_pe_id = $object->id;
    }

    /**
     * Method get_hrn_pe
     * Sample of usage: $var->hrn_pe->attribute;
     * @returns HrnPe instance
     */
    public function get_hrn_pe()
    {
    
        // loads the associated object
        if (empty($this->hrn_pe))
            $this->hrn_pe = new HrnPe($this->hrn_pe_id);
    
        // returns the associated object
        return $this->hrn_pe;
    }
    /**
     * Method set_hrn_pmp
     * Sample of usage: $var->hrn_pmp = $object;
     * @param $object Instance of HrnPmp
     */
    public function set_hrn_pmp(HrnPmp $object)
    {
        $this->hrn_pmp = $object;
        $this->hrn_pmp_id = $object->id;
    }

    /**
     * Method get_hrn_pmp
     * Sample of usage: $var->hrn_pmp->attribute;
     * @returns HrnPmp instance
     */
    public function get_hrn_pmp()
    {
    
        // loads the associated object
        if (empty($this->hrn_pmp))
            $this->hrn_pmp = new HrnPmp($this->hrn_pmp_id);
    
        // returns the associated object
        return $this->hrn_pmp;
    }
    /**
     * Method set_f_exposicao
     * Sample of usage: $var->f_exposicao = $object;
     * @param $object Instance of FExposicao
     */
    public function set_f_exposicao(FExposicao $object)
    {
        $this->f_exposicao = $object;
        $this->f_exposicao_id = $object->id;
    }

    /**
     * Method get_f_exposicao
     * Sample of usage: $var->f_exposicao->attribute;
     * @returns FExposicao instance
     */
    public function get_f_exposicao()
    {
    
        // loads the associated object
        if (empty($this->f_exposicao))
            $this->f_exposicao = new FExposicao($this->f_exposicao_id);
    
        // returns the associated object
        return $this->f_exposicao;
    }
    /**
     * Method set_s_ferimento
     * Sample of usage: $var->s_ferimento = $object;
     * @param $object Instance of SFerimento
     */
    public function set_s_ferimento(SFerimento $object)
    {
        $this->s_ferimento = $object;
        $this->s_ferimento_id = $object->id;
    }

    /**
     * Method get_s_ferimento
     * Sample of usage: $var->s_ferimento->attribute;
     * @returns SFerimento instance
     */
    public function get_s_ferimento()
    {
    
        // loads the associated object
        if (empty($this->s_ferimento))
            $this->s_ferimento = new SFerimento($this->s_ferimento_id);
    
        // returns the associated object
        return $this->s_ferimento;
    }
    /**
     * Method set_p_evitar_perigo
     * Sample of usage: $var->p_evitar_perigo = $object;
     * @param $object Instance of PEvitarPerigo
     */
    public function set_p_evitar_perigo(PEvitarPerigo $object)
    {
        $this->p_evitar_perigo = $object;
        $this->p_evitar_perigo_id = $object->id;
    }

    /**
     * Method get_p_evitar_perigo
     * Sample of usage: $var->p_evitar_perigo->attribute;
     * @returns PEvitarPerigo instance
     */
    public function get_p_evitar_perigo()
    {
    
        // loads the associated object
        if (empty($this->p_evitar_perigo))
            $this->p_evitar_perigo = new PEvitarPerigo($this->p_evitar_perigo_id);
    
        // returns the associated object
        return $this->p_evitar_perigo;
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
     * Method getPontoSistemaSegurancas
     */
    public function getPontoSistemaSegurancas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ponto_id', '=', $this->id));
        return PontoSistemaSeguranca::getObjects( $criteria );
    }
    /**
     * Method getPontoPerigos
     */
    public function getPontoPerigos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ponto_id', '=', $this->id));
        return PontoPerigo::getObjects( $criteria );
    }
    /**
     * Method getPontoRiscos
     */
    public function getPontoRiscos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ponto_id', '=', $this->id));
        return PontoRisco::getObjects( $criteria );
    }
    /**
     * Method getPontoParecerTecnicos
     */
    public function getPontoParecerTecnicos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ponto_id', '=', $this->id));
        return PontoParecerTecnico::getObjects( $criteria );
    }

    
}

