@extends('dashboard.master')
@section('judul','Rekap Data Nilai Program Studi')
@section('content')
<form class="form-horizontal" form action="/rekap-program-studi" method="GET">
  <div class="row g-3 align-items-center ml-1">
    <div class="col-4">
      <div class="row">
        <input type="search" name="search" class="form-control" placeholder="Masukkan Angkatan Mahasiswa">
      </div>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-outline-primary">Search</button>
    </div>
  </div>
</form>

@if (isset($mahasiswa))
  <div class="card mt-3">
      <div class="card-header">
            <h5 class="text-bold mt-2">
              Angkatan {{ $keyword }}
            </h5>
      </div>
      <div class="card-body">
          <table class="table table-bordered">
              <thead>
                  <tr>
                    <th class="text-center align-middle" width="20px" rowspan="2">NO</th>
                    <th class="text-center align-middle" width="100px" rowspan="2">Nama Mahasiswa</th>
                    <th class="text-center align-middle" rowspan="2">NIM</th>
                    <th class="text-center align-middle" rowspan="2">Angkatan</th>
                    <th class="text-center" colspan="15">CAPAIAN PEMBELAJARAN LULUSAN</th>
                  </tr>

                  <tr>
                    @php
                        $header = array();
                    @endphp
                    @for ($i = 1; $i < $cepeel+1; $i++)
                      @php
                        $dta = ["CPL-$i"];
                        array_push($header, $dta);
                      @endphp
                      <th class="text-center">CPL-{{ $i }}</th>    
                    @endfor
                  </tr>
              </thead>
              <tbody>
                  @foreach ($mahasiswa as $mhs)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $mhs->nama }}</td>
                    <td class="text-center">{{ $mhs->nim }}</td>
                    <td class="text-center">{{ $mhs->angkatan }}</td>
                    @php
                        $nilai1 = 0;
                        $nilai2 = 0;
                        $nilai3 = 0;
                        $nilai4 = 0;
                        $nilai5 = 0;
                        $nilai6 = 0;
                        $nilai7 = 0;
                        $nilai8 = 0;
                        $nilai9 = 0;
                        $nilai10 = 0;
                        $nilai11 = 0;
                        $nilai12 = 0;
                        $nilai13 = 0;
                        $nilai14 = 0;
                        $nilai15 = 0;
                    @endphp
                    
                    @foreach ($pesertas->where('id_mahasiswa', $mhs->id) as $peserta)
                      @foreach ($penilaians->where('id_kelas', $peserta->id_kelas)->where('id_peserta', $peserta->id) as $nilai) 
                      @for ($i = 1; $i < $cepeel+1; $i++)
                            @php
                              $a = $nilai->{'nilai_cpl'.$i};
                              $cpl = array_sum(array_map('intval', explode(',', $a)));
                              ${"nilai$i"} = ${"nilai$i"} + $cpl;
                            @endphp
                        @endfor
                      @endforeach
                    @endforeach
                    @for ($i = 1; $i < $cepeel+1; $i++)
                      <td class="text-center align-middle" style="white-space: nowrap;">
                        {{ ${"nilai$i"} }}
                      </td>   
                    @endfor
                  </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  <tr>
                    <th class="text-center" width="20px" colspan="4">TOTAL</th>

                    @php
                        $nilai1 = 0;
                        $nilai2 = 0;
                        $nilai3 = 0;
                        $nilai4 = 0;
                        $nilai5 = 0;
                        $nilai6 = 0;
                        $nilai7 = 0;
                        $nilai8 = 0;
                        $nilai9 = 0;
                        $nilai10 = 0;
                        $nilai11 = 0;
                        $nilai12 = 0;
                        $nilai13 = 0;
                        $nilai14 = 0;
                        $nilai15 = 0;
                    @endphp
                    
                    @foreach($mahasiswa as $mhs)
                    @foreach ($pesertas->where('id_mahasiswa', $mhs->id) as $peserta)
                      @foreach ($penilaians->where('id_kelas', $peserta->id_kelas)->where('id_peserta', $peserta->id) as $nilai) 
                      @for ($i = 1; $i < $cepeel+1; $i++)
                            @php
                              $a = $nilai->{'nilai_cpl'.$i};
                              $cpl = array_sum(array_map('intval', explode(',', $a)));
                              ${"nilai$i"} = ${"nilai$i"} + $cpl;
                            @endphp
                        @endfor
                      @endforeach
                    @endforeach
                    @endforeach
                    @for ($i = 1; $i < $cepeel+1; $i++)
                      <th class="text-center align-middle" style="white-space: nowrap;">
                        {{ ${"nilai$i"} }}
                      </th>   
                    @endfor
                  </tr>
              </tfoot>
          </table>
      </div>
  </div>

  <div class="card">
      <div class="card-header">
          <div class="row">
              <h4>Grafik Rekap Data Nilai Program Studi</h4>
          </div>
      </div>
      <div class="card-body">
          <div class="chart">
              <canvas id="barChart" ></canvas>
            </div>
      </div>
  </div>
@else
<div class="card mt-3">
  <div class="card-body">
    <h3 class="text-center">Data tidak ditemukan!</h3>
    <h6 class="text-center">Silahkan input terlebih dahulu!</h6>
  </div>
</div>
@endif
@endsection

@section('js')
<script>
    $(function () {
        //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    
    var barChartData = {
      labels  : {!! json_encode($header) !!},
      datasets: [
        {
          label               : 'Capaian Pembelajaran Lulusan',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          data                : [{{ $nilai1 }}, {{ $nilai2 }}, {{ $nilai3 }}, {{ $nilai4 }}, {{ $nilai5 }}, {{ $nilai6 }}, {{ $nilai7 }}, {{ $nilai8 }}, {{ $nilai9 }}, {{ $nilai10 }}, {{ $nilai11 }}, {{ $nilai12 }}, {{ $nilai13 }}, {{ $nilai14 }}, {{ $nilai15 }}]
        },
      ]
    }

      var barChartOptions = {
        responsive              : true,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true, // mulai dari 0
              max: 1000 // nilai maksimum sumbu y
            }
          }]
        }
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions,
        })
    })
</script>
@endsection
