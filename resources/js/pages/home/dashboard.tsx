import DoctorProfileCard from "@/components/info-card";
import DoctorOrderCard from "@/components/order-card";
import { Doctor } from "@/types/doctor.models";
import { Head } from "@inertiajs/react";

export default function Dashboard({ doctors }: { doctors: Doctor }) {
    console.log("doctors : ", doctors);

    return (
        <>
            <Head title="Dashboard Doctor" />

            <div className="min-h-screen flex flex-col items-center justify-center bg-gray-50 space-y-6">
                <h1 className="text-2xl font-semibold text-gray-800">
                    {doctors ? (
                        <>
                            Welcome, {doctors.name} {doctors.id} 👨‍⚕️
                        </>
                    ) : (
                        <>Loading doctor...</>
                    )}
                </h1>

                {/* ✅ Hanya render jika doctors sudah tersedia */}
            </div>
        </>
    );
}
