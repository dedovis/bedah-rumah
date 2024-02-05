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

                        <div class="card-header">
                            <h3 class="card-title">Detail</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Longitude</dt>
                                <dd class="col-sm-9">{{ $rumah->longitude }}</dd>

                                <dt class="col-sm-3">Latitude</dt>
                                <dd class="col-sm-9">{{ $rumah->latitude }}</dd>

                                <dt class="col-sm-3">Alamat</dt>
                                <dd class="col-sm-9">{{ $rumah->alamat }}</dd>

                                <dt class="col-sm-3">Nama</dt>
                                <dd class="col-sm-9">{{ $rumah->nama }}</dd>

                                <dt class="col-sm-3">Tempat, Tanggal Lahir</dt>
                                <dd class="col-sm-9">{{ $rumah->tempat_lahir }}, {{Carbon\carbon::parse($rumah->tanggal_lahir)->translatedFormat('d-F-Y')}}</dd>

                                <dt class="col-sm-3">NIK</dt>
                                <dd class="col-sm-9">{{ $rumah->nik }}</dd>

                                <dt class="col-sm-3">Nomor KK</dt>
                                <dd class="col-sm-9">{{ $rumah->nokk }}</dd>

                                <dt class="col-sm-3">Pekerjaan</dt>
                                <dd class="col-sm-9">{{ $rumah->pekerjaan }}</dd>

                                <dt class="col-sm-3">Keterangan</dt>
                                <dd class="col-sm-9">{{ $rumah->keterangan }}</dd>
                            </dl>
                            <hr>

                            @if ($rumah->foto_sebelum)
                                <h4 class="card-subtitle mb-2 text-muted">Foto</h4>
                                <div class="row">
                                    @foreach (json_decode($rumah->foto_sebelum) as $image)
                                        <div class="col-md-3">
                                            <img src="{{ asset('img/fotosebelum/' . $image) }}" class="img-fluid" alt="Foto Sebelum">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>




                    {{-- @if ($rumah->foto_sesudah)
                        <h4 class="card-subtitle mb-2 text-muted">Foto Sesudah</h4>
                        @foreach (json_decode($rumah->foto_sesudah) as $image)
                            <img src="{{ asset('img/fotosesudah/' . $image) }}" alt="Foto Sesudah">
                        @endforeach
                    @endif --}}
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

@endsection
