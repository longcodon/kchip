@extends('home')
@section('content')

<!-- CSS thu gọn biểu đồ -->
<style>
  .chart-small {
    max-height: 180px;
    max-width: 100%;
  }
  .table th, .table td {
    font-size: 16px;
    vertical-align: middle;
  }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <!-- Biểu đồ -->
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">🧾 Doanh thu theo ngày</h3>
          </div>
          <div class="card-body">
            <canvas id="revenueBarChart" class="chart-small"></canvas>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">📚 Doanh thu theo tác phẩm</h3>
          </div>
          <div class="card-body">
            <canvas id="revenuePieChart" class="chart-small"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Bảng thống kê -->
    <div class="row mt-4">
      <div class="col-md-6 offset-md-3">
        <div class="card border-success">
          <div class="card-header bg-success text-white text-center">
            <h4>📊 Thống kê tổng quan</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered text-center">
              <tr>
                <th class="bg-light">Tổng số đơn hàng</th>
                <td><strong>{{ $totalOrders }}</strong></td>
              </tr>
              <tr>
                <th class="bg-light">Tổng doanh thu</th>
                <td><strong>{{ number_format($totalRevenue, 0, ',', '.') }} VND</strong></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Biểu đồ script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Biểu đồ cột - doanh thu theo ngày
  const barCtx = document.getElementById('revenueBarChart').getContext('2d');
  new Chart(barCtx, {
      type: 'bar',
      data: {
          labels: {!! json_encode($dailyRevenue->pluck('date')) !!},
          datasets: [{
              label: 'Doanh thu (VND)',
              data: {!! json_encode($dailyRevenue->pluck('total')) !!},
              backgroundColor: '#007bff'
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });

  // Biểu đồ tròn - doanh thu theo tác phẩm
  const pieCtx = document.getElementById('revenuePieChart').getContext('2d');
  new Chart(pieCtx, {
      type: 'pie',
      data: {
          labels: {!! json_encode($titleRevenue->pluck('title')) !!},
          datasets: [{
              label: 'Doanh thu theo tác phẩm',
              data: {!! json_encode($titleRevenue->pluck('total')) !!},
              backgroundColor: ['#f39c12', '#00c0ef', '#dd4b39', '#00a65a', '#3c8dbc']
          }]
      }
  });
</script>

@endsection
