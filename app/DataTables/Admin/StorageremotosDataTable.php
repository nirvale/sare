<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Storageremoto;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StorageremotosDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(Storageremoto $storageremoto){
              $actionBtn = '
                            <a href="'.route('storageremoto.destroy', $storageremoto).'" id="eliminarstorageremoto" class="text-danger"><i class="fas fa-times-circle"></i></a> '
              ;
            return $actionBtn;
            })
          ->addColumn('utilidades', function (Storageremoto $storageremoto) {
              return $storageremoto->udremotas->map(function($udremotas) {
                    return $udremotas->udremota;
              })->implode(', ');
           })
          ->rawColumns(['utilidades','action'])
          ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Storageremoto $model): QueryBuilder
  {
  // return $model->newQuery()->where('id',1);

return  $model = Storageremoto::select(
        'storageremotos.id',
        'storageremotos.storageremoto',
        'storageremotos.capacidad',
        'storageremotos.usado',
        'storageremotos.usadop',
        'storageremotos.cve_tecremotadisco',
        'storageremotos.cve_mhardware',
          'tecremotadiscos.tecremotadisco',
          'mhardwares.mhardware',
          'datacenters.datacenter',
        )
            ->join('tecremotadiscos','tecremotadiscos.id','=','storageremotos.cve_tecremotadisco')
            ->join('mhardwares','mhardwares.id','=','storageremotos.cve_mhardware')
            ->join('datacenters','datacenters.id','=','storageremotos.cve_datacenter')
            ->with('udremotas')
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
              ->setTableId('catStorageremotos')
              ->columns($this->getColumns())
              ->minifiedAjax()
              //->dom('Bfrtip')
              ->orderBy(0,'asc')
              ->selectStyleSingle()
              ->parameters([
                //'dom'  => 'Bfrtip',
                'layout' => ['top2' => 'buttons','topStart' => 'pageLength' ,'topEnd' => 'search'],
                  //'buttons'   => ['nuevostorageremoto'],
                  'responsive' => true,
                  'language' => [ 'url' => '/sare/vendor/DataTables/lang/Spanish.json', ],
                  'columnDefs' => [
                      ['targets' => [8],'render' => '$.fn.dataTable.render.percentBar("square","#fff", "#c1efcb", "#FF0033", "#28a745", 0, "groove")' ],
                      //['targets' => [3], 'visible' => false],
                    ]

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

    Column::make('storageremoto')
          ->addClass('catEditable')
          ->title('SISTEMA'),
    Column::make('tecremotadisco')
          ->addClass('catEditable')
          ->addClass('catCombox')
          //->searchable(false)
          ->name('tecremotadiscos.tecremotadisco') //para habilitar la búsqueda en los joins
          ->title('TECNOLOGÍA'),
    Column::make('mhardware')
          ->addClass('catEditable')
          ->addClass('catCombox')
          //->searchable(false)
          ->name('mhardwares.mhardware') //para habilitar la búsqueda en los joins
          ->title('FABRICANTE'),
    Column::make('utilidades')
          ->addClass('catEditable')
          ->addClass('catComboxMulti')
          ->addClass('catCombox')
          //->searchable(false)
          //->name('mhardwares.mhardware') //para habilitar la búsqueda en los joins
          ->title('UTILIDADES SOPORTADAS'),
    Column::make('datacenter')
          ->addClass('catEditable')
          ->addClass('catCombox')
          //->searchable(false)
          ->name('datacenters.datacenter') //para habilitar la búsqueda en los joins
          ->title('DATACENTER'),
    Column::make('capacidad')
          ->addClass('catEditable')
          ->title('CAPACIDAD (GB)'),
    Column::make('usado')
          ->addClass('catEditable')
          ->title('USADO (GB)'),
    Column::make('usadop')
          //->addClass('catEditable')
          ->title('USADO (%)'),

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
        return 'Storageremotos_' . date('YmdHis');
    }
}
