<?php

class DisposicoesFinaisForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'DisposicoesFinais';
    private static $primaryKey = 'id';
    private static $formName = 'form_DisposicoesFinais';

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
        $this->form->setFormTitle('Cadastro de disposicoes finais');


        $id = new TEntry('id');
        $apreciacao_id = new TDBCombo('apreciacao_id', 'nr12', 'Apreciacao', 'id', '{id} - {equipamento->empresa_unidade->descricao_unidade} -  {equipamento->nome} - {equipamento->patrimonio} ','id asc'  );
        $manutencao_ph = new TRadioGroup('manutencao_ph');
        $registro_manutencao = new TRadioGroup('registro_manutencao');
        $acesso_rm = new TRadioGroup('acesso_rm');
        $manuais = new TRadioGroup('manuais');
        $procedimento_ts = new TRadioGroup('procedimento_ts');
        $capacitacao = new TRadioGroup('capacitacao');
        $observacao = new TEntry('observacao');

        $apreciacao_id->addValidation('Apreciacao id', new TRequiredValidator()); 
        $manutencao_ph->addValidation('Manutencao ph', new TRequiredValidator()); 
        $registro_manutencao->addValidation('Registro manutencao', new TRequiredValidator()); 
        $acesso_rm->addValidation('Acesso rm', new TRequiredValidator()); 
        $manuais->addValidation('Manuais ', new TRequiredValidator()); 
        $procedimento_ts->addValidation('Procedimento ts', new TRequiredValidator()); 
        $capacitacao->addValidation('Capacitacao', new TRequiredValidator()); 
        $observacao->addValidation('Observacao', new TRequiredValidator()); 

        $observacao->setValue('informações fornecidas pela empresa/responsabilidade da empresa.');
        $id->setEditable(false);
        $observacao->setEditable(false);

        $manuais->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $capacitacao->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $manutencao_ph->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $procedimento_ts->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $registro_manutencao->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $acesso_rm->addItems(['Sim'=>'Sim','Não'=>'Não']);

        $manuais->setLayout('horizontal');
        $acesso_rm->setLayout('horizontal');
        $capacitacao->setLayout('horizontal');
        $manutencao_ph->setLayout('horizontal');
        $procedimento_ts->setLayout('horizontal');
        $registro_manutencao->setLayout('horizontal');

        $manuais->setUseButton();
        $acesso_rm->setUseButton();
        $capacitacao->setUseButton();
        $manutencao_ph->setUseButton();
        $procedimento_ts->setUseButton();
        $registro_manutencao->setUseButton();

        $id->setSize(100);
        $manuais->setSize(80);
        $acesso_rm->setSize(80);
        $capacitacao->setSize(80);
        $manutencao_ph->setSize(80);
        $observacao->setSize('70%');
        $procedimento_ts->setSize(80);
        $apreciacao_id->setSize('70%');
        $registro_manutencao->setSize(80);


        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Apreciação:', '#ff0000', '14px', null)],[$apreciacao_id]);
        $row2 = $this->form->addContent([new TFormSeparator('Manutenção, inspeção, preparação, ajuste, reparo e limpeza', '#333333', '18', '#eeeeee')]);
        $row3 = $this->form->addFields([new TLabel('As manutenções preventivas com potencial de causar acidentes do trabalho são objetos de planejamento e gerenciamento efetuado por profissional legalmente habilitado.', '#ff0000', '14px', null)],[$manutencao_ph]);
        $row3->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];

        $row4 = $this->form->addFields([new TLabel('As manutenções preventivas e corretivas são registradas em livro próprio, ficha ou sistema informatizado, com os seguintes dados: a) cronograma de manutenção; b) intervenções realizadas; c) data da realização de cada intervenção; d) serviço realizado; e) peças reparadas ou substituídas; f) condições de segurança do equipamento; g) indicação conclusiva quanto às condições de segurança da máquina; e h) nome do responsável pela execução das intervenções.', '#ff0000', '14px', null)],[$registro_manutencao]);
          $row4->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];
          
        $row5 = $this->form->addFields([new TLabel('O registro das manutenções está  disponível aos trabalhadores envolvidos na operação, manutenção e reparos, bem como à Comissão Interna de Prevenção de Acidentes - CIPA, ao Serviço de Segurança e Medicina do Trabalho - SESMT e à fiscalização do Ministério do Trabalho e Emprego.', '#ff0000', '14px', null)],[$acesso_rm]);
          $row5->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];
          
        $row6 = $this->form->addContent([new TFormSeparator('Manuais', '#333333', '18', '#eeeeee')]);
          $row6->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];
          
        $row7 = $this->form->addFields([new TLabel('As máquinas e equipamentos possuem manual de instruções fornecido pelo fabricante ou importador, com informações relativas à segurança em todas as fases de utilização.', '#ff0000', '14px', null)],[$manuais]);
          $row7->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];
          
        $row8 = $this->form->addContent([new TFormSeparator('Procedimentos de trabalho e segurança', '#333333', '18', '#eeeeee')]);
          $row8->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];
          
        $row9 = $this->form->addFields([new TLabel('A máquina possui procedimentos de trabalho e segurança específicos, padronizados, com descrição detalhada de cada tarefa, passo a passo, a partir da análise de risco.', '#ff0000', '14px', null)],[$procedimento_ts]);
        $row9->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];
          
        $row10 = $this->form->addContent([new TFormSeparator('Capacitação', '#333333', '18', '#eeeeee')]);
        $row10->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];
        
        $row11 = $this->form->addFields([new TLabel('Os trabalhadores envolvidos na operação, manutenção, inspeção e demais intervenções em máquinas e equipamentos possuem capacitação providenciada pelo empregador e compatível com suas funções, que aborde os riscos a que estão expostos e as medidas de proteção existentes e necessárias, nos termos desta Norma, para a prevenção de acidentes e doenças.', '#ff0000', '14px', null)],[$capacitacao]);
        $row11->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];        
        
        $row12 = $this->form->addContent([new TFormSeparator('Observação', '#333333', '18', '#eeeeee')]);
        $row12->layout = [' col-sm-12 col-lg-9 col-md-9',' col-xs-12 col-sm-12 col-lg-3 col-md-3'];
        
        $row13 = $this->form->addFields([$observacao]);
        $row13->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Lançamentos','Cadastro de disposicoes finais']));
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

            $object = new DisposicoesFinais(); // create an empty object 

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

                $object = new DisposicoesFinais($key); // instantiates the Active Record 

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

