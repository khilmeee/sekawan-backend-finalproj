<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    protected $penyewaanModel;

    public function __construct() {
        $this->penyewaanModel = new Penyewaan();
    }
}
