<?php

class Equipamento extends TRecord
{
    const TABLENAME  = 'equipamento';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $empresa_unidade;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('empresa_unidade_id');
        parent::addAttribute('nome');
        parent::addAttribute('tipo');
        parent::addAttribute('modelo');
        parent::addAttribute('numero_serie');
        parent::addAttribute('data_fabricacao');
        parent::addAttribute('peso');
        parent::addAttribute('capacidade');
        parent::addAttribute('setor');
        parent::addAttribute('fabricante');
        parent::addAttribute('fabricante_endereco');
        parent::addAttribute('fabricante_cidade_id');
        parent::addAttribute('fabricante_cep');
        parent::addAttribute('fabricante_cnpj');
        parent::addAttribute('fabricante_registro_crea');
        parent::addAttribute('tag');
        parent::addAttribute('patrimonio');
        parent::addAttribute('altura');
        parent::addAttribute('largura');
        parent::addAttribute('profundidade');
        parent::addAttribute('vista_frontal');
        parent::addAttribute('vista_lateral_esquerda');
        parent::addAttribute('vista_lateral_direita');
        parent::addAttribute('vista_posterior');
        parent::addAttribute('utilizacao');
        parent::addAttribute('capacidade_produtiva');
        parent::addAttribute('descricao_processos');
        parent::addAttribute('numero_operadores');
        parent::addAttribute('intervencoes_realizadas');
        parent::addAttribute('fonte_energia');
        parent::addAttribute('tempo_acionamento');
        parent::addAttribute('tempo_ciclo');
        parent::addAttribute('tempo_parada_emergencia');
        parent::addAttribute('numero_posicoes_comando');
        parent::addAttribute('outros');
            
    }

    /**
     * Method set_empresa_unidade
     * Sample of usage: $var->empresa_unidade = $object;
     * @param $object Instance of EmpresaUnidade
     */
    public function set_empresa_unidade(EmpresaUnidade $object)
    {
        $this->empresa_unidade = $object;
        $this->empresa_unidade_id = $object->id;
    }

    /**
     * Method get_empresa_unidade
     * Sample of usage: $var->empresa_unidade->attribute;
     * @returns EmpresaUnidade instance
     */
    public function get_empresa_unidade()
    {
    
        // loads the associated object
        if (empty($this->empresa_unidade))
            $this->empresa_unidade = new EmpresaUnidade($this->empresa_unidade_id);
    
        // returns the associated object
        return $this->empresa_unidade;
    }

    /**
     * Method getApreciacaos
     */
    public function getApreciacaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('equipamento_id', '=', $this->id));
        return Apreciacao::getObjects( $criteria );
    }

    
}

