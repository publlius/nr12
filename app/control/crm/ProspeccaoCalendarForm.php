<?php

class ProspeccaoCalendarForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'Prospeccao';
    private static $primaryKey = 'id';
    private static $formName = 'form_Prospeccao';
    private static $startDateField = 'data_contato';
    private static $endDateField = 'retornar_em';

    use Adianti\Base\AdiantiMasterDetailTrait;

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.80, null);
        parent::setTitle('Prospecção de clientes');
        parent::setProperty('class', 'window_modal');

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle('Prospecção de clientes');

        $view = new THidden('view');

        $id = new TEntry('id');
        $empresa = new TEntry('empresa');
        $estado_id = new TDBCombo('estado_id', 'nr12', 'Estado', 'id', '{uf} {nome} ','uf asc'  );
        $cidade_id = new TCombo('cidade_id');
        $site = new TEntry('site');
        $ramo = new TEntry('ramo');
        $porte = new TEntry('porte');
        $telefone = new TEntry('telefone');
        $prospeccao_contato_prospeccao_nome = new TEntry('prospeccao_contato_prospeccao_nome');
        $prospeccao_contato_prospeccao_cargo = new TEntry('prospeccao_contato_prospeccao_cargo');
        $prospeccao_contato_prospeccao_fone = new TEntry('prospeccao_contato_prospeccao_fone');
        $prospeccao_contato_prospeccao_celular = new TEntry('prospeccao_contato_prospeccao_celular');
        $prospeccao_contato_prospeccao_email = new TEntry('prospeccao_contato_prospeccao_email');
        $prospeccao_conversa_prospeccao_resumo = new TText('prospeccao_conversa_prospeccao_resumo');
        $prospeccao_conversa_prospeccao_data_conversa = new TDateTime('prospeccao_conversa_prospeccao_data_conversa');
        $observacao = new TText('observacao');
        $status = new TCombo('status');
        $data_contato = new TDateTime('data_contato');
        $retornar_em = new THidden('retornar_em');
        $cor = new TColor('cor');
        $prospeccao_contato_prospeccao_id = new THidden('prospeccao_contato_prospeccao_id');
        $prospeccao_conversa_prospeccao_id = new THidden('prospeccao_conversa_prospeccao_id');

        $estado_id->setChangeAction(new TAction([$this,'onChangeestado_id']));

        $empresa->addValidation('Empresa', new TRequiredValidator()); 
        $estado_id->addValidation('Estado id', new TRequiredValidator()); 
        $cidade_id->addValidation('Cidade id', new TRequiredValidator()); 
        $status->addValidation('Status', new TRequiredValidator()); 

        $id->setEditable(false);
        $status->addItems(['Sem interesse'=>'Sem interesse','Já adequando'=>'Já adequando','Há interesse'=>'Há interesse','Em andamento'=>'Em andamento','Finalizado positivo'=>'Finalizado positivo','Encerrado'=>'Encerrado']);

        $data_contato->setMask('dd/mm/yyyy hh:ii');
        $prospeccao_conversa_prospeccao_data_conversa->setMask('dd/mm/yyyy hh:ii');

        $data_contato->setDatabaseMask('yyyy-mm-dd hh:ii');
        $prospeccao_conversa_prospeccao_data_conversa->setDatabaseMask('yyyy-mm-dd hh:ii');

        $id->setSize(100);
        $cor->setSize(100);
        $site->setSize('70%');
        $ramo->setSize('70%');
        $porte->setSize('70%');
        $status->setSize('70%');
        $empresa->setSize('72%');
        $telefone->setSize('70%');
        $estado_id->setSize('70%');
        $retornar_em->setSize(200);
        $cidade_id->setSize('70%');
        $data_contato->setSize(150);
        $observacao->setSize('95%', 88);
        $prospeccao_contato_prospeccao_fone->setSize('50%');
        $prospeccao_contato_prospeccao_nome->setSize('90%');
        $prospeccao_contato_prospeccao_email->setSize('72%');
        $prospeccao_contato_prospeccao_cargo->setSize('50%');
        $prospeccao_contato_prospeccao_celular->setSize('50%');
        $prospeccao_conversa_prospeccao_resumo->setSize('72%', 86);
        $prospeccao_conversa_prospeccao_data_conversa->setSize(160);

        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[],[]);
        $row2 = $this->form->addFields([new TLabel('Empresa:', '#ff0000', '14px', null)],[$empresa]);
        $row3 = $this->form->addFields([new TLabel('Estado:', '#ff0000', '14px', null)],[$estado_id],[new TLabel('Cidade:', '#ff0000', '14px', null)],[$cidade_id]);
        $row4 = $this->form->addFields([new TLabel('Site:', null, '14px', null)],[$site],[new TLabel('Ramo:', null, '14px', null)],[$ramo]);
        $row5 = $this->form->addFields([new TLabel('Porte:', null, '14px', null)],[$porte],[new TLabel('Telefone:', null, '14px', null)],[$telefone]);
        $row6 = $this->form->addContent([new TFormSeparator('Contatos (Pessoas)', '#333333', '18', '#eeeeee')]);
        $row7 = $this->form->addFields([new TLabel('Nome:', null, '14px', null)],[$prospeccao_contato_prospeccao_nome],[new TLabel('Cargo:', null, '14px', null)],[$prospeccao_contato_prospeccao_cargo]);
        $row8 = $this->form->addFields([new TLabel('Fone:', null, '14px', null)],[$prospeccao_contato_prospeccao_fone],[new TLabel('Celular:', null, '14px', null)],[$prospeccao_contato_prospeccao_celular]);
        $row9 = $this->form->addFields([new TLabel('Email:', null, '14px', null)],[$prospeccao_contato_prospeccao_email]);
        $row10 = $this->form->addFields([$prospeccao_contato_prospeccao_id]);         
        $add_prospeccao_contato_prospeccao = new TButton('add_prospeccao_contato_prospeccao');

        $action_prospeccao_contato_prospeccao = new TAction(array($this, 'onAddProspeccaoContatoProspeccao'));

        $add_prospeccao_contato_prospeccao->setAction($action_prospeccao_contato_prospeccao, 'Adicionar');
        $add_prospeccao_contato_prospeccao->setImage('fa:plus #000000');

        $this->form->addFields([$add_prospeccao_contato_prospeccao]);

        $this->prospeccao_contato_prospeccao_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->prospeccao_contato_prospeccao_list->style = 'width:100%';
        $this->prospeccao_contato_prospeccao_list->class .= ' table-bordered';
        $this->prospeccao_contato_prospeccao_list->disableDefaultClick();
        $this->prospeccao_contato_prospeccao_list->addQuickColumn('', 'edit', 'left', 50);
        $this->prospeccao_contato_prospeccao_list->addQuickColumn('', 'delete', 'left', 50);

        $column_prospeccao_contato_prospeccao_nome = $this->prospeccao_contato_prospeccao_list->addQuickColumn('Nome', 'prospeccao_contato_prospeccao_nome', 'left');
        $column_prospeccao_contato_prospeccao_cargo = $this->prospeccao_contato_prospeccao_list->addQuickColumn('Cargo', 'prospeccao_contato_prospeccao_cargo', 'left');
        $column_prospeccao_contato_prospeccao_fone = $this->prospeccao_contato_prospeccao_list->addQuickColumn('Fone', 'prospeccao_contato_prospeccao_fone', 'left');
        $column_prospeccao_contato_prospeccao_celular = $this->prospeccao_contato_prospeccao_list->addQuickColumn('Celular', 'prospeccao_contato_prospeccao_celular', 'left');
        $column_prospeccao_contato_prospeccao_email = $this->prospeccao_contato_prospeccao_list->addQuickColumn('Email', 'prospeccao_contato_prospeccao_email', 'left');

        $this->prospeccao_contato_prospeccao_list->createModel();
        $this->form->addContent([$this->prospeccao_contato_prospeccao_list]);
        $row11 = $this->form->addContent([new TFormSeparator('Conversas', '#333333', '18', '#eeeeee')]);
        $row12 = $this->form->addFields([new TLabel('Resumo:', '#ff0000', '14px', null)],[$prospeccao_conversa_prospeccao_resumo]);
        $row13 = $this->form->addFields([new TLabel('Data conversa:', '#ff0000', '14px', null)],[$prospeccao_conversa_prospeccao_data_conversa]);
        $row14 = $this->form->addFields([$prospeccao_conversa_prospeccao_id]);         
        $add_prospeccao_conversa_prospeccao = new TButton('add_prospeccao_conversa_prospeccao');

        $action_prospeccao_conversa_prospeccao = new TAction(array($this, 'onAddProspeccaoConversaProspeccao'));

        $add_prospeccao_conversa_prospeccao->setAction($action_prospeccao_conversa_prospeccao, 'Adicionar');
        $add_prospeccao_conversa_prospeccao->setImage('fa:plus #000000');

        $this->form->addFields([$add_prospeccao_conversa_prospeccao]);

        $this->prospeccao_conversa_prospeccao_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->prospeccao_conversa_prospeccao_list->style = 'width:100%';
        $this->prospeccao_conversa_prospeccao_list->class .= ' table-bordered';
        $this->prospeccao_conversa_prospeccao_list->disableDefaultClick();
        $this->prospeccao_conversa_prospeccao_list->addQuickColumn('', 'edit', 'left', 50);
        $this->prospeccao_conversa_prospeccao_list->addQuickColumn('', 'delete', 'left', 50);

        $column_prospeccao_conversa_prospeccao_resumo = $this->prospeccao_conversa_prospeccao_list->addQuickColumn('Resumo', 'prospeccao_conversa_prospeccao_resumo', 'left');
        $column_prospeccao_conversa_prospeccao_data_conversa_transformed = $this->prospeccao_conversa_prospeccao_list->addQuickColumn('Data conversa', 'prospeccao_conversa_prospeccao_data_conversa', 'left');

        $this->prospeccao_conversa_prospeccao_list->createModel();
        $this->form->addContent([$this->prospeccao_conversa_prospeccao_list]);

        $column_prospeccao_conversa_prospeccao_data_conversa_transformed->setTransformer(function($value, $object, $row)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y H:i');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });        $row15 = $this->form->addFields([new TLabel('Observações gerais sobre a empresa:', null, '14px', null)],[$observacao],[new TLabel('Status da prospecção:', null, '14px', null)],[$status]);
        $row16 = $this->form->addFields([new TLabel('Retornar em:', '#ff0000', '14px', null)],[$data_contato,$retornar_em],[new TLabel('Cor:', null, '14px', null)],[$cor]);

        $this->form->addFields([$view]);

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        $btn_ondelete = $this->form->addAction('Excluir', new TAction([$this, 'onDelete']), 'fa:trash-o #dd5a43');

        parent::add($this->form);
    }

    public static function onChangeestado_id($param)
    {
        try
        {

            if (isset($param['estado_id']) && $param['estado_id'])
            { 
                $criteria = TCriteria::create(['estado_id' => (int) $param['estado_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'cidade_id', 'nr12', 'Cidade', 'id', '{nome} ', 'id asc', $criteria, TRUE); 
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

            $object = new Prospeccao(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            if (empty($object->id))
            {
                $object->criado_por_system_users_id = TSession::getValue('userid');
                $object->criado_em = date('Y-m-d H:i:s');
                $object->data_conversa = date('Y-m-d H:i:s');
            } else {
                $object->alterado_por_system_users_id = TSession::getValue('userid');
                $object->alterado_em = date('Y-m-d H:i:s');
            }

            $object->store(); // save the object 

            $this->fireEvents($object);

            $messageAction = new TAction(['ProspeccaoCalendarFormView', 'onReload']);
            $messageAction->setParameter('view', $data->view);
            $messageAction->setParameter('date', explode(' ', $data->data_contato)[0]);

            $prospeccao_conversa_prospeccao_items = $this->storeItems('ProspeccaoConversa', 'prospeccao_id', $object, 'prospeccao_conversa_prospeccao', function($masterObject, $detailObject){ 

                //code here

            }); 

            $prospeccao_contato_prospeccao_items = $this->storeItems('ProspeccaoContato', 'prospeccao_id', $object, 'prospeccao_contato_prospeccao', function($masterObject, $detailObject){ 

                //code here

            }); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'), $messageAction);

                TWindow::closeWindow(parent::getId()); 

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    public function onDelete($param = null) 
    {
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                $key = $param[self::$primaryKey];

                // open a transaction with database
                TTransaction::open(self::$database);

                $class = self::$activeRecord;

                // instantiates object
                $object = new $class($key, FALSE);

                // deletes the object from the database
                $object->delete();

                // close the transaction
                TTransaction::close();

                $messageAction = new TAction(array(__CLASS__.'View', 'onReload'));
                $messageAction->setParameter('view', $param['view']);
                $messageAction->setParameter('date', explode(' ',$param[self::$startDateField])[0]);

                // shows the success message
                new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'), $messageAction);
            }
            catch (Exception $e) // in case of exception
            {
                // shows the exception error message
                new TMessage('error', $e->getMessage());
                // undo all pending operations
                TTransaction::rollback();
            }
        }
        else
        {
            // define the delete action
            $action = new TAction(array($this, 'onDelete'));
            $action->setParameters((array) $this->form->getData());
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
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

                                $object->estado_id = $object->estado->id;
                $object->cidade_id = $object->cidade->id;
                $object->view = $param['view']; 

                $prospeccao_conversa_prospeccao_items = $this->loadItems('ProspeccaoConversa', 'prospeccao_id', $object, 'prospeccao_conversa_prospeccao', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $prospeccao_contato_prospeccao_items = $this->loadItems('ProspeccaoContato', 'prospeccao_id', $object, 'prospeccao_contato_prospeccao', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $this->form->setData($object); // fill the form 

                $this->fireEvents($object);
                $this->onReload();

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

        TSession::setValue('prospeccao_contato_prospeccao_items', null);
        TSession::setValue('prospeccao_conversa_prospeccao_items', null);

        $this->onReload();
    }

    public function onAddProspeccaoContatoProspeccao( $param )
    {
        try
        {
            $data = $this->form->getData();

            $prospeccao_contato_prospeccao_items = TSession::getValue('prospeccao_contato_prospeccao_items');
            $key = isset($data->prospeccao_contato_prospeccao_id) && $data->prospeccao_contato_prospeccao_id ? $data->prospeccao_contato_prospeccao_id : uniqid();
            $fields = []; 

            $fields['prospeccao_contato_prospeccao_nome'] = $data->prospeccao_contato_prospeccao_nome;
            $fields['prospeccao_contato_prospeccao_cargo'] = $data->prospeccao_contato_prospeccao_cargo;
            $fields['prospeccao_contato_prospeccao_fone'] = $data->prospeccao_contato_prospeccao_fone;
            $fields['prospeccao_contato_prospeccao_celular'] = $data->prospeccao_contato_prospeccao_celular;
            $fields['prospeccao_contato_prospeccao_email'] = $data->prospeccao_contato_prospeccao_email;
            $prospeccao_contato_prospeccao_items[ $key ] = $fields;

            TSession::setValue('prospeccao_contato_prospeccao_items', $prospeccao_contato_prospeccao_items);

            $data->prospeccao_contato_prospeccao_id = '';
            $data->prospeccao_contato_prospeccao_nome = '';
            $data->prospeccao_contato_prospeccao_cargo = '';
            $data->prospeccao_contato_prospeccao_fone = '';
            $data->prospeccao_contato_prospeccao_celular = '';
            $data->prospeccao_contato_prospeccao_email = '';

            $this->form->setData($data);
            $this->fireEvents($data);
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            $this->fireEvents($data);
            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditProspeccaoContatoProspeccao( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('prospeccao_contato_prospeccao_items');

        // get the session item
        $item = $items[$param['prospeccao_contato_prospeccao_id_row_id']];

        $data->prospeccao_contato_prospeccao_nome = $item['prospeccao_contato_prospeccao_nome'];
        $data->prospeccao_contato_prospeccao_cargo = $item['prospeccao_contato_prospeccao_cargo'];
        $data->prospeccao_contato_prospeccao_fone = $item['prospeccao_contato_prospeccao_fone'];
        $data->prospeccao_contato_prospeccao_celular = $item['prospeccao_contato_prospeccao_celular'];
        $data->prospeccao_contato_prospeccao_email = $item['prospeccao_contato_prospeccao_email'];

        $data->prospeccao_contato_prospeccao_id = $param['prospeccao_contato_prospeccao_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->fireEvents($data);

        $this->onReload( $param );
    }

    public function onDeleteProspeccaoContatoProspeccao( $param )
    {
        $data = $this->form->getData();

        $data->prospeccao_contato_prospeccao_nome = '';
        $data->prospeccao_contato_prospeccao_cargo = '';
        $data->prospeccao_contato_prospeccao_fone = '';
        $data->prospeccao_contato_prospeccao_celular = '';
        $data->prospeccao_contato_prospeccao_email = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('prospeccao_contato_prospeccao_items');

        // delete the item from session
        unset($items[$param['prospeccao_contato_prospeccao_id_row_id']]);
        TSession::setValue('prospeccao_contato_prospeccao_items', $items);

        $this->fireEvents($data);

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadProspeccaoContatoProspeccao( $param )
    {
        $items = TSession::getValue('prospeccao_contato_prospeccao_items'); 

        $this->prospeccao_contato_prospeccao_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteProspeccaoContatoProspeccao')); 
                $action_del->setParameter('prospeccao_contato_prospeccao_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditProspeccaoContatoProspeccao'));  
                $action_edi->setParameter('prospeccao_contato_prospeccao_id_row_id', $key);  

                $button_del = new TButton('delete_prospeccao_contato_prospeccao'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_prospeccao_contato_prospeccao'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                $rowItem->prospeccao_contato_prospeccao_nome = isset($item['prospeccao_contato_prospeccao_nome']) ? $item['prospeccao_contato_prospeccao_nome'] : '';
                $rowItem->prospeccao_contato_prospeccao_cargo = isset($item['prospeccao_contato_prospeccao_cargo']) ? $item['prospeccao_contato_prospeccao_cargo'] : '';
                $rowItem->prospeccao_contato_prospeccao_fone = isset($item['prospeccao_contato_prospeccao_fone']) ? $item['prospeccao_contato_prospeccao_fone'] : '';
                $rowItem->prospeccao_contato_prospeccao_celular = isset($item['prospeccao_contato_prospeccao_celular']) ? $item['prospeccao_contato_prospeccao_celular'] : '';
                $rowItem->prospeccao_contato_prospeccao_email = isset($item['prospeccao_contato_prospeccao_email']) ? $item['prospeccao_contato_prospeccao_email'] : '';

                $row = $this->prospeccao_contato_prospeccao_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddProspeccaoConversaProspeccao( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->prospeccao_conversa_prospeccao_resumo)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Resumo'));
            }             

            $prospeccao_conversa_prospeccao_items = TSession::getValue('prospeccao_conversa_prospeccao_items');
            $key = isset($data->prospeccao_conversa_prospeccao_id) && $data->prospeccao_conversa_prospeccao_id ? $data->prospeccao_conversa_prospeccao_id : uniqid();
            $fields = []; 

            $fields['prospeccao_conversa_prospeccao_resumo'] = $data->prospeccao_conversa_prospeccao_resumo;
            $fields['prospeccao_conversa_prospeccao_data_conversa'] = $data->prospeccao_conversa_prospeccao_data_conversa;
            $prospeccao_conversa_prospeccao_items[ $key ] = $fields;

            TSession::setValue('prospeccao_conversa_prospeccao_items', $prospeccao_conversa_prospeccao_items);

            $data->prospeccao_conversa_prospeccao_id = '';
            $data->prospeccao_conversa_prospeccao_resumo = '';
            $data->prospeccao_conversa_prospeccao_data_conversa = '';

            $this->form->setData($data);
            $this->fireEvents($data);
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            $this->fireEvents($data);
            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditProspeccaoConversaProspeccao( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('prospeccao_conversa_prospeccao_items');

        // get the session item
        $item = $items[$param['prospeccao_conversa_prospeccao_id_row_id']];

        $data->prospeccao_conversa_prospeccao_resumo = $item['prospeccao_conversa_prospeccao_resumo'];
        $data->prospeccao_conversa_prospeccao_data_conversa = $item['prospeccao_conversa_prospeccao_data_conversa'];

        $data->prospeccao_conversa_prospeccao_id = $param['prospeccao_conversa_prospeccao_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->fireEvents($data);

        $this->onReload( $param );
    }

    public function onDeleteProspeccaoConversaProspeccao( $param )
    {
        $data = $this->form->getData();

        $data->prospeccao_conversa_prospeccao_resumo = '';
        $data->prospeccao_conversa_prospeccao_data_conversa = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('prospeccao_conversa_prospeccao_items');

        // delete the item from session
        unset($items[$param['prospeccao_conversa_prospeccao_id_row_id']]);
        TSession::setValue('prospeccao_conversa_prospeccao_items', $items);

        $this->fireEvents($data);

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadProspeccaoConversaProspeccao( $param )
    {
        $items = TSession::getValue('prospeccao_conversa_prospeccao_items'); 

        $this->prospeccao_conversa_prospeccao_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteProspeccaoConversaProspeccao')); 
                $action_del->setParameter('prospeccao_conversa_prospeccao_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditProspeccaoConversaProspeccao'));  
                $action_edi->setParameter('prospeccao_conversa_prospeccao_id_row_id', $key);  

                $button_del = new TButton('delete_prospeccao_conversa_prospeccao'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_prospeccao_conversa_prospeccao'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                $rowItem->prospeccao_contato_prospeccao_nome = isset($item['prospeccao_contato_prospeccao_nome']) ? $item['prospeccao_contato_prospeccao_nome'] : '';
                $rowItem->prospeccao_contato_prospeccao_cargo = isset($item['prospeccao_contato_prospeccao_cargo']) ? $item['prospeccao_contato_prospeccao_cargo'] : '';
                $rowItem->prospeccao_contato_prospeccao_fone = isset($item['prospeccao_contato_prospeccao_fone']) ? $item['prospeccao_contato_prospeccao_fone'] : '';
                $rowItem->prospeccao_contato_prospeccao_celular = isset($item['prospeccao_contato_prospeccao_celular']) ? $item['prospeccao_contato_prospeccao_celular'] : '';
                $rowItem->prospeccao_contato_prospeccao_email = isset($item['prospeccao_contato_prospeccao_email']) ? $item['prospeccao_contato_prospeccao_email'] : '';
                $rowItem->prospeccao_conversa_prospeccao_resumo = isset($item['prospeccao_conversa_prospeccao_resumo']) ? $item['prospeccao_conversa_prospeccao_resumo'] : '';
                $rowItem->prospeccao_conversa_prospeccao_data_conversa = isset($item['prospeccao_conversa_prospeccao_data_conversa']) ? $item['prospeccao_conversa_prospeccao_data_conversa'] : '';

                $row = $this->prospeccao_conversa_prospeccao_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onShow($param = null)
    {
        TSession::setValue('prospeccao_contato_prospeccao_items', null);
        TSession::setValue('prospeccao_conversa_prospeccao_items', null);

        $this->onReload();

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

    public function onReload($params = null)
    {
        $this->loaded = TRUE;

        $this->onReloadProspeccaoContatoProspeccao($params);
        $this->onReloadProspeccaoConversaProspeccao($params);
    }

    public function show() 
    { 
        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') ) 
        { 
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }

    public function onStartEdit($param)
    {
        TSession::setValue('prospeccao_contato_prospeccao_items', null);
        TSession::setValue('prospeccao_conversa_prospeccao_items', null);

        $this->form->clear(true);

        $data = new stdClass;
        $data->view = $param['view']; // calendar view
        $data->cor = '#3a87ad';

        if ($param['date'])
        {
            if(strlen($param['date']) == '10')
                $param['date'].= ' 09:00';

            $data->data_contato = str_replace('T', ' ', $param['date']);

            $retornar_em = new DateTime($data->data_contato);
            $retornar_em->add(new DateInterval('PT1H'));
            $data->retornar_em = $retornar_em->format('Y-m-d H:i:s');

            $this->form->setData( $data );
        }
    }

    public static function onUpdateEvent($param)
    {
        try
        {
            if (isset($param['id']))
            {
                TTransaction::open(self::$database);

                $class = self::$activeRecord;
                $object = new $class($param['id']);

                $object->data_contato = str_replace('T', ' ', $param['start_time']);
                $object->retornar_em   = str_replace('T', ' ', $param['end_time']);

                $object->store();

                // close the transaction
                TTransaction::close();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            TTransaction::rollback();
        }
    }

}

