<?php

class EquipamentoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'Equipamento';
    private static $primaryKey = 'id';
    private static $formName = 'form_Equipamento';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle('Cadastro de equipamento');


        $id = new TEntry('id');
        $empresa_unidade_id = new TDBCombo('empresa_unidade_id', 'nr12', 'EmpresaUnidade', 'id', '{id}','id asc'  );
        $nome = new TEntry('nome');
        $tipo = new TEntry('tipo');
        $modelo = new TEntry('modelo');
        $numero_serie = new TEntry('numero_serie');
        $data_fabricacao = new TDate('data_fabricacao');
        $peso = new TNumeric('peso', '2', ',', '.' );
        $capacidade = new TEntry('capacidade');
        $setor = new TEntry('setor');
        $fabricante = new TEntry('fabricante');
        $fabricante_endereco = new TEntry('fabricante_endereco');
        $fabricante_cidade_id = new TEntry('fabricante_cidade_id');
        $fabricante_cep = new TEntry('fabricante_cep');
        $fabricante_cnpj = new TEntry('fabricante_cnpj');
        $fabricante_registro_crea = new TEntry('fabricante_registro_crea');
        $tag = new TEntry('tag');
        $patrimonio = new TEntry('patrimonio');
        $altura = new TNumeric('altura', '2', ',', '.' );
        $largura = new TNumeric('largura', '2', ',', '.' );
        $profundidade = new TNumeric('profundidade', '2', ',', '.' );
        $vista_frontal = new TEntry('vista_frontal');
        $vista_lateral_esquerda = new TEntry('vista_lateral_esquerda');
        $vista_lateral_direita = new TEntry('vista_lateral_direita');
        $vista_posterior = new TEntry('vista_posterior');
        $utilizacao = new TEntry('utilizacao');
        $capacidade_produtiva = new TEntry('capacidade_produtiva');
        $descricao_processos = new TEntry('descricao_processos');
        $numero_operadores = new TEntry('numero_operadores');
        $intervencoes_realizadas = new TEntry('intervencoes_realizadas');
        $fonte_energia = new TEntry('fonte_energia');
        $tempo_acionamento = new TEntry('tempo_acionamento');
        $tempo_ciclo = new TEntry('tempo_ciclo');
        $tempo_parada_emergencia = new TEntry('tempo_parada_emergencia');
        $numero_posicoes_comando = new TEntry('numero_posicoes_comando');
        $outros = new TEntry('outros');

        $empresa_unidade_id->addValidation('Empresa unidade id', new TRequiredValidator()); 
        $nome->addValidation('Nome', new TRequiredValidator()); 
        $vista_frontal->addValidation('Vista frontal', new TRequiredValidator()); 
        $vista_lateral_esquerda->addValidation('Vista lateral esquerda', new TRequiredValidator()); 
        $vista_lateral_direita->addValidation('Vista lateral direita', new TRequiredValidator()); 
        $vista_posterior->addValidation('Vista posterior', new TRequiredValidator()); 
        $utilizacao->addValidation('Utilizacao', new TRequiredValidator()); 
        $capacidade_produtiva->addValidation('Capacidade produtiva', new TRequiredValidator()); 
        $descricao_processos->addValidation('Descricao processos', new TRequiredValidator()); 
        $numero_operadores->addValidation('Numero operadores', new TRequiredValidator()); 
        $intervencoes_realizadas->addValidation('Intervencoes realizadas', new TRequiredValidator()); 

        $id->setEditable(false);
        $data_fabricacao->setMask('dd/mm/yyyy');
        $data_fabricacao->setDatabaseMask('yyyy-mm-dd');
        $id->setSize(100);
        $tag->setSize('70%');
        $peso->setSize('70%');
        $nome->setSize('70%');
        $tipo->setSize('70%');
        $setor->setSize('70%');
        $altura->setSize('70%');
        $outros->setSize('70%');
        $modelo->setSize('70%');
        $largura->setSize('70%');
        $fabricante->setSize('70%');
        $utilizacao->setSize('70%');
        $capacidade->setSize('70%');
        $patrimonio->setSize('70%');
        $tempo_ciclo->setSize('70%');
        $numero_serie->setSize('70%');
        $profundidade->setSize('70%');
        $fonte_energia->setSize('70%');
        $data_fabricacao->setSize(110);
        $vista_frontal->setSize('70%');
        $fabricante_cep->setSize('70%');
        $fabricante_cnpj->setSize('70%');
        $vista_posterior->setSize('70%');
        $tempo_acionamento->setSize('70%');
        $numero_operadores->setSize('70%');
        $empresa_unidade_id->setSize('70%');
        $fabricante_endereco->setSize('70%');
        $descricao_processos->setSize('70%');
        $capacidade_produtiva->setSize('70%');
        $fabricante_cidade_id->setSize('70%');
        $vista_lateral_direita->setSize('70%');
        $vista_lateral_esquerda->setSize('70%');
        $intervencoes_realizadas->setSize('70%');
        $tempo_parada_emergencia->setSize('70%');
        $numero_posicoes_comando->setSize('70%');
        $fabricante_registro_crea->setSize('70%');








        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Empresa unidade id:', '#ff0000', '14px', null)],[$empresa_unidade_id]);
        $row2 = $this->form->addFields([new TLabel('Nome:', '#ff0000', '14px', null)],[$nome],[new TLabel('Tipo:', null, '14px', null)],[$tipo]);
        $row3 = $this->form->addFields([new TLabel('Modelo:', null, '14px', null)],[$modelo],[new TLabel('Numero serie:', null, '14px', null)],[$numero_serie]);
        $row4 = $this->form->addFields([new TLabel('Data fabricacao:', null, '14px', null)],[$data_fabricacao],[new TLabel('Peso:', null, '14px', null)],[$peso]);
        $row5 = $this->form->addFields([new TLabel('Capacidade:', null, '14px', null)],[$capacidade],[new TLabel('Setor:', null, '14px', null)],[$setor]);
        $row6 = $this->form->addFields([new TLabel('Fabricante:', null, '14px', null)],[$fabricante],[new TLabel('Fabricante endereco:', null, '14px', null)],[$fabricante_endereco]);
        $row7 = $this->form->addFields([new TLabel('Fabricante cidade id:', null, '14px', null)],[$fabricante_cidade_id],[new TLabel('Fabricante cep:', null, '14px', null)],[$fabricante_cep]);
        $row8 = $this->form->addFields([new TLabel('Fabricante cnpj:', null, '14px', null)],[$fabricante_cnpj],[new TLabel('Fabricante registro crea:', null, '14px', null)],[$fabricante_registro_crea]);
        $row9 = $this->form->addFields([new TLabel('Tag:', null, '14px', null)],[$tag],[new TLabel('Patrimonio:', null, '14px', null)],[$patrimonio]);
        $row10 = $this->form->addFields([new TLabel('Altura:', null, '14px', null)],[$altura],[new TLabel('Largura:', null, '14px', null)],[$largura]);
        $row11 = $this->form->addFields([new TLabel('Profundidade:', null, '14px', null)],[$profundidade],[new TLabel('Vista frontal:', '#ff0000', '14px', null)],[$vista_frontal]);
        $row12 = $this->form->addFields([new TLabel('Vista lateral esquerda:', '#ff0000', '14px', null)],[$vista_lateral_esquerda],[new TLabel('Vista lateral direita:', '#ff0000', '14px', null)],[$vista_lateral_direita]);
        $row13 = $this->form->addFields([new TLabel('Vista posterior:', '#ff0000', '14px', null)],[$vista_posterior],[new TLabel('Utilizacao:', '#ff0000', '14px', null)],[$utilizacao]);
        $row14 = $this->form->addFields([new TLabel('Capacidade produtiva:', '#ff0000', '14px', null)],[$capacidade_produtiva],[new TLabel('Descricao processos:', '#ff0000', '14px', null)],[$descricao_processos]);
        $row15 = $this->form->addFields([new TLabel('Numero operadores:', '#ff0000', '14px', null)],[$numero_operadores],[new TLabel('Intervencoes realizadas:', '#ff0000', '14px', null)],[$intervencoes_realizadas]);
        $row16 = $this->form->addFields([new TLabel('Fonte energia:', null, '14px', null)],[$fonte_energia],[new TLabel('Tempo acionamento:', null, '14px', null)],[$tempo_acionamento]);
        $row17 = $this->form->addFields([new TLabel('Tempo ciclo:', null, '14px', null)],[$tempo_ciclo],[new TLabel('Tempo parada emergencia:', null, '14px', null)],[$tempo_parada_emergencia]);
        $row18 = $this->form->addFields([new TLabel('Numero posicoes comando:', null, '14px', null)],[$numero_posicoes_comando],[new TLabel('Outros:', null, '14px', null)],[$outros]);

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);

        parent::add($container);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Equipamento(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'), $messageAction);

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Equipamento($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

}

