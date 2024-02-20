<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Dominio;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\DataTablesEditor;

class DominiosDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'dominios.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Dominio $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('catDominios')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->parameters([
                        'dom'  => 'Bfrtip',
                        'buttons'   => ['excel', 'csv','print','reload','myCustomAction'],
                        'responsive' => true,
                        'language' => [ 'url' => '/sare/vendor/DataTables/lang/Spanish.json', ],
                     ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id')->width(30)->title('ID'),
            // Column::make('add your columns'),
            Column::make('dominio')
                  ->addClass('catEditable')
                  ->title('DOMINIO'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('ACCIÓN'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Dominios_' . date('YmdHis');
    }

}
