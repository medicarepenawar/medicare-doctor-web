import { VcDoctorDetail } from "@/components/info-card";

export interface Doctor {
    id: number;
    name: string;
    nric: string;
    passport_number: string;
    gender: string;
    phone_number: string;
    specialist: string;
    experience: string;
    medical_degree_university: string;
    apc_number: string;
    apc_expired: string; // ISO string
    apc_certificate_file: string;
    mmc_number: string;
    mmc_certificate_file: string;
    photo: string;
    front_nric_photo: string;
    back_nric_photo: string;
    verified: boolean;
    created_at: string;
    updated_at: string;
    vc_doctor_details?: VcDoctorDetail[];
    tc_doctor_details?: any[];
}
