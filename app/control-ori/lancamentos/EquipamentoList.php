<?php

class EquipamentoList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private static $database = 'nr12';
    private static $activeRecord = 'Equipamento';
    private static $primaryKey = 'id';
    private static $formName = 'formList_Equipamento';

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle('Listagem de equipamentos');


        $id = new TEntry('id');
        $empresa_unidade_id = new TDBCombo('empresa_unidade_id', 'nr12', 'EmpresaUnidade', 'id', '{id}','id asc'  );
        $nome = new TEntry('nome');
        $tipo = new TEntry('tipo');
        $modelo = new TEntry('modelo');
        $numero_serie = new TEntry('numero_serie');
        $data_fabricacao = new TDate('data_fabricacao');
        $peso = new TNumeric('peso', '2', ',', '.' );
        $capacidade = new TEntry('capacidade');
        $setor = new TEntry('setor');
        $fabricante = new TEntry('fabricante');
        $fabricante_endereco = new TEntry('fabricante_endereco');
        $fabricante_cidade_id = new TEntry('fabricante_cidade_id');
        $fabricante_cep = new TEntry('fabricante_cep');
        $fabricante_cnpj = new TEntry('fabricante_cnpj');
        $fabricante_registro_crea = new TEntry('fabricante_registro_crea');
        $tag = new TEntry('tag');
        $patrimonio = new TEntry('patrimonio');
        $altura = new TNumeric('altura', '2', ',', '.' );
        $largura = new TNumeric('largura', '2', ',', '.' );
        $profundidade = new TNumeric('profundidade', '2', ',', '.' );
        $vista_frontal = new TEntry('vista_frontal');
        $vista_lateral_esquerda = new TEntry('vista_lateral_esquerda');
        $vista_lateral_direita = new TEntry('vista_lateral_direita');
        $vista_posterior = new TEntry('vista_posterior');
        $utilizacao = new TEntry('utilizacao');
        $capacidade_produtiva = new TEntry('capacidade_produtiva');
        $descricao_processos = new TEntry('descricao_processos');
        $numero_operadores = new TEntry('numero_operadores');
        $intervencoes_realizadas = new TEntry('intervencoes_realizadas');
        $fonte_energia = new TEntry('fonte_energia');
        $tempo_acionamento = new TEntry('tempo_acionamento');
        $tempo_ciclo = new TEntry('tempo_ciclo');
        $tempo_parada_emergencia = new TEntry('tempo_parada_emergencia');
        $numero_posicoes_comando = new TEntry('numero_posicoes_comando');
        $outros = new TEntry('outros');

        $data_fabricacao->setMask('dd/mm/yyyy');
        $data_fabricacao->setDatabaseMask('yyyy-mm-dd');
        $id->setSize(100);
        $tag->setSize('70%');
        $peso->setSize('70%');
        $nome->setSize('70%');
        $tipo->setSize('70%');
        $setor->setSize('70%');
        $altura->setSize('70%');
        $outros->setSize('70%');
        $modelo->setSize('70%');
        $largura->setSize('70%');
        $fabricante->setSize('70%');
        $utilizacao->setSize('70%');
        $capacidade->setSize('70%');
        $patrimonio->setSize('70%');
        $tempo_ciclo->setSize('70%');
        $numero_serie->setSize('70%');
        $profundidade->setSize('70%');
        $fonte_energia->setSize('70%');
        $data_fabricacao->setSize(110);
        $vista_frontal->setSize('70%');
        $fabricante_cep->setSize('70%');
        $fabricante_cnpj->setSize('70%');
        $vista_posterior->setSize('70%');
        $tempo_acionamento->setSize('70%');
        $numero_operadores->setSize('70%');
        $empresa_unidade_id->setSize('70%');
        $fabricante_endereco->setSize('70%');
        $descricao_processos->setSize('70%');
        $capacidade_produtiva->setSize('70%');
        $fabricante_cidade_id->setSize('70%');
        $vista_lateral_direita->setSize('70%');
        $vista_lateral_esquerda->setSize('70%');
        $intervencoes_realizadas->setSize('70%');
        $tempo_parada_emergencia->setSize('70%');
        $numero_posicoes_comando->setSize('70%');
        $fabricante_registro_crea->setSize('70%');








        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Empresa unidade id:', null, '14px', null)],[$empresa_unidade_id]);
        $row2 = $this->form->addFields([new TLabel('Nome:', null, '14px', null)],[$nome],[new TLabel('Tipo:', null, '14px', null)],[$tipo]);
        $row3 = $this->form->addFields([new TLabel('Modelo:', null, '14px', null)],[$modelo],[new TLabel('Numero serie:', null, '14px', null)],[$numero_serie]);
        $row4 = $this->form->addFields([new TLabel('Data fabricacao:', null, '14px', null)],[$data_fabricacao],[new TLabel('Peso:', null, '14px', null)],[$peso]);
        $row5 = $this->form->addFields([new TLabel('Capacidade:', null, '14px', null)],[$capacidade],[new TLabel('Setor:', null, '14px', null)],[$setor]);
        $row6 = $this->form->addFields([new TLabel('Fabricante:', null, '14px', null)],[$fabricante],[new TLabel('Fabricante endereco:', null, '14px', null)],[$fabricante_endereco]);
        $row7 = $this->form->addFields([new TLabel('Fabricante cidade id:', null, '14px', null)],[$fabricante_cidade_id],[new TLabel('Fabricante cep:', null, '14px', null)],[$fabricante_cep]);
        $row8 = $this->form->addFields([new TLabel('Fabricante cnpj:', null, '14px', null)],[$fabricante_cnpj],[new TLabel('Fabricante registro crea:', null, '14px', null)],[$fabricante_registro_crea]);
        $row9 = $this->form->addFields([new TLabel('Tag:', null, '14px', null)],[$tag],[new TLabel('Patrimonio:', null, '14px', null)],[$patrimonio]);
        $row10 = $this->form->addFields([new TLabel('Altura:', null, '14px', null)],[$altura],[new TLabel('Largura:', null, '14px', null)],[$largura]);
        $row11 = $this->form->addFields([new TLabel('Profundidade:', null, '14px', null)],[$profundidade],[new TLabel('Vista frontal:', null, '14px', null)],[$vista_frontal]);
        $row12 = $this->form->addFields([new TLabel('Vista lateral esquerda:', null, '14px', null)],[$vista_lateral_esquerda],[new TLabel('Vista lateral direita:', null, '14px', null)],[$vista_lateral_direita]);
        $row13 = $this->form->addFields([new TLabel('Vista posterior:', null, '14px', null)],[$vista_posterior],[new TLabel('Utilizacao:', null, '14px', null)],[$utilizacao]);
        $row14 = $this->form->addFields([new TLabel('Capacidade produtiva:', null, '14px', null)],[$capacidade_produtiva],[new TLabel('Descricao processos:', null, '14px', null)],[$descricao_processos]);
        $row15 = $this->form->addFields([new TLabel('Numero operadores:', null, '14px', null)],[$numero_operadores],[new TLabel('Intervencoes realizadas:', null, '14px', null)],[$intervencoes_realizadas]);
        $row16 = $this->form->addFields([new TLabel('Fonte energia:', null, '14px', null)],[$fonte_energia],[new TLabel('Tempo acionamento:', null, '14px', null)],[$tempo_acionamento]);
        $row17 = $this->form->addFields([new TLabel('Tempo ciclo:', null, '14px', null)],[$tempo_ciclo],[new TLabel('Tempo parada emergencia:', null, '14px', null)],[$tempo_parada_emergencia]);
        $row18 = $this->form->addFields([new TLabel('Numero posicoes comando:', null, '14px', null)],[$numero_posicoes_comando],[new TLabel('Outros:', null, '14px', null)],[$outros]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onexportcsv = $this->form->addAction('Exportar como CSV', new TAction([$this, 'onExportCsv']), 'fa:file-text-o #000000');

        $btn_onshow = $this->form->addAction('Cadastrar', new TAction(['EquipamentoForm', 'onShow']), 'fa:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_id = new TDataGridColumn('id', 'Id', 'center' , '70px');
        $column_empresa_unidade_id = new TDataGridColumn('empresa_unidade_id', 'Empresa unidade id', 'left');
        $column_nome = new TDataGridColumn('nome', 'Nome', 'left');
        $column_tipo = new TDataGridColumn('tipo', 'Tipo', 'left');
        $column_modelo = new TDataGridColumn('modelo', 'Modelo', 'left');
        $column_numero_serie = new TDataGridColumn('numero_serie', 'Numero serie', 'left');
        $column_data_fabricacao = new TDataGridColumn('data_fabricacao', 'Data fabricacao', 'left');
        $column_peso = new TDataGridColumn('peso', 'Peso', 'left');
        $column_capacidade = new TDataGridColumn('capacidade', 'Capacidade', 'left');
        $column_setor = new TDataGridColumn('setor', 'Setor', 'left');
        $column_fabricante = new TDataGridColumn('fabricante', 'Fabricante', 'left');
        $column_fabricante_endereco = new TDataGridColumn('fabricante_endereco', 'Fabricante endereco', 'left');
        $column_fabricante_cidade_id = new TDataGridColumn('fabricante_cidade_id', 'Fabricante cidade id', 'left');
        $column_fabricante_cep = new TDataGridColumn('fabricante_cep', 'Fabricante cep', 'left');
        $column_fabricante_cnpj = new TDataGridColumn('fabricante_cnpj', 'Fabricante cnpj', 'left');
        $column_fabricante_registro_crea = new TDataGridColumn('fabricante_registro_crea', 'Fabricante registro crea', 'left');
        $column_tag = new TDataGridColumn('tag', 'Tag', 'left');
        $column_patrimonio = new TDataGridColumn('patrimonio', 'Patrimonio', 'left');
        $column_altura = new TDataGridColumn('altura', 'Altura', 'left');
        $column_largura = new TDataGridColumn('largura', 'Largura', 'left');
        $column_profundidade = new TDataGridColumn('profundidade', 'Profundidade', 'left');
        $column_vista_frontal = new TDataGridColumn('vista_frontal', 'Vista frontal', 'left');
        $column_vista_lateral_esquerda = new TDataGridColumn('vista_lateral_esquerda', 'Vista lateral esquerda', 'left');
        $column_vista_lateral_direita = new TDataGridColumn('vista_lateral_direita', 'Vista lateral direita', 'left');
        $column_vista_posterior = new TDataGridColumn('vista_posterior', 'Vista posterior', 'left');
        $column_utilizacao = new TDataGridColumn('utilizacao', 'Utilizacao', 'left');
        $column_capacidade_produtiva = new TDataGridColumn('capacidade_produtiva', 'Capacidade produtiva', 'left');
        $column_descricao_processos = new TDataGridColumn('descricao_processos', 'Descricao processos', 'left');
        $column_numero_operadores = new TDataGridColumn('numero_operadores', 'Numero operadores', 'left');
        $column_intervencoes_realizadas = new TDataGridColumn('intervencoes_realizadas', 'Intervencoes realizadas', 'left');
        $column_fonte_energia = new TDataGridColumn('fonte_energia', 'Fonte energia', 'left');
        $column_tempo_acionamento = new TDataGridColumn('tempo_acionamento', 'Tempo acionamento', 'left');
        $column_tempo_ciclo = new TDataGridColumn('tempo_ciclo', 'Tempo ciclo', 'left');
        $column_tempo_parada_emergencia = new TDataGridColumn('tempo_parada_emergencia', 'Tempo parada emergencia', 'left');
        $column_numero_posicoes_comando = new TDataGridColumn('numero_posicoes_comando', 'Numero posicoes comando', 'left');
        $column_outros = new TDataGridColumn('outros', 'Outros', 'left');

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_empresa_unidade_id);
        $this->datagrid->addColumn($column_nome);
        $this->datagrid->addColumn($column_tipo);
        $this->datagrid->addColumn($column_modelo);
        $this->datagrid->addColumn($column_numero_serie);
        $this->datagrid->addColumn($column_data_fabricacao);
        $this->datagrid->addColumn($column_peso);
        $this->datagrid->addColumn($column_capacidade);
        $this->datagrid->addColumn($column_setor);
        $this->datagrid->addColumn($column_fabricante);
        $this->datagrid->addColumn($column_fabricante_endereco);
        $this->datagrid->addColumn($column_fabricante_cidade_id);
        $this->datagrid->addColumn($column_fabricante_cep);
        $this->datagrid->addColumn($column_fabricante_cnpj);
        $this->datagrid->addColumn($column_fabricante_registro_crea);
        $this->datagrid->addColumn($column_tag);
        $this->datagrid->addColumn($column_patrimonio);
        $this->datagrid->addColumn($column_altura);
        $this->datagrid->addColumn($column_largura);
        $this->datagrid->addColumn($column_profundidade);
        $this->datagrid->addColumn($column_vista_frontal);
        $this->datagrid->addColumn($column_vista_lateral_esquerda);
        $this->datagrid->addColumn($column_vista_lateral_direita);
        $this->datagrid->addColumn($column_vista_posterior);
        $this->datagrid->addColumn($column_utilizacao);
        $this->datagrid->addColumn($column_capacidade_produtiva);
        $this->datagrid->addColumn($column_descricao_processos);
        $this->datagrid->addColumn($column_numero_operadores);
        $this->datagrid->addColumn($column_intervencoes_realizadas);
        $this->datagrid->addColumn($column_fonte_energia);
        $this->datagrid->addColumn($column_tempo_acionamento);
        $this->datagrid->addColumn($column_tempo_ciclo);
        $this->datagrid->addColumn($column_tempo_parada_emergencia);
        $this->datagrid->addColumn($column_numero_posicoes_comando);
        $this->datagrid->addColumn($column_outros);

        $action_onEdit = new TDataGridAction(array('EquipamentoForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel('Editar');
        $action_onEdit->setImage('fa:pencil-square-o #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('EquipamentoList', 'onDelete'));
        $action_onDelete->setUseButton(false);
        $action_onDelete->setButtonClass('btn btn-default btn-sm');
        $action_onDelete->setLabel('Excluir');
        $action_onDelete->setImage('fa:trash-o #dd5a43');
        $action_onDelete->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onDelete);

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup;
        $panel->add($this->datagrid);

        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(TBreadCrumb::create(['Lançamentos','Equipamentos']));
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);

    }

    public function onExportCsv($param = null) 
    {
        try
        {
            $this->onSearch();

            TTransaction::open(self::$database); // open a transaction
            $repository = new TRepository(self::$activeRecord); // creates a repository for Customer
            $criteria = new TCriteria; // creates a criteria

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            $records = $repository->load($criteria); // load the objects according to criteria
            if ($records)
            {
                $file = 'tmp/'.uniqid().'.csv';
                $handle = fopen($file, 'w');
                $columns = $this->datagrid->getColumns();

                $csvColumns = [];
                foreach($columns as $column)
                {
                    $csvColumns[] = $column->getLabel();
                }
                fputcsv($handle, $csvColumns, ';');

                foreach ($records as $record)
                {
                    $csvColumns = [];
                    foreach($columns as $column)
                    {
                        $name = $column->getName();
                        $csvColumns[] = $record->{$name};
                    }
                    fputcsv($handle, $csvColumns, ';');
                }
                fclose($handle);

                TPage::openFile($file);
            }
            else
            {
                new TMessage('info', _t('No records found'));       
            }

            TTransaction::close(); // close the transaction
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onDelete($param = null) 
    { 
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                // get the paramseter $key
                $key = $param['key'];
                // open a transaction with database
                TTransaction::open(self::$database);

                // instantiates object
                $object = new Equipamento($key, FALSE); 

                // deletes the object from the database
                $object->delete();

                // close the transaction
                TTransaction::close();

                // reload the listing
                $this->onReload( $param );
                // shows the success message
                new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'));
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
            $action->setParameters($param); // pass the key paramseter ahead
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
        }
    }

    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->id) AND ( (is_scalar($data->id) AND $data->id !== '') OR (is_array($data->id) AND (!empty($data->id)) )) )
        {

            $filters[] = new TFilter('id', '=', $data->id);// create the filter 
        }

        if (isset($data->empresa_unidade_id) AND ( (is_scalar($data->empresa_unidade_id) AND $data->empresa_unidade_id !== '') OR (is_array($data->empresa_unidade_id) AND (!empty($data->empresa_unidade_id)) )) )
        {

            $filters[] = new TFilter('empresa_unidade_id', '=', $data->empresa_unidade_id);// create the filter 
        }

        if (isset($data->nome) AND ( (is_scalar($data->nome) AND $data->nome !== '') OR (is_array($data->nome) AND (!empty($data->nome)) )) )
        {

            $filters[] = new TFilter('nome', 'like', "%{$data->nome}%");// create the filter 
        }

        if (isset($data->tipo) AND ( (is_scalar($data->tipo) AND $data->tipo !== '') OR (is_array($data->tipo) AND (!empty($data->tipo)) )) )
        {

            $filters[] = new TFilter('tipo', 'like', "%{$data->tipo}%");// create the filter 
        }

        if (isset($data->modelo) AND ( (is_scalar($data->modelo) AND $data->modelo !== '') OR (is_array($data->modelo) AND (!empty($data->modelo)) )) )
        {

            $filters[] = new TFilter('modelo', 'like', "%{$data->modelo}%");// create the filter 
        }

        if (isset($data->numero_serie) AND ( (is_scalar($data->numero_serie) AND $data->numero_serie !== '') OR (is_array($data->numero_serie) AND (!empty($data->numero_serie)) )) )
        {

            $filters[] = new TFilter('numero_serie', 'like', "%{$data->numero_serie}%");// create the filter 
        }

        if (isset($data->data_fabricacao) AND ( (is_scalar($data->data_fabricacao) AND $data->data_fabricacao !== '') OR (is_array($data->data_fabricacao) AND (!empty($data->data_fabricacao)) )) )
        {

            $filters[] = new TFilter('data_fabricacao', '=', $data->data_fabricacao);// create the filter 
        }

        if (isset($data->peso) AND ( (is_scalar($data->peso) AND $data->peso !== '') OR (is_array($data->peso) AND (!empty($data->peso)) )) )
        {

            $filters[] = new TFilter('peso', '=', $data->peso);// create the filter 
        }

        if (isset($data->capacidade) AND ( (is_scalar($data->capacidade) AND $data->capacidade !== '') OR (is_array($data->capacidade) AND (!empty($data->capacidade)) )) )
        {

            $filters[] = new TFilter('capacidade', 'like', "%{$data->capacidade}%");// create the filter 
        }

        if (isset($data->setor) AND ( (is_scalar($data->setor) AND $data->setor !== '') OR (is_array($data->setor) AND (!empty($data->setor)) )) )
        {

            $filters[] = new TFilter('setor', 'like', "%{$data->setor}%");// create the filter 
        }

        if (isset($data->fabricante) AND ( (is_scalar($data->fabricante) AND $data->fabricante !== '') OR (is_array($data->fabricante) AND (!empty($data->fabricante)) )) )
        {

            $filters[] = new TFilter('fabricante', 'like', "%{$data->fabricante}%");// create the filter 
        }

        if (isset($data->fabricante_endereco) AND ( (is_scalar($data->fabricante_endereco) AND $data->fabricante_endereco !== '') OR (is_array($data->fabricante_endereco) AND (!empty($data->fabricante_endereco)) )) )
        {

            $filters[] = new TFilter('fabricante_endereco', 'like', "%{$data->fabricante_endereco}%");// create the filter 
        }

        if (isset($data->fabricante_cidade_id) AND ( (is_scalar($data->fabricante_cidade_id) AND $data->fabricante_cidade_id !== '') OR (is_array($data->fabricante_cidade_id) AND (!empty($data->fabricante_cidade_id)) )) )
        {

            $filters[] = new TFilter('fabricante_cidade_id', '=', $data->fabricante_cidade_id);// create the filter 
        }

        if (isset($data->fabricante_cep) AND ( (is_scalar($data->fabricante_cep) AND $data->fabricante_cep !== '') OR (is_array($data->fabricante_cep) AND (!empty($data->fabricante_cep)) )) )
        {

            $filters[] = new TFilter('fabricante_cep', 'like', "%{$data->fabricante_cep}%");// create the filter 
        }

        if (isset($data->fabricante_cnpj) AND ( (is_scalar($data->fabricante_cnpj) AND $data->fabricante_cnpj !== '') OR (is_array($data->fabricante_cnpj) AND (!empty($data->fabricante_cnpj)) )) )
        {

            $filters[] = new TFilter('fabricante_cnpj', 'like', "%{$data->fabricante_cnpj}%");// create the filter 
        }

        if (isset($data->fabricante_registro_crea) AND ( (is_scalar($data->fabricante_registro_crea) AND $data->fabricante_registro_crea !== '') OR (is_array($data->fabricante_registro_crea) AND (!empty($data->fabricante_registro_crea)) )) )
        {

            $filters[] = new TFilter('fabricante_registro_crea', 'like', "%{$data->fabricante_registro_crea}%");// create the filter 
        }

        if (isset($data->tag) AND ( (is_scalar($data->tag) AND $data->tag !== '') OR (is_array($data->tag) AND (!empty($data->tag)) )) )
        {

            $filters[] = new TFilter('tag', 'like', "%{$data->tag}%");// create the filter 
        }

        if (isset($data->patrimonio) AND ( (is_scalar($data->patrimonio) AND $data->patrimonio !== '') OR (is_array($data->patrimonio) AND (!empty($data->patrimonio)) )) )
        {

            $filters[] = new TFilter('patrimonio', 'like', "%{$data->patrimonio}%");// create the filter 
        }

        if (isset($data->altura) AND ( (is_scalar($data->altura) AND $data->altura !== '') OR (is_array($data->altura) AND (!empty($data->altura)) )) )
        {

            $filters[] = new TFilter('altura', '=', $data->altura);// create the filter 
        }

        if (isset($data->largura) AND ( (is_scalar($data->largura) AND $data->largura !== '') OR (is_array($data->largura) AND (!empty($data->largura)) )) )
        {

            $filters[] = new TFilter('largura', '=', $data->largura);// create the filter 
        }

        if (isset($data->profundidade) AND ( (is_scalar($data->profundidade) AND $data->profundidade !== '') OR (is_array($data->profundidade) AND (!empty($data->profundidade)) )) )
        {

            $filters[] = new TFilter('profundidade', '=', $data->profundidade);// create the filter 
        }

        if (isset($data->vista_frontal) AND ( (is_scalar($data->vista_frontal) AND $data->vista_frontal !== '') OR (is_array($data->vista_frontal) AND (!empty($data->vista_frontal)) )) )
        {

            $filters[] = new TFilter('vista_frontal', 'like', "%{$data->vista_frontal}%");// create the filter 
        }

        if (isset($data->vista_lateral_esquerda) AND ( (is_scalar($data->vista_lateral_esquerda) AND $data->vista_lateral_esquerda !== '') OR (is_array($data->vista_lateral_esquerda) AND (!empty($data->vista_lateral_esquerda)) )) )
        {

            $filters[] = new TFilter('vista_lateral_esquerda', 'like', "%{$data->vista_lateral_esquerda}%");// create the filter 
        }

        if (isset($data->vista_lateral_direita) AND ( (is_scalar($data->vista_lateral_direita) AND $data->vista_lateral_direita !== '') OR (is_array($data->vista_lateral_direita) AND (!empty($data->vista_lateral_direita)) )) )
        {

            $filters[] = new TFilter('vista_lateral_direita', 'like', "%{$data->vista_lateral_direita}%");// create the filter 
        }

        if (isset($data->vista_posterior) AND ( (is_scalar($data->vista_posterior) AND $data->vista_posterior !== '') OR (is_array($data->vista_posterior) AND (!empty($data->vista_posterior)) )) )
        {

            $filters[] = new TFilter('vista_posterior', 'like', "%{$data->vista_posterior}%");// create the filter 
        }

        if (isset($data->utilizacao) AND ( (is_scalar($data->utilizacao) AND $data->utilizacao !== '') OR (is_array($data->utilizacao) AND (!empty($data->utilizacao)) )) )
        {

            $filters[] = new TFilter('utilizacao', 'like', "%{$data->utilizacao}%");// create the filter 
        }

        if (isset($data->capacidade_produtiva) AND ( (is_scalar($data->capacidade_produtiva) AND $data->capacidade_produtiva !== '') OR (is_array($data->capacidade_produtiva) AND (!empty($data->capacidade_produtiva)) )) )
        {

            $filters[] = new TFilter('capacidade_produtiva', 'like', "%{$data->capacidade_produtiva}%");// create the filter 
        }

        if (isset($data->descricao_processos) AND ( (is_scalar($data->descricao_processos) AND $data->descricao_processos !== '') OR (is_array($data->descricao_processos) AND (!empty($data->descricao_processos)) )) )
        {

            $filters[] = new TFilter('descricao_processos', 'like', "%{$data->descricao_processos}%");// create the filter 
        }

        if (isset($data->numero_operadores) AND ( (is_scalar($data->numero_operadores) AND $data->numero_operadores !== '') OR (is_array($data->numero_operadores) AND (!empty($data->numero_operadores)) )) )
        {

            $filters[] = new TFilter('numero_operadores', 'like', "%{$data->numero_operadores}%");// create the filter 
        }

        if (isset($data->intervencoes_realizadas) AND ( (is_scalar($data->intervencoes_realizadas) AND $data->intervencoes_realizadas !== '') OR (is_array($data->intervencoes_realizadas) AND (!empty($data->intervencoes_realizadas)) )) )
        {

            $filters[] = new TFilter('intervencoes_realizadas', 'like', "%{$data->intervencoes_realizadas}%");// create the filter 
        }

        if (isset($data->fonte_energia) AND ( (is_scalar($data->fonte_energia) AND $data->fonte_energia !== '') OR (is_array($data->fonte_energia) AND (!empty($data->fonte_energia)) )) )
        {

            $filters[] = new TFilter('fonte_energia', 'like', "%{$data->fonte_energia}%");// create the filter 
        }

        if (isset($data->tempo_acionamento) AND ( (is_scalar($data->tempo_acionamento) AND $data->tempo_acionamento !== '') OR (is_array($data->tempo_acionamento) AND (!empty($data->tempo_acionamento)) )) )
        {

            $filters[] = new TFilter('tempo_acionamento', 'like', "%{$data->tempo_acionamento}%");// create the filter 
        }

        if (isset($data->tempo_ciclo) AND ( (is_scalar($data->tempo_ciclo) AND $data->tempo_ciclo !== '') OR (is_array($data->tempo_ciclo) AND (!empty($data->tempo_ciclo)) )) )
        {

            $filters[] = new TFilter('tempo_ciclo', 'like', "%{$data->tempo_ciclo}%");// create the filter 
        }

        if (isset($data->tempo_parada_emergencia) AND ( (is_scalar($data->tempo_parada_emergencia) AND $data->tempo_parada_emergencia !== '') OR (is_array($data->tempo_parada_emergencia) AND (!empty($data->tempo_parada_emergencia)) )) )
        {

            $filters[] = new TFilter('tempo_parada_emergencia', 'like', "%{$data->tempo_parada_emergencia}%");// create the filter 
        }

        if (isset($data->numero_posicoes_comando) AND ( (is_scalar($data->numero_posicoes_comando) AND $data->numero_posicoes_comando !== '') OR (is_array($data->numero_posicoes_comando) AND (!empty($data->numero_posicoes_comando)) )) )
        {

            $filters[] = new TFilter('numero_posicoes_comando', '=', $data->numero_posicoes_comando);// create the filter 
        }

        if (isset($data->outros) AND ( (is_scalar($data->outros) AND $data->outros !== '') OR (is_array($data->outros) AND (!empty($data->outros)) )) )
        {

            $filters[] = new TFilter('outros', 'like', "%{$data->outros}%");// create the filter 
        }

        $param = array();
        $param['offset']     = 0;
        $param['first_page'] = 1;

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);

        $this->onReload($param);
    }

    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'nr12'
            TTransaction::open(self::$database);

            // creates a repository for Equipamento
            $repository = new TRepository(self::$activeRecord);
            $limit = 20;
            // creates a criteria
            $criteria = new TCriteria;

            if (empty($param['order']))
            {
                $param['order'] = 'id';    
            }

            if (empty($param['direction']))
            {
                $param['direction'] = 'desc';
            }

            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid

                    $this->datagrid->addItem($object);

                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit

            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }

    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  array('onReload', 'onSearch')))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

}

