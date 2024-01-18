<?php

class ItemNormaForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'ItemNorma';
    private static $primaryKey = 'id';
    private static $formName = 'form_ItemNorma';

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
        $this->form->setFormTitle('Cadastro de item norma');


        $id = new TEntry('id');
        $codigo_item_norma = new TEntry('codigo_item_norma');
        $descricao_item_norma = new TEntry('descricao_item_norma');
        $titulo_id = new TDBCombo('titulo_id', 'nr12', 'TituloParecerTecnico', 'id', '{titulo_parecer_tecnico}','titulo_parecer_tecnico asc'  );
        $status_item_id = new TDBCombo('status_item_id', 'nr12', 'StatusItem', 'id', '{status_item}','status_item asc'  );
        $observacao = new TEntry('observacao');

        $codigo_item_norma->addValidation('Codigo item norma', new TRequiredValidator()); 
        $descricao_item_norma->addValidation('Descricao item norma', new TRequiredValidator()); 
        $titulo_id->addValidation('Título', new TRequiredValidator()); 
        $status_item_id->addValidation('Status item', new TRequiredValidator()); 

        $id->setEditable(false);
        $id->setSize(100);
        $titulo_id->setSize('70%');
        $observacao->setSize('70%');
        $status_item_id->setSize('70%');
        $codigo_item_norma->setSize('70%');
        $descricao_item_norma->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel('Código item norma:', '#ff0000', '14px', null)],[$codigo_item_norma]);
        $row3 = $this->form->addFields([new TLabel('Descrição item norma:', '#ff0000', '14px', null)],[$descricao_item_norma]);
        $row4 = $this->form->addFields([new TLabel('Título:', '#ff0000', '14px', null)],[$titulo_id]);
        $row5 = $this->form->addFields([new TLabel('Status item:', '#ff0000', '14px', null)],[$status_item_id]);
        $row6 = $this->form->addFields([new TLabel('Observação:', null, '14px', null)],[$observacao]);

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Cadastros','Cadastro de item norma']));
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

            $object = new ItemNorma(); // create an empty object 

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

                $object = new ItemNorma($key); // instantiates the Active Record 

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

