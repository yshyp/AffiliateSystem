<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    /**
     * Created By Vaisakh Y P
     * Add a new user to the affiliate system.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addUser(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'parent_id' => 'nullable|exists:users,id' // Parent ID is optional but must exist in the users table if provided
        ]);

        // Create a new user with the validated data
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'parent_id' => $request->parent_id // Set the parent_id if provided
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('status', 'User added successfully!');
    }

    /**
     * Record a sale and distribute the affiliate commissions.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function recordSale(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'amount' => 'required|numeric' // Ensure the sale amount is a number
        ]);

        // Create a new sale record
        $sale = Sale::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount
        ]);

        // Distribute commissions based on the sale
        $this->distributeCommission($sale);

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Sale recorded and commissions distributed!');
    }

    /**
     * Distribute the commission up to 5 levels in the affiliate hierarchy.
     *
     * @param \App\Models\Sale $sale
     */
    protected function distributeCommission(Sale $sale)
    {
        // Get the user who made the sale
        $user = $sale->user;

        // Define the commission rates for each level
        $commissionRates = [0.10, 0.05, 0.03, 0.02, 0.01];

        // Loop through each commission level and distribute the commission
        foreach ($commissionRates as $level => $rate) {
            if ($user->parent_id && $level < count($commissionRates)) {
                // Find the parent user and calculate the commission
                $user = User::find($user->parent_id);
                $commission = $sale->amount * $rate;

                // Add the commission logic here (e.g., updating user's balance, creating commission records, etc.)
                // Example:
                // $user->commissions()->create(['amount' => $commission, 'sale_id' => $sale->id]);

            } else {
                break; // Exit the loop if no more parent or exceeded the commission levels
            }
        }
    }
}

