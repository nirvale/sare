<?php

namespace App\DataTables\Admin;

use App\Models\Admin\OsVersion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class Os_versionsDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(osversion $osversion){
              $actionBtn = '
                            <a href="'.route('osversion.destroy', $osversion).'" id="eliminarosversion" class="text-danger"><i class="fas fa-times-circle"></i></a> '
              ;
            return $actionBtn;
            })
          ->setRowId('id'); //para habilitar ordenar en clobs de oracle
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Osversion $model): QueryBuilder
  {
      // return $model->newQuery()->where('id',1);

    return  $model = Osversion::select('os_versions.id','os_versions.osversion','os_versions.cve_distribucion','distribuciones.distribucion')
          ->join('distribuciones','distribuciones.id','=','os_versions.cve_distribucion');
          // ->withCasts(['fecha' => 'date:Y-m-d'])
          // ->get();

  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
      return $this->builder()
                  ->setTableId('catOsversions')
                  ->columns($this->getColumns())
                  ->minifiedAjax()
                  //->dom('Bfrtip')
                  ->orderBy(0,'asc')
                  ->selectStyleSingle()
                  ->parameters([
                      'dom'  => 'Bfrtip',
                      //'buttons'   => ['nuevoosversion'],
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

        Column::make('osversion')
              ->addClass('catEditable')
              ->title('VERSIÓN'),
        Column::make('distribucion')
              ->addClass('catEditable')
              ->addClass('catCombox')
              //->searchable(false)
              ->name('distribuciones.distribucion') //para habilitar la búsqueda en los joins
              ->title('DISTRIBUCIÓN'),

              // ->orderable(false),

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
      return 'Osversions_' . date('YmdHis');
  }

}
