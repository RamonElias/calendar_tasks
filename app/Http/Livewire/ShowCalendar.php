<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class ShowCalendar extends Component
{
    public $currentDate;

    public $days;

    public $today;

    public function mount()
    {
        $this->fill([
            'currentDate' => Carbon::now(),
            'days' => $this->calendar(),
            'today' => Carbon::now(),
        ]);
    }

    public function calendar($date = null)
    {
        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);

        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);

        // $html = '';
        $days = [];
        while ($startOfCalendar <= $endOfCalendar) {
            // $html .= $startOfCalendar->format('j');
            // $days[] = $startOfCalendar->format('j');

            $days[] = [
                'toDateString' => $startOfCalendar->toDateString(),
                'number' => $startOfCalendar->format('j'),
                'tasks' => auth()->user()->tasks()->whereDate('scheduled', '=', $startOfCalendar)->get(),
            ];
            $startOfCalendar->addDay();
        }

        // return $html;
        return $days;
    }

    public function goPreviousMonth()
    {
        $this->currentDate = $this->currentDate->subMonth();

        $this->days = $this->calendar($this->currentDate);
    }

    public function goNextMonth()
    {
        $this->currentDate = $this->currentDate->addMonth();

        $this->days = $this->calendar($this->currentDate);
    }

    public function render()
    {
        return view('livewire.show-calendar');
    }
}
