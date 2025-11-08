import React, { useEffect, useState } from "react";
import axios from "axios";
import { Doctor } from "@/types/doctor.models";

export default function DoctorOrderCard() {
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios
            .get(`/doctor/order/`)
            .then((res) => {
                console.log("res : ", res);
            })
            .catch((err) => {
                console.error("Error fetching doctor:", err);
            })
            .finally();
    }, []);

    if (loading) {
        return (
            <div className="bg-white rounded-xl shadow p-6 w-full max-w-md">
                <p className="text-gray-500 animate-pulse">
                    Loading doctor order data...
                </p>
            </div>
        );
    }
}
