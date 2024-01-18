<?php

class EquipamentoReport extends TPage
{
    private $form; // form
    private $loaded;
    private static $database = 'nr12';
    private static $activeRecord = 'Equipamento';
    private static $primaryKey = 'id';
    private static $formName = 'formReport_Equipamento';

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
        $this->form->setFormTitle('Equipamentos');

        $id = new TEntry('id');
        $empresa_unidade_id = new TDBCombo('empresa_unidade_id', 'nr12', 'EmpresaUnidade', 'id', '{id}','id asc'  );
        $nome = new TEntry('nome');
        $tipo = new TEntry('tipo');

        $id->setSize(100);
        $nome->setSize('70%');
        $tipo->setSize('70%');
        $empresa_unidade_id->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[new TLabel('Unidade:', null, '14px', null)],[$empresa_unidade_id]);
        $row2 = $this->form->addFields([new TLabel('Nome:', null, '14px', null)],[$nome],[new TLabel('Tipo:', null, '14px', null)],[$tipo]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_ongeneratehtml = $this->form->addAction('Gerar HTML', new TAction([$this, 'onGenerateHtml']), 'fa:code #ffffff');
        $btn_ongeneratehtml->addStyleClass('btn-primary'); 

        $btn_ongeneratepdf = $this->form->addAction('Gerar PDF', new TAction([$this, 'onGeneratePdf']), 'fa:file-pdf-o #d44734');

        $btn_ongeneratexls = $this->form->addAction('Gerar XLS', new TAction([$this, 'onGenerateXls']), 'fa:file-excel-o #00a65a');

        $btn_ongeneratertf = $this->form->addAction('Gerar RTF', new TAction([$this, 'onGenerateRtf']), 'fa:file-text-o #324bcc');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Relatórios','Equipamentos']));
        $container->add($this->form);

        parent::add($container);

    }

    public function onGenerateHtml($param = null) 
    {
        $this->onGenerate('html');
    }
    public function onGeneratePdf($param = null) 
    {
        $this->onGenerate('pdf');
    }
    public function onGenerateXls($param = null) 
    {
        $this->onGenerate('xls');
    }
    public function onGenerateRtf($param = null) 
    {
        $this->onGenerate('rtf');
    }

    /**
     * Register the filter in the session
     */
    public function getFilters()
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

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);

        return $filters;
    }

    public function onGenerate($format)
    {
        try
        {
            $filters = $this->getFilters();
            // open a transaction with database 'nr12'
            TTransaction::open(self::$database);
            $param = [];
            // creates a repository for Equipamento
            $repository = new TRepository(self::$activeRecord);
            // creates a criteria
            $criteria = new TCriteria;

            $criteria->setProperties($param);

            if ($filters)
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            if ($objects)
            {
                $widths = array(200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200);

                switch ($format)
                {
                    case 'html':
                        $tr = new TTableWriterHTML($widths);
                        break;
                    case 'xls':
                        $tr = new TTableWriterXLS($widths);
                        break;
                    case 'pdf':
                        $tr = new TTableWriterPDF($widths, 'L');
                        break;
                    case 'rtf':
                        if (!class_exists('PHPRtfLite_Autoloader'))
                        {
                            PHPRtfLite::registerAutoloader();
                        }
                        $tr = new TTableWriterRTF($widths, 'L');
                        break;
                }

                if (!empty($tr))
                {
                    // create the document styles
                    $tr->addStyle('title', 'Helvetica', '10', 'B',   '#000000', '#dbdbdb');
                    $tr->addStyle('datap', 'Arial', '10', '',    '#333333', '#f0f0f0');
                    $tr->addStyle('datai', 'Arial', '10', '',    '#333333', '#ffffff');
                    $tr->addStyle('header', 'Helvetica', '16', 'B',   '#5a5a5a', '#6B6B6B');
                    $tr->addStyle('footer', 'Helvetica', '10', 'B',  '#5a5a5a', '#A3A3A3');
                    $tr->addStyle('break', 'Helvetica', '10', 'B',  '#ffffff', '#9a9a9a');
                    $tr->addStyle('total', 'Helvetica', '10', 'I',  '#000000', '#c7c7c7');
                    $tr->addStyle('breakTotal', 'Helvetica', '10', 'I',  '#000000', '#c6c8d0');

                    // add titles row
                    $tr->addRow();
                    $tr->addCell('Id', 'left', 'title');
                    $tr->addCell('Unidade', 'left', 'title');
                    $tr->addCell('Nome', 'left', 'title');
                    $tr->addCell('Tipo', 'left', 'title');
                    $tr->addCell('Modelo', 'left', 'title');
                    $tr->addCell('Numero serie', 'left', 'title');
                    $tr->addCell('Data fabricacao', 'left', 'title');
                    $tr->addCell('Peso', 'left', 'title');
                    $tr->addCell('Setor', 'left', 'title');
                    
                    $grandTotal = [];
                    $breakTotal = [];
                    $breakValue = null;
                    $firstRow = true;

                    // controls the background filling
                    $colour = false;                
                    foreach ($objects as $object)
                    {
                        $style = $colour ? 'datap' : 'datai';

                        $firstRow = false;

                        $tr->addRow();

                        $tr->addCell($object->id, 'left', $style);
                        $tr->addCell($object->empresa_unidade_id, 'left', $style);
                        $tr->addCell($object->nome, 'left', $style);
                        $tr->addCell($object->tipo, 'left', $style);
                        $tr->addCell($object->modelo, 'left', $style);
                        $tr->addCell($object->numero_serie, 'left', $style);
                        $tr->addCell($object->data_fabricacao, 'left', $style);
                        $tr->addCell($object->peso, 'left', $style);
                        $tr->addCell($object->setor, 'left', $style);
                        
                        $tr->addRow();                        
                    $tr->addCell('Fabricante', 'left', 'title');
                    $tr->addCell('Fabricante endereco', 'left', 'title');
                    $tr->addCell('Fabricante cidade id', 'left', 'title');
                    $tr->addCell('Fabricante cep', 'left', 'title');
                    $tr->addCell('Fabricante cnpj', 'left', 'title');
                    $tr->addCell('Fabricante registro crea', 'left', 'title');
                    
                        $tr->addRow();                        
                        $tr->addCell($object->fabricante, 'left', $style);
                        $tr->addCell($object->fabricante_endereco, 'left', $style);
                        $tr->addCell($object->fabricante_cidade_id, 'left', $style);
                        $tr->addCell($object->fabricante_cep, 'left', $style);
                        $tr->addCell($object->fabricante_cnpj, 'left', $style);
                        $tr->addCell($object->fabricante_registro_crea, 'left', $style);

                        $tr->addRow();
                    $tr->addCell('Vista frontal', 'left', 'title');
                    $tr->addCell('Vista lateral esquerda', 'left', 'title');
                    $tr->addCell('Vista lateral direita', 'left', 'title');
                    $tr->addCell('Vista posterior', 'left', 'title');
                    
                        $tr->addRow();
                        $tr->addCell($object->vista_frontal, 'left', $style);
                        $tr->addCell($object->vista_lateral_esquerda, 'left', $style);
                        $tr->addCell($object->vista_lateral_direita, 'left', $style);
                        $tr->addCell($object->vista_posterior, 'left', $style);

                        $colour = !$colour;
                    }

                    $file = 'report_'.uniqid().".{$format}";
                    // stores the file
                    if (!file_exists("app/output/{$file}") || is_writable("app/output/{$file}"))
                    {
                        $tr->save("app/output/{$file}");
                    }
                    else
                    {
                        throw new Exception(_t('Permission denied') . ': ' . "app/output/{$file}");
                    }

                    parent::openFile("app/output/{$file}");

                    // shows the success message
                    new TMessage('info', _t('Report generated. Please, enable popups'));
                }
            }
            else
            {
                new TMessage('error', _t('No records found'));
            }

            // close the transaction
            TTransaction::close();
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

}

