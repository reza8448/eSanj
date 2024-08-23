<?php

namespace App\Livewire;


//use Illuminate\Console\View\Components\Task;
use App\Models\task;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MainTask extends Component
{


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public function refreshDate()
    {
    }

    protected  $rules = [
        'search'=>'nullable|string'
    ];


    #[On('LoadPage')]
    public function reload()
    {

    }

    public function render()
    {
        $Tasks=  task::query();
        if ($this->search!=null){
            $this->resetPage();

            $Tasks->where( 'title','LIKE',"%{$this->search}%")
                ->orwhere('description','LIKE',"%{$this->search}%")
                ->orwhere('expiration','LIKE',"%{$this->search}%")
                ->orwhere('priority','LIKE',"%{$this->search}%")
                ->orwhere('status','LIKE',"%{$this->search}%")
                ->orwhere('user_created','LIKE',"%{$this->search}%")
                ->orwhere('user_id','LIKE',"%{$this->search}%")->get()->toArray();
            $this->refreshDate();
            $Tasks=$Tasks ->paginate(10) ;
        }
        else{
            $Tasks=  task::paginate(10) ;
        }
        return view('livewire.main-task',['Tasks'=>$Tasks] );
    }

}
