<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'        => 'Attività per Servizio',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\DailyActivity',
            'group_by_field'     => 'nome_servizio',
            'aggregate_function' => 'sum',
            'aggregate_field'    => 'worktime',
            'filter_field'       => 'created_at',
            'filter_period'      => 'month',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'service',
            'translation_key'    => 'dailyActivity',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'        => 'Risorse per Team',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\User',
            'group_by_field'     => 'team_name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'team',
            'translation_key'    => 'user',
        ];

        $chart2 = new LaravelChart($settings2);

        return view('home', compact('chart1', 'chart2'));
    }
}
