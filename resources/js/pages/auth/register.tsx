import { useState } from "react";
import { router, useForm, usePage } from "@inertiajs/react";

/* ============================================================
   ✅ TypeScript Interfaces
   ============================================================ */

interface DoctorFormData {
    name: string;
    nric: string;
    gender: string;
    phone_number: string;
    passport_number: string;
    specialist: string;
    experience: string;
    medical_degree_university: string;
    mmc_number: string;
    apc_number: string;
    apc_expired: string;

    photo: File | null;
    front_nric_photo: File | null;
    back_nric_photo: File | null;
    apc_certificate_file: File | null;
    mmc_certificate_file: File | null;

    email: string;
    password: string;
    password_confirmation: string;
}

interface Step1Errors {
    [key: string]: string;
}

/* ============================================================
   ✅ Component
   ============================================================ */

export default function RegisterPage({ doctor }: { doctor: any }) {
    console.log("doctor : ", doctor);
    const [step, setStep] = useState<number>(1);
    const [showPassword, setShowPassword] = useState<boolean>(false);

    const [step1Errors, setStep1Errors] = useState<Step1Errors>({});

    const { data, setData, post, processing, errors } = useForm<DoctorFormData>(
        {
            name: doctor?.name || "",
            nric: doctor?.nric || "",
            gender: doctor?.gender || "male",
            phone_number: doctor?.phone_number || "",
            passport_number: doctor?.passport_number || "",
            specialist: doctor?.specialist || "",
            experience: doctor?.experience || "",
            medical_degree_university: doctor?.first_graduate_from || "",
            mmc_number: doctor?.mmc_full_reg_no || "",
            apc_number: doctor?.apc_number || "",
            apc_expired: doctor?.apc_expired || "",

            photo: null,
            front_nric_photo: doctor?.front_nric_image || null,
            back_nric_photo: doctor?.back_nric_image || null,
            apc_certificate_file: doctor?.apc_image || null,
            mmc_certificate_file: null, // kalau ada file asli bisa pakai doctor?.mmc_file

            email: "",
            password: "",
            password_confirmation: "",
        }
    );

    const onSubmit = (e: React.MouseEvent<HTMLButtonElement>) => {
        e.preventDefault();
        post("register/store");
    };

    /* ============================================================
       ✅ Step 1 Validation
       ============================================================ */

    const validateStep1 = (): boolean => {
        const newErrors: Step1Errors = {};

        if (!data.name) newErrors.name = "Full name is required.";
        if (!data.nric) newErrors.nric = "NRIC is required.";
        if (!data.phone_number)
            newErrors.phone_number = "Phone number is required.";
        if (!data.specialist)
            newErrors.specialist = "Specialization is required.";
        if (!data.experience) newErrors.experience = "Experience is required.";
        if (!data.medical_degree_university)
            newErrors.medical_degree_university =
                "Medical degree university is required.";
        if (!data.mmc_number) newErrors.mmc_number = "MMC number is required.";
        if (!data.apc_number) newErrors.apc_number = "APC number is required.";
        if (!data.apc_expired)
            newErrors.apc_expired = "APC expiration date is required.";

        setStep1Errors(newErrors);

        return Object.keys(newErrors).length === 0;
    };

    const handleNext = () => {
        if (validateStep1()) setStep(2);
    };

    // console.log("Inertia page props:", page.props);
    /* ============================================================
       ✅ Render
       ============================================================ */
    const { flash } = usePage().props as any;
    console.log(flash);
    return (
        <div className="max-w-6xl mx-auto p-8">
            <h1 className="text-3xl font-bold mb-8">Register Doctor</h1>
            {flash?.success && (
                <div className="text-green-600">{flash.success}</div>
            )}
            {flash?.error && <div className="text-red-600">{flash.error}</div>}
            {/* ✅ FLASH MESSAGE */}
            {/* {flash?.success && (
                <div
                    className="
                p-4 mb-6 rounded-md bg-green-100 border border-green-300 text-green-800
                animate-fade-slide
            "
                >
                    ✅ {flash.success}
                </div>
            )}

            {flash?.error && (
                <div
                    className="
                p-4 mb-6 rounded-md bg-red-100 border border-red-300 text-red-800
                animate-fade-slide
            "
                >
                    ❌ {flash.error}
                </div>
            )} */}

            {/* {flash.message && <div className="alert">{flash.message}</div>} */}

            {/* ✅ PROGRESS BAR */}
            <div className="mb-10 animate-fade-slide">
                <div className="flex justify-between text-sm font-medium mb-2">
                    <span
                        className={
                            step === 1 ? "text-blue-600" : "text-gray-500"
                        }
                    >
                        Step 1: Doctor Information
                    </span>
                    <span
                        className={
                            step === 2 ? "text-blue-600" : "text-gray-500"
                        }
                    >
                        Step 2: Account Information
                    </span>
                </div>

                <div className="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div
                        className="h-full bg-blue-600 transition-all duration-500"
                        style={{ width: step === 1 ? "50%" : "100%" }}
                    ></div>
                </div>
            </div>

            {/* ====================================================== */}
            {/* ✅ STEP 1 — NEW LAYOUT (2 columns + 1 bottom) */}
            {/* ====================================================== */}

            {step === 1 && (
                <div className="space-y-10 animate-fade-slide">
                    {/* ✅ TOP TWO COLUMNS */}
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {/* LEFT */}
                        <div className="p-6 bg-white shadow rounded-lg space-y-6">
                            <h2 className="text-xl font-semibold mb-4">
                                General Information
                            </h2>

                            <div className="space-y-5">
                                <div>
                                    <label className="font-medium block mb-1">
                                        Full Name{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <input
                                        className="input"
                                        placeholder="Enter full name"
                                        value={data.name}
                                        onChange={(e) =>
                                            setData("name", e.target.value)
                                        }
                                    />
                                    {step1Errors.name && (
                                        <p className="text-red-600">
                                            {step1Errors.name}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        NRIC{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <input
                                        className="input"
                                        placeholder="Enter NRIC number"
                                        value={data.nric}
                                        onChange={(e) =>
                                            setData("nric", e.target.value)
                                        }
                                    />
                                    {step1Errors.nric && (
                                        <p className="text-red-600">
                                            {step1Errors.nric}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        Gender
                                    </label>
                                    <select
                                        className="input"
                                        value={data.gender}
                                        onChange={(e) =>
                                            setData("gender", e.target.value)
                                        }
                                    >
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        Phone Number{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <input
                                        className="input"
                                        placeholder="Enter phone number"
                                        value={data.phone_number}
                                        onChange={(e) =>
                                            setData(
                                                "phone_number",
                                                e.target.value
                                            )
                                        }
                                    />
                                    {step1Errors.phone_number && (
                                        <p className="text-red-600">
                                            {step1Errors.phone_number}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        Passport Number (Optional)
                                    </label>
                                    <input
                                        className="input"
                                        placeholder="Enter passport number"
                                        value={data.passport_number}
                                        onChange={(e) =>
                                            setData(
                                                "passport_number",
                                                e.target.value
                                            )
                                        }
                                    />
                                </div>
                            </div>
                        </div>

                        {/* RIGHT */}
                        <div className="p-6 bg-white shadow rounded-lg space-y-6">
                            <h2 className="text-xl font-semibold mb-4">
                                Medical Information
                            </h2>

                            <div className="space-y-5">
                                <div>
                                    <label className="font-medium block mb-1">
                                        Specialization{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <input
                                        className="input"
                                        placeholder="Ex: Cardiologist, Dermatologist"
                                        value={data.specialist}
                                        onChange={(e) =>
                                            setData(
                                                "specialist",
                                                e.target.value
                                            )
                                        }
                                    />
                                    {step1Errors.specialist && (
                                        <p className="text-red-600">
                                            {step1Errors.specialist}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        Experience{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <textarea
                                        className="input h-24"
                                        placeholder="Describe experience"
                                        value={data.experience}
                                        onChange={(e) =>
                                            setData(
                                                "experience",
                                                e.target.value
                                            )
                                        }
                                    ></textarea>
                                    {step1Errors.experience && (
                                        <p className="text-red-600">
                                            {step1Errors.experience}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        Medical Degree University{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <input
                                        className="input"
                                        placeholder="Ex: University of Malaya"
                                        value={data.medical_degree_university}
                                        onChange={(e) =>
                                            setData(
                                                "medical_degree_university",
                                                e.target.value
                                            )
                                        }
                                    />
                                    {step1Errors.medical_degree_university && (
                                        <p className="text-red-600">
                                            {
                                                step1Errors.medical_degree_university
                                            }
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        MMC Number{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <input
                                        className="input"
                                        placeholder="Enter MMC number"
                                        value={data.mmc_number}
                                        onChange={(e) =>
                                            setData(
                                                "mmc_number",
                                                e.target.value
                                            )
                                        }
                                    />
                                    {step1Errors.mmc_number && (
                                        <p className="text-red-600">
                                            {step1Errors.mmc_number}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        APC Number{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <input
                                        className="input"
                                        placeholder="Enter APC number"
                                        value={data.apc_number}
                                        onChange={(e) =>
                                            setData(
                                                "apc_number",
                                                e.target.value
                                            )
                                        }
                                    />
                                    {step1Errors.apc_number && (
                                        <p className="text-red-600">
                                            {step1Errors.apc_number}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="font-medium block mb-1">
                                        APC Expired Date{" "}
                                        <span className="text-red-600">*</span>
                                    </label>
                                    <input
                                        type="date"
                                        className="input"
                                        value={data.apc_expired}
                                        onChange={(e) =>
                                            setData(
                                                "apc_expired",
                                                e.target.value
                                            )
                                        }
                                    />
                                    {step1Errors.apc_expired && (
                                        <p className="text-red-600">
                                            {step1Errors.apc_expired}
                                        </p>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* ✅ FILE UPLOAD SECTION (BOTTOM FULL WIDTH) */}
                    <div className="p-6 bg-white shadow rounded-lg animate-fade-slide">
                        <h2 className="text-xl font-semibold mb-4">
                            Document Uploads
                        </h2>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label className="font-medium block mb-1">
                                    Profile Photo
                                </label>
                                <input
                                    type="file"
                                    className="input-file"
                                    onChange={(e) =>
                                        setData(
                                            "photo",
                                            e.target.files?.[0] ?? null
                                        )
                                    }
                                />
                            </div>

                            <div>
                                <label className="font-medium block mb-1">
                                    Front NRIC
                                </label>
                                <input
                                    type="file"
                                    className="input-file"
                                    onChange={(e) =>
                                        setData(
                                            "front_nric_photo",
                                            e.target.files?.[0] ?? null
                                        )
                                    }
                                />
                            </div>

                            <div>
                                <label className="font-medium block mb-1">
                                    Back NRIC
                                </label>
                                <input
                                    type="file"
                                    className="input-file"
                                    onChange={(e) =>
                                        setData(
                                            "back_nric_photo",
                                            e.target.files?.[0] ?? null
                                        )
                                    }
                                />
                            </div>

                            <div>
                                <label className="font-medium block mb-1">
                                    APC Certificate
                                </label>
                                <input
                                    type="file"
                                    className="input-file"
                                    onChange={(e) =>
                                        setData(
                                            "apc_certificate_file",
                                            e.target.files?.[0] ?? null
                                        )
                                    }
                                />
                            </div>

                            <div>
                                <label className="font-medium block mb-1">
                                    MMC Certificate
                                </label>
                                <input
                                    type="file"
                                    className="input-file"
                                    onChange={(e) =>
                                        setData(
                                            "mmc_certificate_file",
                                            e.target.files?.[0] ?? null
                                        )
                                    }
                                />
                            </div>
                        </div>
                    </div>

                    {/* ✅ NEXT BUTTON */}
                    <div className="text-right">
                        <button
                            onClick={handleNext}
                            className="px-6 py-2 bg-blue-600 text-white rounded shadow"
                        >
                            Next
                        </button>
                    </div>
                </div>
            )}

            {/* ====================================================== */}
            {/* ✅ STEP 2 — Account */}
            {/* ====================================================== */}

            {step === 2 && (
                <div className="max-w-md mx-auto bg-white shadow p-6 rounded space-y-6 animate-fade-slide">
                    <h2 className="text-2xl font-semibold text-center">
                        Account Information
                    </h2>

                    <div>
                        <label className="font-medium block mb-1">
                            Email <span className="text-red-600">*</span>
                        </label>
                        <input
                            className="input"
                            placeholder="Enter email address"
                            value={data.email}
                            onChange={(e) => setData("email", e.target.value)}
                        />
                        {errors.email && (
                            <p className="text-red-600">{errors.email}</p>
                        )}
                    </div>

                    <div>
                        <label className="font-medium block mb-1">
                            Password <span className="text-red-600">*</span>
                        </label>
                        <div className="relative">
                            <input
                                type={showPassword ? "text" : "password"}
                                className="input pr-12"
                                placeholder="Enter password"
                                value={data.password}
                                onChange={(e) =>
                                    setData("password", e.target.value)
                                }
                            />

                            <button
                                type="button"
                                onClick={() => setShowPassword(!showPassword)}
                                className="absolute right-3 top-1/2 -translate-y-1/2 text-blue-600"
                            >
                                {showPassword ? "Hide" : "Show"}
                            </button>
                        </div>

                        {errors.password && (
                            <p className="text-red-600">{errors.password}</p>
                        )}
                    </div>

                    <div>
                        <label className="font-medium block mb-1">
                            Confirm Password{" "}
                            <span className="text-red-600">*</span>
                        </label>
                        <input
                            type="password"
                            className="input"
                            placeholder="Re-enter password"
                            value={data.password_confirmation}
                            onChange={(e) =>
                                setData("password_confirmation", e.target.value)
                            }
                        />
                        {errors.password_confirmation && (
                            <p className="text-red-600">
                                {errors.password_confirmation}
                            </p>
                        )}
                    </div>

                    {/* ACTION BUTTONS */}
                    <div className="flex justify-between pt-6">
                        <button
                            type="button"
                            onClick={() => setStep(1)}
                            className="px-6 py-2 bg-gray-300 rounded"
                        >
                            Back
                        </button>

                        <button
                            className="px-6 py-2 bg-blue-600 text-white rounded"
                            disabled={processing}
                            onClick={(e) => onSubmit(e)}
                        >
                            {processing ? "Submitting..." : "Submit"}
                        </button>
                    </div>
                </div>
            )}
        </div>
    );
}
