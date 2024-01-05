<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class NotificationComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $notification = DB::table('products')
        ->where('total_stock', '<=', DB::raw('alarm'))
        ->get();
        $count= $notification->count();
// dd($notification);

        return view('components.notification-component',['notification'=>$notification,'count'=>$count]);
    }
}
