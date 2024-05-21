<?php

namespace App\Http\Livewire;

use App\Models\agency;
use App\Models\employ;
use App\Models\leaverequest;
use Livewire\Component;

class Historyindex2 extends Component
{
    public $employs,$agen,$leaverequest;
    public $list = [];
    public $agenlist = [];
    public function mount(){
        $this->employs = employ::all();
        $this->agen = agency::all();
        $this->leaverequest = LeaveRequest::all();

        
    }
    public function agency(){
        $this->agenlist = $this->agen->pluck('id');
    }
    public function employ(){
        $this->list = $this->employs->pluck('id');
        
    }
    
    public function render()
    {
        
        
        return view('livewire.historyindex2', [
            'employs' => $this->employs,
            'agen' => $this->agen,
            'leaverequest' => $this->leaverequest,
        ]);
    }
}
