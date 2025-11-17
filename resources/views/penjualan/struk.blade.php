<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasirku - Struk Penjualan</title>
    <style>
        body { background: #eee; }
        .struk-box { max-width:340px;margin:30px auto;padding:20px;border:1px dashed #888;background:#fff;font-family:monospace;font-size:15px }
        @media print {
            body { background: #fff; }
            .struk-box { box-shadow:none;border:0;margin:0;padding:0; }
            a, .btn-print { display: none !important; }
        }
    </style>
</head>
<body>
<div class="struk-box">
    <div style="text-align:center;line-height:1.2">
        <b>KASIRKU</b><br>
        Jl. Marhas No. 123, Kota<br>
        Telp: 628-9524632011<br>
        ----------------------------------------
        <br><b>KASIRKU</b>
    </div>
    <div style="margin:10px 0">
        Tanggal : @if($penjualan->created_at){{ $penjualan->created_at->format('d-m-Y H:i') }}@else-@endif<br>
        Kasir   : {{ Auth::user()->name ?? '-' }}<br>
        Pelanggan : {{ $penjualan->pelanggan->nama ?? '-' }}
    </div>
    <div style="border-top:1px dashed #888;margin:8px 0"></div>
    <div>
        @foreach($penjualan->detail as $d)
            {{ str_pad(substr($d->produk->nama_produk,0,16), 16) }}
            {{ str_pad('Rp'.number_format($d->harga_satuan,0,',','.'), 10, ' ', STR_PAD_LEFT) }}
            <br>
            Qty: {{ $d->jumlah }} x Rp{{ number_format($d->harga_satuan,0,',','.') }}
            <span style="float:right">Rp{{ number_format($d->subtotal,0,',','.') }}</span><br>
        @endforeach
    </div>
    <div style="border-top:1px dashed #888;margin:8px 0"></div>
    <div>
        Subtotal        : Rp{{ number_format($penjualan->total_harga,0,',','.') }}<br>
        @if(session('kode_promo'))
        Kode Promo      : {{ session('kode_promo') }}<br>
        Diskon          : -Rp{{ number_format(session('diskon', 0),0,',','.') }}<br>
        Total Setelah Diskon : Rp{{ number_format($penjualan->grand_total,0,',','.') }}<br>
        @else
        Total           : Rp{{ number_format($penjualan->grand_total,0,',','.') }}<br>
        @endif
        @php
            $bayar = $penjualan->bayar ?? session('bayar', 0);
            $kembalian = $penjualan->kembalian ?? session('kembalian', 0);
        @endphp
        Bayar           : Rp{{ number_format($bayar,0,',','.') }}<br>
        Kembalian       : Rp{{ number_format($kembalian,0,',','.') }}<br>
    </div>
    <div style="border-top:1px dashed #888;margin:8px 0"></div>
    <div style="text-align:center;line-height:1.2">
        --- TERIMA KASIH ---<br>
        Barang yang sudah dibeli<br>
        tidak dapat dikembalikan.<br>
        <br>
        <button onclick="window.print()" class="btn-print" style="display:inline-block;margin-top:10px;padding:6px 18px;background:#000;color:#fff;text-decoration:none;border-radius:4px;font-size:15px;border:none;cursor:pointer;width:100%">Print Struk</button>
    </div>
</div>
</body>
</html>
