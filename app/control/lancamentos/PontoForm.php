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
        $this->form->setFormTitle('Cadastro de ponto');

        //<onBeginPageCreation>

        //</onBeginPageCreation>

        $id = new TEntry('id');
        $apreciacao_id = new TDBCombo('apreciacao_id', 'nr12', 'Apreciacao', 'id', '{id} - {equipamento->nome} - {equipamento->tag} - {equipamento->patrimonio} ','id asc'  );
        $vista_ponto = new TFile('vista_ponto');
        $localizacao_ponto = new TCombo('localizacao_ponto');
        $ponto_perigo_ponto_tipo_perigo_id = new TDBCombo('ponto_perigo_ponto_tipo_perigo_id', 'nr12', 'TipoPerigo', 'id', '{tipo_perigo}','tipo_perigo asc'  );
        $ponto_perigo_ponto_perigo_id = new TCombo('ponto_perigo_ponto_perigo_id');
        $ponto_risco_ponto_tipo_perigo_id = new TDBCombo('ponto_risco_ponto_tipo_perigo_id', 'nr12', 'TipoPerigo', 'id', '{tipo_perigo}','tipo_perigo asc'  );
        $ponto_risco_ponto_risco_id = new TCombo('ponto_risco_ponto_risco_id');
        $ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = new TDBCombo('ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id', 'nr12', 'TipoSistemaSeguranca', 'id', '{tipo_sistema_seguranca}','tipo_sistema_seguranca asc'  );
        $ponto_sistema_seguranca_ponto_sistema_seguranca_id = new TCombo('ponto_sistema_seguranca_ponto_sistema_seguranca_id');
        $s_ferimento_id = new TDBCombo('s_ferimento_id', 'nr12', 'SFerimento', 'id', '{classificacao} - {severidade} ','id asc'  );
        $f_exposicao_id = new TDBCombo('f_exposicao_id', 'nr12', 'FExposicao', 'id', '{classificacao} - {frequencia} ','id asc'  );
        $p_evitar_perigo_id = new TDBCombo('p_evitar_perigo_id', 'nr12', 'PEvitarPerigo', 'id', '{classificacao} - {possibilidade_evitar} ','id asc'  );
        $hrn_pe_id = new TDBCombo('hrn_pe_id', 'nr12', 'HrnPe', 'id', '{valor} - {descricao} - {dica} ','id asc'  );
        $hrn_fe_id = new TDBCombo('hrn_fe_id', 'nr12', 'HrnFe', 'id', '{valor} - {descricao} - {dica} ','id asc'  );
        $hrn_pmp_id = new TDBCombo('hrn_pmp_id', 'nr12', 'HrnPmp', 'id', '{valor} - {descricao} - {dica} ','id asc'  );
        $hrn_np_id = new TDBCombo('hrn_np_id', 'nr12', 'HrnNp', 'id', '{valor} - {descricao} - {dica} ','id asc'  );
        $ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = new TDBCombo('ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id', 'nr12', 'TituloParecerTecnico', 'id', '{titulo_parecer_tecnico}','id asc'  );
        $ponto_parecer_tecnico_ponto_item_norma_id = new TCombo('ponto_parecer_tecnico_ponto_item_norma_id');
        $parecer_extra_norma = new TText('parecer_extra_norma');
        $possiveis_solucoes = new TText('possiveis_solucoes');
        $ponto_perigo_ponto_id = new THidden('ponto_perigo_ponto_id');
        $ponto_risco_ponto_id = new THidden('ponto_risco_ponto_id');
        $ponto_sistema_seguranca_ponto_id = new THidden('ponto_sistema_seguranca_ponto_id');
        $ponto_parecer_tecnico_ponto_id = new THidden('ponto_parecer_tecnico_ponto_id');

        $ponto_perigo_ponto_tipo_perigo_id->setChangeAction(new TAction([$this,'onChangeponto_perigo_ponto_tipo_perigo_id']));
        $ponto_risco_ponto_tipo_perigo_id->setChangeAction(new TAction([$this,'onChangeponto_risco_ponto_tipo_perigo_id']));
        $ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id->setChangeAction(new TAction([$this,'onChangeponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id']));
        $ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id->setChangeAction(new TAction([$this,'onChangeponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id']));

        $apreciacao_id->addValidation('Apreciacao', new TRequiredValidator()); 
        $vista_ponto->addValidation('Vista ponto', new TRequiredValidator()); 
        $localizacao_ponto->addValidation('Localizacao ponto', new TRequiredValidator()); 
        $s_ferimento_id->addValidation('S', new TRequiredValidator()); 
        $f_exposicao_id->addValidation('F', new TRequiredValidator()); 

        $id->setEditable(false);
        $vista_ponto->enableFileHandling();
        $vista_ponto->setAllowedExtensions(["png","gif","jpg","jpeg"]);
        $localizacao_ponto->addItems(['Frontal'=>'Frontal','Lateral esquerda'=>'Lateral esquerda','Lateral direita'=>'Lateral direita','Posterior'=>'Posterior']);
        $id->setSize(100);
        $hrn_np_id->setSize('70%');
        $hrn_fe_id->setSize('70%');
        $hrn_pe_id->setSize('70%');
        $hrn_pmp_id->setSize('70%');
        $vista_ponto->setSize('70%');
        $apreciacao_id->setSize('70%');
        $f_exposicao_id->setSize('70%');
        $s_ferimento_id->setSize('71%');
        $localizacao_ponto->setSize('70%');
        $p_evitar_perigo_id->setSize('70%');
        $possiveis_solucoes->setSize('70%', 80);
        $parecer_extra_norma->setSize('70%', 80);
        $ponto_risco_ponto_risco_id->setSize('70%');
        $ponto_perigo_ponto_perigo_id->setSize('70%');
        $ponto_risco_ponto_tipo_perigo_id->setSize('70%');
        $ponto_perigo_ponto_tipo_perigo_id->setSize('70%');
        $ponto_parecer_tecnico_ponto_item_norma_id->setSize('70%');
        $ponto_sistema_seguranca_ponto_sistema_seguranca_id->setSize('70%');
        $ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id->setSize('70%');
        $ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id->setSize('70%');





        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Apreciação:', '#ff0000', '14px', null)],[$apreciacao_id]);
        $row2 = $this->form->addFields([new TLabel('Vista ponto:', '#ff0000', '14px', null)],[$vista_ponto],[new TLabel('Localizacao ponto:', '#ff0000', '14px', null)],[$localizacao_ponto]);
        $row3 = $this->form->addContent([new TFormSeparator('Perigos', '#333333', '18', '#eeeeee')]);
        $row4 = $this->form->addFields([new TLabel('Tipo perigo:', '#ff0000', '14px', null)],[$ponto_perigo_ponto_tipo_perigo_id]);
        $row5 = $this->form->addFields([new TLabel('Perigo:', '#ff0000', '14px', null)],[$ponto_perigo_ponto_perigo_id]);
        $row6 = $this->form->addFields([$ponto_perigo_ponto_id]);         
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

        $column_ponto_perigo_ponto_tipo_perigo_id = $this->ponto_perigo_ponto_list->addQuickColumn('Tipo perigo', 'ponto_perigo_ponto_tipo_perigo_id', 'left');
        $column_ponto_perigo_ponto_perigo_id = $this->ponto_perigo_ponto_list->addQuickColumn('Perigo', 'ponto_perigo_ponto_perigo_id', 'left');

        $this->ponto_perigo_ponto_list->createModel();
        $this->form->addContent([$this->ponto_perigo_ponto_list]);
        $row7 = $this->form->addContent([new TFormSeparator('Riscos', '#333333', '18', '#eeeeee')]);
        $row8 = $this->form->addFields([new TLabel('Tipo perigo:', '#ff0000', '14px', null)],[$ponto_risco_ponto_tipo_perigo_id]);
        $row9 = $this->form->addFields([new TLabel('Risco:', '#ff0000', '14px', null)],[$ponto_risco_ponto_risco_id]);
        $row10 = $this->form->addFields([$ponto_risco_ponto_id]);         
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

        $column_ponto_risco_ponto_tipo_perigo_id = $this->ponto_risco_ponto_list->addQuickColumn('Tipo perigo', 'ponto_risco_ponto_tipo_perigo_id', 'left');
        $column_ponto_risco_ponto_risco_id = $this->ponto_risco_ponto_list->addQuickColumn('Risco', 'ponto_risco_ponto_risco_id', 'left');

        $this->ponto_risco_ponto_list->createModel();
        $this->form->addContent([$this->ponto_risco_ponto_list]);
        $row11 = $this->form->addContent([new TFormSeparator('Sistemas de Segurança Aplicados', '#333333', '18', '#eeeeee')]);
        $row12 = $this->form->addFields([new TLabel('Tipo sistema segurança:', '#ff0000', '14px', null)],[$ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id]);
        $row13 = $this->form->addFields([new TLabel('Sistema segurança:', '#ff0000', '14px', null)],[$ponto_sistema_seguranca_ponto_sistema_seguranca_id]);
        $row14 = $this->form->addFields([$ponto_sistema_seguranca_ponto_id]);         
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

        $column_ponto_sistema_seguranca_ponto_sistema_seguranca_id = $this->ponto_sistema_seguranca_ponto_list->addQuickColumn('Sistema seguranca', 'ponto_sistema_seguranca_ponto_sistema_seguranca_id', 'left');
        $column_ponto_sistema_seguranca_ponto_id = $this->ponto_sistema_seguranca_ponto_list->addQuickColumn('Tipo sistema seguranca', 'ponto_sistema_seguranca_ponto_id', 'left');

        $this->ponto_sistema_seguranca_ponto_list->createModel();
        $this->form->addContent([$this->ponto_sistema_seguranca_ponto_list]);
        $row15 = $this->form->addContent([new TFormSeparator('Categorias para partes relacionadas a seguranca de sistemas de comando', '#333333', '18', '#eeeeee')]);
        $row16 = $this->form->addFields([new TLabel('S - Severidade do ferimento?', '#ff0000', '14px', null)],[$s_ferimento_id]);
        $row17 = $this->form->addFields([new TLabel('F - Frequencia/tempo de exposicao ao perigo:', '#ff0000', '14px', null)],[$f_exposicao_id]);
        $row18 = $this->form->addFields([new TLabel('P - Possibilidade de evitar o perigo:', '#ff0000', '14px', null)],[$p_evitar_perigo_id]);
        $row19 = $this->form->addContent([new TFormSeparator('HRN', '#333333', '18', '#eeeeee')]);
        $row20 = $this->form->addFields([new TLabel('Probabilidade de Exposição (PE):', '#ff0000', '14px', null)],[$hrn_pe_id]);
        $row21 = $this->form->addFields([new TLabel('Frequência de Exposição (FE):', '#ff0000', '14px', null)],[$hrn_fe_id]);
        $row22 = $this->form->addFields([new TLabel('Probabilidade Máxima de Perda (PMP):', '#ff0000', '14px', null)],[$hrn_pmp_id]);
        $row23 = $this->form->addFields([new TLabel('Número de pessoas expostas ao risco (NP):', '#ff0000', '14px', null)],[$hrn_np_id]);
        $row24 = $this->form->addContent([new TFormSeparator('Parecer Técnico', '#333333', '18', '#eeeeee')]);
        $row25 = $this->form->addFields([new TLabel('Titulo parecer técnico:', '#ff0000', '14px', null)],[$ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id]);
        $row26 = $this->form->addFields([new TLabel('Item norma:', '#ff0000', '14px', null)],[$ponto_parecer_tecnico_ponto_item_norma_id]);
        $row27 = $this->form->addFields([$ponto_parecer_tecnico_ponto_id]);         
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

        $column_ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = $this->ponto_parecer_tecnico_ponto_list->addQuickColumn('Titulo parecer tecnico', 'ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id', 'left');
        $column_ponto_parecer_tecnico_ponto_item_norma_id = $this->ponto_parecer_tecnico_ponto_list->addQuickColumn('Item norma', 'ponto_parecer_tecnico_ponto_item_norma_id', 'left');

        $this->ponto_parecer_tecnico_ponto_list->createModel();
        $this->form->addContent([$this->ponto_parecer_tecnico_ponto_list]);
        $row28 = $this->form->addFields([new TLabel('Parecer técnico adicional:', null, '14px', null)],[$parecer_extra_norma]);
        $row29 = $this->form->addFields([new TLabel('Possíveis Soluções:', null, '14px', null)],[$possiveis_solucoes]);

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

    public static function onChangeponto_perigo_ponto_tipo_perigo_id($param)
    {
        try
        {

            if (isset($param['ponto_perigo_ponto_tipo_perigo_id']) && $param['ponto_perigo_ponto_tipo_perigo_id'])
            { 
                $criteria = TCriteria::create(['tipo_perigo_id' => (int) $param['ponto_perigo_ponto_tipo_perigo_id']]);
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

    public static function onChangeponto_risco_ponto_tipo_perigo_id($param)
    {
        try
        {

            if (isset($param['ponto_risco_ponto_tipo_perigo_id']) && $param['ponto_risco_ponto_tipo_perigo_id'])
            { 
                $criteria = TCriteria::create(['tipo_perigo_id' => (int) $param['ponto_risco_ponto_tipo_perigo_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'ponto_risco_ponto_risco_id', 'nr12', 'Risco', 'id', '{risco}', 'risco asc', $criteria, TRUE); 
            } 
            else 
            { 
                TCombo::clearField(self::$formName, 'ponto_risco_ponto_risco_id'); 
            }  

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    } 

    public static function onChangeponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id($param)
    {
        try
        {

            if (isset($param['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id']) && $param['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id'])
            { 
                $criteria = TCriteria::create(['tipo_sistema_seguranca_id' => (int) $param['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'ponto_sistema_seguranca_ponto_sistema_seguranca_id', 'nr12', 'SistemaSeguranca', 'id', '{sistema_seguranca}', 'sistema_seguranca asc', $criteria, TRUE); 
            } 
            else 
            { 
                TCombo::clearField(self::$formName, 'ponto_sistema_seguranca_ponto_sistema_seguranca_id'); 
            }  

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    } 

    public static function onChangeponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id($param)
    {
        try
        {

            if (isset($param['ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id']) && $param['ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id'])
            { 
                $criteria = TCriteria::create(['titulo_id' => (int) $param['ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'ponto_parecer_tecnico_ponto_item_norma_id', 'nr12', 'ItemNorma', 'id', '{descricao_item_norma}', 'descricao_item_norma asc', $criteria, TRUE); 
            } 
            else 
            { 
                TCombo::clearField(self::$formName, 'ponto_parecer_tecnico_ponto_item_norma_id'); 
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
//<generatedAutoCode>

            $vista_ponto_dir = '../documents';
//</generatedAutoCode> 

            $object->store(); // save the object //</blockLine>

            //</afterStoreAutoCode> //</blockLine>
 //<generatedAutoCode>

            $this->fireEvents($object);

            $this->saveFile($object, $data, 'vista_ponto', $vista_ponto_dir);
//</generatedAutoCode>

    //<detail-48182-430377> //</hideLine>
            $ponto_parecer_tecnico_ponto_items = $this->storeItems('PontoParecerTecnico', 'ponto_id', $object, 'ponto_parecer_tecnico_ponto', function($masterObject, $detailObject){ //</blockLine>

                //code here

                //</autoCode>
            }); //</blockLine>
    //</hideLine> //</detail-48182-430377>

    //<detail-48185-467571> //</hideLine>
            $ponto_sistema_seguranca_ponto_items = $this->storeItems('PontoSistemaSeguranca', 'ponto_id', $object, 'ponto_sistema_seguranca_ponto', function($masterObject, $detailObject){ //</blockLine>

                //code here

                //</autoCode>
            }); //</blockLine>
    //</hideLine> //</detail-48185-467571>

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
//<generatedAutoCode>

                    $objectItems->ponto_parecer_tecnico_ponto_item_norma_id = null;
                    if(isset($detailObject->item_norma_id) && $detailObject->item_norma_id)
                    {
                        $objectItems->ponto_parecer_tecnico_ponto_item_norma_id = $detailObject->item_norma_id;
                    }
                    $objectItems->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = null;
                    if(isset($detailObject->titulo_parecer_tecnico->id) && $detailObject->titulo_parecer_tecnico->id)
                    {
                        $objectItems->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = $detailObject->titulo_parecer_tecnico->id;
                    }

//</generatedAutoCode>

                }); //</blockLine>
    //</hideLine> //</detail-48182-430377>

    //<detail-48185-467571> //</hideLine>
                $ponto_sistema_seguranca_ponto_items = $this->loadItems('PontoSistemaSeguranca', 'ponto_id', $object, 'ponto_sistema_seguranca_ponto', function($masterObject, $detailObject, $objectItems){ //</blockLine>

                    //code here

                    //</autoCode>
//<generatedAutoCode>

                    $objectItems->ponto_sistema_seguranca_ponto_sistema_seguranca_id = null;
                    if(isset($detailObject->sistema_seguranca_id) && $detailObject->sistema_seguranca_id)
                    {
                        $objectItems->ponto_sistema_seguranca_ponto_sistema_seguranca_id = $detailObject->sistema_seguranca_id;
                    }
                    $objectItems->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = null;
                    if(isset($detailObject->tipo_sistema_seguranca->id) && $detailObject->tipo_sistema_seguranca->id)
                    {
                        $objectItems->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = $detailObject->tipo_sistema_seguranca->id;
                    }

//</generatedAutoCode>

                }); //</blockLine>
    //</hideLine> //</detail-48185-467571>

    //<detail-59427-458919> //</hideLine>
                $ponto_risco_ponto_items = $this->loadItems('PontoRisco', 'ponto_id', $object, 'ponto_risco_ponto', function($masterObject, $detailObject, $objectItems){ //</blockLine>

                    //code here

                    //</autoCode>
//<generatedAutoCode>

                    $objectItems->ponto_risco_ponto_risco_id = null;
                    if(isset($detailObject->risco_id) && $detailObject->risco_id)
                    {
                        $objectItems->ponto_risco_ponto_risco_id = $detailObject->risco_id;
                    }
                    $objectItems->ponto_risco_ponto_tipo_perigo_id = null;
                    if(isset($detailObject->tipo_perigo->id) && $detailObject->tipo_perigo->id)
                    {
                        $objectItems->ponto_risco_ponto_tipo_perigo_id = $detailObject->tipo_perigo->id;
                    }

//</generatedAutoCode>

                }); //</blockLine>
    //</hideLine> //</detail-59427-458919>

    //<detail-59428-458922> //</hideLine>
                $ponto_perigo_ponto_items = $this->loadItems('PontoPerigo', 'ponto_id', $object, 'ponto_perigo_ponto', function($masterObject, $detailObject, $objectItems){ //</blockLine>

                    //code here

                    //</autoCode>
//<generatedAutoCode>

                    $objectItems->ponto_perigo_ponto_perigo_id = null;
                    if(isset($detailObject->perigo_id) && $detailObject->perigo_id)
                    {
                        $objectItems->ponto_perigo_ponto_perigo_id = $detailObject->perigo_id;
                    }
                    $objectItems->ponto_perigo_ponto_tipo_perigo_id = null;
                    if(isset($detailObject->tipo_perigo->id) && $detailObject->tipo_perigo->id)
                    {
                        $objectItems->ponto_perigo_ponto_tipo_perigo_id = $detailObject->tipo_perigo->id;
                    }

//</generatedAutoCode>

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

            if(!$data->ponto_perigo_ponto_tipo_perigo_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Tipo perigo'));
            }             
            if(!$data->ponto_perigo_ponto_perigo_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Perigo id'));
            }             

            $ponto_perigo_ponto_items = TSession::getValue('ponto_perigo_ponto_items');
            $key = isset($data->ponto_perigo_ponto_id) && $data->ponto_perigo_ponto_id ? $data->ponto_perigo_ponto_id : uniqid();
            $fields = []; 

            $fields['ponto_perigo_ponto_tipo_perigo_id'] = $data->ponto_perigo_ponto_tipo_perigo_id;
            $fields['ponto_perigo_ponto_perigo_id'] = $data->ponto_perigo_ponto_perigo_id;
            $ponto_perigo_ponto_items[ $key ] = $fields;

            //<onAddDetailPontoPerigoPonto>

            //</onAddDetailPontoPerigoPonto>

            TSession::setValue('ponto_perigo_ponto_items', $ponto_perigo_ponto_items);

            $data->ponto_perigo_ponto_id = '';
            $data->ponto_perigo_ponto_tipo_perigo_id = '';
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

        $data->ponto_perigo_ponto_tipo_perigo_id = $item['ponto_perigo_ponto_tipo_perigo_id'];
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

        $data->ponto_perigo_ponto_tipo_perigo_id = '';
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
                $rowItem->ponto_perigo_ponto_tipo_perigo_id = '';
                if(isset($item['ponto_perigo_ponto_tipo_perigo_id']) && $item['ponto_perigo_ponto_tipo_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_perigo = TipoPerigo::find($item['ponto_perigo_ponto_tipo_perigo_id']);
                    if($tipo_perigo)
                    {
                        $rowItem->ponto_perigo_ponto_tipo_perigo_id = $tipo_perigo->render('{tipo_perigo}');
                    }
                    TTransaction::close();
                }

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

            if(!$data->ponto_risco_ponto_tipo_perigo_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Tipo perigo id'));
            }             
            if(!$data->ponto_risco_ponto_risco_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Risco'));
            }             

            $ponto_risco_ponto_items = TSession::getValue('ponto_risco_ponto_items');
            $key = isset($data->ponto_risco_ponto_id) && $data->ponto_risco_ponto_id ? $data->ponto_risco_ponto_id : uniqid();
            $fields = []; 

            $fields['ponto_risco_ponto_tipo_perigo_id'] = $data->ponto_risco_ponto_tipo_perigo_id;
            $fields['ponto_risco_ponto_risco_id'] = $data->ponto_risco_ponto_risco_id;
            $ponto_risco_ponto_items[ $key ] = $fields;

            //<onAddDetailPontoRiscoPonto>

            //</onAddDetailPontoRiscoPonto>

            TSession::setValue('ponto_risco_ponto_items', $ponto_risco_ponto_items);

            $data->ponto_risco_ponto_id = '';
            $data->ponto_risco_ponto_tipo_perigo_id = '';
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

        $data->ponto_risco_ponto_tipo_perigo_id = $item['ponto_risco_ponto_tipo_perigo_id'];
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

        $data->ponto_risco_ponto_tipo_perigo_id = '';
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
                $rowItem->ponto_perigo_ponto_tipo_perigo_id = '';
                if(isset($item['ponto_perigo_ponto_tipo_perigo_id']) && $item['ponto_perigo_ponto_tipo_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_perigo = TipoPerigo::find($item['ponto_perigo_ponto_tipo_perigo_id']);
                    if($tipo_perigo)
                    {
                        $rowItem->ponto_perigo_ponto_tipo_perigo_id = $tipo_perigo->render('{tipo_perigo}');
                    }
                    TTransaction::close();
                }

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

                $rowItem->ponto_risco_ponto_tipo_perigo_id = '';
                if(isset($item['ponto_risco_ponto_tipo_perigo_id']) && $item['ponto_risco_ponto_tipo_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_perigo = TipoPerigo::find($item['ponto_risco_ponto_tipo_perigo_id']);
                    if($tipo_perigo)
                    {
                        $rowItem->ponto_risco_ponto_tipo_perigo_id = $tipo_perigo->render('{tipo_perigo}');
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

            if(!$data->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Tipo sistema seguranca id'));
            }             
            if(!$data->ponto_sistema_seguranca_ponto_sistema_seguranca_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Sistema seguranca id'));
            }             

            $ponto_sistema_seguranca_ponto_items = TSession::getValue('ponto_sistema_seguranca_ponto_items');
            $key = isset($data->ponto_sistema_seguranca_ponto_id) && $data->ponto_sistema_seguranca_ponto_id ? $data->ponto_sistema_seguranca_ponto_id : uniqid();
            $fields = []; 

            $fields['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id'] = $data->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id;
            $fields['ponto_sistema_seguranca_ponto_sistema_seguranca_id'] = $data->ponto_sistema_seguranca_ponto_sistema_seguranca_id;
            $ponto_sistema_seguranca_ponto_items[ $key ] = $fields;

            //<onAddDetailPontoSistemaSegurancaPonto>

            //</onAddDetailPontoSistemaSegurancaPonto>

            TSession::setValue('ponto_sistema_seguranca_ponto_items', $ponto_sistema_seguranca_ponto_items);

            $data->ponto_sistema_seguranca_ponto_id = '';
            $data->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = '';
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

        $data->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = $item['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id'];
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

        $data->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = '';
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
                $rowItem->ponto_perigo_ponto_tipo_perigo_id = '';
                if(isset($item['ponto_perigo_ponto_tipo_perigo_id']) && $item['ponto_perigo_ponto_tipo_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_perigo = TipoPerigo::find($item['ponto_perigo_ponto_tipo_perigo_id']);
                    if($tipo_perigo)
                    {
                        $rowItem->ponto_perigo_ponto_tipo_perigo_id = $tipo_perigo->render('{tipo_perigo}');
                    }
                    TTransaction::close();
                }

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

                $rowItem->ponto_risco_ponto_tipo_perigo_id = '';
                if(isset($item['ponto_risco_ponto_tipo_perigo_id']) && $item['ponto_risco_ponto_tipo_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_perigo = TipoPerigo::find($item['ponto_risco_ponto_tipo_perigo_id']);
                    if($tipo_perigo)
                    {
                        $rowItem->ponto_risco_ponto_tipo_perigo_id = $tipo_perigo->render('{tipo_perigo}');
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

                $rowItem->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = '';
                if(isset($item['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id']) && $item['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_sistema_seguranca = TipoSistemaSeguranca::find($item['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id']);
                    if($tipo_sistema_seguranca)
                    {
                        $rowItem->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = $tipo_sistema_seguranca->render('{tipo_sistema_seguranca}');
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
                $rowItem->ponto_perigo_ponto_tipo_perigo_id = '';
                if(isset($item['ponto_perigo_ponto_tipo_perigo_id']) && $item['ponto_perigo_ponto_tipo_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_perigo = TipoPerigo::find($item['ponto_perigo_ponto_tipo_perigo_id']);
                    if($tipo_perigo)
                    {
                        $rowItem->ponto_perigo_ponto_tipo_perigo_id = $tipo_perigo->render('{tipo_perigo}');
                    }
                    TTransaction::close();
                }

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

                $rowItem->ponto_risco_ponto_tipo_perigo_id = '';
                if(isset($item['ponto_risco_ponto_tipo_perigo_id']) && $item['ponto_risco_ponto_tipo_perigo_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_perigo = TipoPerigo::find($item['ponto_risco_ponto_tipo_perigo_id']);
                    if($tipo_perigo)
                    {
                        $rowItem->ponto_risco_ponto_tipo_perigo_id = $tipo_perigo->render('{tipo_perigo}');
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

                $rowItem->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = '';
                if(isset($item['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id']) && $item['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id'])
                {
                    TTransaction::open('nr12');
                    $tipo_sistema_seguranca = TipoSistemaSeguranca::find($item['ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id']);
                    if($tipo_sistema_seguranca)
                    {
                        $rowItem->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = $tipo_sistema_seguranca->render('{tipo_sistema_seguranca}');
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
                        $rowItem->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = $titulo_parecer_tecnico->render('{titulo_parecer_tecnico}');
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
            if(isset($object->ponto_perigo_ponto_tipo_perigo_id))
            {
                $obj->ponto_perigo_ponto_tipo_perigo_id = $object->ponto_perigo_ponto_tipo_perigo_id;
            }
            if(isset($object->ponto_perigo_ponto_perigo_id))
            {
                $obj->ponto_perigo_ponto_perigo_id = $object->ponto_perigo_ponto_perigo_id;
            }
            if(isset($object->ponto_risco_ponto_tipo_perigo_id))
            {
                $obj->ponto_risco_ponto_tipo_perigo_id = $object->ponto_risco_ponto_tipo_perigo_id;
            }
            if(isset($object->ponto_risco_ponto_risco_id))
            {
                $obj->ponto_risco_ponto_risco_id = $object->ponto_risco_ponto_risco_id;
            }
            if(isset($object->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id))
            {
                $obj->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = $object->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id;
            }
            if(isset($object->ponto_sistema_seguranca_ponto_sistema_seguranca_id))
            {
                $obj->ponto_sistema_seguranca_ponto_sistema_seguranca_id = $object->ponto_sistema_seguranca_ponto_sistema_seguranca_id;
            }
            if(isset($object->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id))
            {
                $obj->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = $object->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id;
            }
            if(isset($object->ponto_parecer_tecnico_ponto_item_norma_id))
            {
                $obj->ponto_parecer_tecnico_ponto_item_norma_id = $object->ponto_parecer_tecnico_ponto_item_norma_id;
            }
        }
        elseif(is_object($object))
        {
            if(isset($object->ponto_perigo->ponto->tipo_perigo->id))
            {
                $obj->ponto_perigo_ponto_tipo_perigo_id = $object->ponto_perigo->ponto->tipo_perigo->id;
            }
            if(isset($object->ponto_perigo->ponto->perigo_id))
            {
                $obj->ponto_perigo_ponto_perigo_id = $object->ponto_perigo->ponto->perigo_id;
            }
            if(isset($object->ponto_risco->ponto->tipo_perigo->id))
            {
                $obj->ponto_risco_ponto_tipo_perigo_id = $object->ponto_risco->ponto->tipo_perigo->id;
            }
            if(isset($object->ponto_risco->ponto->risco_id))
            {
                $obj->ponto_risco_ponto_risco_id = $object->ponto_risco->ponto->risco_id;
            }
            if(isset($object->ponto_sistema_seguranca->ponto->tipo_sistema_seguranca->id))
            {
                $obj->ponto_sistema_seguranca_ponto_tipo_sistema_seguranca_id = $object->ponto_sistema_seguranca->ponto->tipo_sistema_seguranca->id;
            }
            if(isset($object->ponto_sistema_seguranca->ponto->sistema_seguranca_id))
            {
                $obj->ponto_sistema_seguranca_ponto_sistema_seguranca_id = $object->ponto_sistema_seguranca->ponto->sistema_seguranca_id;
            }
            if(isset($object->ponto_parecer_tecnico->ponto->titulo_parecer_tecnico->id))
            {
                $obj->ponto_parecer_tecnico_ponto_titulo_parecer_tecnico_id = $object->ponto_parecer_tecnico->ponto->titulo_parecer_tecnico->id;
            }
            if(isset($object->ponto_parecer_tecnico->ponto->item_norma_id))
            {
                $obj->ponto_parecer_tecnico_ponto_item_norma_id = $object->ponto_parecer_tecnico->ponto->item_norma_id;
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