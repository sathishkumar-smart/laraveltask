<div class="box-body no-padding">
    <div class="text-center mb-4">
        <h1 class="font-weight-bold text-primary">Loan Details</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>S.no</th>
                    <th>Client Id</th>
                    <th>Num of Payments</th>
                    <th>Initial Payment On</th>
                    <th>Final Settlement On</th>
                    <th>Total Amount</th>
                    <th>Requested On</th>
                </tr>
            </thead>
            <tbody>
                @if(count($results) < 1)
                    <tr>
                        <td colspan="7" class="text-center">
                            <div id="no_data" class="lead no-data">
                                <img src="{{asset('assets/images/dark-data.svg')}}"
                                    style="width:150px; margin-top:25px; margin-bottom:25px;" alt="No Data">
                                <h4 class="text-muted mt-3">No Data Found</h4>
                            </div>
                        </td>
                    </tr>
                @else
                    @php    $i = 1; @endphp
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $result->clientid }}</td>
                            <td>{{ $result->num_of_payment }}</td>
                            <td>{{ \Carbon\Carbon::parse($result->first_payment_date)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($result->last_payment_date)->format('d-m-Y') }}</td>
                            <td>{{ number_format($result->loan_amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Add this CSS in your stylesheet -->
<style>
    .box-body {
        padding: 20px;
    }

    .text-center {
        text-align: center;
    }

    .font-weight-bold {
        font-weight: bold;
    }

    .text-primary {
        color: #007bff;
        /* Primary color */
    }

    .thead-dark {
        background-color: #343a40;
        /* Dark header background */
        color: #fff;
        /* White text */
    }

    .table {
        width: 100%;
        margin: 0 auto;
        border-collapse: separate;
        /* Add spacing between cells */
        border-spacing: 0;
        /* Remove default spacing */
    }

    .table th,
    .table td {
        padding: 12px;
        /* Add padding inside cells */
        border: 1px solid #dee2e6;
        /* Cell borders */
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
        /* Alternating row colors */
    }

    .table-bordered {
        border: 1px solid #dee2e6;
        /* Table border */
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
        /* Cell borders */
    }

    .text-muted {
        color: #6c757d;
        /* Muted text color */
    }

    .lead.no-data {
        font-size: 1.25rem;
        /* Larger font size for no data message */
    }

    .no-data img {
        display: block;
        margin: 0 auto;
    }

    /* Optional: Adjust width for better visual fit */
    .table-responsive {
        overflow-x: auto;
    }
</style>