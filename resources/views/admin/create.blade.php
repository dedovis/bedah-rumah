@extends('layouts.main')

@section('title')
Tambah Marker
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Marker</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.beranda')}}">Home</a></li>
              <li class="breadcrumb-item active">Tambah Marker</li>
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
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-info text-center" id="addMarkerButton">Cek Marker</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.rumah.store') }}" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" class="form-control" id="longitude" name="longitude"
                                                placeholder="longitude" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input type="text" class="form-control" id="latitude" name="latitude"
                                                placeholder="latitude" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                placeholder="Masukan Nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="number" class="form-control" id="nik" name="nik"
                                                placeholder="Masukan nik" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nokk">Nomor KK</label>
                                            <input type="number" class="form-control" id="nokk" name="nokk"
                                                placeholder="Masukan Nomor KK" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea type="text" class="form-control" id="alamat" name="alamat"
                                                placeholder="Masukan Alamat" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                placeholder="Masukan Pekerjaan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                                placeholder="Masukan Tempat ahir" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                                placeholder="Masukan tanggal ahir" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan"
                                                placeholder="Masukan Keterangan" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto_sebelum">Foto Sebelum</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="foto_sebelum[]" id="foto_sebelum" multiple>
                                                    <label class="custom-file-label" for="foto_sebelum">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto_sesudah">Foto Sesudah</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="foto_sesudah[]" id="foto_sesudah" multiple>
                                                    <label class="custom-file-label" for="foto_sesudah">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <td>
                                    <a type="button" href="{{ route('admin.beranda') }}"
                                        class="btn btn btn-outline-danger">Kembali</a>
                                </td>
                                <button type="submit" class="btn btn-outline-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
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

<!-- bs-custom-file-input -->
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
    var map = L.map('map').setView([-3.4458,114.8214], 13);

    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker;

    function addOrUpdateMarker() {
        var latitude = parseFloat(document.getElementById('latitude').value);
        var longitude = parseFloat(document.getElementById('longitude').value);

        if (!isNaN(latitude) && !isNaN(longitude)) {
            var newLatLng = L.latLng(latitude, longitude);

            if (marker) {
                marker.setLatLng(newLatLng);
            } else {
                marker = L.marker(newLatLng).addTo(map);
            }
        } else {
            toastr.warning('Koordinat tidak valid. Silakan masukkan nilai numerik yang valid.');
        }
    }

    document.getElementById('addMarkerButton').addEventListener('click', function () {
        addOrUpdateMarker();
    });

    map.on('click', function (e) {
        document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
        document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
        addOrUpdateMarker();
    });

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
