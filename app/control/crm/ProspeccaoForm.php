<?php

class ProspeccaoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'Prospeccao';
    private static $primaryKey = 'id';
    private static $formName = 'form_Prospeccao';

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
        $this->form->setFormTitle('Prospecção de cliente');


        $id = new TEntry('id');
        $estado_id = new TDBCombo('estado_id', 'nr12', 'Estado', 'id', '{id}','id asc'  );
        $cidade_id = new TDBCombo('cidade_id', 'nr12', 'Cidade', 'id', '{id}','id asc'  );
        $empresa = new TEntry('empresa');
        $site = new TEntry('site');
        $ramo = new TEntry('ramo');
        $porte = new TEntry('porte');
        $telefone = new TEntry('telefone');
        $data_contato = new TDateTime('data_contato');
        $retornar_em = new TDateTime('retornar_em');
        $cor = new TEntry('cor');
        $criado_em = new TDateTime('criado_em');
        $criado_por_system_users_id = new TDBCombo('criado_por_system_users_id', 'nr12', 'SystemUsers', 'id', '{name}','name asc'  );
        $alterado_em = new TDateTime('alterado_em');
        $alterado_por_system_users_id = new TDBCombo('alterado_por_system_users_id', 'nr12', 'SystemUsers', 'id', '{name}','name asc'  );
        $status = new TEntry('status');
        $observacao = new TEntry('observacao');

        $estado_id->addValidation('Estado id', new TRequiredValidator()); 
        $cidade_id->addValidation('Cidade id', new TRequiredValidator()); 
        $empresa->addValidation('Empresa', new TRequiredValidator()); 
        $status->addValidation('Status', new TRequiredValidator()); 

        $id->setEditable(false);

        $criado_em->setMask('dd/mm/yyyy hh:ii');
        $retornar_em->setMask('dd/mm/yyyy hh:ii');
        $alterado_em->setMask('dd/mm/yyyy hh:ii');
        $data_contato->setMask('dd/mm/yyyy hh:ii');

        $criado_em->setDatabaseMask('yyyy-mm-dd hh:ii');
        $retornar_em->setDatabaseMask('yyyy-mm-dd hh:ii');
        $alterado_em->setDatabaseMask('yyyy-mm-dd hh:ii');
        $data_contato->setDatabaseMask('yyyy-mm-dd hh:ii');

        $id->setSize(100);
        $cor->setSize('70%');
        $site->setSize('70%');
        $ramo->setSize('70%');
        $porte->setSize('70%');
        $status->setSize('70%');
        $empresa->setSize('70%');
        $criado_em->setSize(150);
        $telefone->setSize('70%');
        $alterado_em->setSize(150);
        $cidade_id->setSize('70%');
        $estado_id->setSize('70%');
        $retornar_em->setSize(150);
        $data_contato->setSize(150);
        $observacao->setSize('70%');
        $criado_por_system_users_id->setSize('70%');
        $alterado_por_system_users_id->setSize('70%');

        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel('Estado id:', '#ff0000', '14px', null)],[$estado_id]);
        $row3 = $this->form->addFields([new TLabel('Cidade id:', '#ff0000', '14px', null)],[$cidade_id]);
        $row4 = $this->form->addFields([new TLabel('Empresa:', '#ff0000', '14px', null)],[$empresa]);
        $row5 = $this->form->addFields([new TLabel('Site:', null, '14px', null)],[$site]);
        $row6 = $this->form->addFields([new TLabel('Ramo:', null, '14px', null)],[$ramo]);
        $row7 = $this->form->addFields([new TLabel('Porte:', null, '14px', null)],[$porte]);
        $row8 = $this->form->addFields([new TLabel('Telefone:', null, '14px', null)],[$telefone]);
        $row9 = $this->form->addFields([new TLabel('Data contato:', null, '14px', null)],[$data_contato]);
        $row10 = $this->form->addFields([new TLabel('Retornar em:', null, '14px', null)],[$retornar_em]);
        $row11 = $this->form->addFields([new TLabel('Cor:', null, '14px', null)],[$cor]);
        $row12 = $this->form->addFields([new TLabel('Criado em:', null, '14px', null)],[$criado_em]);
        $row13 = $this->form->addFields([new TLabel('Criado por system users id:', null, '14px', null)],[$criado_por_system_users_id]);
        $row14 = $this->form->addFields([new TLabel('Alterado em:', null, '14px', null)],[$alterado_em]);
        $row15 = $this->form->addFields([new TLabel('Alterado por system users id:', null, '14px', null)],[$alterado_por_system_users_id]);
        $row16 = $this->form->addFields([new TLabel('Status:', '#ff0000', '14px', null)],[$status]);
        $row17 = $this->form->addFields([new TLabel('Observacao:', null, '14px', null)],[$observacao]);

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['CRM','Prospecção de cliente']));
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

            $object = new Prospeccao(); // create an empty object 

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

                $object = new Prospeccao($key); // instantiates the Active Record 

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

