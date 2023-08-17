<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\RequestCheckup;
use App\Models\User;
use Livewire\Component;

class DashBoard extends Component
{
    public function render()
    {
        return view('livewire.dashboard.dash-board',[
            'User' => User::all(),
            'Admin' => User::all()->where('rule_id',1),
            'Patient' => User::all()->where('rule_id',2),
            'Complied' => RequestCheckup::all()->where('status_id',2),
            'Pending' => RequestCheckup::all()->where('status_id',1)
            ]);
    }
}
