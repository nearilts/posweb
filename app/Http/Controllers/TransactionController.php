<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index() {
        $data['data'] = Transaction::latest()->get();
        $data['product'] = Product::latest()->get();
        return view('transaction.index', $data);
    }

    public function create() {
        $data['product'] = Product::latest()->get();
        return view('transaction.create', $data);
    }

    public function show(Transaction $transaction) {
        $data['data'] = $transaction;
        $pdf = Pdf::loadView('transaction.invoice', $data);
        return $pdf->stream('invoice-'.$transaction->invoice_no.'.pdf');
    }
    public function edit(Transaction $transaction) {
        $data['transaction'] = $transaction;
        $data['product'] = Product::latest()->get();
        return view('transaction.edit', $data);
    }
    
    public function store(Request $request) {

        // dd($request->all());

        if (count($request->transaksi_produk) < 1) {
            return redirect()->back()->withInput()->with('error', 'Category tidak ada!');
        }
        $transaksi = Transaction::create([
            'invoice_no' => $request->invoice_no,
            'tanggal' => $request->tanggal,
            'tanggal_kirim' => $request->invoice_tanggalkirim,
            'nama_pelanggan' => $request->pelanggan,
            'alamat' => $request->invoice_alamat,
            'telp' => $request->invoice_tlp,
            'kasir' => $request->invoice_kasir,
            'user_id' => $request->kasir,
            'sub_total' => $request->sub_total,
            'diskon' => $request->diskon,
            'total' => $request->total,
            'paid' => $request->total_downpayment,
            'unpaid' => $request->total_sisatotal,
        ]);

        $profit = 0;

        foreach ($request->transaksi_produk as $key => $value) {
            $product = Product::find($value);
            $harga = $product->harga_modal;
            $harga_jual = $product->harga_jual;

            $tansdetail = TransactionDetail::create([
                'transaction_id' => $transaksi->id,
                'product_id' => $value,
                'product' => $product->name,
                'informasi' => $request->informasi[$key],
                'size' => $request->size[$key],
                'qty' => $request->transaksi_jumlah[$key],
                'price' => $harga_jual,
                'profit' => $harga_jual * $request->transaksi_jumlah[$key],
            ]); 
            $profit += ($harga_jual-$harga) * $request->transaksi_jumlah[$key];
        }

        $diskon = ($request->total * $request->diskon) / 100;
        $profit = $profit - $diskon ;

        $transaksi->update(['total_profit' => $profit]);

        return redirect()->back()->with('success', 'Your data has been saved successfully!');
    }

    
    public function update(Request $request, $id) {
        // dd($request->all());

        $transaksi = Transaction::find($id);
        $transaksi->update([
            'paid' => $request->paid,
            'unpaid' => $request->unpaid,
            'total' => $request->total,
            'sub_total' => $request->sub_total,
            ]
        );
        $profit = 0;

        foreach ($request->detail as $key => $value) {
            // dd($value);
            $product = Product::find($value['product_id']);
            $harga = $product->harga_modal;
            $harga_jual = $product->harga_jual;
            $tansdetail = TransactionDetail::find($value['id']);
            $tansdetail->update([
                'qty' => $value['qty'],
                'price' => $harga_jual,
                'profit' => $harga_jual * $value['qty'],
            ]); 
            $profit += ($harga_jual-$harga) * $value['qty'];
        }

        $diskon = ($transaksi->total * $transaksi->diskon) / 100;
        $profit = $profit - $diskon ;

        $transaksi->update([
            'paid' => $request->paid,
            'unpaid' => $request->unpaid,
            'total_profit' => $profit]
        );

        return redirect()->back()->with('success', 'Your data has been updated successfully!');
    }

   
    public function report(Request  $request) {
        $startDate = Carbon::parse($request->tanggal_dari);
        $endDate = Carbon::parse($request->tanggal_sampai);

        // Mengambil data yang berada dalam rentang tanggal
        $data['data'] = Transaction::whereBetween('tanggal_kirim', [$startDate, $endDate])->get();
        return view('transaction.report', $data);
    }
}
