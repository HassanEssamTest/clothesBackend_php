<?php
/**
 * File name: PricingDataTable.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Models\Pricing;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Barryvdh\DomPDF\Facade as PDF;

class PricingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('from_governorate_id', function ($pricing) {
                if (isset($pricing->from_governorate))
                    return $pricing->from_governorate->name;
                return '';
            })
            ->editColumn('from_city_id', function ($pricing) {
                if (isset($pricing->from_city))
                    return $pricing->from_city->name;
                return '';
            })
            ->editColumn('to_governorate_id', function ($pricing) {
                if (isset($pricing->to_governorate))
                    return $pricing->to_governorate->name;
                return '';
            })
            ->editColumn('to_city_id', function ($pricing) {
                if (isset($pricing->to_city))
                    return $pricing->to_city->name;
                return '';
            })
            ->editColumn('updated_at', function ($pricing) {
                return getDateColumn($pricing, 'updated_at');
            })
            ->addColumn('action', 'pricings.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'from_governorate_id',
                'title' => 'From Governorate',

            ],
            [
                'data' => 'from_city_id',
                'title' => 'From City',

            ],
            [
                'data' => 'to_governorate_id',
                'title' => 'To Governorate',

            ],
            [
                'data' => 'to_city_id',
                'title' => 'To City',

            ],
            [
                'data' => 'price',
                'title' => trans('lang.clothes_order_price'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.pricing_updated_at'),
                'searchable' => false,
            ]
        ];
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pricing $model)
    {
        return $model->newQuery()->select('pricings.*')->orderBy('pricings.updated_at','desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title'=>trans('lang.actions'),'width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true)
                ]
            ));
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pricingsdatatable_' . time();
    }
}