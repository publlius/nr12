<?php

class EmpresaUnidadeForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'EmpresaUnidade';
    private static $primaryKey = 'id';
    private static $formName = 'form_EmpresaUnidade';

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
        $this->form->setFormTitle('Cadastro de empresa unidade');


        $id = new TEntry('id');
        $empresa_id = new TDBCombo('empresa_id', 'nr12', 'Empresa', 'id', '{id}','id asc'  );
        $descricao_unidade = new TEntry('descricao_unidade');
        $pais_id = new TDBCombo('pais_id', 'nr12', 'Pais', 'id', '{id}','id asc'  );
        $estado_id = new TDBCombo('estado_id', 'nr12', 'Estado', 'id', '{id}','id asc'  );
        $cidade_id = new TDBCombo('cidade_id', 'nr12', 'Cidade', 'id', '{id}','id asc'  );

        $empresa_id->addValidation('Empresa id', new TRequiredValidator()); 
        $descricao_unidade->addValidation('Descricao unidade', new TRequiredValidator()); 
        $pais_id->addValidation('Pais id', new TRequiredValidator()); 
        $estado_id->addValidation('Estado id', new TRequiredValidator()); 
        $cidade_id->addValidation('Cidade id', new TRequiredValidator()); 

        $id->setEditable(false);
        $id->setSize(100);
        $pais_id->setSize('70%');
        $estado_id->setSize('70%');
        $cidade_id->setSize('70%');
        $empresa_id->setSize('70%');
        $descricao_unidade->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel('Empresa id:', '#ff0000', '14px', null)],[$empresa_id]);
        $row3 = $this->form->addFields([new TLabel('Descricao unidade:', '#ff0000', '14px', null)],[$descricao_unidade]);
        $row4 = $this->form->addFields([new TLabel('Pais id:', '#ff0000', '14px', null)],[$pais_id]);
        $row5 = $this->form->addFields([new TLabel('Estado id:', '#ff0000', '14px', null)],[$estado_id]);
        $row6 = $this->form->addFields([new TLabel('Cidade id:', '#ff0000', '14px', null)],[$cidade_id]);

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

            $object = new EmpresaUnidade(); // create an empty object 

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

                $object = new EmpresaUnidade($key); // instantiates the Active Record 

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

