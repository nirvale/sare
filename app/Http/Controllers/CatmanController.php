<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Tipodc;
use App\Models\Admin\Dependencia;
use App\Models\Admin\Os;
use App\Models\Admin\Distribucion;
use App\Models\Admin\Rdbms;
use App\Models\Admin\Mprocesador;
use App\Models\Admin\Aprocesador;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Datacenter;
use App\Models\Admin\Tipo;
use App\Models\Admin\Virtualizador;
use App\Models\Admin\Mhardware;
use App\Models\Admin\Dominio;
use App\Models\Admin\Procesador;
use App\Models\Admin\OsVersion;
use App\Models\Admin\Tnic;
use App\Models\Admin\Servidor;
use App\Models\Admin\Dns;
use App\Models\Admin\Tecremotadisco;
use App\Models\Admin\Udremota;
use App\Models\Admin\Dformato;

class CatmanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function catman(Request $request)
   {//dd($request);
      switch ($request->catman) {
        case 'datacenter':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'tipodc':
                  $theadcomboxr='tipodc';
                  $catmanr[$theadcomboxr]=Tipodc::all();
              break;
            // case 'descripción':
            //       $theadcomboxr='descripción';
            //       $catmanr[$theadcomboxr]=Tipodc::all();
            //   //break;

              default:
                // code...
                break;
            }
          }
        break;
        case 'programa':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'dependencia':
                  $theadcomboxr='dependencia';
                  $catmanr[$theadcomboxr]=Dependencia::orderBy('dependencia')->get();
                break;
            // case 'descripción':
            //       $theadcomboxr='descripción';
            //       $catmanr[$theadcomboxr]=Tipodc::all();
            //   //break;

              default:
                // code...
                break;
            }
          }
        break;
        case 'distribucion':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'sistema_operativo':
                  $theadcomboxr='sistema_operativo';
                  $catmanr[$theadcomboxr]=Os::select('id','os as sistema_operativo')->orderBy('sistema_operativo')->get();
                break;
            // case 'descripción':
            //       $theadcomboxr='descripción';
            //       $catmanr[$theadcomboxr]=Tipodc::all();
            //   //break;

              default:
                // code...
                break;
            }
          }
        break;
        case 'osversion':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'distribucion':
                  $theadcomboxr='distribucion';
                  $catmanr[$theadcomboxr]=Distribucion::select('id','distribucion')->orderBy('distribucion')->get();
                break;
            // case 'descripción':
            //       $theadcomboxr='descripción';
            //       $catmanr[$theadcomboxr]=Tipodc::all();
            //   //break;

              default:
                // code...
                break;
            }
          }
        break;
        case 'rdbmsversion':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'manejador':
                  $theadcomboxr='manejador';
                  $catmanr[$theadcomboxr]=Rdbms::select('id','rdbms as manejador')->orderBy('manejador')->get();
                break;
            // case 'descripción':
            //       $theadcomboxr='descripción';
            //       $catmanr[$theadcomboxr]=Tipodc::all();
            //   //break;

              default:
                // code...
                break;
            }
          }
          case 'nic':
            foreach ($request->theadcombox as $key => $head) {
              switch ($head) {
                case 'tipo':
                    $theadcomboxr='tipo';
                    $catmanr[$theadcomboxr]=Tnic::select('id','tnic as tipo')->orderBy('tipo')->get();
                break;
                case 'servidor':
                    $theadcomboxr='servidor';
                    $catmanr[$theadcomboxr]=Servidor::select('id','hostname as servidor')->orderBy('servidor')->get();
                break;
                case 'dns1':
                    $theadcomboxr='dns1';
                    $catmanr[$theadcomboxr]=Dns::select('id','dnsip as dns1')->orderBy('dns1')->get();
                break;
                case 'dns2':
                    $theadcomboxr='dns2';
                    $catmanr[$theadcomboxr]=Dns::select('id','dnsip as dns2')->orderBy('dns2')->get();
                break;
                case 'dns3':
                    $theadcomboxr='dns3';
                    $catmanr[$theadcomboxr]=Dns::select('id','dnsip as dns3')->orderBy('dns3')->get();
                break;
              // case 'descripción':
              //       $theadcomboxr='descripción';
              //       $catmanr[$theadcomboxr]=Tipodc::all();
              //   //break;

                default:
                  // code...
                  break;
              }
            }
        break;
        case 'storageremoto':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'tecnologia':
                  $theadcomboxr='tecnologia';
                  $catmanr[$theadcomboxr]=Tecremotadisco::select('id','tecremotadisco as tecnologia')->orderBy('tecnologia')->get();
              break;
              case 'fabricante':
                  $theadcomboxr='fabricante';
                  $catmanr[$theadcomboxr]=Mhardware::select('id','mhardware as fabricante')->orderBy('fabricante')->get();
              break;
              case 'utilidades_soportadas':
                  $theadcomboxr='utilidades_soportadas';
                  $catmanr[$theadcomboxr]=Udremota::select('id','udremota as utilidades_soportadas')->orderBy('utilidades_soportadas')->get();
              break;
              case 'datacenter':
                  $theadcomboxr='datacenter';
                  $catmanr[$theadcomboxr]=Datacenter::select('id','datacenter')->orderBy('datacenter')->get();
              break;
            // case 'descripción':
            //       $theadcomboxr='descripción';
            //       $catmanr[$theadcomboxr]=Tipodc::all();
            //   //break;

              default:
                // code...
                break;
            }
          }
      break;
        case 'servidor':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'modelo_de_procesador':
                  $theadcomboxr='modelo_de_procesador';
                  $procesadores = Procesador::with('mprocesador','aprocesador')
                                                        ->select()
                                                        ->get()->sortBy('mprocesador');
                  foreach ($procesadores as $id => $procesador) {
                    $temp[]= (['id' => $id, 'modelo_de_procesador' => $procesador->mprocesador->mprocesador.' | '.$procesador->procesador.' | '. $procesador->velocidad.' | '.$procesador->nucleos.' cores | '.$procesador->aprocesador->aprocesador]);
                  }
                  $catmanr[$theadcomboxr]=$temp;
                  unset($temp);
                break;
              case 'ambiente':
                  $theadcomboxr='ambiente';
                  $catmanr[$theadcomboxr]=Ambiente::select('id','ambiente')->orderBy('ambiente')->get();
                break;
              case 'datacenter':
                  $theadcomboxr='datacenter';
                  $catmanr[$theadcomboxr]=Datacenter::select('id','datacenter')->orderBy('datacenter')->get();
                break;
              case 'tipo':
                  $theadcomboxr='tipo';
                  $catmanr[$theadcomboxr]=Tipo::select('id','tipo')->orderBy('tipo')->get();
                break;
              case 'virtualizador':
                  $theadcomboxr='virtualizador';
                  $catmanr[$theadcomboxr]=Virtualizador::select('id','virtualizador')->orderBy('virtualizador')->get();
                break;
              case 'fabricante':
                  $theadcomboxr='fabricante';
                  $catmanr[$theadcomboxr]=Mhardware::select('id','mhardware as fabricante')->orderBy('fabricante')->get();
                break;
              case 'dominio':
                  $theadcomboxr='dominio';
                  $catmanr[$theadcomboxr]=Dominio::select('id','dominio')->orderBy('dominio')->get();
                break;
              case 'sistema_operativo':
                  $theadcomboxr='sistema_operativo';
                  $osversions = Osversion::with('distribucion','distribucion.os')
                                                        ->select()
                                                        ->get()->sortBy('distribucion.os.os');
                  foreach ($osversions as $id => $osversion) {
                    $temp[]= (['id' => $id, 'sistema_operativo' => $osversion->distribucion->os->os.' | '.$osversion->distribucion->distribucion.' | '. $osversion->osversion]);
                  }
                  $catmanr[$theadcomboxr]=$temp;
                  unset($temp);
                break;

              default:
                // code...
                break;
            }
          }
        break;
        case 'procesador':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'fabricante':
                  $theadcomboxr='fabricante';
                  $catmanr[$theadcomboxr]=Mprocesador::select('id','mprocesador as fabricante')->orderBy('fabricante')->get();
                break;
              case 'arquitectura':
                  $theadcomboxr='arquitectura';
                  $catmanr[$theadcomboxr]=Aprocesador::select('id','aprocesador as arquitectura')->orderBy('arquitectura')->get();
                break;
              // case 'os':
              //     $theadcomboxr='os';
              //     $catmanr[$theadcomboxr]=Os::select('id','os')->get();
              //   //break;
              // case 'distribución':
              //     $theadcomboxr='distribucion';
              //     $catmanr[$theadcomboxr]=Distribucion::select('id','distribucion')->get();
              //   //break;

              default:
                // code...
                break;
            }
          }
        break;
        case 'dns':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'servidor':
                  $theadcomboxr='servidor';
                  $catmanr[$theadcomboxr]=Servidor::select('id','hostname as servidor')->orderBy('servidor')->get();
              break;
              default:
                // code...
              break;
            }
          }
        break;
        case 'localdisco':
          foreach ($request->theadcombox as $key => $head) {
            switch ($head) {
              case 'servidor':
                  $theadcomboxr='servidor';
                  $catmanr[$theadcomboxr]=Servidor::select('id','hostname as servidor')->orderBy('servidor')->get();
              break;
              case 'formato':
                  $theadcomboxr='formato';
                  $catmanr[$theadcomboxr]=Dformato::select('id','dformato as formato')->orderBy('formato')->get();
              break;
              default:
                // code...
                break;
            }
          }
        break;
        default:
           // code...
          break;
       }

       return $catmanr;
   }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
