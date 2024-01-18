<?php

//<fileHeader>

//</fileHeader>

class EquipamentoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'Equipamento';
    private static $primaryKey = 'id';
    private static $formName = 'form_Equipamento';

    //<classProperties>

    //</classProperties>

    use Adianti\Base\AdiantiFileSaveTrait;

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

        //<onBeginPageCreation>

        //</onBeginPageCreation>

        $id = new TEntry('id');
        $empresa_unidade_id = new TDBCombo('empresa_unidade_id', 'nr12', 'EmpresaUnidade', 'id', '{empresa_id} - {descricao_unidade} ','id asc'  );
        $nome = new TEntry('nome');
        $tipo = new TEntry('tipo');
        $modelo = new TEntry('modelo');
        $numero_serie = new TEntry('numero_serie');
        $data_fabricacao = new TDate('data_fabricacao');
        $peso = new TNumeric('peso', '2', ',', '.' );
        $capacidade = new TEntry('capacidade');
        $setor = new TEntry('setor');
        $tag = new TEntry('tag');
        $patrimonio = new TEntry('patrimonio');
        $altura = new TNumeric('altura', '2', ',', '.' );
        $largura = new TNumeric('largura', '2', ',', '.' );
        $profundidade = new TNumeric('profundidade', '2', ',', '.' );
        $vista_frontal = new TFile('vista_frontal');
        $vista_lateral_esquerda = new TFile('vista_lateral_esquerda');
        $vista_lateral_direita = new TFile('vista_lateral_direita');
        $vista_posterior = new TFile('vista_posterior');
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
        $fabricante = new TEntry('fabricante');
        $fabricante_endereco = new TEntry('fabricante_endereco');
        $fabricante_cidade_id = new TDBCombo('fabricante_cidade_id', 'nr12', 'Cidade', 'id', '{nome} -  {estado->uf} ','id asc'  );
        $fabricante_cep = new TEntry('fabricante_cep');
        $fabricante_cnpj = new TEntry('fabricante_cnpj');
        $fabricante_registro_crea = new TEntry('fabricante_registro_crea');

        $empresa_unidade_id->addValidation('Empresa unidade id', new TRequiredValidator()); 
        $nome->addValidation('Nome', new TRequiredValidator()); 
        $utilizacao->addValidation('Utilizacao', new TRequiredValidator()); 
        $capacidade_produtiva->addValidation('Capacidade produtiva', new TRequiredValidator()); 
        $descricao_processos->addValidation('Descricao processos', new TRequiredValidator()); 
        $numero_operadores->addValidation('Numero operadores', new TRequiredValidator()); 
        $intervencoes_realizadas->addValidation('Intervencoes realizadas', new TRequiredValidator()); 

        $id->setEditable(false);
        $data_fabricacao->setMask('dd/mm/yyyy');
        $data_fabricacao->setDatabaseMask('yyyy-mm-dd');
        $vista_frontal->enableFileHandling();
        $vista_posterior->enableFileHandling();
        $vista_lateral_direita->enableFileHandling();
        $vista_lateral_esquerda->enableFileHandling();

        $id->setSize(100);
        $tag->setSize('70%');
        $nome->setSize('70%');
        $tipo->setSize('70%');
        $peso->setSize('70%');
        $setor->setSize('70%');
        $altura->setSize('70%');
        $modelo->setSize('70%');
        $outros->setSize('70%');
        $largura->setSize('70%');
        $utilizacao->setSize('70%');
        $fabricante->setSize('70%');
        $patrimonio->setSize('70%');
        $capacidade->setSize('70%');
        $tempo_ciclo->setSize('70%');
        $profundidade->setSize('70%');
        $numero_serie->setSize('70%');
        $fonte_energia->setSize('70%');
        $vista_frontal->setSize('70%');
        $data_fabricacao->setSize(110);
        $fabricante_cep->setSize('70%');
        $fabricante_cnpj->setSize('70%');
        $vista_posterior->setSize('70%');
        $numero_operadores->setSize('70%');
        $tempo_acionamento->setSize('70%');
        $empresa_unidade_id->setSize('72%');
        $descricao_processos->setSize('70%');
        $fabricante_endereco->setSize('70%');
        $capacidade_produtiva->setSize('70%');
        $fabricante_cidade_id->setSize('70%');
        $vista_lateral_direita->setSize('70%');
        $vista_lateral_esquerda->setSize('70%');
        $intervencoes_realizadas->setSize('70%');
        $tempo_parada_emergencia->setSize('70%');
        $numero_posicoes_comando->setSize('70%');
        $fabricante_registro_crea->setSize('70%');







        $this->form->appendPage('Equipamento');
        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Unidade (filial):', '#ff0000', '14px', null)],[$empresa_unidade_id]);
        $row2 = $this->form->addFields([new TLabel('Nome:', '#ff0000', '14px', null)],[$nome],[new TLabel('Tipo:', null, '14px', null)],[$tipo]);
        $row3 = $this->form->addFields([new TLabel('Modelo:', null, '14px', null)],[$modelo],[new TLabel('Numero serie:', null, '14px', null)],[$numero_serie]);
        $row4 = $this->form->addFields([new TLabel('Data fabricacao:', null, '14px', null)],[$data_fabricacao],[new TLabel('Peso:', null, '14px', null)],[$peso]);
        $row5 = $this->form->addFields([new TLabel('Capacidade:', null, '14px', null)],[$capacidade],[new TLabel('Setor:', null, '14px', null)],[$setor]);
        $row6 = $this->form->addFields([new TLabel('Tag:', null, '14px', null)],[$tag],[new TLabel('Patrimonio:', null, '14px', null)],[$patrimonio]);
        $row7 = $this->form->addFields([new TLabel('Altura:', null, '14px', null)],[$altura],[new TLabel('Largura:', null, '14px', null)],[$largura]);
        $row8 = $this->form->addFields([new TLabel('Profundidade:', null, '14px', null)],[$profundidade],[new TLabel('Vista frontal:', '#ff0000', '14px', null)],[$vista_frontal]);
        $row9 = $this->form->addFields([new TLabel('Vista lateral esquerda:', '#ff0000', '14px', null)],[$vista_lateral_esquerda],[new TLabel('Vista lateral direita:', '#ff0000', '14px', null)],[$vista_lateral_direita]);
        $row10 = $this->form->addFields([new TLabel('Vista posterior:', '#ff0000', '14px', null)],[$vista_posterior],[new TLabel('Utilizacao:', '#ff0000', '14px', null)],[$utilizacao]);
        $row11 = $this->form->addFields([new TLabel('Capacidade produtiva:', '#ff0000', '14px', null)],[$capacidade_produtiva],[new TLabel('Descricao processos:', '#ff0000', '14px', null)],[$descricao_processos]);
        $row12 = $this->form->addFields([new TLabel('Numero operadores:', '#ff0000', '14px', null)],[$numero_operadores],[new TLabel('Intervencoes realizadas:', '#ff0000', '14px', null)],[$intervencoes_realizadas]);
        $row13 = $this->form->addFields([new TLabel('Fonte energia:', null, '14px', null)],[$fonte_energia],[new TLabel('Tempo acionamento:', null, '14px', null)],[$tempo_acionamento]);
        $row14 = $this->form->addFields([new TLabel('Tempo ciclo:', null, '14px', null)],[$tempo_ciclo],[new TLabel('Tempo parada emergencia:', null, '14px', null)],[$tempo_parada_emergencia]);
        $row15 = $this->form->addFields([new TLabel('Numero posicoes comando:', null, '14px', null)],[$numero_posicoes_comando],[new TLabel('Outros:', null, '14px', null)],[$outros]);

        $this->form->appendPage('Fabricante');
        $row16 = $this->form->addFields([new TLabel('Rótulo:', null, '14px', null)],[]);
        $row17 = $this->form->addFields([new TLabel('Fabricante:', null, '14px', null)],[$fabricante],[new TLabel('Endereço:', null, '14px', null)],[$fabricante_endereco]);
        $row18 = $this->form->addFields([new TLabel('Cidade:', null, '14px', null)],[$fabricante_cidade_id],[new TLabel('CEP:', null, '14px', null)],[$fabricante_cep]);
        $row19 = $this->form->addFields([new TLabel('CNPJ:', null, '14px', null)],[$fabricante_cnpj],[new TLabel('CREA:', null, '14px', null)],[$fabricante_registro_crea]);

        //<onAfterFieldsCreation>

        //</onAfterFieldsCreation>

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Lançamentos','Cadastro de equipamento']));
        $container->add($this->form);

        //<onAfterPageCreation>

        //</onAfterPageCreation>

        parent::add($container);

    }

//<generated-FormAction-onSave>
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

            $object = new Equipamento(); // create an empty object //</blockLine>

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            //</beforeStoreAutoCode> //</blockLine> 
//<generatedAutoCode>

            $vista_frontal_dir = '../documents';
            $vista_lateral_esquerda_dir = '../documents';
            $vista_lateral_direita_dir = '../documents';
            $vista_posterior_dir = '../documents';
//</generatedAutoCode>

            $object->store(); // save the object //</blockLine>

            //</afterStoreAutoCode> //</blockLine>
 //<generatedAutoCode>

            $this->saveFile($object, $data, 'vista_frontal', $vista_frontal_dir);
            $this->saveFile($object, $data, 'vista_lateral_esquerda', $vista_lateral_esquerda_dir);
            $this->saveFile($object, $data, 'vista_lateral_direita', $vista_lateral_direita_dir);
            $this->saveFile($object, $data, 'vista_posterior', $vista_posterior_dir);
//</generatedAutoCode>

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; //</blockLine>

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'), $messageAction);

            //</endTryAutoCode> //</blockLine>

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> //</blockLine>

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
//</generated-FormAction-onSave>

//<generated-onEdit>
    public function onEdit( $param )//</ini>
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Equipamento($key); // instantiates the Active Record //</blockLine>

                //</beforeSetDataAutoCode> //</blockLine>

                $this->form->setData($object); // fill the form //</blockLine>

                //</afterSetDataAutoCode> //</blockLine>
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
    }//</end>
//</generated-onEdit>

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

        //<onFormClear>

        //</onFormClear>

    }

    public function onShow($param = null)
    {

        //<onShow>

        //</onShow>
    } 

    //</hideLine> <addUserFunctionsCode/>

    //<userCustomFunctions>

    //</userCustomFunctions>

}