<?php

class EmpresaList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private static $database = 'nr12';
    private static $activeRecord = 'Empresa';
    private static $primaryKey = 'id';
    private static $formName = 'formList_Empresa';

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
        $this->form->setFormTitle('Listagem de empresas');


        $id = new TEntry('id');
        $razao_social = new TEntry('razao_social');
        $nome_fantasia = new TEntry('nome_fantasia');
        $cnpj = new TEntry('cnpj');
        $ie = new TEntry('ie');
        $im = new TEntry('im');
        $cnae_principal = new TEntry('cnae_principal');
        $cnae_secundario = new TEntry('cnae_secundario');
        $endereco = new TEntry('endereco');
        $cidade_id = new TEntry('cidade_id');
        $estado_id = new TEntry('estado_id');
        $pais_id = new TEntry('pais_id');

        $id->setSize(100);
        $ie->setSize('70%');
        $im->setSize('70%');
        $cnpj->setSize('70%');
        $pais_id->setSize('70%');
        $endereco->setSize('70%');
        $cidade_id->setSize('70%');
        $estado_id->setSize('70%');
        $razao_social->setSize('70%');
        $nome_fantasia->setSize('70%');
        $cnae_principal->setSize('70%');
        $cnae_secundario->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel('Razao social:', null, '14px', null)],[$razao_social]);
        $row3 = $this->form->addFields([new TLabel('Nome fantasia:', null, '14px', null)],[$nome_fantasia]);
        $row4 = $this->form->addFields([new TLabel('Cnpj:', null, '14px', null)],[$cnpj]);
        $row5 = $this->form->addFields([new TLabel('Ie:', null, '14px', null)],[$ie]);
        $row6 = $this->form->addFields([new TLabel('Im:', null, '14px', null)],[$im]);
        $row7 = $this->form->addFields([new TLabel('Cnae principal:', null, '14px', null)],[$cnae_principal]);
        $row8 = $this->form->addFields([new TLabel('Cnae secundario:', null, '14px', null)],[$cnae_secundario]);
        $row9 = $this->form->addFields([new TLabel('Endereco:', null, '14px', null)],[$endereco]);
        $row10 = $this->form->addFields([new TLabel('Cidade id:', null, '14px', null)],[$cidade_id]);
        $row11 = $this->form->addFields([new TLabel('Estado id:', null, '14px', null)],[$estado_id]);
        $row12 = $this->form->addFields([new TLabel('Pais id:', null, '14px', null)],[$pais_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onexportcsv = $this->form->addAction('Exportar como CSV', new TAction([$this, 'onExportCsv']), 'fa:file-text-o #000000');

        $btn_onshow = $this->form->addAction('Cadastrar', new TAction(['EmpresaForm', 'onShow']), 'fa:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_id = new TDataGridColumn('id', 'Id', 'center' , '70px');
        $column_razao_social = new TDataGridColumn('razao_social', 'Razao social', 'left');
        $column_nome_fantasia = new TDataGridColumn('nome_fantasia', 'Nome fantasia', 'left');
        $column_cnpj = new TDataGridColumn('cnpj', 'Cnpj', 'left');
        $column_ie = new TDataGridColumn('ie', 'Ie', 'left');
        $column_im = new TDataGridColumn('im', 'Im', 'left');
        $column_cnae_principal = new TDataGridColumn('cnae_principal', 'Cnae principal', 'left');
        $column_cnae_secundario = new TDataGridColumn('cnae_secundario', 'Cnae secundario', 'left');
        $column_endereco = new TDataGridColumn('endereco', 'Endereco', 'left');
        $column_cidade_id = new TDataGridColumn('cidade_id', 'Cidade id', 'left');
        $column_estado_id = new TDataGridColumn('estado_id', 'Estado id', 'left');
        $column_pais_id = new TDataGridColumn('pais_id', 'Pais id', 'left');

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_razao_social);
        $this->datagrid->addColumn($column_nome_fantasia);
        $this->datagrid->addColumn($column_cnpj);
        $this->datagrid->addColumn($column_ie);
        $this->datagrid->addColumn($column_im);
        $this->datagrid->addColumn($column_cnae_principal);
        $this->datagrid->addColumn($column_cnae_secundario);
        $this->datagrid->addColumn($column_endereco);
        $this->datagrid->addColumn($column_cidade_id);
        $this->datagrid->addColumn($column_estado_id);
        $this->datagrid->addColumn($column_pais_id);

        $action_onEdit = new TDataGridAction(array('EmpresaForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel('Editar');
        $action_onEdit->setImage('fa:pencil-square-o #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('EmpresaList', 'onDelete'));
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
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup;
        $panel->add($this->datagrid);

        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(TBreadCrumb::create(['Cadastros','Empresas']));
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
                $object = new Empresa($key, FALSE); 

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

        if (isset($data->razao_social) AND ( (is_scalar($data->razao_social) AND $data->razao_social !== '') OR (is_array($data->razao_social) AND (!empty($data->razao_social)) )) )
        {

            $filters[] = new TFilter('razao_social', 'like', "%{$data->razao_social}%");// create the filter 
        }

        if (isset($data->nome_fantasia) AND ( (is_scalar($data->nome_fantasia) AND $data->nome_fantasia !== '') OR (is_array($data->nome_fantasia) AND (!empty($data->nome_fantasia)) )) )
        {

            $filters[] = new TFilter('nome_fantasia', 'like', "%{$data->nome_fantasia}%");// create the filter 
        }

        if (isset($data->cnpj) AND ( (is_scalar($data->cnpj) AND $data->cnpj !== '') OR (is_array($data->cnpj) AND (!empty($data->cnpj)) )) )
        {

            $filters[] = new TFilter('cnpj', 'like', "%{$data->cnpj}%");// create the filter 
        }

        if (isset($data->ie) AND ( (is_scalar($data->ie) AND $data->ie !== '') OR (is_array($data->ie) AND (!empty($data->ie)) )) )
        {

            $filters[] = new TFilter('ie', 'like', "%{$data->ie}%");// create the filter 
        }

        if (isset($data->im) AND ( (is_scalar($data->im) AND $data->im !== '') OR (is_array($data->im) AND (!empty($data->im)) )) )
        {

            $filters[] = new TFilter('im', 'like', "%{$data->im}%");// create the filter 
        }

        if (isset($data->cnae_principal) AND ( (is_scalar($data->cnae_principal) AND $data->cnae_principal !== '') OR (is_array($data->cnae_principal) AND (!empty($data->cnae_principal)) )) )
        {

            $filters[] = new TFilter('cnae_principal', 'like', "%{$data->cnae_principal}%");// create the filter 
        }

        if (isset($data->cnae_secundario) AND ( (is_scalar($data->cnae_secundario) AND $data->cnae_secundario !== '') OR (is_array($data->cnae_secundario) AND (!empty($data->cnae_secundario)) )) )
        {

            $filters[] = new TFilter('cnae_secundario', 'like', "%{$data->cnae_secundario}%");// create the filter 
        }

        if (isset($data->endereco) AND ( (is_scalar($data->endereco) AND $data->endereco !== '') OR (is_array($data->endereco) AND (!empty($data->endereco)) )) )
        {

            $filters[] = new TFilter('endereco', 'like', "%{$data->endereco}%");// create the filter 
        }

        if (isset($data->cidade_id) AND ( (is_scalar($data->cidade_id) AND $data->cidade_id !== '') OR (is_array($data->cidade_id) AND (!empty($data->cidade_id)) )) )
        {

            $filters[] = new TFilter('cidade_id', '=', $data->cidade_id);// create the filter 
        }

        if (isset($data->estado_id) AND ( (is_scalar($data->estado_id) AND $data->estado_id !== '') OR (is_array($data->estado_id) AND (!empty($data->estado_id)) )) )
        {

            $filters[] = new TFilter('estado_id', '=', $data->estado_id);// create the filter 
        }

        if (isset($data->pais_id) AND ( (is_scalar($data->pais_id) AND $data->pais_id !== '') OR (is_array($data->pais_id) AND (!empty($data->pais_id)) )) )
        {

            $filters[] = new TFilter('pais_id', '=', $data->pais_id);// create the filter 
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

            // creates a repository for Empresa
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

