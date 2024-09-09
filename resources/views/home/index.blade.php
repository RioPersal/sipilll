@extends('dashboard.master')
@section('judul','Home')
@section('content')
<div class="card">
<div class="card-body">
  <div class="row mt-3 d-flex align-items-stretch">
    <div class="col-lg-3 col-6 mb-3">
      <!-- small box -->
      <div class="small-box bg-info h-100">
        <div class="inner">
          <h3>{{ $mahasiswa }}</h3>
          <p>Jumlah Mahasiswa ({{ $mahasiswa_lama }}-{{ $mahasiswa_baru }})</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-person"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6 mb-3">
      <!-- small box -->
      <div class="small-box bg-success h-100">
        <div class="inner">
          <h3>{{ $dosen }}</h3>
          <p>Jumlah Dosen</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-person"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6 mb-3">
      <!-- small box -->
      <div class="small-box bg-secondary h-100">
        <div class="inner">
          <h3>{{ $matkul }}</h3>
          <p>Jumlah Matakuliah</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-book"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6 mb-3">
      <!-- small box -->
      <div class="small-box bg-danger h-100">
        <div class="inner">
          <h3>{{ $count_cpl }}</h3>
          <p>Capaian Pembelajaran Lulusan</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>
</div>

</div>

  <div class="card">
    <div class="card-header">
        <div class="row">
          <div class="col">
          <h5 class="text-bold mt-2">Capaian Pembelajaran Lulusan (CPL)</h5>
        </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered" style="table-layout: fixed;">
            <thead>
                <tr>
                    
                    <th class="text-center col-2">Kode</th>
                    <th class="text-center col-8">Keterangan</th>
                    <th class="text-center col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($cpl as $key => $value)
              <tr>
                  
                  <td class="text-center align-middle">{{$value->kode_cpl}}</td>
                  <td class="ml-2 mr-2">{{$value->keterangan}}</td>
                  <td class="text-center align-middle">
                      <a class="btn btn-sm btn-outline-info"  data-toggle="collapse" href="#collapseExample{{$key+1}}" title="Tampilkan Data CPMK"><i class="fa fa-eye"></i></a>

                  </td>
              </tr>

              @foreach ($indikator_cpl->where('id_cpl', $value->id) as $data)
                    <tr class="collapse bg-light" id="collapseExample{{$key+1}}">
                        <td class="text-center">{{$data->indikator}}</td>
                        <td class="ml-2 mr-2" colspan="2">{{$data->ket_indikator}}</td>
                    </tr>
                @endforeach
              @endforeach
            </tbody>

        </table>
    </div>
  </div>
@endsection
