import axios from "axios";
import { useState } from "react";

export default function RegisterOptionsPage() {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [nric, setNric] = useState("");
    const [doctor, setDoctor] = useState<any | null>(null);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState("");

    const handleSearch = async () => {
        if (!nric) return;

        setLoading(true);
        setError("");
        setDoctor(null);

        try {
            const response = await axios.get("/doctor/search-template", {
                params: { nric },
            });

            if (response.data.success) {
                setDoctor(response.data.doctor);
            } else {
                setError("Doctor not found");
            }
        } catch (err: any) {
            if (err.response?.status === 404) {
                setError("Doctor not found");
            } else {
                setError("Something went wrong");
            }
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-teal-50 p-8">
            <div className="w-full max-w-lg bg-white rounded-2xl shadow-xl p-8 border border-white/40 backdrop-blur-md">
                {/* Title */}
                <div className="text-center mb-8">
                    <h1 className="text-3xl font-bold text-gray-800">
                        Register Doctor
                    </h1>
                    <p className="text-gray-500 text-sm mt-1">
                        Choose how you want to register a new doctor
                    </p>
                </div>

                {/* OPTIONS */}
                <div className="grid grid-cols-1 gap-6">
                    {/* Option 1 */}
                    <a
                        href="/register"
                        className="w-full px-6 py-4 bg-blue-600 text-white rounded-xl shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2"
                    >
                        <span className="text-lg font-medium">
                            Register from Scratch
                        </span>
                    </a>

                    {/* Option 2 */}
                    <button
                        onClick={() => setIsModalOpen(true)}
                        className="w-full px-6 py-4 bg-green-600 text-white rounded-xl shadow-md hover:bg-green-700 transition flex items-center justify-center gap-2"
                    >
                        <span className="text-lg font-medium">
                            Register from Template
                        </span>
                    </button>
                </div>
            </div>

            {/* Modal */}
            {isModalOpen && (
                <div className="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 p-4">
                    <div className="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6 relative border border-gray-100">
                        {/* Modal Header */}
                        <h2 className="text-xl font-semibold text-gray-800 mb-4">
                            Search Doctor by NRIC
                        </h2>

                        {/* Input */}
                        <input
                            type="text"
                            placeholder="Enter NRIC"
                            value={nric}
                            onChange={(e) => setNric(e.target.value)}
                            className="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-300 transition mb-4"
                        />

                        {/* Buttons */}
                        <div className="flex justify-end gap-3 mb-3">
                            <button
                                onClick={() => setIsModalOpen(false)}
                                className="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition"
                            >
                                Cancel
                            </button>
                            <button
                                onClick={handleSearch}
                                className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                                disabled={loading}
                            >
                                {loading ? "Searching..." : "Search"}
                            </button>
                        </div>

                        {/* Error */}
                        {error && (
                            <p className="text-red-600 text-sm mb-3">{error}</p>
                        )}

                        {/* Result */}
                        {doctor && (
                            <div className="border-t pt-4 mt-3 text-gray-700">
                                <p>
                                    <strong>Name:</strong> {doctor.name}
                                </p>
                                <p>
                                    <strong>NRIC:</strong> {doctor.nric}
                                </p>
                                <p>
                                    <strong>Specialist:</strong>{" "}
                                    {doctor.specialist}
                                </p>
                                <p>
                                    <strong>Experience:</strong>{" "}
                                    {doctor.experience}
                                </p>

                                <div className="text-right mt-4">
                                    <button
                                        onClick={() => {
                                            setIsModalOpen(false);
                                            if (doctor?.id) {
                                                window.location.href = `/register/${doctor.id}`;
                                            }
                                        }}
                                        className="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow"
                                    >
                                        Select
                                    </button>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            )}
        </div>
    );
}
