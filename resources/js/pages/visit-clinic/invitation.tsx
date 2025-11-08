import { VcDoctorDetail } from "./schedule";
import { MapPin, Clock, Circle } from "phosphor-react";

export default function InvitationPage({
    invitation,
}: {
    invitation: VcDoctorDetail[];
}) {
    if (!invitation?.length) {
        return (
            <div className="text-center text-gray-500 my-3 py-10">
                No schedules available.
            </div>
        );
    }

    return (
        <div className="bg-white rounded-xl shadow my-3 p-6">
            <h2 className="text-xl font-semibold mb-4">Schedule</h2>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                {invitation.map((shift) => {
                    const clinic = shift.vendors_visit_clinic;
                    const isOnline =
                        shift.on_duty === true || shift.on_duty === 1;

                    return (
                        <div
                            key={shift.id}
                            className="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow"
                        >
                            {/* Header: Clinic Name + Status */}
                            <div className="flex justify-between items-start mb-3">
                                <h3 className="text-lg font-semibold text-gray-800">
                                    {clinic
                                        ? clinic.registration_number.replace(
                                              "RS-",
                                              ""
                                          )
                                        : "Unknown Clinic"}
                                </h3>

                                <span
                                    className={`flex items-center gap-1 text-sm px-3 py-1 rounded-full border ${
                                        isOnline
                                            ? "text-green-600 bg-green-50 border-green-200"
                                            : "text-red-600 bg-red-50 border-red-200"
                                    }`}
                                >
                                    <Circle
                                        size={10}
                                        weight="fill"
                                        className={
                                            isOnline
                                                ? "text-green-500"
                                                : "text-red-500"
                                        }
                                    />
                                    {isOnline ? "Online" : "Offline"}
                                </span>
                            </div>

                            {/* Info: Address + Shift */}
                            <div className="text-gray-600 text-sm space-y-2">
                                <div className="flex items-center gap-2">
                                    <MapPin
                                        size={16}
                                        className="text-gray-500"
                                    />
                                    <span>
                                        {clinic
                                            ? "Jalan Gajayana, Dinoyo, Lowokwaru, Malang, East Java"
                                            : "Address not available"}
                                    </span>
                                </div>

                                <div className="flex items-center gap-2">
                                    <Clock
                                        size={16}
                                        className="text-gray-500"
                                    />
                                    <span>
                                        {shift.shift === "1"
                                            ? "Morning (08:00 - 12:00)"
                                            : "Evening (17:00 - 21:00)"}
                                    </span>
                                </div>
                            </div>
                        </div>
                    );
                })}
            </div>
        </div>
    );
}
