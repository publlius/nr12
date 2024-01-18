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
        $empresa_id = new TDBCombo('empresa_id', 'nr12', 'Empresa', 'id', '{razao_social} ','id asc'  );
        $descricao_unidade = new TEntry('descricao_unidade');
        $estado_id = new TDBCombo('estado_id', 'nr12', 'Estado', 'id', '{nome} ','id asc'  );
        $cidade_id = new TCombo('cidade_id');

        $estado_id->setChangeAction(new TAction([$this,'onChangeestado_id']));

        $empresa_id->addValidation('Empresa', new TRequiredValidator()); 
        $descricao_unidade->addValidation('Descricao unidade', new TRequiredValidator()); 
        $estado_id->addValidation('Estado', new TRequiredValidator()); 
        $cidade_id->addValidation('Cidade', new TRequiredValidator()); 

        $id->setEditable(false);
        $id->setSize(100);
        $estado_id->setSize('70%');
        $cidade_id->setSize('70%');
        $empresa_id->setSize('70%');
        $descricao_unidade->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel('Empresa:', '#ff0000', '14px', null)],[$empresa_id]);
        $row3 = $this->form->addFields([new TLabel('Descricao unidade:', '#ff0000', '14px', null)],[$descricao_unidade]);
        $row4 = $this->form->addFields([new TLabel('Estado:', '#ff0000', '14px', null)],[$estado_id]);
        $row5 = $this->form->addFields([new TLabel('Cidade:', '#ff0000', '14px', null)],[$cidade_id]);

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

    public static function onChangeestado_id($param)
    {
        try
        {

            if (isset($param['estado_id']) && $param['estado_id'])
            { 
                $criteria = TCriteria::create(['estado_id' => (int) $param['estado_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'cidade_id', 'nr12', 'Cidade', 'id', '{nome} - {estado->uf} ', 'id asc', $criteria, TRUE); 
            } 
            else 
            { 
                TCombo::clearField(self::$formName, 'cidade_id'); 
            }  

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
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

            $this->fireEvents($object);

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

                                $object->estado_id = $object->estado->id;
                $object->cidade_id = $object->cidade->id;

                $this->form->setData($object); // fill the form 

                $this->fireEvents($object);

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

    public function fireEvents( $object )
    {
        $obj = new stdClass;
        if(is_object($object) && get_class($object) == 'stdClass')
        {
            if(isset($object->estado_id))
            {
                $obj->estado_id = $object->estado_id;
            }
            if(isset($object->cidade_id))
            {
                $obj->cidade_id = $object->cidade_id;
            }
        }
        elseif(is_object($object))
        {
            if(isset($object->estado->id))
            {
                $obj->estado_id = $object->estado->id;
            }
            if(isset($object->cidade->id))
            {
                $obj->cidade_id = $object->cidade->id;
            }
        }
        TForm::sendData(self::$formName, $obj);
    }  

}

