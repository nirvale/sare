{{-- @extends('layouts.app')

@slot('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>


@push('scripts')
    {{ $dataTable->scripts() }}
@endpush --}}

@extends('adminlte::page')
@section('meta_tags')
  {{  $dataTable->scripts() }}
@vite([ 'resources/js/admin_custom.js','resources/js/app.js','resources/sass/app.scss','resources/css/admin_custom.css','resources/js/dominio.js'])
@endsection
@section('title', 'Dashboard')

@section('content_header')
  <div class="card">
    <div class="card-header">
        <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1>
    </div>
    <div class="card-body">
      <h4 class="card-subtitle"> <i class="fas fa-users-cog"></i> Módulo de Catatlogos - Dominios </h4>
    </div>
  </div>
@stop

@section('content')

      <div class="card">
          {{-- <div class="card-header">Manage Users</div> --}}
          <div class="card-body">
              {{ $dataTable->table(['class' => 'table table-bordered table-striped no-footer' ]) }}
          </div>
      </div>

      <div class="container">
  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Salary</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Tiger Nixon</td>
        <td class="position" data-id="1">System Architect</td>
        <td class="location" data-id="1">Edinburgh</td>
        <td>$320,800</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Garrett Winters</td>
        <td class="position" data-id="2">Accountant</td>
        <td class="location" data-id="2">Tokyo</td>
        <td>$170,750</td>
      </tr>
      <tr>
        <td>3</td>
        <td>Ashton Cox</td>
        <td class="position" data-id="3">Junior Technical Author</td>
        <td class="location" data-id="3">San Francisco</td>
        <td>$86,000</td>
      </tr>
      <tr>
        <td>4</td>
        <td>Cedric Kelly</td>
        <td class="position" data-id="4">Senior Javascript Developer</td>
        <td class="location" data-id="4">Edinburgh</td>
        <td>$433,060</td>
      </tr>
      <tr>
        <td>5</td>
        <td>Airi Satou</td>
        <td class="position" data-id="5">Accountant</td>
        <td class="location" data-id="5">Tokyo</td>
        <td>$162,700</td>
      </tr>
      <tr>
        <td>6</td>
        <td>Brielle Williamson</td>
        <td class="position" data-id="6">Integration Specialist</td>
        <td class="location" data-id="6">New York</td>
        <td>$372,000</td>
      </tr>
      <tr>
        <td>7</td>
        <td>Herrod Chandler</td>
        <td class="position" data-id="7">Sales Assistant</td>
        <td class="location" data-id="7">San Francisco</td>
        <td>$137,500</td>
      </tr>
      <tr>
        <td>8</td>
        <td>Rhona Davidson</td>
        <td class="position" data-id="8">Integration Specialist</td>
        <td class="location" data-id="8">Tokyo</td>
        <td>$327,900</td>
      </tr>
      <tr>
        <td>9</td>
        <td>Colleen Hurst</td>
        <td class="position" data-id="9">Javascript Developer</td>
        <td class="location" data-id="9">San Francisco</td>
        <td>$205,500</td>
      </tr>
      <tr>
        <td>10</td>
        <td>Sonya Frost</td>
        <td class="position" data-id="10">Software Engineer</td>
        <td class="location" data-id="10">Edinburgh</td>
        <td>$103,600</td>
      </tr>
      <tr>
        <td>11</td>
        <td>Jena Gaines</td>
        <td class="position" data-id="11">Office Manager</td>
        <td class="location" data-id="11">London</td>
        <td>$90,560</td>
      </tr>
      <tr>
        <td>12</td>
        <td>Quinn Flynn</td>
        <td class="position" data-id="12">Support Lead</td>
        <td class="location" data-id="12">Edinburgh</td>
        <td>$342,000</td>
      </tr>
      <tr>
        <td>13</td>
        <td>Charde Marshall</td>
        <td class="position" data-id="13">Regional Director</td>
        <td class="location" data-id="13">San Francisco</td>
        <td>$470,600</td>
      </tr>
      <tr>
        <td>14</td>
        <td>Haley Kennedy</td>
        <td class="position" data-id="14">Senior Marketing Designer</td>
        <td class="location" data-id="14">London</td>
        <td>$313,500</td>
      </tr>
      <tr>
        <td>15</td>
        <td>Tatyana Fitzpatrick</td>
        <td class="position" data-id="15">Regional Director</td>
        <td class="location" data-id="15">London</td>
        <td>$385,750</td>
      </tr>
      <tr>
        <td>16</td>
        <td>Michael Silva</td>
        <td class="position" data-id="16">Marketing Designer</td>
        <td class="location" data-id="16">London</td>
        <td>$198,500</td>
      </tr>
      <tr>
        <td>17</td>
        <td>Paul Byrd</td>
        <td class="position" data-id="17">Chief Financial Officer (CFO)</td>
        <td class="location" data-id="17">New York</td>
        <td>$725,000</td>
      </tr>
      <tr>
        <td>18</td>
        <td>Gloria Little</td>
        <td class="position" data-id="18">Systems Administrator</td>
        <td class="location" data-id="18">New York</td>
        <td>$237,500</td>
      </tr>
      <tr>
        <td>19</td>
        <td>Bradley Greer</td>
        <td class="position" data-id="19">Software Engineer</td>
        <td class="location" data-id="19">London</td>
        <td>$132,000</td>
      </tr>
      <tr>
        <td>20</td>
        <td>Dai Rios</td>
        <td class="position" data-id="20">Personnel Lead</td>
        <td class="location" data-id="20">Edinburgh</td>
        <td>$217,500</td>
      </tr>
      <tr>
        <td>21</td>
        <td>Jenette Caldwell</td>
        <td class="position" data-id="21">Development Lead</td>
        <td class="location" data-id="21">New York</td>
        <td>$345,000</td>
      </tr>
      <tr>
        <td>22</td>
        <td>Yuri Berry</td>
        <td class="position" data-id="22">Chief Marketing Officer (CMO)</td>
        <td class="location" data-id="22">New York</td>
        <td>$675,000</td>
      </tr>
      <tr>
        <td>23</td>
        <td>Caesar Vance</td>
        <td class="position" data-id="23">Pre-Sales Support</td>
        <td class="location" data-id="23">New York</td>
        <td>$106,450</td>
      </tr>
      <tr>
        <td>24</td>
        <td>Doris Wilder</td>
        <td class="position" data-id="24">Sales Assistant</td>
        <td class="location" data-id="24">Sidney</td>
        <td>$85,600</td>
      </tr>
      <tr>
        <td>25</td>
        <td>Angelica Ramos</td>
        <td class="position" data-id="25">Chief Executive Officer (CEO)</td>
        <td class="location" data-id="25">London</td>
        <td>$1,200,000</td>
      </tr>
      <tr>
        <td>26</td>
        <td>Gavin Joyce</td>
        <td class="position" data-id="26">Developer</td>
        <td class="location" data-id="26">Edinburgh</td>
        <td>$92,575</td>
      </tr>
      <tr>
        <td>27</td>
        <td>Jennifer Chang</td>
        <td class="position" data-id="27">Regional Director</td>
        <td class="location" data-id="27">Singapore</td>
        <td>$357,650</td>
      </tr>
      <tr>
        <td>28</td>
        <td>Brenden Wagner</td>
        <td class="position" data-id="28">Software Engineer</td>
        <td class="location" data-id="28">San Francisco</td>
        <td>$206,850</td>
      </tr>
      <tr>
        <td>29</td>
        <td>Fiona Green</td>
        <td class="position" data-id="29">Chief Operating Officer (COO)</td>
        <td class="location" data-id="29">San Francisco</td>
        <td>$850,000</td>
      </tr>
      <tr>
        <td>30</td>
        <td>Shou Itou</td>
        <td class="position" data-id="30">Regional Marketing</td>
        <td class="location" data-id="30">Tokyo</td>
        <td>$163,000</td>
      </tr>
      <tr>
        <td>31</td>
        <td>Michelle House</td>
        <td class="position" data-id="31">Integration Specialist</td>
        <td class="location" data-id="31">Sidney</td>
        <td>$95,400</td>
      </tr>
      <tr>
        <td>32</td>
        <td>Suki Burks</td>
        <td class="position" data-id="32">Developer</td>
        <td class="location" data-id="32">London</td>
        <td>$114,500</td>
      </tr>
      <tr>
        <td>33</td>
        <td>Prescott Bartlett</td>
        <td class="position" data-id="33">Technical Author</td>
        <td class="location" data-id="33">London</td>
        <td>$145,000</td>
      </tr>
      <tr>
        <td>34</td>
        <td>Gavin Cortez</td>
        <td class="position" data-id="34">Team Leader</td>
        <td class="location" data-id="34">San Francisco</td>
        <td>$235,500</td>
      </tr>
      <tr>
        <td>35</td>
        <td>Martena Mccray</td>
        <td class="position" data-id="35">Post-Sales support</td>
        <td class="location" data-id="35">Edinburgh</td>
        <td>$324,050</td>
      </tr>
      <tr>
        <td>36</td>
        <td>Unity Butler</td>
        <td class="position" data-id="36">Marketing Designer</td>
        <td class="location" data-id="36">San Francisco</td>
        <td>$85,675</td>
      </tr>
      <tr>
        <td>37</td>
        <td>Howard Hatfield</td>
        <td class="position" data-id="37">Office Manager</td>
        <td class="location" data-id="37">San Francisco</td>
        <td>$164,500</td>
      </tr>
      <tr>
        <td>38</td>
        <td>Hope Fuentes</td>
        <td class="position" data-id="38">Secretary</td>
        <td class="location" data-id="38">San Francisco</td>
        <td>$109,850</td>
      </tr>
      <tr>
        <td>39</td>
        <td>Vivian Harrell</td>
        <td class="position" data-id="39">Financial Controller</td>
        <td class="location" data-id="39">San Francisco</td>
        <td>$452,500</td>
      </tr>
      <tr>
        <td>40</td>
        <td>Timothy Mooney</td>
        <td class="position" data-id="40">Office Manager</td>
        <td class="location" data-id="40">London</td>
        <td>$136,200</td>
      </tr>
      <tr>
        <td>41</td>
        <td>Jackson Bradshaw</td>
        <td class="position" data-id="41">Director</td>
        <td class="location" data-id="41">New York</td>
        <td>$645,750</td>
      </tr>
      <tr>
        <td>42</td>
        <td>Olivia Liang</td>
        <td class="position" data-id="42">Support Engineer</td>
        <td class="location" data-id="42">Singapore</td>
        <td>$234,500</td>
      </tr>
      <tr>
        <td>43</td>
        <td>Bruno Nash</td>
        <td class="position" data-id="43">Software Engineer</td>
        <td class="location" data-id="43">London</td>
        <td>$163,500</td>
      </tr>
      <tr>
        <td>44</td>
        <td>Sakura Yamamoto</td>
        <td class="position" data-id="44">Support Engineer</td>
        <td class="location" data-id="44">Tokyo</td>
        <td>$139,575</td>
      </tr>
      <tr>
        <td>45</td>
        <td>Thor Walton</td>
        <td class="position" data-id="45">Developer</td>
        <td class="location" data-id="45">New York</td>
        <td>$98,540</td>
      </tr>
      <tr>
        <td>46</td>
        <td>Finn Camacho</td>
        <td class="position" data-id="46">Support Engineer</td>
        <td class="location" data-id="46">San Francisco</td>
        <td>$87,500</td>
      </tr>
      <tr>
        <td>47</td>
        <td>Serge Baldwin</td>
        <td class="position" data-id="47">Data Coordinator</td>
        <td class="location" data-id="47">Singapore</td>
        <td>$138,575</td>
      </tr>
      <tr>
        <td>48</td>
        <td>Zenaida Frank</td>
        <td class="position" data-id="48">Software Engineer</td>
        <td class="location" data-id="48">New York</td>
        <td>$125,250</td>
      </tr>
      <tr>
        <td>49</td>
        <td>Zorita Serrano</td>
        <td class="position" data-id="49">Software Engineer</td>
        <td class="location" data-id="49">San Francisco</td>
        <td>$115,000</td>
      </tr>
      <tr>
        <td>50</td>
        <td>Jennifer Acosta</td>
        <td class="position" data-id="50">Junior Javascript Developer</td>
        <td class="location" data-id="50">Edinburgh</td>
        <td>$75,650</td>
      </tr>
      <tr>
        <td>51</td>
        <td>Cara Stevens</td>
        <td class="position" data-id="51">Sales Assistant</td>
        <td class="location" data-id="51">New York</td>
        <td>$145,600</td>
      </tr>
      <tr>
        <td>52</td>
        <td>Hermione Butler</td>
        <td class="position" data-id="52">Regional Director</td>
        <td class="location" data-id="52">London</td>
        <td>$356,250</td>
      </tr>
      <tr>
        <td>53</td>
        <td>Lael Greer</td>
        <td class="position" data-id="53">Systems Administrator</td>
        <td class="location" data-id="53">London</td>
        <td>$103,500</td>
      </tr>
      <tr>
        <td>54</td>
        <td>Jonas Alexander</td>
        <td class="position" data-id="54">Developer</td>
        <td class="location" data-id="54">San Francisco</td>
        <td>$86,500</td>
      </tr>
      <tr>
        <td>55</td>
        <td>Shad Decker</td>
        <td class="position" data-id="55">Regional Director</td>
        <td class="location" data-id="55">Edinburgh</td>
        <td>$183,000</td>
      </tr>
      <tr>
        <td>56</td>
        <td>Michael Bruce</td>
        <td class="position" data-id="56">Javascript Developer</td>
        <td class="location" data-id="56">Singapore</td>
        <td>$183,000</td>
      </tr>
      <tr>
        <td>57</td>
        <td>Donna Snider</td>
        <td class="position" data-id="57">Customer Support</td>
        <td class="location" data-id="57">New York</td>
        <td>$112,000</td>
      </tr>
    </tbody>
  </table>
</div>
@include('layouts.footer')
@stop
