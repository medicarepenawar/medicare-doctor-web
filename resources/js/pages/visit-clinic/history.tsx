import axios from "axios";
import { useEffect, useState } from "react";
import {
    Clock,
    ClipboardText,
    CaretLeft,
    CaretRight,
    WarningCircle,
} from "phosphor-react";

export interface VcOrder {
    id: number;
    order_id: number;
    doctor_id: number;
    patient_id: number;
    status: string;
    issue: string | null;
    created_at: string;
    updated_at: string;
}

export default function HistoryPage() {
    const [orders, setOrders] = useState<VcOrder[]>([]);
    const [loading, setLoading] = useState(true);
    const [page, setPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);

    useEffect(() => {
        setLoading(true);
        axios
            .get(`/visit-clinic/history/data?page=${page}`)
            .then((res) => {
                setOrders(res.data.data);
                setTotalPages(res.data.last_page);
            })
            .catch(() => setOrders([]))
            .finally(() => setLoading(false));
    }, [page]);

    const handlePrev = () => {
        if (page > 1) setPage(page - 1);
    };

    const handleNext = () => {
        if (page < totalPages) setPage(page + 1);
    };

    const getStatusColor = (status: string) => {
        switch (status.toLowerCase()) {
            case "completed":
                return "bg-green-50 text-green-600 border-green-200";
            case "pending":
                return "bg-yellow-50 text-yellow-600 border-yellow-200";
            case "cancelled":
                return "bg-red-50 text-red-600 border-red-200";
            default:
                return "bg-gray-50 text-gray-600 border-gray-200";
        }
    };

    return (
        <div className="bg-white rounded-xl shadow my-3 p-6">
            <h2 className="text-xl font-semibold mb-4">History</h2>

            {loading ? (
                <div className="text-center py-10 text-gray-500">
                    Loading...
                </div>
            ) : orders.length === 0 ? (
                <div className="text-center py-10 text-gray-500 flex flex-col items-center">
                    <WarningCircle
                        size={40}
                        weight="duotone"
                        className="mb-2 text-gray-400"
                    />
                    No history available
                </div>
            ) : (
                <div className="space-y-4">
                    {orders.map((order) => (
                        <div
                            key={order.id}
                            className="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow"
                        >
                            <div className="flex justify-between items-center mb-2">
                                <div className="flex items-center gap-2 text-gray-700 font-medium">
                                    <ClipboardText size={18} />
                                    Order #{order.order_id}
                                </div>
                                <span
                                    className={`text-sm px-3 py-1 rounded-full border ${getStatusColor(
                                        order.status
                                    )}`}
                                >
                                    {order.status}
                                </span>
                            </div>

                            <div className="text-gray-600 text-sm space-y-1">
                                <div className="flex items-center gap-2">
                                    <Clock
                                        size={16}
                                        className="text-gray-500"
                                    />
                                    <span>
                                        {new Date(
                                            order.created_at
                                        ).toLocaleString()}
                                    </span>
                                </div>
                                {order.issue && (
                                    <div className="flex items-start gap-2">
                                        <WarningCircle
                                            size={16}
                                            className="text-red-500 mt-0.5"
                                        />
                                        <span className="text-red-600">
                                            {order.issue}
                                        </span>
                                    </div>
                                )}
                            </div>
                        </div>
                    ))}

                    {/* Pagination */}
                    <div className="flex justify-center items-center gap-4 pt-4 border-t border-gray-100">
                        <button
                            onClick={handlePrev}
                            disabled={page === 1}
                            className={`flex items-center gap-1 px-3 py-1.5 rounded-md border ${
                                page === 1
                                    ? "text-gray-400 border-gray-200 cursor-not-allowed"
                                    : "text-gray-700 border-gray-300 hover:bg-gray-50"
                            }`}
                        >
                            <CaretLeft size={16} /> Prev
                        </button>
                        <span className="text-gray-600 text-sm">
                            Page {page} of {totalPages}
                        </span>
                        <button
                            onClick={handleNext}
                            disabled={page === totalPages}
                            className={`flex items-center gap-1 px-3 py-1.5 rounded-md border ${
                                page === totalPages
                                    ? "text-gray-400 border-gray-200 cursor-not-allowed"
                                    : "text-gray-700 border-gray-300 hover:bg-gray-50"
                            }`}
                        >
                            Next <CaretRight size={16} />
                        </button>
                    </div>
                </div>
            )}
        </div>
    );
}
