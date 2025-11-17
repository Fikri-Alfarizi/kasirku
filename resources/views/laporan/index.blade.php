@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-3">
                <h6 class="text-white text-capitalize m-0">Laporan Penjualan</h6>
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between px-3 pt-3 gap-2" style="background:rgba(30,60,114,0.03);border-radius:0 0 16px 16px;">
                <form method="GET" class="d-flex align-items-center gap-2 flex-wrap">
                    <label class="mb-0 me-2 fw-semibold">Periode:</label>
                    <input type="date" name="from" value="{{ request('from') }}" class="form-control form-control-sm" style="max-width:150px;">
                    <span class="mx-1">s/d</span>
                    <input type="date" name="to" value="{{ request('to') }}" class="form-control form-control-sm" style="max-width:150px;">
                    <button type="submit" class="btn btn-sm btn-primary ms-2"><i class="fa fa-filter me-1"></i>Filter</button>
                </form>
                <div class="d-flex gap-2">
                    <button id="btnPrintPDF" class="btn btn-danger btn-sm px-3"><i class="fa fa-file-pdf me-1"></i>Cetak PDF</button>
                </div>
            </div>
            <div class="px-3 pt-4">
                <div class="card shadow border-0 mb-3" style="border-radius:18px;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="fw-bold" style="font-size:1.08rem;">Grafik Penjualan
                                <span class="text-secondary fw-normal" style="font-size:0.98rem;">({{ request('from') ?: 'Semua' }} - {{ request('to') ?: 'Semua' }})</span>
                            </div>
                        </div>
                        <canvas id="salesChart" height="90"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Grand Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualans as $p)
                        <tr>
                            <td>
                                {{ optional($p->created_at)->format('d-m-Y H:i') ?? ($p->created_at ?? '-') }}
                            </td>
                            <td>{{ $p->pelanggan->nama ?? '-' }}</td>
                            <td>Rp{{ number_format($p->total_harga,0,',','.') }}</td>
                            <td>Rp{{ number_format($p->grand_total,0,',','.') }}</td>
                            <td>
                                <a href="{{ route('penjualan.struk', $p->id) }}" class="btn btn-info btn-sm" target="_blank" rel="noopener">Lihat Struk Kasirku</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Chart.js & PDFMake -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
// Data chart dari backend (dummy, ganti dengan data dinamis dari controller)
const salesChartLabels = @json($chartLabels ?? []);
const salesChartData = @json($chartData ?? []);
const salesChart = new Chart(document.getElementById('salesChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: salesChartLabels,
        datasets: [{
            label: 'Total Penjualan',
            data: salesChartData,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.08)',
            tension: 0.35,
            pointRadius: 4,
            pointBackgroundColor: '#2563eb',
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// Cetak PDF (tabel + chart)
document.getElementById('btnPrintPDF').onclick = function() {
    // Ambil data tabel
    const rows = Array.from(document.querySelectorAll('table tbody tr')).map(tr =>
        Array.from(tr.children).slice(0, 4).map(td => td.innerText.trim())
    );
    // Header tabel
    const headers = ['Tanggal', 'Pelanggan', 'Total Harga', 'Grand Total'];
    // Data chart
    const chartLabels = salesChartLabels;
    const chartData = salesChartData;

    // PDFMake content
    const docDefinition = {
        content: [
            { text: 'Laporan Penjualan', style: 'header', alignment: 'center', margin: [0,0,0,10] },
            { text: 'Periode: ' + (document.querySelector('input[name=from]').value || 'Semua') + ' s/d ' + (document.querySelector('input[name=to]').value || 'Semua'), style: 'subheader', alignment: 'center', margin: [0,0,0,10] },
            { text: 'Grafik Penjualan', style: 'subheader', margin: [0,10,0,4] },
            {
                columns: [
                    {
                        width: '*',
                        canvas: chartLabels.map((label, i) => {
                            if(i === 0) return null;
                            // Simple line chart (pdfmake canvas)
                            const x1 = (i-1) * 40, y1 = 100 - (chartData[i-1] / Math.max(...chartData) * 80);
                            const x2 = i * 40, y2 = 100 - (chartData[i] / Math.max(...chartData) * 80);
                            return { type: 'line', x1, y1, x2, y2, lineColor: '#2563eb', lineWidth: 2 };
                        }).filter(Boolean)
                    }
                ],
                margin: [0,0,0,10],
                height: 110
            },
            { text: 'Tabel Penjualan', style: 'subheader', margin: [0,10,0,4] },
            {
                table: {
                    headerRows: 1,
                    widths: ['auto','*','auto','auto'],
                    body: [
                        headers,
                        ...rows
                    ]
                },
                layout: 'lightHorizontalLines',
                fontSize: 10
            }
        ],
        styles: {
            header: { fontSize: 18, bold: true },
            subheader: { fontSize: 13, bold: true }
        },
        defaultStyle: { font: 'Roboto' }
    };
    pdfMake.createPdf(docDefinition).open();
};
</script>
    </div>
</div>
@endsection
