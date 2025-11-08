<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WalletController extends Controller
{
    //

    public function index()
    {
        try {
            $doctor = Auth::user();

            // Jika user belum punya wallet
            if (!$doctor->wallet) {
                return Inertia::render("wallet/wallet", [
                    'wallet' => null,
                    'income' => 0,
                    'outcome' => 0,
                    'balance' => 0,
                    'error' => 'Wallet belum tersedia untuk akun ini.',
                ]);
            }

            $wallet = $doctor->wallet;

            // Total top-up sukses
            $income = WalletTransaction::where('wallet_id', $wallet->id)
                ->where('type', 'topup')
                ->where('status', 'success')
                ->sum('amount');

            // Total withdraw sukses
            $outcome = WalletTransaction::where('wallet_id', $wallet->id)
                ->where('type', 'withdraw')
                ->where('status', 'success')
                ->sum('amount');

            return Inertia::render("wallet/wallet", [
                'wallet' => $wallet,
                'income' => $income,
                'outcome' => $outcome,
                'balance' => $wallet->balance,
            ]);

        } catch (\Throwable $e) {

            // Jika ada error lain (misalnya query error, model error)
            return Inertia::render("wallet/wallet", [
                'wallet' => null,
                'income' => 0,
                'outcome' => 0,
                'balance' => 0,
                'error' => $e->getMessage(),
            ]);
        }
    }


    public function transaction()
    {
        $doctor = Auth::user();
        $wallet = $doctor->wallet;
        $wallet_trans = $wallet->wallet_transactions;

        return response()->json([
            'wallet' => $wallet,
            'wallet_transaction' => $wallet_trans
        ]);
    }
}
