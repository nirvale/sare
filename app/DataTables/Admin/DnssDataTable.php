<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Dns;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DnssDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
      return (new EloquentDataTable($query))
          ->addColumn('action',function(Dns $dns){
              $actionBtn = '
                            <a href="'.route('dns.destroy', $dns).'" id="eliminardns" class="text-danger"><i class="fas fa-times-circle"></i></a> '
              ;
            return $actionBtn;
            })
          ->setRowId('id')
          // ->editColumn('action', function (Dns $dns) {
          //     return '<a href="'.route('usuario.show', $dns).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
          // })
          ;
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Dns $model): QueryBuilder
  {
    //  $model->newQuery();

        return  $model = Dns::select(
          'dns.id',
          'dns.dnsname',
          'dns.dnsip',
          'dns.cve_servidor',
          'dns.descripcion',
           'servidores.hostname'
          )
          ->leftjoin('servidores','servidores.id','=','dns.cve_servidor')
          ;


  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
      return $this->builder()
                  ->setTableId('catDnss')
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
          Column::make('dnsname')
                ->addClass('catEditable')
                ->title('NOMBRE'),
          Column::make('hostname')
                ->addClass('catEditable')
                ->addClass('catCombox')
                ->title('SERVIDOR'),
          Column::make('dnsip')
                ->addClass('catEditable')
                ->title('IP'),
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
        return 'Dnss_' . date('YmdHis');
    }
}
