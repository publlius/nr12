<?php

class EmpresaForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'Empresa';
    private static $primaryKey = 'id';
    private static $formName = 'form_Empresa';

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
        $this->form->setFormTitle('Cadastro de empresa');


        $id = new TEntry('id');
        $razao_social = new TEntry('razao_social');
        $nome_fantasia = new TEntry('nome_fantasia');
        $cnpj = new TEntry('cnpj');
        $ie = new TEntry('ie');
        $im = new TEntry('im');
        $cnae_principal = new TEntry('cnae_principal');
        $cnae_secundario = new TEntry('cnae_secundario');
        $pais_id = new TDBCombo('pais_id', 'nr12', 'Pais', 'id', '{nome}','id asc'  );
        $estado_id = new TDBCombo('estado_id', 'nr12', 'Estado', 'id', '{nome} - {uf} ','id asc'  );
        $cidade_id = new TEntry('cidade_id');
        $endereco = new TEntry('endereco');

        $razao_social->addValidation('Razao social', new TRequiredValidator()); 
        $nome_fantasia->addValidation('Nome fantasia', new TRequiredValidator()); 

        $id->setEditable(false);
        $cnpj->setMask('11.111.111/1111-11');
        $id->setSize(100);
        $ie->setSize(200);
        $im->setSize(200);
        $cnpj->setSize(200);
        $pais_id->setSize('70%');
        $endereco->setSize('70%');
        $estado_id->setSize('70%');
        $cidade_id->setSize('70%');
        $razao_social->setSize('70%');
        $nome_fantasia->setSize('70%');
        $cnae_principal->setSize('70%');
        $cnae_secundario->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel('Razao social:', '#ff0000', '14px', null)],[$razao_social]);
        $row3 = $this->form->addFields([new TLabel('Nome fantasia:', '#ff0000', '14px', null)],[$nome_fantasia]);
        $row4 = $this->form->addFields([new TLabel('CNPJ:', null, '14px', null)],[$cnpj]);
        $row5 = $this->form->addFields([new TLabel('Ie:', null, '14px', null)],[$ie]);
        $row6 = $this->form->addFields([new TLabel('Im:', null, '14px', null)],[$im]);
        $row7 = $this->form->addFields([new TLabel('Cnae principal:', null, '14px', null)],[$cnae_principal]);
        $row8 = $this->form->addFields([new TLabel('Cnae secundario:', null, '14px', null)],[$cnae_secundario]);
        $row9 = $this->form->addFields([new TLabel('País:', null, '14px', null)],[$pais_id]);
        $row10 = $this->form->addFields([new TLabel('UF:', null, '14px', null)],[$estado_id]);
        $row11 = $this->form->addFields([new TLabel('Cidade:', null, '14px', null)],[$cidade_id]);
        $row12 = $this->form->addFields([new TLabel('Endereco:', null, '14px', null)],[$endereco]);

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

            $object = new Empresa(); // create an empty object 

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

                $object = new Empresa($key); // instantiates the Active Record 

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

