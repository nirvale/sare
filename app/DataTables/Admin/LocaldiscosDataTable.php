<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Localdisco;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LocaldiscosDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(Localdisco $localdisco){
              $actionBtn =  '
                              <a href="'.route('localdisco.destroy', $localdisco).'" id="eliminarlocaldisco" class="text-danger"><i class="fas fa-times-circle"></i></a>
                            '
              ;
            return $actionBtn;
          })
          ->addColumn('comontaje',function(Localdisco $localdisco){
              $commandos =  nl2br($localdisco->comontaje)
              ;
            return $commandos;
          })
          ->rawColumns(['comontaje','action'])
          //->setRowId('id')
          ->orderColumn('descripcion', "DBMS_LOB.SUBSTR(descripcion,20) $1")
          ->orderColumn('comontaje', "DBMS_LOB.SUBSTR(comontaje,20) $1")
          ; //para habilitar ordenar en clobs de oracle
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Localdisco $model): QueryBuilder
  {
      // return $model->newQuery()->where('id',1);
  return  $model = Localdisco::select(
                'localdiscos.id',
                'localdiscos.localdisco',
                'localdiscos.pmontaje',
                'localdiscos.capacidad',
                'localdiscos.usado',
                'localdiscos.usadop',
                'localdiscos.comontaje',
                'localdiscos.descripcion',
                    'servidores.hostname',
                    'dformatos.dformato',
        )
         ->join('servidores','servidores.id','=','localdiscos.cve_servidor')
         ->join('dformatos','dformatos.id','=','localdiscos.cve_dformato')
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
              ->setTableId('catLocaldiscos')
              ->columns($this->getColumns())
              ->minifiedAjax()
              //->dom('Bfrtip')
              ->orderBy(0,'asc')
              ->selectStyleSingle()
              ->parameters([
                  //'dom'  => 'Bfrtip',
                  'layout' => ['top2' => 'buttons','topStart' => 'pageLength' ,'topEnd' => 'search'],
                  //'buttons'   => ['nuevolocaldisco'],
                  'responsive' => true,
                  'language' => [ 'url' => '/sare/vendor/DataTables/lang/Spanish.json', ],
                  'columnDefs' => [
                      ['targets' => [6],'render' => '$.fn.dataTable.render.percentBar("square","#fff", "#c1efcb", "#FF0033", "#28a745", 0, "groove")' ],
                      //['targets' => [3], 'visible' => false],
                    ],


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
    Column::make('id')->width(10)->title('ID'),
    // Column::make('add your columns'),
    Column::make('localdisco')
          ->addClass('catEditable')
          ->title('DISCO')->width(20),
    Column::make('hostname')
          ->addClass('catCombox')
          ->addClass('catEditable')
          ->name('servidores.hostname')
          ->title('SERVIDOR')->width(20),
    Column::make('pmontaje')
          ->addClass('catEditable')
          ->title('MONTAJE')->width(20),
    Column::make('capacidad')
          ->addClass('catEditable')
          ->title('CAPACIDAD (GB)')->width(20),
    Column::make('usado')
          ->addClass('catEditable')
          //->name('mlocaldiscoes.mlocaldisco')
          ->title('USADO (GB)')->width(20),
    Column::make('usadop')
        //->addClass('catEditable')
        //->name('mlocaldiscoes.mlocaldisco')
        ->title('USADO (%)')->width(20),
    Column::make('dformato')
          ->addClass('catCombox')
          ->addClass('catEditable')
          ->name('dformatos.dformato')
          ->title('FORMATO')->width(20),
          // ->orderable(false),
    Column::make('comontaje')
          ->addClass('catEditable')
          ->addClass('catEditableTA')
          ->title('COMANDOS')->width(60),
    Column::make('descripcion')
          ->addClass('catEditable')
          ->title('DESCRIPCIÓN')->width(60),

    // Column::make('created_at'),
    // Column::make('updated_at'),
    Column::computed('action')
          ->exportable(false)
          ->printable(false)
          ->width(10)
          ->addClass('text-center')
          ->title('ACCIÓN'),
  ];
}
    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Localdiscos_' . date('YmdHis');
    }
}
