<?php

class PontoRiscoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'PontoRisco';
    private static $primaryKey = 'id';
    private static $formName = 'form_PontoRisco';

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
        $this->form->setFormTitle('Cadastro de ponto risco');


        $id = new TEntry('id');
        $apreciacao_id = new TDBCombo('apreciacao_id', 'nr12', 'Apreciacao', 'id', '{id}','id asc'  );
        $ponto_id = new TDBCombo('ponto_id', 'nr12', 'Ponto', 'id', '{id}','id asc'  );
        $risco_id = new TDBCombo('risco_id', 'nr12', 'Risco', 'id', '{risco}','risco asc'  );

        $apreciacao_id->addValidation('Apreciacao id', new TRequiredValidator()); 
        $ponto_id->addValidation('Ponto id', new TRequiredValidator()); 
        $risco_id->addValidation('Risco id', new TRequiredValidator()); 

        $id->setEditable(false);
        $id->setSize(100);
        $ponto_id->setSize('70%');
        $risco_id->setSize('70%');
        $apreciacao_id->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Apreciacao id:', '#ff0000', '14px', null)],[$apreciacao_id]);
        $row2 = $this->form->addFields([new TLabel('Ponto id:', '#ff0000', '14px', null)],[$ponto_id],[new TLabel('Risco id:', '#ff0000', '14px', null)],[$risco_id]);

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

            $object = new PontoRisco(); // create an empty object 

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

                $object = new PontoRisco($key); // instantiates the Active Record 

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

