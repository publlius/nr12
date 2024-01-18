<?php

//<fileHeader>

//</fileHeader>

class PontoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'Ponto';
    private static $primaryKey = 'id';
    private static $formName = 'form_Ponto';

    //<classProperties>

    //</classProperties>

    use Adianti\Base\AdiantiMasterDetailTrait;

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
        $this->form->setFormTitle('Cadastro de ponto');

        //<onBeginPageCreation>

        //</onBeginPageCreation>

        $id = new TEntry('id');
        $vista_ponto = new TEntry('vista_ponto');
        $localizacao_ponto = new TEntry('localizacao_ponto');
        $severidade_ferimento = new TEntry('severidade_ferimento');
        $tipo_perigo_id = new TDBCombo('tipo_perigo_id', 'nr12', 'TipoPerigo', 'id', '{tipo_perigo}','tipo_perigo asc'  );
        $frequencia_exposicao = new TEntry('frequencia_exposicao');
        $possibilidade_evitar = new TEntry('possibilidade_evitar');
        $parecer_extra_norma = new TEntry('parecer_extra_norma');
        $possiveis_solucoes = new TEntry('possiveis_solucoes');
        $ponto_perigo_ponto_perigo_id = new TCombo('ponto_perigo_ponto_perigo_id');
        $ponto_risco_ponto_risco_id = new TDBCombo('ponto_risco_ponto_risco_id', 'nr12', 'Risco', 'id', '{risco}','risco asc'  );
        $ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = new TDBCombo('ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id', 'nr12', 'SistemaSegurancaTipo', 'id', '{descricao_tipo}','descricao_tipo asc'  );
        $ponto_sistema_seguranca_ponto_sistema_seguranca_id = new TCombo('ponto_sistema_seguranca_ponto_sistema_seguranca_id');
        $ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = new TDBCombo('ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id', 'nr12', 'TituloParecerTecnico', 'id', '{id}','id asc'  );
        $ponto_parecer_tecnico_ponto_item_norma_id = new TDBCombo('ponto_parecer_tecnico_ponto_item_norma_id', 'nr12', 'ItemNorma', 'id', '{descricao_item_norma}','descricao_item_norma asc'  );
        $ponto_perigo_ponto_id = new THidden('ponto_perigo_ponto_id');
        $ponto_risco_ponto_id = new THidden('ponto_risco_ponto_id');
        $ponto_sistema_seguranca_ponto_id = new THidden('ponto_sistema_seguranca_ponto_id');
        $ponto_parecer_tecnico_ponto_id = new THidden('ponto_parecer_tecnico_ponto_id');

        $tipo_perigo_id->setChangeAction(new TAction([$this,'onChangetipo_perigo_id']));

        $vista_ponto->addValidation('Vista ponto', new TRequiredValidator()); 
        $localizacao_ponto->addValidation('Localizacao ponto', new TRequiredValidator()); 
        $tipo_perigo_id->addValidation('Tipo perigo id', new TRequiredValidator()); 

        $id->setEditable(false);
        $id->setSize(100);
        $vista_ponto->setSize('70%');
        $tipo_perigo_id->setSize('70%');
        $localizacao_ponto->setSize('70%');
        $possiveis_solucoes->setSize('70%');
        $parecer_extra_norma->setSize('70%');
        $severidade_ferimento->setSize('70%');
        $frequencia_exposicao->setSize('70%');
        $possibilidade_evitar->setSize('70%');
        $ponto_risco_ponto_risco_id->setSize('70%');
        $ponto_perigo_ponto_perigo_id->setSize('70%');
        $ponto_parecer_tecnico_ponto_item_norma_id->setSize('70%');
        $ponto_sistema_seguranca_ponto_sistema_seguranca_id->setSize('70%');
        $ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id->setSize('70%');
        $ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Apreciacao id:', '#ff0000', '14px', null)],[]);
        $row2 = $this->form->addFields([new TLabel('Vista ponto:', '#ff0000', '14px', null)],[$vista_ponto],[new TLabel('Localizacao ponto:', '#ff0000', '14px', null)],[$localizacao_ponto]);
        $row3 = $this->form->addFields([new TLabel('Severidade do ferimento:', null, '14px', null)],[$severidade_ferimento],[new TLabel('Tipo perigo:', '#ff0000', '14px', null)],[$tipo_perigo_id]);
        $row4 = $this->form->addFields([new TLabel('Frequencia de exposição ao perigo:', null, '14px', null)],[$frequencia_exposicao],[new TLabel('Possibilidade de evitar o perigo:', null, '14px', null)],[$possibilidade_evitar]);
        $row5 = $this->form->addFields([new TLabel('Parecer extra-norma:', null, '14px', null)],[$parecer_extra_norma],[new TLabel('Possíveis soluções:', null, '14px', null)],[$possiveis_solucoes]);
        $row6 = $this->form->addContent([new TFormSeparator('Perigos', '#333333', '18', '#eeeeee')]);
        $row7 = $this->form->addFields([new TLabel('Perigo:', '#ff0000', '14px', null)],[$ponto_perigo_ponto_perigo_id]);
        $row8 = $this->form->addFields([$ponto_perigo_ponto_id]);         
        $add_ponto_perigo_ponto = new TButton('add_ponto_perigo_ponto');

        $action_ponto_perigo_ponto = new TAction(array($this, 'onAddPontoPerigoPonto'));

        $add_ponto_perigo_ponto->setAction($action_ponto_perigo_ponto, 'Adicionar');
        $add_ponto_perigo_ponto->setImage('fa:plus #000000');

        $this->form->addFields([$add_ponto_perigo_ponto]);

        $this->ponto_perigo_ponto_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->ponto_perigo_ponto_list->style = 'width:100%';
        $this->ponto_perigo_ponto_list->class .= ' table-bordered';
        $this->ponto_perigo_ponto_list->disableDefaultClick();
        $this->ponto_perigo_ponto_list->addQuickColumn('', 'edit', 'left', 50);
        $this->ponto_perigo_ponto_list->addQuickColumn('', 'delete', 'left', 50);

        $column_ponto_perigo_ponto_perigo_id = $this->ponto_perigo_ponto_list->addQuickColumn('Perigo id', 'ponto_perigo_ponto_perigo_id', 'left');

        $this->ponto_perigo_ponto_list->createModel();
        $this->form->addContent([$this->ponto_perigo_ponto_list]);
        $row9 = $this->form->addContent([new TFormSeparator('Riscos', '#333333', '18', '#eeeeee')]);
        $row10 = $this->form->addFields([new TLabel('Risco id:', '#ff0000', '14px', null)],[$ponto_risco_ponto_risco_id]);
        $row11 = $this->form->addFields([$ponto_risco_ponto_id]);         
        $add_ponto_risco_ponto = new TButton('add_ponto_risco_ponto');

        $action_ponto_risco_ponto = new TAction(array($this, 'onAddPontoRiscoPonto'));

        $add_ponto_risco_ponto->setAction($action_ponto_risco_ponto, 'Adicionar');
        $add_ponto_risco_ponto->setImage('fa:plus #000000');

        $this->form->addFields([$add_ponto_risco_ponto]);

        $this->ponto_risco_ponto_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->ponto_risco_ponto_list->style = 'width:100%';
        $this->ponto_risco_ponto_list->class .= ' table-bordered';
        $this->ponto_risco_ponto_list->disableDefaultClick();
        $this->ponto_risco_ponto_list->addQuickColumn('', 'edit', 'left', 50);
        $this->ponto_risco_ponto_list->addQuickColumn('', 'delete', 'left', 50);

        $column_ponto_risco_ponto_risco_id = $this->ponto_risco_ponto_list->addQuickColumn('Risco id', 'ponto_risco_ponto_risco_id', 'left');

        $this->ponto_risco_ponto_list->createModel();
        $this->form->addContent([$this->ponto_risco_ponto_list]);
        $row12 = $this->form->addContent([new TFormSeparator('Sistemas de segurança', '#333333', '18', '#eeeeee')]);
        $row13 = $this->form->addFields([new TLabel('Sistema seguranca tipo id:', '#ff0000', '14px', null)],[$ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id]);
        $row14 = $this->form->addFields([new TLabel('Sistema seguranca id:', '#ff0000', '14px', null)],[$ponto_sistema_seguranca_ponto_sistema_seguranca_id]);
        $row15 = $this->form->addFields([$ponto_sistema_seguranca_ponto_id]);         
        $add_ponto_sistema_seguranca_ponto = new TButton('add_ponto_sistema_seguranca_ponto');

        $action_ponto_sistema_seguranca_ponto = new TAction(array($this, 'onAddPontoSistemaSegurancaPonto'));

        $add_ponto_sistema_seguranca_ponto->setAction($action_ponto_sistema_seguranca_ponto, 'Adicionar');
        $add_ponto_sistema_seguranca_ponto->setImage('fa:plus #000000');

        $this->form->addFields([$add_ponto_sistema_seguranca_ponto]);

        $this->ponto_sistema_seguranca_ponto_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->ponto_sistema_seguranca_ponto_list->style = 'width:100%';
        $this->ponto_sistema_seguranca_ponto_list->class .= ' table-bordered';
        $this->ponto_sistema_seguranca_ponto_list->disableDefaultClick();
        $this->ponto_sistema_seguranca_ponto_list->addQuickColumn('', 'edit', 'left', 50);
        $this->ponto_sistema_seguranca_ponto_list->addQuickColumn('', 'delete', 'left', 50);

        $column_ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = $this->ponto_sistema_seguranca_ponto_list->addQuickColumn('Sistema seguranca tipo id', 'ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id', 'left');
        $column_ponto_sistema_seguranca_ponto_sistema_seguranca_id = $this->ponto_sistema_seguranca_ponto_list->addQuickColumn('Sistema seguranca id', 'ponto_sistema_seguranca_ponto_sistema_seguranca_id', 'left');

        $this->ponto_sistema_seguranca_ponto_list->createModel();
        $this->form->addContent([$this->ponto_sistema_seguranca_ponto_list]);
        $row16 = $this->form->addContent([new TFormSeparator('Parecer Técnico', '#333333', '18', '#eeeeee')]);
        $row17 = $this->form->addFields([new TLabel('Titulo parecer tecnico id:', '#ff0000', '14px', null)],[$ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id]);
        $row18 = $this->form->addFields([new TLabel('Item norma id:', '#ff0000', '14px', null)],[$ponto_parecer_tecnico_ponto_item_norma_id]);
        $row19 = $this->form->addFields([$ponto_parecer_tecnico_ponto_id]);         
        $add_ponto_parecer_tecnico_ponto = new TButton('add_ponto_parecer_tecnico_ponto');

        $action_ponto_parecer_tecnico_ponto = new TAction(array($this, 'onAddPontoParecerTecnicoPonto'));

        $add_ponto_parecer_tecnico_ponto->setAction($action_ponto_parecer_tecnico_ponto, 'Adicionar');
        $add_ponto_parecer_tecnico_ponto->setImage('fa:plus #000000');

        $this->form->addFields([$add_ponto_parecer_tecnico_ponto]);

        $this->ponto_parecer_tecnico_ponto_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->ponto_parecer_tecnico_ponto_list->style = 'width:100%';
        $this->ponto_parecer_tecnico_ponto_list->class .= ' table-bordered';
        $this->ponto_parecer_tecnico_ponto_list->disableDefaultClick();
        $this->ponto_parecer_tecnico_ponto_list->addQuickColumn('', 'edit', 'left', 50);
        $this->ponto_parecer_tecnico_ponto_list->addQuickColumn('', 'delete', 'left', 50);

        $column_ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = $this->ponto_parecer_tecnico_ponto_list->addQuickColumn('Titulo parecer tecnico id', 'ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id', 'left');
        $column_ponto_parecer_tecnico_ponto_item_norma_id = $this->ponto_parecer_tecnico_ponto_list->addQuickColumn('Item norma id', 'ponto_parecer_tecnico_ponto_item_norma_id', 'left');

        $this->ponto_parecer_tecnico_ponto_list->createModel();
        $this->form->addContent([$this->ponto_parecer_tecnico_ponto_list]);

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
        $container->add(TBreadCrumb::create(['Lançamentos','Cadastro de ponto']));
        $container->add($this->form);

        //<onAfterPageCreation>

        //</onAfterPageCreation>

        parent::add($container);

    }

    public static function onChangetipo_perigo_id($param)
    {
        try
        {

            if (isset($param['tipo_perigo_id']) && $param['tipo_perigo_id'])
            { 
                $criteria = TCriteria::create(['tipo_perigo_id' => (int) $param['tipo_perigo_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'ponto_perigo_ponto_perigo_id', 'nr12', 'Perigo', 'id', '{perigo}', 'id asc', $criteria, TRUE); 
            } 
            else 
            { 
                TCombo::clearField(self::$formName, 'ponto_perigo_ponto_perigo_id'); 
            }  

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
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

            $object = new Ponto(); // create an empty object //</blockLine>

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            //</beforeStoreAutoCode> //</blockLine>

            $object->store(); // save the object //</blockLine>

            //</afterStoreAutoCode> //</blockLine>
 //<generatedAutoCode>

            $this->fireEvents($object);

//</generatedAutoCode> 

    //<detail-48182-430377> //</hideLine>
            $ponto_parecer_tecnico_ponto_items = $this->storeItems('PontoParecerTecnico', 'ponto_id', $object, 'ponto_parecer_tecnico_ponto', function($masterObject, $detailObject){ //</blockLine>

                //code here

                //</autoCode>
            }); //</blockLine>
    //</hideLine> //</detail-48182-430377>

    //<detail-48185-430387> //</hideLine>
            $ponto_sistema_seguranca_ponto_items = $this->storeItems('PontoSistemaSeguranca', 'ponto_id', $object, 'ponto_sistema_seguranca_ponto', function($masterObject, $detailObject){ //</blockLine>

                //code here

                //</autoCode>
            }); //</blockLine>
    //</hideLine> //</detail-48185-430387>

    //<detail-59427-458919> //</hideLine>
            $ponto_risco_ponto_items = $this->storeItems('PontoRisco', 'ponto_id', $object, 'ponto_risco_ponto', function($masterObject, $detailObject){ //</blockLine>

                //code here

                //</autoCode>
            }); //</blockLine>
    //</hideLine> //</detail-59427-458919>

    //<detail-59428-458922> //</hideLine>
            $ponto_perigo_ponto_items = $this->storeItems('PontoPerigo', 'ponto_id', $object, 'ponto_perigo_ponto', function($masterObject, $detailObject){ //</blockLine>

                //code here

                //</autoCode>
            }); //</blockLine>
    //</hideLine> //</detail-59428-458922>

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
//<generatedAutoCode>

            $data = $this->form->getData();
            $this->fireEvents($data);
//</generatedAutoCode>

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

                $object = new Ponto($key); // instantiates the Active Record //</blockLine>

                //</beforeSetDataAutoCode> //</blockLine> 

    //<detail-48182-430377> //</hideLine>
                $ponto_parecer_tecnico_ponto_items = $this->loadItems('PontoParecerTecnico', 'ponto_id', $object, 'ponto_parecer_tecnico_ponto', function($masterObject, $detailObject, $objectItems){ //</blockLine>

                    //code here

                    //</autoCode>
                }); //</blockLine>
    //</hideLine> //</detail-48182-430377>

    //<detail-48185-430387> //</hideLine>
                $ponto_sistema_seguranca_ponto_items = $this->loadItems('PontoSistemaSeguranca', 'ponto_id', $object, 'ponto_sistema_seguranca_ponto', function($masterObject, $detailObject, $objectItems){ //</blockLine>

                    //code here

                    //</autoCode>
                }); //</blockLine>
    //</hideLine> //</detail-48185-430387>

    //<detail-59427-458919> //</hideLine>
                $ponto_risco_ponto_items = $this->loadItems('PontoRisco', 'ponto_id', $object, 'ponto_risco_ponto', function($masterObject, $detailObject, $objectItems){ //</blockLine>

                    //code here

                    //</autoCode>
                }); //</blockLine>
    //</hideLine> //</detail-59427-458919>

    //<detail-59428-458922> //</hideLine>
                $ponto_perigo_ponto_items = $this->loadItems('PontoPerigo', 'ponto_id', $object, 'ponto_perigo_ponto', function($masterObject, $detailObject, $objectItems){ //</blockLine>

                    //code here

                    //</autoCode>
                }); //</blockLine>
    //</hideLine> //</detail-59428-458922>

                $this->form->setData($object); // fill the form //</blockLine>

                //</afterSetDataAutoCode> //</blockLine>
//<generatedAutoCode>

                $this->fireEvents($object);

                $this->onReload();

//</generatedAutoCode>

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

        TSession::setValue('ponto_perigo_ponto_items', null);
        TSession::setValue('ponto_risco_ponto_items', null);
        TSession::setValue('ponto_sistema_seguranca_ponto_items', null);
        TSession::setValue('ponto_parecer_tecnico_ponto_items', null);

        //<onFormClear>

        //</onFormClear>

        $this->onReload();
    }

    public function onAddPontoPerigoPonto( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->ponto_perigo_ponto_perigo_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Perigo'));
            }             

            $ponto_perigo_ponto_items = TSession::getValue('ponto_perigo_ponto_items');
            $key = isset($data->ponto_perigo_ponto_id) && $data->ponto_perigo_ponto_id ? $data->ponto_perigo_ponto_id : uniqid();
            $fields = []; 

            $fields['ponto_perigo_ponto_perigo_id'] = $data->ponto_perigo_ponto_perigo_id;
            $ponto_perigo_ponto_items[ $key ] = $fields;

            //<onAddDetailPontoPerigoPonto>

            //</onAddDetailPontoPerigoPonto>

            TSession::setValue('ponto_perigo_ponto_items', $ponto_perigo_ponto_items);

            $data->ponto_perigo_ponto_id = '';
            $data->ponto_perigo_ponto_perigo_id = '';

            $this->form->setData($data);
            $this->fireEvents($data); //</blockRemoveLine>
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            $this->fireEvents($data); //</blockRemoveLine>
            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditPontoPerigoPonto( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('ponto_perigo_ponto_items');

        // get the session item
        $item = $items[$param['ponto_perigo_ponto_id_row_id']];

        $data->ponto_perigo_ponto_perigo_id = $item['ponto_perigo_ponto_perigo_id'];

        $data->ponto_perigo_ponto_id = $param['ponto_perigo_ponto_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->fireEvents($data); //</blockRemoveLine>

        $this->onReload( $param );
    }

    public function onDeletePontoPerigoPonto( $param )
    {
        $data = $this->form->getData();

        $data->ponto_perigo_ponto_perigo_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('ponto_perigo_ponto_items');

        // delete the item from session
        unset($items[$param['ponto_perigo_ponto_id_row_id']]);
        TSession::setValue('ponto_perigo_ponto_items', $items);

        $this->fireEvents($data); //</blockRemoveLine>

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadPontoPerigoPonto( $param )
    {
        $items = TSession::getValue('ponto_perigo_ponto_items'); 

        $this->ponto_perigo_ponto_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeletePontoPerigoPonto')); 
                $action_del->setParameter('ponto_perigo_ponto_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditPontoPerigoPonto'));  
                $action_edi->setParameter('ponto_perigo_ponto_id_row_id', $key);  

                $button_del = new TButton('delete_ponto_perigo_ponto'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_ponto_perigo_ponto'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                //<generatedAutoCode>
                $rowItem->ponto_perigo_ponto_perigo_id = '';
                if(isset($item['ponto_perigo_ponto_perigo_id']) && $item['ponto_perigo_ponto_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $perigo = Perigo::find($item['ponto_perigo_ponto_perigo_id']);
                    if($perigo)
                    {
                        $rowItem->ponto_perigo_ponto_perigo_id = $perigo->render('{perigo}');
                    }
                    TTransaction::close();
                }

                //</generatedAutoCode>
                $row = $this->ponto_perigo_ponto_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddPontoRiscoPonto( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->ponto_risco_ponto_risco_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Risco id'));
            }             

            $ponto_risco_ponto_items = TSession::getValue('ponto_risco_ponto_items');
            $key = isset($data->ponto_risco_ponto_id) && $data->ponto_risco_ponto_id ? $data->ponto_risco_ponto_id : uniqid();
            $fields = []; 

            $fields['ponto_risco_ponto_risco_id'] = $data->ponto_risco_ponto_risco_id;
            $ponto_risco_ponto_items[ $key ] = $fields;

            //<onAddDetailPontoRiscoPonto>

            //</onAddDetailPontoRiscoPonto>

            TSession::setValue('ponto_risco_ponto_items', $ponto_risco_ponto_items);

            $data->ponto_risco_ponto_id = '';
            $data->ponto_risco_ponto_risco_id = '';

            $this->form->setData($data);
            $this->fireEvents($data); //</blockRemoveLine>
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            $this->fireEvents($data); //</blockRemoveLine>
            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditPontoRiscoPonto( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('ponto_risco_ponto_items');

        // get the session item
        $item = $items[$param['ponto_risco_ponto_id_row_id']];

        $data->ponto_risco_ponto_risco_id = $item['ponto_risco_ponto_risco_id'];

        $data->ponto_risco_ponto_id = $param['ponto_risco_ponto_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->fireEvents($data); //</blockRemoveLine>

        $this->onReload( $param );
    }

    public function onDeletePontoRiscoPonto( $param )
    {
        $data = $this->form->getData();

        $data->ponto_risco_ponto_risco_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('ponto_risco_ponto_items');

        // delete the item from session
        unset($items[$param['ponto_risco_ponto_id_row_id']]);
        TSession::setValue('ponto_risco_ponto_items', $items);

        $this->fireEvents($data); //</blockRemoveLine>

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadPontoRiscoPonto( $param )
    {
        $items = TSession::getValue('ponto_risco_ponto_items'); 

        $this->ponto_risco_ponto_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeletePontoRiscoPonto')); 
                $action_del->setParameter('ponto_risco_ponto_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditPontoRiscoPonto'));  
                $action_edi->setParameter('ponto_risco_ponto_id_row_id', $key);  

                $button_del = new TButton('delete_ponto_risco_ponto'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_ponto_risco_ponto'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                //<generatedAutoCode>
                $rowItem->ponto_perigo_ponto_perigo_id = '';
                if(isset($item['ponto_perigo_ponto_perigo_id']) && $item['ponto_perigo_ponto_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $perigo = Perigo::find($item['ponto_perigo_ponto_perigo_id']);
                    if($perigo)
                    {
                        $rowItem->ponto_perigo_ponto_perigo_id = $perigo->render('{perigo}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_risco_ponto_risco_id = '';
                if(isset($item['ponto_risco_ponto_risco_id']) && $item['ponto_risco_ponto_risco_id'])
                {
                    TTransaction::open('nr12');
                    $risco = Risco::find($item['ponto_risco_ponto_risco_id']);
                    if($risco)
                    {
                        $rowItem->ponto_risco_ponto_risco_id = $risco->render('{risco}');
                    }
                    TTransaction::close();
                }

                //</generatedAutoCode>
                $row = $this->ponto_risco_ponto_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddPontoSistemaSegurancaPonto( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Sistema seguranca tipo id'));
            }             
            if(!$data->ponto_sistema_seguranca_ponto_sistema_seguranca_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Sistema seguranca id'));
            }             

            $ponto_sistema_seguranca_ponto_items = TSession::getValue('ponto_sistema_seguranca_ponto_items');
            $key = isset($data->ponto_sistema_seguranca_ponto_id) && $data->ponto_sistema_seguranca_ponto_id ? $data->ponto_sistema_seguranca_ponto_id : uniqid();
            $fields = []; 

            $fields['ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id'] = $data->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id;
            $fields['ponto_sistema_seguranca_ponto_sistema_seguranca_id'] = $data->ponto_sistema_seguranca_ponto_sistema_seguranca_id;
            $ponto_sistema_seguranca_ponto_items[ $key ] = $fields;

            //<onAddDetailPontoSistemaSegurancaPonto>

            //</onAddDetailPontoSistemaSegurancaPonto>

            TSession::setValue('ponto_sistema_seguranca_ponto_items', $ponto_sistema_seguranca_ponto_items);

            $data->ponto_sistema_seguranca_ponto_id = '';
            $data->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = '';
            $data->ponto_sistema_seguranca_ponto_sistema_seguranca_id = '';

            $this->form->setData($data);
            $this->fireEvents($data); //</blockRemoveLine>
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            $this->fireEvents($data); //</blockRemoveLine>
            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditPontoSistemaSegurancaPonto( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('ponto_sistema_seguranca_ponto_items');

        // get the session item
        $item = $items[$param['ponto_sistema_seguranca_ponto_id_row_id']];

        $data->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = $item['ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id'];
        $data->ponto_sistema_seguranca_ponto_sistema_seguranca_id = $item['ponto_sistema_seguranca_ponto_sistema_seguranca_id'];

        $data->ponto_sistema_seguranca_ponto_id = $param['ponto_sistema_seguranca_ponto_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->fireEvents($data); //</blockRemoveLine>

        $this->onReload( $param );
    }

    public function onDeletePontoSistemaSegurancaPonto( $param )
    {
        $data = $this->form->getData();

        $data->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = '';
        $data->ponto_sistema_seguranca_ponto_sistema_seguranca_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('ponto_sistema_seguranca_ponto_items');

        // delete the item from session
        unset($items[$param['ponto_sistema_seguranca_ponto_id_row_id']]);
        TSession::setValue('ponto_sistema_seguranca_ponto_items', $items);

        $this->fireEvents($data); //</blockRemoveLine>

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadPontoSistemaSegurancaPonto( $param )
    {
        $items = TSession::getValue('ponto_sistema_seguranca_ponto_items'); 

        $this->ponto_sistema_seguranca_ponto_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeletePontoSistemaSegurancaPonto')); 
                $action_del->setParameter('ponto_sistema_seguranca_ponto_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditPontoSistemaSegurancaPonto'));  
                $action_edi->setParameter('ponto_sistema_seguranca_ponto_id_row_id', $key);  

                $button_del = new TButton('delete_ponto_sistema_seguranca_ponto'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_ponto_sistema_seguranca_ponto'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                //<generatedAutoCode>
                $rowItem->ponto_perigo_ponto_perigo_id = '';
                if(isset($item['ponto_perigo_ponto_perigo_id']) && $item['ponto_perigo_ponto_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $perigo = Perigo::find($item['ponto_perigo_ponto_perigo_id']);
                    if($perigo)
                    {
                        $rowItem->ponto_perigo_ponto_perigo_id = $perigo->render('{perigo}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_risco_ponto_risco_id = '';
                if(isset($item['ponto_risco_ponto_risco_id']) && $item['ponto_risco_ponto_risco_id'])
                {
                    TTransaction::open('nr12');
                    $risco = Risco::find($item['ponto_risco_ponto_risco_id']);
                    if($risco)
                    {
                        $rowItem->ponto_risco_ponto_risco_id = $risco->render('{risco}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = '';
                if(isset($item['ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id']) && $item['ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id'])
                {
                    TTransaction::open('nr12');
                    $sistema_seguranca_tipo = SistemaSegurancaTipo::find($item['ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id']);
                    if($sistema_seguranca_tipo)
                    {
                        $rowItem->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = $sistema_seguranca_tipo->render('{descricao_tipo}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_sistema_seguranca_ponto_sistema_seguranca_id = '';
                if(isset($item['ponto_sistema_seguranca_ponto_sistema_seguranca_id']) && $item['ponto_sistema_seguranca_ponto_sistema_seguranca_id'])
                {
                    TTransaction::open('nr12');
                    $sistema_seguranca = SistemaSeguranca::find($item['ponto_sistema_seguranca_ponto_sistema_seguranca_id']);
                    if($sistema_seguranca)
                    {
                        $rowItem->ponto_sistema_seguranca_ponto_sistema_seguranca_id = $sistema_seguranca->render('{sistema_seguranca}');
                    }
                    TTransaction::close();
                }

                //</generatedAutoCode>
                $row = $this->ponto_sistema_seguranca_ponto_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddPontoParecerTecnicoPonto( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Titulo parecer tecnico id'));
            }             
            if(!$data->ponto_parecer_tecnico_ponto_item_norma_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Item norma id'));
            }             

            $ponto_parecer_tecnico_ponto_items = TSession::getValue('ponto_parecer_tecnico_ponto_items');
            $key = isset($data->ponto_parecer_tecnico_ponto_id) && $data->ponto_parecer_tecnico_ponto_id ? $data->ponto_parecer_tecnico_ponto_id : uniqid();
            $fields = []; 

            $fields['ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id'] = $data->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id;
            $fields['ponto_parecer_tecnico_ponto_item_norma_id'] = $data->ponto_parecer_tecnico_ponto_item_norma_id;
            $ponto_parecer_tecnico_ponto_items[ $key ] = $fields;

            //<onAddDetailPontoParecerTecnicoPonto>

            //</onAddDetailPontoParecerTecnicoPonto>

            TSession::setValue('ponto_parecer_tecnico_ponto_items', $ponto_parecer_tecnico_ponto_items);

            $data->ponto_parecer_tecnico_ponto_id = '';
            $data->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = '';
            $data->ponto_parecer_tecnico_ponto_item_norma_id = '';

            $this->form->setData($data);
            $this->fireEvents($data); //</blockRemoveLine>
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            $this->fireEvents($data); //</blockRemoveLine>
            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditPontoParecerTecnicoPonto( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('ponto_parecer_tecnico_ponto_items');

        // get the session item
        $item = $items[$param['ponto_parecer_tecnico_ponto_id_row_id']];

        $data->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = $item['ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id'];
        $data->ponto_parecer_tecnico_ponto_item_norma_id = $item['ponto_parecer_tecnico_ponto_item_norma_id'];

        $data->ponto_parecer_tecnico_ponto_id = $param['ponto_parecer_tecnico_ponto_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->fireEvents($data); //</blockRemoveLine>

        $this->onReload( $param );
    }

    public function onDeletePontoParecerTecnicoPonto( $param )
    {
        $data = $this->form->getData();

        $data->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = '';
        $data->ponto_parecer_tecnico_ponto_item_norma_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('ponto_parecer_tecnico_ponto_items');

        // delete the item from session
        unset($items[$param['ponto_parecer_tecnico_ponto_id_row_id']]);
        TSession::setValue('ponto_parecer_tecnico_ponto_items', $items);

        $this->fireEvents($data); //</blockRemoveLine>

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadPontoParecerTecnicoPonto( $param )
    {
        $items = TSession::getValue('ponto_parecer_tecnico_ponto_items'); 

        $this->ponto_parecer_tecnico_ponto_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeletePontoParecerTecnicoPonto')); 
                $action_del->setParameter('ponto_parecer_tecnico_ponto_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditPontoParecerTecnicoPonto'));  
                $action_edi->setParameter('ponto_parecer_tecnico_ponto_id_row_id', $key);  

                $button_del = new TButton('delete_ponto_parecer_tecnico_ponto'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_ponto_parecer_tecnico_ponto'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                //<generatedAutoCode>
                $rowItem->ponto_perigo_ponto_perigo_id = '';
                if(isset($item['ponto_perigo_ponto_perigo_id']) && $item['ponto_perigo_ponto_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $perigo = Perigo::find($item['ponto_perigo_ponto_perigo_id']);
                    if($perigo)
                    {
                        $rowItem->ponto_perigo_ponto_perigo_id = $perigo->render('{perigo}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_risco_ponto_risco_id = '';
                if(isset($item['ponto_risco_ponto_risco_id']) && $item['ponto_risco_ponto_risco_id'])
                {
                    TTransaction::open('nr12');
                    $risco = Risco::find($item['ponto_risco_ponto_risco_id']);
                    if($risco)
                    {
                        $rowItem->ponto_risco_ponto_risco_id = $risco->render('{risco}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = '';
                if(isset($item['ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id']) && $item['ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id'])
                {
                    TTransaction::open('nr12');
                    $sistema_seguranca_tipo = SistemaSegurancaTipo::find($item['ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id']);
                    if($sistema_seguranca_tipo)
                    {
                        $rowItem->ponto_sistema_seguranca_ponto_sistema_seguranca_tipo_id = $sistema_seguranca_tipo->render('{descricao_tipo}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_sistema_seguranca_ponto_sistema_seguranca_id = '';
                if(isset($item['ponto_sistema_seguranca_ponto_sistema_seguranca_id']) && $item['ponto_sistema_seguranca_ponto_sistema_seguranca_id'])
                {
                    TTransaction::open('nr12');
                    $sistema_seguranca = SistemaSeguranca::find($item['ponto_sistema_seguranca_ponto_sistema_seguranca_id']);
                    if($sistema_seguranca)
                    {
                        $rowItem->ponto_sistema_seguranca_ponto_sistema_seguranca_id = $sistema_seguranca->render('{sistema_seguranca}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = '';
                if(isset($item['ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id']) && $item['ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id'])
                {
                    TTransaction::open('nr12');
                    $titulo_parecer_tecnico = TituloParecerTecnico::find($item['ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id']);
                    if($titulo_parecer_tecnico)
                    {
                        $rowItem->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = $titulo_parecer_tecnico->render('{id}');
                    }
                    TTransaction::close();
                }

                $rowItem->ponto_parecer_tecnico_ponto_item_norma_id = '';
                if(isset($item['ponto_parecer_tecnico_ponto_item_norma_id']) && $item['ponto_parecer_tecnico_ponto_item_norma_id'])
                {
                    TTransaction::open('nr12');
                    $item_norma = ItemNorma::find($item['ponto_parecer_tecnico_ponto_item_norma_id']);
                    if($item_norma)
                    {
                        $rowItem->ponto_parecer_tecnico_ponto_item_norma_id = $item_norma->render('{descricao_item_norma}');
                    }
                    TTransaction::close();
                }

                //</generatedAutoCode>
                $row = $this->ponto_parecer_tecnico_ponto_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onShow($param = null)
    {
        TSession::setValue('ponto_perigo_ponto_items', null);
        TSession::setValue('ponto_risco_ponto_items', null);
        TSession::setValue('ponto_sistema_seguranca_ponto_items', null);
        TSession::setValue('ponto_parecer_tecnico_ponto_items', null);

        $this->onReload();

        //<onShow>

        //</onShow>
    } 

    public function fireEvents( $object )
    {
        $obj = new stdClass;
        if(is_object($object) && get_class($object) == 'stdClass')
        {
            if(isset($object->tipo_perigo_id))
            {
                $obj->tipo_perigo_id = $object->tipo_perigo_id;
            }
            if(isset($object->ponto_perigo_ponto_perigo_id))
            {
                $obj->ponto_perigo_ponto_perigo_id = $object->ponto_perigo_ponto_perigo_id;
            }
            if(isset($object->ponto_sistema_seguranca_ponto_sistema_seguranca_id))
            {
                $obj->ponto_sistema_seguranca_ponto_sistema_seguranca_id = $object->ponto_sistema_seguranca_ponto_sistema_seguranca_id;
            }
        }
        elseif(is_object($object))
        {
            if(isset($object->tipo_perigo_id))
            {
                $obj->tipo_perigo_id = $object->tipo_perigo_id;
            }
            if(isset($object->ponto_perigo->ponto->perigo_id))
            {
                $obj->ponto_perigo_ponto_perigo_id = $object->ponto_perigo->ponto->perigo_id;
            }
            if(isset($object->ponto_sistema_seguranca->ponto->sistema_seguranca_id))
            {
                $obj->ponto_sistema_seguranca_ponto_sistema_seguranca_id = $object->ponto_sistema_seguranca->ponto->sistema_seguranca_id;
            }
        }
        TForm::sendData(self::$formName, $obj);
    }  

    public function onReload($params = null)
    {
        $this->loaded = TRUE;

        $this->onReloadPontoPerigoPonto($params);
        $this->onReloadPontoRiscoPonto($params);
        $this->onReloadPontoSistemaSegurancaPonto($params);
        $this->onReloadPontoParecerTecnicoPonto($params);
    }

    public function show() 
    { 
        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') ) 
        { 
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }

    //</hideLine> <addUserFunctionsCode/>

    //<userCustomFunctions>

    //</userCustomFunctions>
}