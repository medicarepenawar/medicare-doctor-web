import DetailWalletTable from "@/components/detail-wallet";
import { Head } from "@inertiajs/react";

import { ArrowDown, ArrowUp, Wallet as WalletIcon } from "phosphor-react";
export type WalletStatus = "active" | "inactive" | "suspended";
export interface Wallet {
    id: number;
    user_id: number;
    bank_name: string;
    bank_account: string;
    balance: string; // bisa ubah ke number kalau selalu numeric
    currency: string;
    pin: string;
    status: WalletStatus; // tambahkan opsi lain kalau ada
    created_at: string; // bisa pakai Date kalau mau parse otomatis
    updated_at: string;
}
export default function WalletPage({
    wallet,
    income,
    outcome,
    balance,
}: {
    wallet: Wallet;
    income: string;
    outcome: string;
    balance: string;
}) {
    console.log("wallet : ", wallet);
    console.log("income : ", income);
    console.log("outcome : ", outcome);
    if (!wallet) {
        return (
            <div className="flex flex-col items-center justify-center w-full py-16">
                <div className="p-6 bg-blue-50 rounded-full mb-4">
                    <WalletIcon size={48} className="text-blue-600" />
                </div>

                <h2 className="text-xl font-semibold text-gray-70W0">
                    You don’t have a wallet yet
                </h2>

                <p className="text-gray-500 mt-2 text-center max-w-sm">
                    To start receiving income and manage your funds, please
                    create your wallet first.
                </p>
            </div>
        );
    }

    return (
        <>
            <Head title="Wallet Management" />
            <div className="w-full flex justify-around bg-white shadow rounded-2xl my-3 p-6">
                {/* Balance */}
                <div className="flex items-center gap-4">
                    <div className="p-3 bg-blue-100 rounded-full">
                        <WalletIcon size={28} className="text-blue-600" />
                    </div>
                    <div>
                        <p className="text-sm text-gray-500">Your Balance</p>
                        <p className="text-xl font-semibold">
                            RM {parseFloat(wallet.balance).toFixed(2)}
                        </p>
                    </div>
                </div>

                {/* Income */}
                <div className="flex items-center gap-4">
                    <div className="p-3 bg-green-100 rounded-full">
                        <ArrowDown size={28} className="text-green-600" />
                    </div>
                    <div>
                        <p className="text-sm text-gray-500">Income</p>
                        <p className="text-xl font-semibold">
                            RM {parseFloat(income).toFixed(2)}
                        </p>
                    </div>
                </div>

                {/* Expenses */}
                <div className="flex items-center gap-4">
                    <div className="p-3 bg-red-100 rounded-full">
                        <ArrowUp size={28} className="text-red-600" />
                    </div>
                    <div>
                        <p className="text-sm text-gray-500">Expenses</p>
                        <p className="text-xl font-semibold">
                            RM {parseFloat(outcome).toFixed(2)}
                        </p>
                    </div>
                </div>
            </div>

            <DetailWalletTable />
        </>
    );
}
