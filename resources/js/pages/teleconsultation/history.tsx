import React, { useEffect, useState } from "react";
import axios from "axios";

export interface TcOrder {
    id: number;
    order_id: number;
    doctor_id: number;
    patient_id: number;
    status: string;
    issue: string | null;
    reject_reason: string | null;
    created_at: string;
    updated_at: string;
}

export default function TeleconsultationHistoryTable() {
    const [orders, setOrders] = useState<TcOrder[]>([]);
    const [loading, setLoading] = useState(true);
    const [page, setPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);

    useEffect(() => {
        setLoading(true);
        axios
            .get(`/teleconsultation/history/data?page=${page}`)
            .then((res) => {
                setOrders(res.data.data);
                setTotalPages(res.data.last_page);
            })
            .catch(() => setOrders([]))
            .finally(() => setLoading(false));
    }, [page]);

    if (loading) {
        return (
            <div className="flex justify-center items-center h-48">
                <span className="ml-2 text-gray-500">Loading data...</span>
            </div>
        );
    }

    return (
        <div className="bg-white rounded-xl shadow p-6">
            <h2 className="text-lg font-semibold mb-4">
                Teleconsultation History
            </h2>

            {orders.length > 0 ? (
                <>
                    <table className="min-w-full border border-gray-200 rounded-lg">
                        <thead className="bg-blue-50 text-gray-700 text-sm">
                            <tr>
                                <th className="px-4 py-2 border-b text-left">
                                    Order ID
                                </th>
                                <th className="px-4 py-2 border-b text-left">
                                    Issue
                                </th>
                                <th className="px-4 py-2 border-b text-left">
                                    Status
                                </th>
                                <th className="px-4 py-2 border-b text-left">
                                    Reject Reason
                                </th>
                                <th className="px-4 py-2 border-b text-left">
                                    Created At
                                </th>
                                <th className="px-4 py-2 border-b text-left">
                                    Updated At
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {orders.map((order) => (
                                <tr
                                    key={order.id}
                                    className="border-b hover:bg-gray-50 transition-colors"
                                >
                                    <td className="px-4 py-2 font-medium text-gray-800">
                                        #{order.order_id}
                                    </td>
                                    <td className="px-4 py-2">
                                        {order.issue ?? "-"}
                                    </td>
                                    <td className="px-4 py-2">
                                        <StatusBadge status={order.status} />
                                    </td>
                                    <td className="px-4 py-2 text-sm text-gray-500">
                                        {order.reject_reason ?? "-"}
                                    </td>
                                    <td className="px-4 py-2 text-gray-500">
                                        {new Date(
                                            order.created_at
                                        ).toLocaleString()}
                                    </td>
                                    <td className="px-4 py-2 text-gray-500">
                                        {new Date(
                                            order.updated_at
                                        ).toLocaleString()}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                    {/* Pagination */}
                    <div className="flex justify-between items-center mt-4">
                        <button
                            onClick={() => setPage((p) => Math.max(p - 1, 1))}
                            disabled={page === 1}
                            className="px-3 py-1 bg-gray-100 rounded disabled:opacity-50"
                        >
                            Prev
                        </button>
                        <span className="text-gray-600">
                            Page {page} of {totalPages}
                        </span>
                        <button
                            onClick={() =>
                                setPage((p) => Math.min(p + 1, totalPages))
                            }
                            disabled={page === totalPages}
                            className="px-3 py-1 bg-gray-100 rounded disabled:opacity-50"
                        >
                            Next
                        </button>
                    </div>
                </>
            ) : (
                <div className="text-center text-gray-500 py-10">
                    No teleconsultation history found.
                </div>
            )}
        </div>
    );
}

/* 🔹 Komponen kecil untuk status badge */
function StatusBadge({ status }: { status: string }) {
    let colorClass = "";
    let label = status;

    switch (status) {
        case "completed":
            colorClass = "bg-green-100 text-green-700";
            label = "Completed";
            break;
        case "cancelled":
            colorClass = "bg-gray-200 text-gray-700";
            label = "Cancelled";
            break;
        case "rejected":
            colorClass = "bg-red-100 text-red-700";
            label = "Rejected";
            break;
        default:
            colorClass = "bg-yellow-100 text-yellow-700";
            label = status;
    }

    return (
        <span
            className={`px-2 py-1 rounded-full text-xs font-medium ${colorClass}`}
        >
            {label}
        </span>
    );
}
