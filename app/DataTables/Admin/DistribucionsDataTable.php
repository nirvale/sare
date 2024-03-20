<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Distribucion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DistribucionsDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(distribucion $distribucion){
              $actionBtn = '
                            <a href="'.route('distribucion.destroy', $distribucion).'" id="eliminardistribucion" class="text-danger"><i class="fas fa-times-circle"></i></a> '
              ;
            return $actionBtn;
            })
          ->setRowId('id'); //para habilitar ordenar en clobs de oracle
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Distribucion $model): QueryBuilder
  {
      // return $model->newQuery()->where('id',1);

    return  $model = Distribucion::select('distribuciones.id','distribuciones.distribucion','distribuciones.cve_os','os.os')
          ->join('os','os.id','=','distribuciones.cve_os');
          // ->withCasts(['fecha' => 'date:Y-m-d'])
          // ->get();

  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
      return $this->builder()
                  ->setTableId('catDistribucions')
                  ->columns($this->getColumns())
                  ->minifiedAjax()
                  //->dom('Bfrtip')
                  ->orderBy(0,'asc')
                  ->selectStyleSingle()
                  ->parameters([
                    //'dom'  => 'Bfrtip',
                    'layout' => ['top2' => 'buttons','topStart' => 'pageLength' ,'topEnd' => 'search'],
                      //'buttons'   => ['nuevodistribucion'],
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
        Column::make('distribucion')
              ->addClass('catEditable')
              ->title('DISTRIBUCIÓN'),
        Column::make('os')
              ->addClass('catEditable')
              ->addClass('catCombox')
              //->searchable(false)
              ->name('os.os') //para habilitar la búsqueda en los joins
              ->title('SISTEMA OPERATIVO'),

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
        return 'Distribucions_' . date('YmdHis');
    }
}
