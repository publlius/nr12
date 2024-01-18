<?php

class ProspeccaoList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private static $database = 'nr12';
    private static $activeRecord = 'Prospeccao';
    private static $primaryKey = 'id';
    private static $formName = 'formList_Prospeccao';

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
        $this->form->setFormTitle('Listagem de prospecção');


        $id = new TEntry('id');
        $estado_id = new TDBCombo('estado_id', 'nr12', 'Estado', 'id', '{uf} {nome} ','uf asc'  );
        $cidade_id = new TCombo('cidade_id');
        $empresa = new TEntry('empresa');
        $ramo = new TEntry('ramo');
        $status = new TCombo('status');

        $estado_id->setChangeAction(new TAction([$this,'onChangeestado_id']));

        $status->addItems(['Sem interesse'=>'Sem interesse','Já adequando'=>'Já adequando','Há interesse'=>'Há interesse','Em andamento'=>'Em andamento','Finalizado positivo'=>'Finalizado positivo','Encerrado'=>'Encerrado']);
        $id->setSize(100);
        $ramo->setSize('70%');
        $status->setSize('70%');
        $empresa->setSize('70%');
        $estado_id->setSize('70%');
        $cidade_id->setSize('70%');

        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel('UF:', null, '14px', null)],[$estado_id]);
        $row3 = $this->form->addFields([new TLabel('Cidade:', null, '14px', null)],[$cidade_id]);
        $row4 = $this->form->addFields([new TLabel('Empresa:', null, '14px', null)],[$empresa]);
        $row5 = $this->form->addFields([new TLabel('Ramo:', null, '14px', null)],[$ramo]);
        $row6 = $this->form->addFields([new TLabel('Status:', null, '14px', null)],[$status]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );
        $this->fireEvents( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onexportcsv = $this->form->addAction('Exportar como CSV', new TAction([$this, 'onExportCsv']), 'fa:file-text-o #000000');

        $btn_onshow = $this->form->addAction('Cadastrar', new TAction(['ProspeccaoCalendarForm', 'onShow']), 'fa:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_id = new TDataGridColumn('id', 'Id', 'center' , '70px');
        $column_cidade_nome_cidade_estado_uf = new TDataGridColumn('{cidade->nome} {cidade->estado->uf}', 'Cidade', 'left');
        $column_empresa = new TDataGridColumn('empresa', 'Empresa', 'left');
        $column_ramo = new TDataGridColumn('ramo', 'Ramo', 'left');
        $column_telefone = new TDataGridColumn('telefone', 'Telefone', 'left');
        $column_data_contato_transformed = new TDataGridColumn('data_contato', 'Data contato', 'left');
        $column_status = new TDataGridColumn('status', 'Status', 'left');

        $column_data_contato_transformed->setTransformer(function($value, $object, $row) 
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });        

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);
        $order_data_contato_transformed = new TAction(array($this, 'onReload'));
        $order_data_contato_transformed->setParameter('order', 'data_contato');
        $column_data_contato_transformed->setAction($order_data_contato_transformed);
        $order_status = new TAction(array($this, 'onReload'));
        $order_status->setParameter('order', 'status');
        $column_status->setAction($order_status);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_cidade_nome_cidade_estado_uf);
        $this->datagrid->addColumn($column_empresa);
        $this->datagrid->addColumn($column_ramo);
        $this->datagrid->addColumn($column_telefone);
        $this->datagrid->addColumn($column_data_contato_transformed);
        $this->datagrid->addColumn($column_status);

        $action_onEdit = new TDataGridAction(array('ProspeccaoCalendarForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel('Editar');
        $action_onEdit->setImage('fa:pencil-square-o #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('ProspeccaoList', 'onDelete'));
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
        $container->add(TBreadCrumb::create(['CRM','Prospecção']));
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);

    }

    public static function onChangeestado_id($param)
    {
        try
        {

            if (isset($param['estado_id']) && $param['estado_id'])
            { 
                $criteria = TCriteria::create(['estado_id' => (int) $param['estado_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'cidade_id', 'nr12', 'Cidade', 'id', '{nome} ', 'nome asc', $criteria, TRUE); 
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
                $object = new Prospeccao($key, FALSE); 

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
            if(isset($object->cidade_id))
            {
                $obj->cidade_id = $object->cidade_id;
            }
        }
        TForm::sendData(self::$formName, $obj);
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

        if (isset($data->estado_id) AND ( (is_scalar($data->estado_id) AND $data->estado_id !== '') OR (is_array($data->estado_id) AND (!empty($data->estado_id)) )) )
        {

            $filters[] = new TFilter('estado_id', '=', $data->estado_id);// create the filter 
        }

        if (isset($data->cidade_id) AND ( (is_scalar($data->cidade_id) AND $data->cidade_id !== '') OR (is_array($data->cidade_id) AND (!empty($data->cidade_id)) )) )
        {

            $filters[] = new TFilter('cidade_id', '=', $data->cidade_id);// create the filter 
        }

        if (isset($data->empresa) AND ( (is_scalar($data->empresa) AND $data->empresa !== '') OR (is_array($data->empresa) AND (!empty($data->empresa)) )) )
        {

            $filters[] = new TFilter('empresa', 'like', "%{$data->empresa}%");// create the filter 
        }

        if (isset($data->ramo) AND ( (is_scalar($data->ramo) AND $data->ramo !== '') OR (is_array($data->ramo) AND (!empty($data->ramo)) )) )
        {

            $filters[] = new TFilter('ramo', 'like', "%{$data->ramo}%");// create the filter 
        }

        if (isset($data->status) AND ( (is_scalar($data->status) AND $data->status !== '') OR (is_array($data->status) AND (!empty($data->status)) )) )
        {

            $filters[] = new TFilter('status', '=', $data->status);// create the filter 
        }

        $this->fireEvents($data);

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

            // creates a repository for Prospeccao
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

