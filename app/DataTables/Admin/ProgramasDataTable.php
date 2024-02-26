<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Programa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProgramasDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(Programa $programa){
              $actionBtn = '
                            <a href="'.route('programa.destroy', $programa).'" id="eliminarprograma" class="text-danger"><i class="fas fa-times-circle"></i></a> '
              ;
            return $actionBtn;
            })
          ->setRowId('id')
          // ->editColumn('action', function (Programa $programa) {
          //     return '<a href="'.route('usuario.show', $programa).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
          // })
          ;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Programa $model): QueryBuilder
    {
      // return $model->newQuery()->where('id',1);

    return  $model = Programa::select('programas.id','programas.programa','programas.cve_dependencia','dependencias.dependencia')
          ->join('dependencias','dependencias.id','=','programas.cve_dependencia');
          // ->withCasts(['fecha' => 'date:Y-m-d'])
          // ->get();

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
      return $this->builder()
                  ->setTableId('catProgramas')
                  ->columns($this->getColumns())
                  ->minifiedAjax()
                  //->dom('Bfrtip')
                  ->orderBy(0,'asc')
                  ->selectStyleSingle()
                  ->parameters([
                      'dom'  => 'Bfrtip',
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

          Column::make('id')->width(30)->title('ID')->addClass('catEditable'),
          // Column::make('add your columns'),
          Column::make('programa')
                ->addClass('catEditable')
                ->title('PROGRAMA'),
          Column::make('dependencia')
                ->addClass('catEditable')
                ->addClass('catCombox')
                //->searchable(false)
                ->name('dependencias.dependencia') //para habilitar la búsqueda en los joins
                ->title('DEPENDENCIA'),
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
        return 'Programas_' . date('YmdHis');
    }
}
