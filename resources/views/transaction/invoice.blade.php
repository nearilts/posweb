<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <table align="center">
        <tr>
            <th style="padding-bottom: 5px">PT TOKO GORDEN BALI</th>
        </tr>
        <tr>
            <th style="padding-bottom: 5px" >www.tokogordenbali.co.id</th>
        </tr>
        <tr>
            <th style="padding-bottom: 20px">IJIN:AHU-044569.AH.01.30THN2022 NIB. 1610220008153</th>
        </tr>
        <tr>
            <th style="font-size: 12px">Alamat : Jln Imam Bonjol 257 Denpasar Bali Email: order@tokogordenbali.co.id Tlp/Wa : 082339569596</th>
        </tr>
        <tr>
            <th style="font-size: 12px">Rek BCA 0499469596 a/n: PT. Toko Gorden Bali</th>
        </tr>
    </table>

    <hr>

    <table style="width: 50%">
        <tr>
            <td style="width: 20px;" align="left">Nomor</td>
            <td  style="width: 70px;" align="left">: {{$data->invoice_no}}</td>
        </tr>
        <tr>
            <td style="width: 20px;" align="left">Nama</td>
            <td style="width: 70px;" align="left">: {{$data->nama_pelanggan}}</td>
        </tr>
        <tr>
            <td style="width: 20px;" align="left">Alamat</td>
            <td style="width: 70px;" align="left">: {{$data->alamat}}</td>
        </tr>
        <tr>
            <td style="width: 20px;" align="left" >Telp </td>
            <td style="width: 70px;" align="left" >: {{$data->telp}} </td>
        </tr>
    </table>

    <p>Penawaran Produk Dengan Berbagai Pilihan Bahan dan Merek</p>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
        <tr>
            <th style=" width: 20%; border: 1px solid black;" align="center">Informasi</th>
            <th style=" width: 20%; border: 1px solid black;" align="center">Item</th>
            <th style=" width: 20%; border: 1px solid black;" align="center">Size</th>
            <th style=" width: 15%; border: 1px solid black;" align="center">Total Bahan</th>
            <th style=" width: 20%; border: 1px solid black;" align="center">Harga</th>
            <th style=" width: 20%; border: 1px solid black;" align="center">Total Harga</th>
        </tr>

        @foreach ($data->detail as $pp)
        <tr>
            <td style=" border: 1px solid black;" align="center">{{($pp['informasi'])}}</td>
            <td style=" border: 1px solid black;" align="center">{{($pp['product'])}}</td>
            <td style=" border: 1px solid black;" align="center">{{($pp['size'])}}</td>
            <td style=" border: 1px solid black;" align="center">{{($pp['qty'])}}</td>
            <td style=" border: 1px solid black;" align="right">{{number_format($pp['price'])}}</td>
            <td style=" border: 1px solid black;" align="right">{{number_format($pp['profit'])}}</td>
        </tr>
        @endforeach
        

        <tr>
            <th style=" height:15px; border: 1px solid black;" align="left" colspan="6"> </th>
        </tr>
        <tr>
            <th style=" border: 1px solid black;" align="left" colspan="5">Sub Total</th>
            <th style=" border: 1px solid black;" align="right">{{number_format($data->sub_total)}}</th>
        </tr>
        <tr>
            <th style=" border: 1px solid black;" align="left" colspan="5">Discount {{$data->diskon}}%</th>
            <th style=" border: 1px solid black;" align="right">{{number_format(( $data->sub_total * $data->diskon) /100 )}}</th>
        </tr>
        <tr>
            <th style=" border: 1px solid black;" align="left" colspan="5">Total</th>
            <th style=" border: 1px solid black;" align="right">{{number_format($data->total)}}</th>
        </tr>
        <tr>
            <th style=" border: 1px solid black;" align="left" colspan="5">DP</th>
            <th style=" border: 1px solid black;" align="right">{{number_format($data->paid)}}</th>
        </tr>
        <tr>
            <th style=" border: 1px solid black;" align="left" colspan="5">Sisa Pembayaran</th>
            <th style=" border: 1px solid black;" align="right">{{number_format($data->unpaid)}}</th>
        </tr>
        
    </table>
    <p>Syarat Dan Ketentuan</p>
    <li>Pelunasan Setelah Pekerjaan Selesai</li>

    <table  align="right" style="width: 50%">
        <tr>
            <td align="center">Denpasar,  {{$data->created_at->format('d/m/Y')}}</td>
        </tr>
        <tr>
            <td align="center">Hormat Kami</td>
        </tr>
        <tr>
            <td align="center">
                <img src="{{ public_path('qr.jpeg') }}" alt="QR Code" style="width: 100px; height: auto;">
            </td>
        </tr>
        <tr>
            <td align="center">Tatang Rohiman Jayana</td>
        </tr>
    </table>
</body>
</html>