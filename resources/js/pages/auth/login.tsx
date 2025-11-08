import React, { useEffect, useState } from "react";
import { Head, Form, usePage } from "@inertiajs/react";
import { Eye, EyeSlash } from "phosphor-react";

// 🔹 Snackbar component
interface SnackbarProps {
    message: string;
    type?: "success" | "error" | "info";
    onClose?: () => void;
}

const Snackbar: React.FC<SnackbarProps> = ({
    message,
    type = "info",
    onClose,
}) => {
    if (!message) return null;

    const bg =
        type === "success"
            ? "bg-green-600"
            : type === "error"
            ? "bg-red-600"
            : "bg-gray-700";

    return (
        <div className="fixed bottom-5 right-5 z-50">
            <div
                className={`${bg} text-white px-4 py-2 rounded-lg shadow-lg cursor-pointer`}
                onClick={onClose}
            >
                {message}
            </div>
        </div>
    );
};

// 🔹 Login Page
export default function Login() {
    const [showPw, setShowPw] = useState(false);
    const [data, setData] = useState({ email: "", password: "" });
    const [snackbar, setSnackbar] = useState<{
        message: string;
        type: "success" | "error" | "info" | null;
    }>({
        message: "",
        type: null,
    });

    // Ambil error dari server-side (Laravel)
    const { errors } = usePage<{ errors: Record<string, string> }>().props;

    // ✅ Jalankan snackbar kalau error berubah dan ada error email
    useEffect(() => {
        console.log("error : ", errors);
        if (errors && errors.email) {
            setSnackbar({
                message: errors.email,
                type: "error",
            });
        }
    }, [errors]);

    // Handle perubahan input
    const handleChange = (key: string, value: string) => {
        setData((prev) => ({ ...prev, [key]: value }));
    };

    return (
        <>
            <Head title="Doctor Login" />

            {/* Snackbar notification */}
            <Snackbar
                message={snackbar.message}
                type={snackbar.type || "info"}
                onClose={() => setSnackbar({ message: "", type: null })}
            />

            <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-teal-50 to-white p-6">
                <main className="w-full max-w-sm bg-white/80 backdrop-blur-lg shadow-xl rounded-2xl p-8 border border-white/40">
                    {/* Header */}
                    <div className="text-center mb-8">
                        <h1 className="text-2xl font-bold text-gray-800 mt-4 tracking-tight">
                            Doctor Login
                        </h1>
                        <p className="text-sm text-gray-500 mt-1">
                            Manage Your Doctor Acoount
                        </p>
                    </div>

                    {/* Form */}
                    <Form action="/login" method="post">
                        {({ errors, processing }) => (
                            <>
                                {/* Email */}
                                <div className="mb-4">
                                    <label className="text-sm font-medium text-gray-700 mb-1 block">
                                        Email
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        placeholder="doctor@clinic.com"
                                        className="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                        value={data.email}
                                        onChange={(e) =>
                                            handleChange(
                                                "email",
                                                e.target.value
                                            )
                                        }
                                        required
                                    />
                                    {errors.email && (
                                        <p className="text-red-500 text-sm mt-1">
                                            {errors.email}
                                        </p>
                                    )}
                                </div>

                                {/* Password */}
                                <div className="mb-2 relative">
                                    <label className="text-sm font-medium text-gray-700 mb-1 block">
                                        Password
                                    </label>
                                    <input
                                        type={showPw ? "text" : "password"}
                                        name="password"
                                        placeholder="Enter your password"
                                        className="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-300 pr-11 transition"
                                        value={data.password}
                                        onChange={(e) =>
                                            handleChange(
                                                "password",
                                                e.target.value
                                            )
                                        }
                                        required
                                    />
                                    <button
                                        type="button"
                                        onClick={() => setShowPw((p) => !p)}
                                        className="absolute right-3 top-[38px] text-gray-500 hover:text-gray-700 transition"
                                    >
                                        {showPw ? (
                                            <EyeSlash size={22} />
                                        ) : (
                                            <Eye size={22} />
                                        )}
                                    </button>

                                    {errors.password && (
                                        <p className="text-red-500 text-sm mt-1">
                                            {errors.password}
                                        </p>
                                    )}
                                </div>

                                {/* Forgot */}
                                <div className="text-right mb-4">
                                    <a
                                        href="/forgot-password"
                                        className="text-blue-600 text-sm hover:underline"
                                    >
                                        Forgot password?
                                    </a>
                                </div>

                                {/* Submit */}
                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2.5 transition disabled:opacity-50 shadow-md"
                                >
                                    {processing ? "Signing in..." : "Sign In"}
                                </button>
                            </>
                        )}
                    </Form>

                    {/* Footer */}
                    <div className="text-center mt-6">
                        <p className="text-sm text-gray-500">
                            Don’t have an account?{" "}
                            <a
                                href="/register/options"
                                className="text-blue-600 font-medium hover:underline"
                            >
                                Register
                            </a>
                        </p>
                    </div>
                </main>
            </div>
        </>
    );
}
