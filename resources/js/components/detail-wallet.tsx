import React, { useEffect, useState } from "react";
import axios from "axios";

import { Trash } from "phosphor-react";

interface WalletTransaction {
    id: number;
    wallet_id: number;
    code: string;
    amount: number;
    type: "topup" | "withdraw";
    status: string;
    description: string;
    success_at: string;
    created_at: string;
    updated_at: string;
}

export default function DetailWalletTable() {
    const [walletTransaction, setWalletTransaction] = useState<
        WalletTransaction[]
    >([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios
            .get(`/wallet/detail`)
            .then((res) => {
                setWalletTransaction(res.data.wallet_transaction);
            })
            .catch(() => setWalletTransaction([]))
            .finally(() => setLoading(false));
    }, []);

    if (loading) {
        return (
            <div className="bg-white rounded-xl shadow p-6 text-gray-500 animate-pulse">
                Loading wallet transactions...
            </div>
        );
    }

    return (
        <div className="bg-white rounded-xl shadow p-6 overflow-x-auto">
            <table className="min-w-full border border-gray-200 rounded-lg">
                <thead>
                    <tr className="bg-blue-50 text-gray-700 text-sm font-semibold text-left">
                        <th className="py-3 px-4 border-b">No</th>
                        <th className="py-3 px-4 border-b">Date & Time</th>
                        <th className="py-3 px-4 border-b">Income</th>
                        <th className="py-3 px-4 border-b">Expenses</th>
                        <th className="py-3 px-4 border-b">Balance</th>
                        <th className="py-3 px-4 border-b text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {walletTransaction.length > 0 ? (
                        walletTransaction.map((tx, index) => {
                            const isIncome = tx.type === "topup";
                            const formattedDate = new Date(
                                tx.success_at
                            ).toLocaleString("en-GB", {
                                day: "2-digit",
                                month: "2-digit",
                                year: "numeric",
                                hour: "2-digit",
                                minute: "2-digit",
                            });

                            return (
                                <tr
                                    key={tx.id}
                                    className="hover:bg-gray-50 transition-colors border-b text-sm"
                                >
                                    <td className="py-3 px-4">{index + 1}</td>
                                    <td className="py-3 px-4">
                                        {formattedDate}
                                    </td>
                                    <td className="py-3 px-4 font-medium text-green-600">
                                        {isIncome
                                            ? `+RM ${tx.amount.toFixed(2)}`
                                            : "-"}
                                    </td>
                                    <td className="py-3 px-4 font-medium text-red-500">
                                        {!isIncome
                                            ? `-RM ${tx.amount.toFixed(2)}`
                                            : "-"}
                                    </td>
                                    <td className="py-3 px-4 text-gray-700">
                                        RM {(1000 + tx.amount).toFixed(2)}
                                    </td>
                                    <td className="py-3 px-4 text-center ">
                                        <button
                                            className="p-2 text-red-500 hover:bg-red-50 rounded-lg transition cursor-pointer"
                                            title="Delete transaction"
                                        >
                                            <Trash size={18} />
                                        </button>
                                    </td>
                                </tr>
                            );
                        })
                    ) : (
                        <tr>
                            <td
                                colSpan={6}
                                className="py-6 text-center text-gray-500 italic"
                            >
                                No transactions found.
                            </td>
                        </tr>
                    )}
                </tbody>
            </table>
        </div>
    );
}
