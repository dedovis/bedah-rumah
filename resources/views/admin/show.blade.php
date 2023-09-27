@extends('layouts.main')

@section('title')
Informasi
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Informasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.beranda')}}">Home</a></li>
              <li class="breadcrumb-item active">Informasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="form-group" id="map" style="height: 400px;"></div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table >
                            <tr >
                                <td >Longitude</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->longitude }}</td>
                            </tr>
                            <tr >
                                <td >Latitude</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->latitude }}</td>
                            </tr>
                            <tr >
                                <td >Alamat</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->alamat }}</td>
                            </tr>
                            <tr >
                                <td >Nama</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->nama }}</td>
                            </tr>
                            <tr >
                                <td >Tempat, Tanggal Lahir</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->tempat_lahir }}, {{Carbon\carbon::parse($rumah->tanggal_lahir)->translatedFormat('d-F-Y')}}</td>
                            </tr>
                            <tr >
                                <td >NIK</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->nik }}</td>
                            </tr>
                            <tr >
                                <td >Nomor KK</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->nokk }}</td>
                            </tr>
                            <tr >
                                <td >Pekerjaan</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->pekerjaan }}</td>
                            </tr>
                            <tr >
                                <td >Keterangan</td>
                                <td>:</td>
                                <td text-align="left">{{ $rumah->keterangan }}</td>
                            </tr>
                    </table>
                    </div>
                    <hr>


                    @if ($rumah->foto_sebelum)
                        <h4 class="card-subtitle mb-2 text-muted">Foto Sebelum</h4>
                        @foreach (json_decode($rumah->foto_sebelum) as $image)
                            <img src="{{ asset('img/fotosebelum/' . $image) }}" alt="Foto Sebelum">
                        @endforeach
                    @endif


                    @if ($rumah->foto_sesudah)
                        <h4 class="card-subtitle mb-2 text-muted">Foto Sesudah</h4>
                        @foreach (json_decode($rumah->foto_sesudah) as $image)
                            <img src="{{ asset('img/fotosesudah/' . $image) }}" alt="Foto Sesudah">
                        @endforeach
                    @endif
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
@endsection

@section('script')

<script>
    var map = L.map('map').setView([-3.4458,114.8214], 13);

    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    L.marker([{{ $rumah->latitude }}, {{ $rumah->longitude }}]).addTo(map);


    var gmap = L.tileLayer('http://{s}.google.com/vt?lyrs=m,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    });

    var gsmap = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    });

    var baseMaps = {
    "OpenStreetMap": osm,
    "Google Maps": gmap,
    "Google Satelite Maps": gsmap
    };

    L.control.layers(baseMaps).addTo(map);

</script>

<script>
    $(function () {
      bsCustomFileInput.init();
    });
    </script>
@endsection
