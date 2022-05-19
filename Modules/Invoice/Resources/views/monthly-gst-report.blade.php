@extends('invoice::layouts.master')
@section('content')

<div class="mx-15" id="vueContainer">
    <br>
    <br>

    <div class="d-flex justify-content-between mb-2">
        <h4 class="mb-1 pb-1">Monthly Gst Report</h4>
        <span>
            <a href="{{ route('invoice.monthly-tax-report-export', request()->all()) }}" class="btn btn-info text-white">Export To Excel</a>
        </span>
    </div>
    <br>
    <br>

    <div>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th></th>
                    <th>Date</th>
                    <th>Particular</th>
                    <th>Type</th>
                    <th>INVOICE NO.</th>
                    <th>GST</th>
                    <th>INVOICE VALUE</th>
                    <th>RATE</th>
                    <th>RECEIVABLE AMOUNT</th>
                    <th>TAXABLE AMOUNT</th>
                    <th>IGST</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th>HSN Code</th>
                </tr>
            </thead>

            <tbody>
                @foreach($invoices as $key => $invoice)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
						<td>{{ $invoice->sent_on->format(config('invoice.default-date-format')) }}</td>
						<td>{{ $invoice->client->name }}</td>
						<td>{{ ($invoice->client->country->id == 1 ) ? 'India' : 'Export for international invoice'}}</td>
						<td>{{ $invoice->invoice_number }}</td>
						<td>{{ ($invoice->client->country->id == 1 ) ? !empty($invoice->gst) ? $invoice->gst : 'B2C' : 'Export for international invoice' }}</td>
						<td>{{ $invoice->invoiceAmount() }}</td>
						<td>{{ $currentRates }}</td>
						<td>{{ ($invoice->client->country->id == 2 ) ? $totalReceivableAmount : $invoice->invoiceAmount() }}</td>
						<td>{{ "₹" . $invoice->amount }}</td>
						<td>{{ !($clientAddress[$key]->state == 'Haryana') ? $igst[$key] : '' }}</td>
						<td>{{ ($clientAddress[$key]->state == 'Haryana') ? $cgst[$key] : '' }}</td>
						<td>{{ ($clientAddress[$key]->state == 'Haryana') ? $sgst[$key] : '' }}</td>
						<td>{{-- HSN CODE --}}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection