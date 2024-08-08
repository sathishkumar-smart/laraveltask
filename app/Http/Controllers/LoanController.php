<?php

namespace App\Http\Controllers;

use App\Models\LoanDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LoanController extends Controller
{
    /**
     * Retrieve all loan details from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLoanDetails()
    {
        return LoanDetails::get();
    }

    public function dashboard()
    {
        return view('admin.welcome');
    }

    public function getEMiDetails()
    {
        // Get columns from a table
        $columns = Schema::getColumnListing('emi_details');
        $results = DB::table('emi_details')->get();
        return view('loan.emi_details', compact('results', 'columns'));
    }

    /**
     * Create a table to store EMI details with columns for each month in the given date range.
     *
     * @param string $startDate The start date in 'Y-m-d' format.
     * @param string $endDate The end date in 'Y-m-d' format.
     * @return bool
     */
    public function createTableEmiDetails($startDate, $endDate)
    {
        // Define the table name
        $tableName = 'emi_details';

        // Drop the table if it already exists
        if (Schema::hasTable($tableName)) {
            Schema::drop($tableName);
        }

        // Convert start and end dates to DateTime objects
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);

        // Initialize SQL query for creating the table
        $sql = "CREATE TABLE $tableName (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";

        // Loop through each month in the date range and add a column for each month
        while ($start <= $end) {
            $yearMonth = $start->format('Y_M');
            $sql .= "$yearMonth DOUBLE DEFAULT 0.0, ";
            $start->modify('+1 month');
        }

        // Add timestamps for created_at and updated_at columns
        $sql .= "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, ";
        $sql .= "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";

        // Execute the raw SQL to create the table
        return DB::statement($sql);
    }

    /**
     * Process loan records and insert calculated EMI details into the emi_details table.
     *
     * @param \Illuminate\Database\Eloquent\Collection $loans
     * @return void
     */
    public function processLoans($loans)
    {
        try {
            foreach ($loans as $loan) {
                // Calculate the EMI amount for the loan
                $emiAmount = $loan->loan_amount / $loan->num_of_payment;

                // Create Carbon instances for the start and end dates
                $startDate = Carbon::createFromFormat('Y-m-d', $loan->first_payment_date);
                $endDate = Carbon::createFromFormat('Y-m-d', $loan->last_payment_date);

                // Initialize an array to hold the data for insertion
                $insertdata = ['id' => $loan->clientid];
                $totalEmi = 0;

                // Set the start date to the beginning of the month
                $startDate = $startDate->startOfMonth();
                $endateN = clone $endDate;
                $endateN = $endateN->subMonth();

                // Loop through each month in the range and calculate EMI values
                while ($startDate->lessThan($endateN)) {
                    $yearMonth = $startDate->format('Y_M');
                    $val = round($emiAmount, 2);
                    $insertdata = array_merge($insertdata, [$yearMonth => $val]);
                    $totalEmi += $val;
                    $startDate->addMonth();
                }

                // Calculate the last payment amount and add it to the data
                $lastpayment = round($loan->loan_amount - $totalEmi, 2);
                $insertdata = array_merge($insertdata, [$endDate->format('Y_M') => $lastpayment, 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                // Insert the data into the emi_details table
                DB::table('emi_details')->insert($insertdata);
            }

        } catch (\Throwable $th) {
            // Handle any errors and log them
            dd($th);
        }
    }

    /**
     * Process loan data by creating a table and inserting EMI details.
     *
     * @return mixed
     */
    public function processData()
    {
        $loan_details = $this->getLoanDetails();

        // Get the earliest and latest payment dates from the loan details
        $earliestFirstPaymentDate = LoanDetails::min('first_payment_date');
        $latestLastPaymentDate = LoanDetails::max('last_payment_date');

        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Create the EMI details table
            $status = $this->createTableEmiDetails($earliestFirstPaymentDate, $latestLastPaymentDate);

            // If table creation is successful, process the loan details
            if ($status) {
                $this->processLoans($loan_details);
            }
            $columns = ['sample'];
            // Commit the transaction
            // DB::commit();
            return view('admin.welcome', compact('columns'));
        } catch (\Throwable $th) {
            // Rollback the transaction on error and log the exception
            DB::rollBack();
            \Log::error($th);
            dd($th);
            return redirect()->route('processdata')->with('error', 'Something went wrong! Please try again later.');
        }
    }

    /**
     * Fetch loan details and return the view with the data.
     *
     * @return \Illuminate\View\View
     */
    public function fetch()
    {
        $results = $this->getLoanDetails();
        return view('loan.index', compact('results'));
    }

    /**
     * Return the view for processing loan data.
     *
     * @return \Illuminate\View\View
     */
    public function viewprocessdata()
    {
        return view('loan.proccess_data');
    }
}
