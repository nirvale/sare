<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Procesador;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProcesadorsDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(Procesador $procesador){
              $actionBtn =  '
                              <a href="'.route('procesador.destroy', $procesador).'" id="eliminarprocesador" class="text-danger"><i class="fas fa-times-circle"></i></a>
                            '
              ;
            return $actionBtn;
          });

          //->setRowId('id')
          //->orderColumn('descripcion', "DBMS_LOB.SUBSTR(descripcion,20) $1"); //para habilitar ordenar en clobs de oracle
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Procesador $model): QueryBuilder
  {
      // return $model->newQuery()->where('id',1);
  return  $model = Procesador::select(
                'procesadores.id',
                'procesadores.procesador',
                'procesadores.nucleos',
                'procesadores.velocidad',
                   'mprocesadores.mprocesador',
                   'aprocesadores.aprocesador',
        )
         ->join('mprocesadores','mprocesadores.id','=','procesadores.cve_mprocesador')
         ->join('aprocesadores','aprocesadores.id','=','procesadores.cve_aprocesador')
         ;
      // ->withCasts(['fecha' => 'date:Y-m-d'])
      // ->get();

}

/**
* Optional method if you want to use the html builder.
*/
public function html(): HtmlBuilder
{
  return $this->builder()
              ->setTableId('catProcesadors')
              ->columns($this->getColumns())
              ->minifiedAjax()
              //->dom('Bfrtip')
              ->orderBy(0,'asc')
              ->selectStyleSingle()
              ->parameters([
                  //'dom'  => 'Bfrtip',
                  'layout' => ['top2' => 'buttons','topStart' => 'pageLength' ,'topEnd' => 'search'],
                  //'buttons'   => ['nuevoprocesador'],
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
    Column::make('procesador')
          ->addClass('catEditable')
          ->title('PROCESADOR')->width(30),
    Column::make('nucleos')
          ->addClass('catEditable')
          ->title('NÚCLEOS')->width(30),
    Column::make('velocidad')
          ->addClass('catEditable')
          ->title('VELOCIDAD')->width(30),
    Column::make('mprocesador')
          ->addClass('catCombox')
          ->addClass('catEditable')
          ->name('mprocesadores.mprocesador')
          ->title('FABRICANTE')->width(30),
    Column::make('aprocesador')
          ->addClass('catCombox')
          ->addClass('catEditable')
          ->name('aprocesadores.aprocesador')
          ->title('ARQUITECTURA')->width(30),

          // ->orderable(false),

    // Column::make('created_at'),
    // Column::make('updated_at'),
    Column::computed('action')
          ->exportable(false)
          ->printable(false)
          ->width(30)
          ->addClass('text-center')
          ->title('ACCIÓN'),
  ];
}

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Procesadors_' . date('YmdHis');
    }
}
