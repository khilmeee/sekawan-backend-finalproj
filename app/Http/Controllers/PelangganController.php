<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    protected $pelangganModel;

    public function __construct() {
        $this->pelangganModel = new Pelanggan();
    }
}
