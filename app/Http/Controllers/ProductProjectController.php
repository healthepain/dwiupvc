<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductProjectController extends Controller
{
    /**
     * Menampilkan daftar product yang tersedia
     * untuk dipilih pada modal.
     */
    public function products()
    {
        $products = Product::select(
            'id',
            'product_name',
            'lebar_kusen',
            'tinggi_kusen',
            'jumlah_lebar_kusen',
            'jumlah_tinggi_kusen',
            'jumlah_lebar_daun',
            'jumlah_tinggi_daun',
            'harga_kusen',
            'harga_daun',
            'harga_kaca',
            'harga_panel',
            'harga_aksesoris'
        )
            ->orderBy('product_name')
            ->get();

        return response()->json($products);
    }

    /**
     * Menambahkan product ke project.
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'lebar_kusen' => 'required|numeric|min:0',
            'tinggi_kusen' => 'required|numeric|min:0',
        ]);

        // Ambil product dari database
        $product = Product::findOrFail($request->product_id);

        // Ukuran kusen dari input user
        $lebarKusen = (float) $request->lebar_kusen;
        $tinggiKusen = (float) $request->tinggi_kusen;

        /*
        |--------------------------------------------------------------------------
        | Perhitungan harga
        |--------------------------------------------------------------------------
        */

        // Karena pada perhitungan sebelumnya:
        // lebar daun = lebar kusen
        // tinggi daun = tinggi kusen
        $lebarDaun = $lebarKusen;
        $tinggiDaun = $tinggiKusen;

        // Panjang kusen
        $pKusen =
            ($lebarKusen * (float) $product->jumlah_lebar_kusen) +
            ($tinggiKusen * (float) $product->jumlah_tinggi_kusen);

        // Panjang daun
        $pDaun =
            ($lebarDaun * (float) $product->jumlah_lebar_daun) +
            ($tinggiDaun * (float) $product->jumlah_tinggi_daun);

        // Luas kaca / panel
        $luas =
            $lebarKusen * $tinggiKusen;

        // Harga kusen
        $kusen =
            $pKusen * (float) $product->harga_kusen;

        // Harga daun
        $daun =
            $pDaun * (float) $product->harga_daun;

        // Harga kaca + panel
        $kacaPanel =
            (
                (float) $product->harga_kaca +
                (float) $product->harga_panel
            ) * $luas;

        // Harga hitam
        $hargaHitam =
            $kusen +
            $daun +
            $kacaPanel +
            (float) $product->harga_aksesoris;

        // Harga putih = 85% dari harga hitam
        $hargaPutih = $hargaHitam * 0.85;

        /*
        |--------------------------------------------------------------------------
        | Simpan ke product_project
        |--------------------------------------------------------------------------
        */

        $productProject = ProductProject::create([
            'product_id' => $product->id,
            'project_id' => $project->id,
            'tinggi_kusen' => $tinggiKusen,
            'lebar_kusen' => $lebarKusen,
            'harga_hitam' => round($hargaHitam),
            'harga_putih' => round($hargaPutih),
        ]);

        return redirect()
            ->route('project.show', $project->id)
            ->with('success', 'Project created successfully.');
    }

    /**
     * Menghapus product dari project.
     */
    public function destroy(ProductProject $productProject)
    {
        $projectId = $productProject->project_id;

        $productProject->delete();

        return redirect()
            ->route('project.show', $projectId)
            ->with('success', 'Product berhasil dihapus dari project.');
    }

    public function pdf(Project $project)
    {
        // ambil data product dalam project
        $project->load('products');

        $pdf = Pdf::loadView(
            'admin.project.pdf',
            compact('project')
        );

        return $pdf->stream(
            'project-' . $project->id . '.pdf'
        );
    }
}
