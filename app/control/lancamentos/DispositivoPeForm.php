<?php

class DispositivoPeForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'nr12';
    private static $activeRecord = 'DispositivoPe';
    private static $primaryKey = 'id';
    private static $formName = 'form_DispositivoPe';

    use Adianti\Base\AdiantiMasterDetailTrait;
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
        $this->form->setFormTitle('Cadastro de dispositivo pe');


        $id = new TEntry('id');
        $apreciacao_id = new TDBCombo('apreciacao_id', 'nr12', 'Apreciacao', 'id', '{id} - {equipamento->nome} - {equipamento->tag} - {equipamento->patrimonio} ','id asc'  );
        $vista_dispositivo = new TFile('vista_dispositivo');
        $dispositivo_seguranca = new TRadioGroup('dispositivo_seguranca');
        $dispositivo_seguranca_nr12 = new TRadioGroup('dispositivo_seguranca_nr12');
        $dispositivo_usado_partida = new TRadioGroup('dispositivo_usado_partida');
        $dispositivo_usado_partida_nr12 = new TRadioGroup('dispositivo_usado_partida_nr12');
        $acionado_outro_operador = new TRadioGroup('acionado_outro_operador');
        $acionado_outro_operador_nr12 = new TRadioGroup('acionado_outro_operador_nr12');
        $passivel_burla = new TRadioGroup('passivel_burla');
        $passivel_burla_nr12 = new TRadioGroup('passivel_burla_nr12');
        $identificado_ptbr = new TRadioGroup('identificado_ptbr');
        $identificado_ptbr_nr12 = new TRadioGroup('identificado_ptbr_nr12');
        $rearme_manual = new TRadioGroup('rearme_manual');
        $rearme_manual_nr12 = new TRadioGroup('rearme_manual_nr12');
        $apresenta_retencao = new TRadioGroup('apresenta_retencao');
        $apresenta_retencao_nr12 = new TRadioGroup('apresenta_retencao_nr12');
        $acionado_ebt = new TRadioGroup('acionado_ebt');
        $acionado_ebt_nr12 = new TRadioGroup('acionado_ebt_nr12');
        $pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = new TDBCombo('pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id', 'nr12', 'TituloParecerTecnico', 'id', '{titulo_parecer_tecnico} ','titulo_parecer_tecnico asc'  );
        $pe_parecer_tecnico_dispositivo_pe_item_norma_id = new TCombo('pe_parecer_tecnico_dispositivo_pe_item_norma_id');
        $parecer_extra_norma = new TText('parecer_extra_norma');
        $pe_parecer_tecnico_dispositivo_pe_id = new THidden('pe_parecer_tecnico_dispositivo_pe_id');

        $pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id->setChangeAction(new TAction([$this,'onChangepe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id']));

        $apreciacao_id->addValidation('Apreciação', new TRequiredValidator()); 
        $vista_dispositivo->addValidation('Vista dispositivo', new TRequiredValidator()); 
        $dispositivo_seguranca->addValidation('Há dispositivos de segurança instalados?', new TRequiredValidator()); 
        $dispositivo_seguranca_nr12->addValidation('Atende NR12?', new TRequiredValidator()); 
        $dispositivo_usado_partida->addValidation('O dispositivo é utilizado para partida?', new TRequiredValidator()); 
        $dispositivo_usado_partida_nr12->addValidation('Atende NR12?', new TRequiredValidator()); 
        $acionado_outro_operador->addValidation('Pode ser acionado por outro operador?', new TRequiredValidator()); 
        $acionado_outro_operador_nr12->addValidation('Atende NR12?', new TRequiredValidator()); 
        $passivel_burla->addValidation('É passível de burla?', new TRequiredValidator()); 
        $passivel_burla_nr12->addValidation('Atende NR12?', new TRequiredValidator()); 
        $identificado_ptbr->addValidation('Está identificado em Língua Portuguesa?', new TRequiredValidator()); 
        $identificado_ptbr_nr12->addValidation('Atende NR12?', new TRequiredValidator()); 
        $rearme_manual->addValidation('Exige rearme manual?', new TRequiredValidator()); 
        $rearme_manual_nr12->addValidation('Atende NR12?', new TRequiredValidator()); 
        $apresenta_retencao->addValidation('Apresenta retenção após acionado?', new TRequiredValidator()); 
        $apresenta_retencao_nr12->addValidation('Atende NR12?', new TRequiredValidator()); 
        $acionado_ebt->addValidation('Acionado em EBT?', new TRequiredValidator()); 
        $acionado_ebt_nr12->addValidation('Atende NR12?', new TRequiredValidator()); 

        $id->setEditable(false);
        $vista_dispositivo->enableFileHandling();
        $pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id->setTip("Utilizar sempre a Opção ID 6: Dispositivos de Parada de Emergência");
        $acionado_ebt->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $rearme_manual->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $passivel_burla->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $identificado_ptbr->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $acionado_ebt_nr12->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $rearme_manual_nr12->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $apresenta_retencao->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $passivel_burla_nr12->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $dispositivo_seguranca->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $identificado_ptbr_nr12->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $acionado_outro_operador->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $apresenta_retencao_nr12->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $dispositivo_usado_partida->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $dispositivo_seguranca_nr12->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $acionado_outro_operador_nr12->addItems(['Sim'=>'Sim','Não'=>'Não']);
        $dispositivo_usado_partida_nr12->addItems(['Sim'=>'Sim','Não'=>'Não']);

        $acionado_ebt->setLayout('horizontal');
        $rearme_manual->setLayout('horizontal');
        $passivel_burla->setLayout('horizontal');
        $identificado_ptbr->setLayout('horizontal');
        $acionado_ebt_nr12->setLayout('horizontal');
        $rearme_manual_nr12->setLayout('horizontal');
        $apresenta_retencao->setLayout('horizontal');
        $passivel_burla_nr12->setLayout('horizontal');
        $dispositivo_seguranca->setLayout('horizontal');
        $identificado_ptbr_nr12->setLayout('horizontal');
        $acionado_outro_operador->setLayout('horizontal');
        $apresenta_retencao_nr12->setLayout('horizontal');
        $dispositivo_usado_partida->setLayout('horizontal');
        $dispositivo_seguranca_nr12->setLayout('horizontal');
        $acionado_outro_operador_nr12->setLayout('horizontal');
        $dispositivo_usado_partida_nr12->setLayout('horizontal');

        $acionado_ebt->setUseButton();
        $rearme_manual->setUseButton();
        $passivel_burla->setUseButton();
        $identificado_ptbr->setUseButton();
        $acionado_ebt_nr12->setUseButton();
        $rearme_manual_nr12->setUseButton();
        $apresenta_retencao->setUseButton();
        $passivel_burla_nr12->setUseButton();
        $dispositivo_seguranca->setUseButton();
        $identificado_ptbr_nr12->setUseButton();
        $acionado_outro_operador->setUseButton();
        $apresenta_retencao_nr12->setUseButton();
        $dispositivo_usado_partida->setUseButton();
        $dispositivo_seguranca_nr12->setUseButton();
        $acionado_outro_operador_nr12->setUseButton();
        $dispositivo_usado_partida_nr12->setUseButton();

        $id->setSize(100);
        $acionado_ebt->setSize(80);
        $rearme_manual->setSize(80);
        $passivel_burla->setSize(80);
        $apreciacao_id->setSize('70%');
        $acionado_ebt_nr12->setSize(80);
        $identificado_ptbr->setSize(80);
        $apresenta_retencao->setSize(80);
        $rearme_manual_nr12->setSize(80);
        $passivel_burla_nr12->setSize(80);
        $vista_dispositivo->setSize('70%');
        $dispositivo_seguranca->setSize(80);
        $identificado_ptbr_nr12->setSize(80);
        $acionado_outro_operador->setSize(80);
        $apresenta_retencao_nr12->setSize(80);
        $dispositivo_usado_partida->setSize(80);
        $dispositivo_seguranca_nr12->setSize(80);
        $parecer_extra_norma->setSize('70%', 70);
        $acionado_outro_operador_nr12->setSize(80);
        $dispositivo_usado_partida_nr12->setSize(80);
        $pe_parecer_tecnico_dispositivo_pe_item_norma_id->setSize('70%');
        $pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id->setSize('70%');





        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Apreciação:', '#ff0000', '14px', null)],[$apreciacao_id]);
        $row2 = $this->form->addFields([new TLabel('Vista dispositivo:', '#ff0000', '14px', null)],[$vista_dispositivo]);
        $row3 = $this->form->addFields([new TLabel('Há dispositivos de segurança instalados?:', '#ff0000', '14px', null)],[$dispositivo_seguranca],[new TLabel('Atende NR12?:', '#ff0000', '14px', null)],[$dispositivo_seguranca_nr12]);
        $row4 = $this->form->addFields([new TLabel('O dispositivo é utilizado para partida?:', '#ff0000', '14px', null)],[$dispositivo_usado_partida],[new TLabel('Atende NR12?:', '#ff0000', '14px', null)],[$dispositivo_usado_partida_nr12]);
        $row5 = $this->form->addFields([new TLabel('Pode ser acionado por outro operador?:', '#ff0000', '14px', null)],[$acionado_outro_operador],[new TLabel('Atende NR12?:', '#ff0000', '14px', null)],[$acionado_outro_operador_nr12]);
        $row6 = $this->form->addFields([new TLabel('É passível de burla?:', '#ff0000', '14px', null)],[$passivel_burla],[new TLabel('Atende NR12?:', '#ff0000', '14px', null)],[$passivel_burla_nr12]);
        $row7 = $this->form->addFields([new TLabel('Está identificado em Língua Portuguesa?:', '#ff0000', '14px', null)],[$identificado_ptbr],[new TLabel('Atende NR12?:', '#ff0000', '14px', null)],[$identificado_ptbr_nr12]);
        $row8 = $this->form->addFields([new TLabel('Exige rearme manual?:', '#ff0000', '14px', null)],[$rearme_manual],[new TLabel('Atende NR12?:', '#ff0000', '14px', null)],[$rearme_manual_nr12]);
        $row9 = $this->form->addFields([new TLabel('Apresenta retenção após acionado?:', '#ff0000', '14px', null)],[$apresenta_retencao],[new TLabel('Atende NR12?:', '#ff0000', '14px', null)],[$apresenta_retencao_nr12]);
        $row10 = $this->form->addFields([new TLabel('Acionado em EBT?:', '#ff0000', '14px', null)],[$acionado_ebt],[new TLabel('Atende NR12?:', '#ff0000', '14px', null)],[$acionado_ebt_nr12]);
        $row11 = $this->form->addContent([new TFormSeparator('Parecer Técnico', '#333333', '18', '#eeeeee')]);
        $row12 = $this->form->addFields([new TLabel('Título parecer técnico:', '#ff0000', '14px', null)],[$pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id]);
        $row13 = $this->form->addFields([new TLabel('Item norma:', '#ff0000', '14px', null)],[$pe_parecer_tecnico_dispositivo_pe_item_norma_id]);
        $row14 = $this->form->addFields([$pe_parecer_tecnico_dispositivo_pe_id]);         
        $add_pe_parecer_tecnico_dispositivo_pe = new TButton('add_pe_parecer_tecnico_dispositivo_pe');

        $action_pe_parecer_tecnico_dispositivo_pe = new TAction(array($this, 'onAddPeParecerTecnicoDispositivoPe'));

        $add_pe_parecer_tecnico_dispositivo_pe->setAction($action_pe_parecer_tecnico_dispositivo_pe, 'Adicionar');
        $add_pe_parecer_tecnico_dispositivo_pe->setImage('fa:plus #000000');

        $this->form->addFields([$add_pe_parecer_tecnico_dispositivo_pe]);

        $this->pe_parecer_tecnico_dispositivo_pe_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->pe_parecer_tecnico_dispositivo_pe_list->style = 'width:100%';
        $this->pe_parecer_tecnico_dispositivo_pe_list->class .= ' table-bordered';
        $this->pe_parecer_tecnico_dispositivo_pe_list->disableDefaultClick();
        $this->pe_parecer_tecnico_dispositivo_pe_list->addQuickColumn('', 'edit', 'left', 50);
        $this->pe_parecer_tecnico_dispositivo_pe_list->addQuickColumn('', 'delete', 'left', 50);

        $column_pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = $this->pe_parecer_tecnico_dispositivo_pe_list->addQuickColumn('Título parecer técnico', 'pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id', 'left');
        $column_pe_parecer_tecnico_dispositivo_pe_item_norma_id = $this->pe_parecer_tecnico_dispositivo_pe_list->addQuickColumn('Item norma id', 'pe_parecer_tecnico_dispositivo_pe_item_norma_id', 'left');

        $this->pe_parecer_tecnico_dispositivo_pe_list->createModel();
        $this->form->addContent([$this->pe_parecer_tecnico_dispositivo_pe_list]);
        $row15 = $this->form->addFields([new TLabel('Parecer técnico adicional:', null, '14px', null)],[$parecer_extra_norma]);

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Lançamentos','Cadastro de dispositivo pe']));
        $container->add($this->form);

        parent::add($container);

    }

    public static function onChangepe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id($param)
    {
        try
        {

            if (isset($param['pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id']) && $param['pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id'])
            { 
                $criteria = TCriteria::create(['titulo_id' => (int) $param['pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'pe_parecer_tecnico_dispositivo_pe_item_norma_id', 'nr12', 'ItemNorma', 'id', '{codigo_item_norma} - {descricao_item_norma} ', 'descricao_item_norma asc', $criteria, TRUE); 
            } 
            else 
            { 
                TCombo::clearField(self::$formName, 'pe_parecer_tecnico_dispositivo_pe_item_norma_id'); 
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

            $object = new DispositivoPe(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $vista_dispositivo_dir = '../documents'; 

            $object->store(); // save the object 

            $this->fireEvents($object);

            $this->saveFile($object, $data, 'vista_dispositivo', $vista_dispositivo_dir);  

            $pe_parecer_tecnico_dispositivo_pe_items = $this->storeItems('PeParecerTecnico', 'dispositivo_pe_id', $object, 'pe_parecer_tecnico_dispositivo_pe', function($masterObject, $detailObject){ 

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

                $object = new DispositivoPe($key); // instantiates the Active Record 

                $pe_parecer_tecnico_dispositivo_pe_items = $this->loadItems('PeParecerTecnico', 'dispositivo_pe_id', $object, 'pe_parecer_tecnico_dispositivo_pe', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                    $objectItems->pe_parecer_tecnico_dispositivo_pe_item_norma_id = null;
                    if(isset($detailObject->item_norma->id) && $detailObject->item_norma->id)
                    {
                        $objectItems->pe_parecer_tecnico_dispositivo_pe_item_norma_id = $detailObject->item_norma->id;
                    }
                    $objectItems->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = null;
                    if(isset($detailObject->titulo_parecer_tecnico->id) && $detailObject->titulo_parecer_tecnico->id)
                    {
                        $objectItems->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = $detailObject->titulo_parecer_tecnico->id;
                    }

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

        TSession::setValue('pe_parecer_tecnico_dispositivo_pe_items', null);

        $this->onReload();
    }

    public function onAddPeParecerTecnicoDispositivoPe( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Titulo parecer tecnico id'));
            }             
            if(!$data->pe_parecer_tecnico_dispositivo_pe_item_norma_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Item norma id'));
            }             

            $pe_parecer_tecnico_dispositivo_pe_items = TSession::getValue('pe_parecer_tecnico_dispositivo_pe_items');
            $key = isset($data->pe_parecer_tecnico_dispositivo_pe_id) && $data->pe_parecer_tecnico_dispositivo_pe_id ? $data->pe_parecer_tecnico_dispositivo_pe_id : uniqid();
            $fields = []; 

            $fields['pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id'] = $data->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id;
            $fields['pe_parecer_tecnico_dispositivo_pe_item_norma_id'] = $data->pe_parecer_tecnico_dispositivo_pe_item_norma_id;
            $pe_parecer_tecnico_dispositivo_pe_items[ $key ] = $fields;

            TSession::setValue('pe_parecer_tecnico_dispositivo_pe_items', $pe_parecer_tecnico_dispositivo_pe_items);

            $data->pe_parecer_tecnico_dispositivo_pe_id = '';
            $data->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = '';
            $data->pe_parecer_tecnico_dispositivo_pe_item_norma_id = '';

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

    public function onEditPeParecerTecnicoDispositivoPe( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('pe_parecer_tecnico_dispositivo_pe_items');

        // get the session item
        $item = $items[$param['pe_parecer_tecnico_dispositivo_pe_id_row_id']];

        $data->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = $item['pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id'];
        $data->pe_parecer_tecnico_dispositivo_pe_item_norma_id = $item['pe_parecer_tecnico_dispositivo_pe_item_norma_id'];

        $data->pe_parecer_tecnico_dispositivo_pe_id = $param['pe_parecer_tecnico_dispositivo_pe_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->fireEvents($data);

        $this->onReload( $param );
    }

    public function onDeletePeParecerTecnicoDispositivoPe( $param )
    {
        $data = $this->form->getData();

        $data->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = '';
        $data->pe_parecer_tecnico_dispositivo_pe_item_norma_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('pe_parecer_tecnico_dispositivo_pe_items');

        // delete the item from session
        unset($items[$param['pe_parecer_tecnico_dispositivo_pe_id_row_id']]);
        TSession::setValue('pe_parecer_tecnico_dispositivo_pe_items', $items);

        $this->fireEvents($data);

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadPeParecerTecnicoDispositivoPe( $param )
    {
        $items = TSession::getValue('pe_parecer_tecnico_dispositivo_pe_items'); 

        $this->pe_parecer_tecnico_dispositivo_pe_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeletePeParecerTecnicoDispositivoPe')); 
                $action_del->setParameter('pe_parecer_tecnico_dispositivo_pe_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditPeParecerTecnicoDispositivoPe'));  
                $action_edi->setParameter('pe_parecer_tecnico_dispositivo_pe_id_row_id', $key);  

                $button_del = new TButton('delete_pe_parecer_tecnico_dispositivo_pe'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_pe_parecer_tecnico_dispositivo_pe'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                $rowItem->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = '';
                if(isset($item['pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id']) && $item['pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id'])
                {
                    TTransaction::open('nr12');
                    $titulo_parecer_tecnico = TituloParecerTecnico::find($item['pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id']);
                    if($titulo_parecer_tecnico)
                    {
                        $rowItem->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = $titulo_parecer_tecnico->render('{titulo_parecer_tecnico} ');
                    }
                    TTransaction::close();
                }

                $rowItem->pe_parecer_tecnico_dispositivo_pe_item_norma_id = '';
                if(isset($item['pe_parecer_tecnico_dispositivo_pe_item_norma_id']) && $item['pe_parecer_tecnico_dispositivo_pe_item_norma_id'])
                {
                    TTransaction::open('nr12');
                    $item_norma = ItemNorma::find($item['pe_parecer_tecnico_dispositivo_pe_item_norma_id']);
                    if($item_norma)
                    {
                        $rowItem->pe_parecer_tecnico_dispositivo_pe_item_norma_id = $item_norma->render('{codigo_item_norma} - {descricao_item_norma} ');
                    }
                    TTransaction::close();
                }

                $row = $this->pe_parecer_tecnico_dispositivo_pe_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onShow($param = null)
    {
        TSession::setValue('pe_parecer_tecnico_dispositivo_pe_items', null);

        $this->onReload();

    } 

    public function fireEvents( $object )
    {
        $obj = new stdClass;
        if(is_object($object) && get_class($object) == 'stdClass')
        {
            if(isset($object->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id))
            {
                $obj->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = $object->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id;
            }
            if(isset($object->pe_parecer_tecnico_dispositivo_pe_item_norma_id))
            {
                $obj->pe_parecer_tecnico_dispositivo_pe_item_norma_id = $object->pe_parecer_tecnico_dispositivo_pe_item_norma_id;
            }
        }
        elseif(is_object($object))
        {
            if(isset($object->pe_parecer_tecnico->dispositivo_pe->titulo_parecer_tecnico->id))
            {
                $obj->pe_parecer_tecnico_dispositivo_pe_titulo_parecer_tecnico_id = $object->pe_parecer_tecnico->dispositivo_pe->titulo_parecer_tecnico->id;
            }
            if(isset($object->pe_parecer_tecnico->dispositivo_pe->item_norma->id))
            {
                $obj->pe_parecer_tecnico_dispositivo_pe_item_norma_id = $object->pe_parecer_tecnico->dispositivo_pe->item_norma->id;
            }
        }
        TForm::sendData(self::$formName, $obj);
    }  

    public function onReload($params = null)
    {
        $this->loaded = TRUE;

        $this->onReloadPeParecerTecnicoDispositivoPe($params);
    }

    public function show() 
    { 
        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') ) 
        { 
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }

}

