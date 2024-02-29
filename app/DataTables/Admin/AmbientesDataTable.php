<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Ambiente;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AmbientesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(Ambiente $ambiente){
              $actionBtn = '
                            <a href="'.route('ambiente.destroy', $ambiente).'" id="eliminarambiente" class="text-danger"><i class="fas fa-times-circle"></i></a> '
              ;
            return $actionBtn;
            })
          ->setRowId('id')
          // ->editColumn('action', function (Ambiente $ambiente) {
          //     return '<a href="'.route('usuario.show', $ambiente).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
          // })
          ;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Ambiente $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
      return $this->builder()
                  ->setTableId('catAmbientes')
                  ->columns($this->getColumns())
                  ->minifiedAjax()
                  //->dom('Bfrtip')
                  ->orderBy(0,'asc')
                  ->selectStyleSingle()
                  ->parameters([
                      //'dom'  => 'Bfrtip',
                      'layout' => ['top2' => 'buttons','topStart' => 'pageLength' ,'topEnd' => 'search'],
                      //'buttons'   => ['nuevo'],
                      'responsive' => true,
                      'language' => [ 'url' => '/sare/vendor/DataTables/lang/Spanish.json', ],
                   ])
                   ->buttons([
                       Button::make('excel'),
                       Button::make('csv'),
                       Button::make('pdf'),
                       Button::make('print'),
                       Button::make('reset'),
                       Button::make('reload'),
                       Button::make('nuevo')
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
          Column::make('ambiente')
                ->addClass('catEditable')
                ->title('AMBIENTE'),
          // Column::make('created_at'),
          // Column::make('updated_at'),
          Column::computed('action')
                ->exportable(false)
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
        return 'Ambientes_' . date('YmdHis');
    }
}
