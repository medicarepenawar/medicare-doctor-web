import React, { useEffect, useState } from "react";
import axios from "axios";
import { Doctor } from "@/types/doctor.models";

export interface VcDoctorDetail {
    id: number;
    doctor_id: number;
    vendors_vc_id: number;
    on_duty: boolean;
    shift: string;
    created_at: string;
    updated_at: string;
    vendors_visit_clinic: VendorVisitClinic;
}

export interface VendorVisitClinic {
    id: number;
    vendor_id: number;
    vendor_type: string;
    registration_number: string;
    registration_document: string;
    images: string[];
    created_at: string;
    updated_at: string;
}

export default function DoctorProfileCard() {
    const [doctor, setDoctor] = useState<Doctor | null>(null);
    const [profileImage, setProfilImage] = useState<string | null>(null);
    const [vcStatus, setVcStatus] = useState<VcDoctorDetail[]>([]);
    const [tcStatus, setTcStatus] = useState<any[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios
            .get(`/doctor/profile`)
            .then((res) => {
                setProfilImage(res.data.profile_image);
                setDoctor(res.data.doctor);
                setVcStatus(res.data.doctor?.vc_doctor_details || []);
                setTcStatus(res.data.doctor?.tc_doctor_details || []);
            })
            .catch((err) => {
                console.error("Error fetching doctor:", err);
            })
            .finally(() => setLoading(false));
    }, []);

    if (loading) {
        return (
            <div className="bg-white rounded-xl shadow p-6">
                <p className="text-gray-500 animate-pulse">
                    Loading doctor data...
                </p>
            </div>
        );
    }

    if (!doctor) {
        return (
            <div className="bg-red-50 border border-red-300 rounded-xl shadow p-6">
                <p className="text-red-700">Failed to load doctor data.</p>
            </div>
        );
    }

    return (
        <div className="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            {/* Header */}
            <div className="bg-blue-50 px-4 py-2 border-b">
                <h2 className="font-semibold text-gray-700">Doctor Details</h2>
            </div>

            {/* Profile Section */}
            <div className="p-5 flex flex-col md:flex-row items-start md:items-center gap-6">
                <img
                    src={profileImage ?? ""}
                    alt={doctor.name}
                    className="w-24 h-24 rounded-md object-cover border"
                />

                <div className="flex-1 grid grid-cols-1 md:grid-cols-2 gap-x-8">
                    <div>
                        <h3 className="text-lg font-semibold text-gray-800">
                            {doctor.name?.toUpperCase()}
                        </h3>
                        <p className="text-sm text-gray-600">
                            Qualification :{" "}
                            {doctor.medical_degree_university || "—"}
                        </p>
                        <p className="text-sm text-gray-600">
                            Latest APC No : {doctor.apc_number || "—"}
                        </p>
                        <p className="text-sm text-gray-600">
                            NRIC : {doctor.nric || "—"}
                        </p>
                    </div>

                    <div className="space-y-1">
                        <p className="text-sm text-gray-600">
                            <strong>Phone :</strong>{" "}
                            {doctor.phone_number || "—"}
                        </p>
                    </div>
                </div>
            </div>

            {/* Status Sections */}
            <div className="border-t bg-gray-50 p-5">
                <h3 className="text-lg font-semibold mb-3 text-gray-800">
                    Services
                </h3>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {/* Visit Clinic */}
                    <div className="bg-white border rounded-lg p-4 shadow-sm">
                        <div className="flex items-center justify-between mb-2">
                            <h4 className="font-medium text-gray-700 flex items-center gap-2">
                                🏥 Visit Clinic
                            </h4>
                            <StatusBadge
                                active={vcStatus.some((v) => v.on_duty)}
                            />
                        </div>
                        <p className="text-sm text-gray-500">
                            {vcStatus.length > 0
                                ? `${vcStatus.length} shift${
                                      vcStatus.length > 1 ? "s" : ""
                                  }`
                                : "No active clinic assignment."}
                        </p>
                    </div>

                    {/* Teleconsultation */}
                    <div className="bg-white border rounded-lg p-4 shadow-sm">
                        <div className="flex items-center justify-between mb-2">
                            <h4 className="font-medium text-gray-700 flex items-center gap-2">
                                💻 Teleconsultation
                            </h4>
                            <StatusBadge
                                active={tcStatus.some((t) => t.on_duty)}
                            />
                        </div>
                        <p className="text-sm text-gray-500">
                            {tcStatus.length > 0
                                ? `${tcStatus.length} shift${
                                      tcStatus.length > 1 ? "s" : ""
                                  }`
                                : "No active teleconsultation assignment."}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}

/* Subcomponent: Status Badge */
function StatusBadge({ active }: { active: boolean }) {
    return (
        <span
            className={`px-3 py-1 text-xs font-medium rounded-full ${
                active
                    ? "bg-green-100 text-green-700"
                    : "bg-red-100 text-red-700"
            }`}
        >
            {active ? "Online" : "Offline"}
        </span>
    );
}
