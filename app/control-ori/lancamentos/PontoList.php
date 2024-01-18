<?php

class PontoList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private static $database = 'nr12';
    private static $activeRecord = 'Ponto';
    private static $primaryKey = 'id';
    private static $formName = 'formList_Ponto';

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
        $this->form->setFormTitle('Listagem de pontos');


        $id = new TEntry('id');
        $apreciacao_id = new TDBCombo('apreciacao_id', 'nr12', 'Apreciacao', 'id', '{id}','id asc'  );
        $vista_ponto = new TEntry('vista_ponto');
        $localizacao_ponto = new TEntry('localizacao_ponto');
        $severidade_ferimento = new TEntry('severidade_ferimento');
        $tipo_perigo_id = new TDBCombo('tipo_perigo_id', 'nr12', 'TipoPerigo', 'id', '{tipo_perigo}','tipo_perigo asc'  );
        $frequencia_exposicao = new TEntry('frequencia_exposicao');
        $possibilidade_evitar = new TEntry('possibilidade_evitar');
        $parecer_extra_norma = new TEntry('parecer_extra_norma');
        $possiveis_solucoes = new TEntry('possiveis_solucoes');

        $id->setSize(100);
        $vista_ponto->setSize('70%');
        $apreciacao_id->setSize('70%');
        $tipo_perigo_id->setSize('70%');
        $localizacao_ponto->setSize('70%');
        $possiveis_solucoes->setSize('70%');
        $parecer_extra_norma->setSize('70%');
        $severidade_ferimento->setSize('70%');
        $frequencia_exposicao->setSize('70%');
        $possibilidade_evitar->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Apreciacao id:', null, '14px', null)],[$apreciacao_id]);
        $row2 = $this->form->addFields([new TLabel('Vista ponto:', null, '14px', null)],[$vista_ponto],[new TLabel('Localizacao ponto:', null, '14px', null)],[$localizacao_ponto]);
        $row3 = $this->form->addFields([new TLabel('Severidade do ferimento:', null, '14px', null)],[$severidade_ferimento],[new TLabel('Tipo perigo id:', null, '14px', null)],[$tipo_perigo_id]);
        $row4 = $this->form->addFields([new TLabel('Frequencia de exposição ao perigo:', null, '14px', null)],[$frequencia_exposicao],[new TLabel('Possibilidade de evitar o perigo:', null, '14px', null)],[$possibilidade_evitar]);
        $row5 = $this->form->addFields([new TLabel('Parecer extra-norma:', null, '14px', null)],[$parecer_extra_norma],[new TLabel('Possíveis soluções:', null, '14px', null)],[$possiveis_solucoes]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onexportcsv = $this->form->addAction('Exportar como CSV', new TAction([$this, 'onExportCsv']), 'fa:file-text-o #000000');

        $btn_onshow = $this->form->addAction('Cadastrar', new TAction(['PontoForm', 'onShow']), 'fa:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_localizacao_ponto = new TDataGridColumn('localizacao_ponto', 'Localizacao ponto', 'left');

        $this->datagrid->addColumn($column_localizacao_ponto);

        $action_onEdit = new TDataGridAction(array('PontoForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel('Editar');
        $action_onEdit->setImage('fa:pencil-square-o #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('PontoList', 'onDelete'));
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
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
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
                $object = new Ponto($key, FALSE); 

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

        if (isset($data->apreciacao_id) AND ( (is_scalar($data->apreciacao_id) AND $data->apreciacao_id !== '') OR (is_array($data->apreciacao_id) AND (!empty($data->apreciacao_id)) )) )
        {

            $filters[] = new TFilter('apreciacao_id', '=', $data->apreciacao_id);// create the filter 
        }

        if (isset($data->vista_ponto) AND ( (is_scalar($data->vista_ponto) AND $data->vista_ponto !== '') OR (is_array($data->vista_ponto) AND (!empty($data->vista_ponto)) )) )
        {

            $filters[] = new TFilter('vista_ponto', 'like', "%{$data->vista_ponto}%");// create the filter 
        }

        if (isset($data->localizacao_ponto) AND ( (is_scalar($data->localizacao_ponto) AND $data->localizacao_ponto !== '') OR (is_array($data->localizacao_ponto) AND (!empty($data->localizacao_ponto)) )) )
        {

            $filters[] = new TFilter('localizacao_ponto', 'like', "%{$data->localizacao_ponto}%");// create the filter 
        }

        if (isset($data->severidade_ferimento) AND ( (is_scalar($data->severidade_ferimento) AND $data->severidade_ferimento !== '') OR (is_array($data->severidade_ferimento) AND (!empty($data->severidade_ferimento)) )) )
        {

            $filters[] = new TFilter('severidade_ferimento', '=', $data->severidade_ferimento);// create the filter 
        }

        if (isset($data->tipo_perigo_id) AND ( (is_scalar($data->tipo_perigo_id) AND $data->tipo_perigo_id !== '') OR (is_array($data->tipo_perigo_id) AND (!empty($data->tipo_perigo_id)) )) )
        {

            $filters[] = new TFilter('tipo_perigo_id', '=', $data->tipo_perigo_id);// create the filter 
        }

        if (isset($data->frequencia_exposicao) AND ( (is_scalar($data->frequencia_exposicao) AND $data->frequencia_exposicao !== '') OR (is_array($data->frequencia_exposicao) AND (!empty($data->frequencia_exposicao)) )) )
        {

            $filters[] = new TFilter('frequencia_exposicao', '=', $data->frequencia_exposicao);// create the filter 
        }

        if (isset($data->possibilidade_evitar) AND ( (is_scalar($data->possibilidade_evitar) AND $data->possibilidade_evitar !== '') OR (is_array($data->possibilidade_evitar) AND (!empty($data->possibilidade_evitar)) )) )
        {

            $filters[] = new TFilter('possibilidade_evitar', '=', $data->possibilidade_evitar);// create the filter 
        }

        if (isset($data->parecer_extra_norma) AND ( (is_scalar($data->parecer_extra_norma) AND $data->parecer_extra_norma !== '') OR (is_array($data->parecer_extra_norma) AND (!empty($data->parecer_extra_norma)) )) )
        {

            $filters[] = new TFilter('parecer_extra_norma', 'like', "%{$data->parecer_extra_norma}%");// create the filter 
        }

        if (isset($data->possiveis_solucoes) AND ( (is_scalar($data->possiveis_solucoes) AND $data->possiveis_solucoes !== '') OR (is_array($data->possiveis_solucoes) AND (!empty($data->possiveis_solucoes)) )) )
        {

            $filters[] = new TFilter('possiveis_solucoes', 'like', "%{$data->possiveis_solucoes}%");// create the filter 
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

            // creates a repository for Ponto
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

