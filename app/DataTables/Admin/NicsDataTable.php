<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Nic;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NicsDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(Nic $nic){
              $actionBtn =  '
                              <a href="'.route('nic.destroy', $nic).'" id="eliminarnic" class="text-danger"><i class="fas fa-times-circle"></i></a>
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
  public function query(Nic $model): QueryBuilder
  {
      // return $model->newQuery()->where('id',1);
  return $model = Nic::select(
                'nics.id',
                'nics.nic',
                'nics.mac',
                'nics.ip',
                'nics.gateway',
                'nics.netmask',

                'nics.descripcion',
                   'servidores.hostname',
                   'tnics.tnic',
                   'dns1.dnsip as dnsip1',
                   'dns2.dnsip as dnsip2',
                   'dns3.dnsip as dnsip3',
        )
         ->join('servidores','servidores.id','=','nics.cve_servidor')
         ->join('tnics','tnics.id','=','nics.cve_tnic')
         ->leftjoin('dns as dns1','dns1.id','=','nics.cve_dns1')
          ->leftjoin('dns as dns2','dns2.id','=','nics.cve_dns2')
           ->leftjoin('dns as dns3','dns3.id','=','nics.cve_dns3')

         ;
      // ->withCasts(['fecha' => 'date:Y-m-d'])
      // ->get();

        $dnsip2 = Nic::select(

                       'dns.dnsip as dnsip2',
            )
            ->leftjoin('dns','dns.id','=','nics.cve_dns1')
            //->first()
             ;
        $dnsip3 = Nic::select(

                      'dns.dnsip as dnsip3',
           )
           ->leftjoin('dns','dns.id','=','nics.cve_dns1')
           //->first()
            ;

        dd($model->get());




}

/**
* Optional method if you want to use the html builder.
*/
public function html(): HtmlBuilder
{
  return $this->builder()
              ->setTableId('catNics')
              ->columns($this->getColumns())
              ->minifiedAjax()
              //->dom('Bfrtip')
              ->orderBy(0,'asc')
              ->selectStyleSingle()
              ->parameters([
                  //'dom'  => 'Bfrtip',
                  'layout' => ['top2' => 'buttons','topStart' => 'pageLength' ,'topEnd' => 'search'],
                  //'buttons'   => ['nuevonic'],
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
    Column::make('nic')
          ->addClass('catEditable')
          ->title('INTERFACE')->width(30),
    Column::make('tnic')
          ->addClass('catCombox')
          ->addClass('catEditable')
          ->name('tnics.tnic')
          ->title('TIPO')->width(30),
    Column::make('hostname')
          ->addClass('catEditable')
          ->addClass('catCombox')
          ->name('servidores.hostname')
          ->title('SERVIDOR')->width(30),
    Column::make('ip')
          ->addClass('catEditable')
          ->title('IP')->width(30),
    Column::make('gateway')
          ->addClass('catEditable')
          ->title('GATEWAY')->width(30),
    Column::make('netmask')
          ->addClass('catEditable')
          ->title('NETMASK')->width(30),
    Column::make('dnsip1')
          ->addClass('catEditable')
          ->addClass('catCombox')
            ->name('dns1.dnsip')
          ->title('DNS1')->width(30),
    Column::make('dnsip2')
          ->addClass('catEditable')
          ->addClass('catCombox')
            ->name('dns2.dnsip')
          ->title('DNS2')->width(30),
    Column::make('dnsip3')
          ->addClass('catEditable')
          ->addClass('catCombox')
            ->name('dns3.dnsip')
          ->title('DNS3')->width(30),
    // Column::make('dns2')
    //       ->addClass('catEditable')
    //       ->title('DNS2')->width(30),
    // Column::make('dns3')
    //       ->addClass('catEditable')
    //       ->title('DNS3')->width(30),
    Column::make('mac')
          ->addClass('catEditable')
          ->title('MAC')->width(30),
    Column::make('descripcion')
          ->addClass('catEditable')
          ->title('DESCRIPCIÓN')->width(30),


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
        return 'Nics_' . date('YmdHis');
    }
}
