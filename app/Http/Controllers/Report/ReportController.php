<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function index(): string {

        return view('workspace.report.run-report');
    }
}