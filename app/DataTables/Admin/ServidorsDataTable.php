<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Servidor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServidorsDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(Servidor $servidor){
              $actionBtn =  '
                              <a href="'.route('servidor.destroy', $servidor).'" id="eliminarservidor" class="text-danger"><i class="fas fa-times-circle"></i></a>
                            '
              ;
            return $actionBtn;
            })
          ->addColumn('sistema operativo',function(Servidor $servidor){
              $osserver = $servidor->os.' | '.$servidor->distribucion.' | '.$servidor->osversion
              ;
            return $osserver;
            })
            ->addColumn('mprocesador',function(Servidor $servidor){
                $osserver = $servidor->mprocesador.' | '.$servidor->nomprocesador.' | '.$servidor->velocidad.' | '.$servidor->nucleos.' cores | '.$servidor->aprocesador
                ;
              return $osserver;
              })

          ->addColumn('nics', function (Servidor $servidor) {
              return $servidor->nics->map(function($nics) {
                    return $nics->nic.': '.$nics->ip;
              })->implode('<br>');
           })

          // ->addColumn('mprocesador', function (Servidor $servidor) {
          //     return
          //         $servidor->procesador->map(function($procesador) {
          //           return
          //           $procesador->mprocesador->map(function($fabricante){
          //             return $fabricante->mprocesador;
          //           })->implode('<br>').' | '.
          //           $procesador->procesador.' | '.
          //           $procesador->velocidad .' | '.
          //           $procesador->nucleos.' núcleos | '.
          //           $procesador->aprocesador->map(function($arquitectura){
          //             return $arquitectura->aprocesador;
          //           })->implode('<br>')
          //
          //         ;
          //     })->implode('<br>');
          //  })
          ->rawColumns(['nics','action'])
          ->orderColumn('descripcion', "DBMS_LOB.SUBSTR(descripcion,20) $1") //para habilitar ordenar en clobs de oracle
          ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Servidor $model): QueryBuilder
  {
      // return $model->newQuery()->where('id',1);

      return  $model = Servidor::select(
                    'servidores.id',
                    'servidores.hostname',
                    'servidores.memoria',
                    'servidores.procesadores',
                    'servidores.cve_procesador',
                      'procesadores.procesador as nomprocesador',
                      'procesadores.nucleos',
                      'procesadores.velocidad',
                      // 'servidores.nucleos',
                      // 'servidores.cve_procesador',
                      // 'servidores.velocidad_procesador',

                       'mprocesadores.mprocesador',
                       'aprocesadores.aprocesador',
                       'os.os',
                       'distribuciones.distribucion',
                       'os_versions.osversion',
                       'ambientes.ambiente',
                       'datacenters.datacenter',
                       'tipos.tipo',
                       'virtualizadores.virtualizador',
                       'mhardwares.mhardware',
                       'dominios.dominio',
                     'servidores.descripcion',
            )
             ->join('procesadores','procesadores.id','=','servidores.cve_procesador')
             ->join('mprocesadores','mprocesadores.id','=','procesadores.cve_mprocesador')
             ->join('aprocesadores','aprocesadores.id','=','procesadores.cve_aprocesador')
             ->join('os_versions','os_versions.id','=','servidores.cve_osversion')
             ->join('distribuciones','distribuciones.id','=','os_versions.cve_distribucion')
             ->join('os','os.id','=','distribuciones.cve_os')
             ->join('ambientes','ambientes.id','=','servidores.cve_ambiente')
             ->join('datacenters','datacenters.id','=','servidores.cve_datacenter')
             ->join('tipos','tipos.id','=','servidores.cve_tipo')
             ->join('virtualizadores','virtualizadores.id','=','servidores.cve_virtualizador')
             ->join('mhardwares','mhardwares.id','=','servidores.cve_mhardware')
             ->join('dominios','dominios.id','=','servidores.cve_dominio')
             ->with('nics')
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
                  ->setTableId('catServidors')
                  ->columns($this->getColumns())
                  ->minifiedAjax()
                  //->dom('Bfrtip')
                  ->orderBy(0,'asc')
                  ->selectStyleSingle()
                  ->parameters([
                      //'dom'  => 'Bfrtip',
                      'layout' => ['top2' => 'buttons','topStart' => 'pageLength' ,'topEnd' => 'search'],
                      //'buttons'   => ['nuevoservidor'],
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
        Column::make('hostname')
              ->addClass('catEditable')
              ->title('HOSTNAME')->width(30),
        Column::make('memoria')
              ->addClass('catEditable')
              ->title('MEMORIA')->width(30),
        Column::make('procesadores')
              ->addClass('catEditable')
              ->title('NP')->width(30),
        Column::computed('mprocesador')
              //->addClass('catEditable')
              ->orderable(true)
              ->searchable(true)
              ->addClass('catEditable')
              ->addClass('catCombox')
              ->name('mprocesadores.mprocesador') //si se usa join es la tabla, su usa table.columna
            //  ->name('procesador.procesador.procesador') //si se eloquent relationships usar el nombre de la relación rel1.subrel2.columna
              ->title('MODELO DE PROCESADOR')->width(30),
        Column::computed('sistema operativo')
              ->orderable(true)
              ->searchable(true)
              ->addClass('catEditable')
              ->addClass('catCombox')
              ->name('os.os')
              ->title('SISTEMA OPERATIVO')->width(30),
        Column::make('ambiente')
              ->addClass('catEditable')
              ->addClass('catCombox')
              //->searchable(false)
              ->name('ambientes.ambiente') //para habilitar la búsqueda en los joins
              ->title('AMBIENTE')->width(30),
        Column::make('datacenter')
              ->addClass('catEditable')
              ->addClass('catCombox')
              //->searchable(false)
              ->name('datacenters.datacenter') //para habilitar la búsqueda en los joins
              ->title('DATACENTER')->width(30),
        Column::make('tipo')
              ->addClass('catEditable')
              ->addClass('catCombox')
              //->searchable(false)
              ->name('tipos.tipo') //para habilitar la búsqueda en los joins
              ->title('TIPO')->width(30),
        Column::make('virtualizador')
              ->addClass('catEditable')
              ->addClass('catCombox')
              //->searchable(false)
              ->name('virtualizadores.virtualizador') //para habilitar la búsqueda en los joins
              ->title('VIRTUALIZADOR')->width(30),
        Column::make('mhardware')
              ->addClass('catEditable')
              ->addClass('catCombox')
              //->searchable(false)
              ->name('mhardwares.mhardware') //para habilitar la búsqueda en los joins
              ->title('FABRICANTE')->width(30),
        Column::make('dominio')
              ->addClass('catEditable')
              ->addClass('catCombox')
              //->searchable(false)
              ->name('dominios.dominio') //para habilitar la búsqueda en los joins
              ->title('DOMINIO')->width(30),
        Column::computed('nics')
              //->addClass('catEditable')
              //->addClass('catCombox')
              ->searchable(false)
              //->name('nics.nic') //para habilitar la búsqueda en los joins
              ->title('INTERFACES')->width(30),
        Column::make('descripcion')
              ->addClass('catEditable')
              ->title('DESCRIPCIÓN'),
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
      return 'servidors_' . date('YmdHis');
  }
}
