<?php

namespace Modules\Report\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Report\Services\Finance\ReportDataService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Client\Entities\Client;
use Modules\Report\Services\Finance\ProfitAndLossReportService;

class FinanceReportController extends Controller
{
    use AuthorizesRequests;

    protected $service;

    public function __construct(ProfitAndLossReportService $service)
    {
        $this->service = $service;
    }

    public function dashboard()
    {
        return view('report::finance.dashboard');
    }

    public function clientWiseInvoiceDashboard(Request $request)
    {
        $selectedClient = $request->has('client_id') ? Client::find($request->get('client_id')) : Client::orderBy('name')->first();

        return view('report::finance.client-wise-revenue.index', [
            'selectedClient' => $selectedClient,
            'clients' => Client::orderBy('name')->get()
        ]);
    }

    public function getReportData(Request $request)
    {
        $type = $request->type;
        $filters = $request->filters;

        return app(ReportDataService::class)->getData($type, json_decode($filters, true));
    }
}
