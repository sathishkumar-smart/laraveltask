<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoanDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loan_details')->insert([
            [
                'clientid' => 1001,
                'num_of_payment' => 12,
                'first_payment_date' => Carbon::create('2018', '06', '29')->format('Y-m-d'),
                'last_payment_date' => Carbon::create('2019', '05', '29')->format('Y-m-d'),
                'loan_amount' => 1550.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'clientid' => 1003,
                'num_of_payment' => 7,
                'first_payment_date' => Carbon::create('2019', '02', '15')->format('Y-m-d'),
                'last_payment_date' => Carbon::create('2019', '08', '15')->format('Y-m-d'),
                'loan_amount' => 6851.94,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'clientid' => 1005,
                'num_of_payment' => 17,
                'first_payment_date' => Carbon::create('2017', '11', '09')->format('Y-m-d'),
                'last_payment_date' => Carbon::create('2019', '03', '09')->format('Y-m-d'),
                'loan_amount' => 1800.01,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
