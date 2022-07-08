<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Car;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\\App\\Event',
            'date_field' => 'start_time',
            'field'      => 'title',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.events.edit',
        ],
    ];

    public function index(Request $request)
    {
        $events = [];
        $cars = Car::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        foreach ($this->sources as $source) {
            $models = $source['model']::when($request->input('car_id'), function ($query) use ($request) {
                    $query->where('car_id', $request->input('car_id'));
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where('user_id', $request->input('user_id'));
                })
                ->get();
            foreach ($models as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }

        }

        return view('admin.calendar.calendar', compact('events', 'cars', 'users'));

    }

}
