<?php
/**
 * ProspeccaoCalendarForm Form
 * @author  <your name here>
 */
class ProspeccaoCalendarFormView extends TPage
{
    private $fc;

    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->fc = new TFullCalendar(date('Y-m-d'), 'month');
        $this->fc->enableDays([1,2,3,4,5]);
        $this->fc->setReloadAction(new TAction(array($this, 'getEvents')));
        $this->fc->setDayClickAction(new TAction(array('ProspeccaoCalendarForm', 'onStartEdit')));
        $this->fc->setEventClickAction(new TAction(array('ProspeccaoCalendarForm', 'onEdit')));
        $this->fc->setEventUpdateAction(new TAction(array('ProspeccaoCalendarForm', 'onUpdateEvent')));
        $this->fc->setCurrentView('agendaWeek');
        $this->fc->setTimeRange('07:00', '19:00');

        parent::add( $this->fc );
    }

    /**
     * Output events as an json
     */
    public static function getEvents($param=NULL)
    {
        $return = array();
        try
        {
            TTransaction::open('nr12');

            $criteria = new TCriteria(); 

            $criteria->add(new TFilter('data_contato', '>=', $param['start'].' 00:00:00'));
            $criteria->add(new TFilter('retornar_em', '<=', $param['end'].' 23:59:59'));

            $events = Prospeccao::getObjects($criteria);

            if ($events)
            {
                foreach ($events as $event)
                {
                    $event_array = $event->toArray();
                    $event_array['start'] = str_replace( ' ', 'T', $event_array['data_contato']);
                    $event_array['end'] = str_replace( ' ', 'T', $event_array['retornar_em']);
                    $event_array['color'] = $event_array['cor'];
                    $event_array['title'] = $event_array['empresa'];

                    $return[] = $event_array;
                }
            }
            TTransaction::close();
            echo json_encode($return);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    /**
     * Reconfigure the callendar
     */
    public function onReload($param = null)
    {
        if (isset($param['view']))
        {
            $this->fc->setCurrentView($param['view']);
        }

        if (isset($param['date']))
        {
            $this->fc->setCurrentDate($param['date']);
        }
    }

}

