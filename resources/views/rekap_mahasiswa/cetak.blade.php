<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .group {
            margin-bottom: 100px;
        }
        .table.static {
            position: relative;
            border: 1px solid #000000;
        }

        .container {
            text-align: center;
        }

        th,td{
            font-size: 12px;
        }
    </style>

</head>
<body>
        <div class="group">
            <div class="container">
            <img src="../public/dist/img/logo_unri.jpg">
            <h1 style="font-size: 24px; margin-top: 4; margin-bottom: 0;">UNIVERSITAS RIAU</h1>
            <h5 style="margin-top: 0; margin-bottom: 0;">Kampus Bina Widya Km 12,5 Simpang Baru 28923</h5>
            <hr style="border: 0; width: 75%; height: 0.5px; background-color: black;">
            </div>

            <h1 align="center" style="font-size: 20px; margin-bottom: 0;">TRASNKRIP CPL</h1>
            <hr style="border: 0; width: 25%; height: 0.5px; background-color: black;">
            <P style="margin-bottom: 0;">Nama Mahasiswa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $mahasiswa->nama }}</P>
            <P style="margin-top: 0; margin-bottom: 0;">Nomor Induk Mahasiswa &nbsp;&nbsp;&nbsp;: {{ $mahasiswa->nim }}</P>
            <P style="margin-top: 0; margin-bottom: 0;">Angkatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $mahasiswa->angkatan }}</P>
            <P style="margin-top: 0; margin-bottom: 0;">Jurusan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Teknik Sipil</P>
            <P style="margin-top: 0;">Program Studi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Teknik Sipil S1</P>
            <table class="static" align="center" rules="all" style="width: 100%">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Mata Kuliah</th>
                        <th rowspan="2">SKS</th>
                        <th rowspan="2">Semester</th>
                        <th colspan="11">Capaian Pembelajaran Lulusan</th>
                    </tr>

                    <tr>
                        @php
                            $header = array();
                        @endphp
    
                        @foreach ($cepeel as $cpl)
                        @php
                            array_push($header, $cpl->kode_cpl);
                        @endphp
                          <th class="text-center align-middle" nowrap>{{ $cpl->kode_cpl }}</th>
                        @endforeach    
                    </tr>
                </thead>
                <tbody>
                
                    @php
                        $total_cpl = array();
                    @endphp
                    @foreach ($matkuls as $kuy => $matkul)
                    @php
                        $total_cpl_mk = array();
                    @endphp
                      <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td style="text-align: center;">{{ $matkul->nama_matkul }}</td>
                        <td style="text-align: center;">{{ $matkul->sks }}</td>
                        <td style="text-align: center;">{{ $matkul->semester }}</td>
                        @if($kelass->where('id_matkul', $matkul->id)->count() == 0)
                          <td colspan="{{ $cepeel_count }}" style="text-align: center; white-space: nowrap;">
                            Data kelas tidak ditemukan. Silahkan buat kelas terlebih dahulu!
                          </td>
                        @else
                        @foreach ($kelass->where('id_matkul',$matkul->id) as $kelas)
                          @foreach ($peserta->where('id_kelas',$kelas->id)->where('id_mahasiswa',$mahasiswa->id) as $pesertaa)
                            @foreach ($cepeel as $key => $cpl)
                              @php
                                $jumlah_rata_rata = 0;
                                $jumlah_nilai_cpl = 0;
                                $jumlah_nilai_ind_final = 0;
                                $jumlah_hasil_rata_rata = 0;
                                $s = 0;
                              @endphp
    
                              @foreach ($indikator->where('id_cpl',$cpl->id) as $ind)
                                @php
                                  $jumlah_nilai_ind = 0;
                                @endphp
    
                                @foreach ($mtkl as $mk)
                                @foreach ($mtnd->where('id_matkul', $mk->id)->where('id_indikator', $ind->id) as $mi)
                                    
                                    @php
                                        $x = 100/$mk->sks;
                                        $s += $x*$mi->bobot_indikator;
                                    @endphp
                                @endforeach
                                @endforeach
    
                                @foreach ($cpmk->where('id_indikator',$ind->id)->where('id_matkul',$matkul->id) as $cpm)
                                  @foreach ($bobot_cpmk->where('id_cpmk',$cpm->id) as $bobot)
                                    @if ($penilaian->where('id_mahasiswa',$mahasiswa->id)->where('id_kelas',$kelas->id)->where('id_asesmen',$bobot->id)->count() == 0)
                                      @php
                                        $jumlah_nilai_ind = 0;
                                      @endphp
                                    @else
                                      @foreach ($penilaian->where('id_mahasiswa',$mahasiswa->id)->where('id_kelas',$kelas->id)->where('id_asesmen',$bobot->id) as $nilai)
                                        @php
                                          $jumlah_nilai_ind += $nilai->nilai*($bobot->bobot_cpmk/100);
                                        @endphp
                                      @endforeach
                                    @endif
                                  @endforeach
                                @endforeach
                                
                                @foreach ($mat_ind->where('id_matkul',$matkul->id)->where('id_indikator',$ind->id) as $matdin)
                                  @php
                                    $rata_rata_ind = 100/$matkul->sks;
                                    $rata_rata_mat_ind = $rata_rata_ind*$matdin->bobot_indikator;
                                    $jumlah_rata_rata += $rata_rata_mat_ind;
                                    $jumlah_hasil_rata_rata = $rata_rata_mat_ind/$jumlah_rata_rata;
                                    $jumlah_nilai_ind_final += $jumlah_nilai_ind;
                                  @endphp
                                @endforeach
                              @endforeach
    
                              @php
                                $jumlah_nilai_cpl = $jumlah_nilai_cpl+($jumlah_nilai_ind_final*$jumlah_hasil_rata_rata);
                                if ($jumlah_nilai_cpl == 0 || $s == 0 || $jumlah_rata_rata == 0) {
                                  $hasil = 0;
                                } else {
                                  $hasil = $jumlah_nilai_cpl * $jumlah_rata_rata / $s;
                                }
                                
                                $total_cpl_mk[$key] = $hasil;
                              @endphp
                              
                              <td style="text-align: center; font-size: 12px">{{ round($hasil, 2) }}</td>
                              @endforeach
                              @php
                                  $total_cpl[$kuy] = $total_cpl_mk;
                              @endphp
                          @endforeach
                        @endforeach

                        @endif
                      </tr>

                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th width="20px" colspan="4">TOTAL</th>
  
                      @php
                          $totalSumArray = [];
  
                          // Looping untuk mengakses setiap elemen dari array dua dimensi
                          foreach ($total_cpl as $rowIndex => $row) {
                              foreach ($row as $colIndex => $value) {
                                  // Jika indeks array baru belum ada, inisialisasi dengan 0
                                  if (!isset($totalSumArray[$colIndex])) {
                                      $totalSumArray[$colIndex] = 0;
                                  }
  
                                  // Tambahkan nilai dari array dua dimensi ke array baru
                                  $totalSumArray[$colIndex] += $value;
                              }
                          }
                      @endphp
  
                      @foreach ($totalSumArray as $result)
                      @if (round($result, 2) <= 50)
                      <th style="background-color: red;">{{ round($result, 2) }}</th>
                      @else
                      <th>{{ round($result, 2) }}</th>
                      @endif
                      
                      @endforeach
                    </tr>
                </tfoot>
            </table>

            
            <div style="float: right; width: 35%">
                <p style="margin-bottom: 0;">Mengesahkan,</p>
                <p style="margin-top: 0; margin-bottom: 0;">Koordinator Prodi Teknik Sipil S1,</p>
                <br>
                <br>
                <br>
                <p style="margin-bottom: 0;">(Andy Hendri, ST, MT)</p>
                <p style="margin-top: 0; margin-bottom: 0;">NIP. 19690717 199803 1 000</p>
            </div>

            <div style="float: left; width: 35%">
                <p style="margin-bottom: 0;">Pekanbaru,</p>
                <p style="margin-top: 0; margin-bottom: 0;">31 Agustus 2001</p>
            </div>
        </div>
        
    </body>
</html>