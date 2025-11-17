@extends('layouts.master')
@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">weekend</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Penjualan Hari Ini</p>
            <h4 class="mb-0">Rp{{ number_format($totalPenjualanHariIni,0,',','.') }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Transaksi Hari Ini</p>
            <h4 class="mb-0">{{ $totalTransaksiHariIni }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Pelanggan</p>
            <h4 class="mb-0">{{ $totalPelanggan }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">weekend</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Produk</p>
            <h4 class="mb-0">{{ $totalProduk }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Chart Row -->
  <div class="row mt-4">
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card z-index-2 ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 ">Penjualan Mingguan</h6>
          <p class="text-sm ">Performa minggu ini</p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm"> update 2 hari lalu </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card z-index-2  ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 "> Penjualan Harian </h6>
          <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) kenaikan hari ini. </p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm"> update 4 menit lalu </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-4 mb-3">
      <div class="card z-index-2 ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 ">Tugas Selesai</h6>
          <p class="text-sm ">Performa tugas minggu ini</p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">baru saja diperbarui</p>
          </div>
        </div>
      </div>
    </div>
  </div>

      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>

    @endsection

@push('scripts')
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script>
  var ctx = document.getElementById("chart-bars").getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["M", "T", "W", "T", "F", "S", "S"],
      datasets: [{
        label: "Sales",
        tension: 0.4,
        borderWidth: 0,
        borderRadius: 4,
        borderSkipped: false,
        backgroundColor: "rgba(255, 255, 255, .8)",
        data: [50, 20, 10, 22, 50, 10, 40],
        maxBarThickness: 6
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      interaction: { intersect: false, mode: 'index' },
      scales: {
        y: {
          grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5], color: 'rgba(255, 255, 255, .2)' },
          ticks: { suggestedMin: 0, suggestedMax: 500, beginAtZero: true, padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 }, color: "#fff" },
        },
        x: {
          grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5], color: 'rgba(255, 255, 255, .2)' },
          ticks: { display: true, color: '#f8f9fa', padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } },
        },
      },
    },
  });

  var ctx2 = document.getElementById("chart-line").getContext("2d");
  new Chart(ctx2, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Mobile apps",
        tension: 0,
        borderWidth: 0,
        pointRadius: 5,
        pointBackgroundColor: "rgba(255, 255, 255, .8)",
        pointBorderColor: "transparent",
        borderColor: "rgba(255, 255, 255, .8)",
        borderWidth: 4,
        backgroundColor: "transparent",
        fill: true,
        data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
        maxBarThickness: 6
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      interaction: { intersect: false, mode: 'index' },
      scales: {
        y: {
          grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5], color: 'rgba(255, 255, 255, .2)' },
          ticks: { display: true, color: '#f8f9fa', padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } },
        },
        x: {
          grid: { drawBorder: false, display: false, drawOnChartArea: false, drawTicks: false, borderDash: [5, 5] },
          ticks: { display: true, color: '#f8f9fa', padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } },
        },
      },
    },
  });

  var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");
  new Chart(ctx3, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Mobile apps",
        tension: 0,
        borderWidth: 0,
        pointRadius: 5,
        pointBackgroundColor: "rgba(255, 255, 255, .8)",
        pointBorderColor: "transparent",
        borderColor: "rgba(255, 255, 255, .8)",
        borderWidth: 4,
        backgroundColor: "transparent",
        fill: true,
        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
        maxBarThickness: 6
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      interaction: { intersect: false, mode: 'index' },
      scales: {
        y: {
          grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5], color: 'rgba(255, 255, 255, .2)' },
          ticks: { display: true, padding: 10, color: '#f8f9fa', font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } },
        },
        x: {
          grid: { drawBorder: false, display: false, drawOnChartArea: false, drawTicks: false, borderDash: [5, 5] },
          ticks: { display: true, color: '#f8f9fa', padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } },
        },
      },
    },
  });
</script>
@endpush
