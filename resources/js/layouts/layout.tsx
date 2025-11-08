import { Form, Link, usePage } from "@inertiajs/react";
import { ReactNode } from "react";
import {
    House,
    Wallet,
    VideoCamera,
    ChartBar,
    ClipboardText,
    Calendar,
    ClockCounterClockwise,
    SignOut,
} from "phosphor-react";
import DoctorProfileCard from "@/components/info-card";

interface LayoutProps {
    children: ReactNode;
}

export default function DefaultLayout({ children }: LayoutProps) {
    const { url } = usePage();

    return (
        <div className="flex h-screen bg-gray-50 text-gray-800">
            {/* Sidebar */}
            <aside className="w-64 bg-white border-r flex flex-col">
                {/* Logo */}
                <div className="px-6 py-4 border-b">
                    <h1 className="text-2xl font-bold">
                        <span className="text-blue-600">Medi</span>
                        <span className="text-red-500">Care</span>
                    </h1>
                </div>

                {/* Navigation */}
                <nav className="flex-1 px-4 py-6 text-sm space-y-4 overflow-y-auto">
                    <div>
                        <NavLink
                            href="/dashboard"
                            icon={<House size={20} />}
                            label="Dashboard"
                            active={url.startsWith("/dashboard")}
                        />
                        <NavLink
                            href="/wallet"
                            icon={<Wallet size={20} />}
                            label="Wallet"
                            active={url.startsWith("/wallet")}
                        />
                    </div>

                    <div className="mt-6">
                        <p className="uppercase text-xs text-gray-400 mb-2">
                            Teleconsultation
                        </p>
                        <NavLink
                            href="/teleconsultation/history"
                            icon={<ClockCounterClockwise size={20} />}
                            label="History"
                            active={url.includes("/teleconsultation/history")}
                        />
                        <NavLink
                            href="/teleconsultation/revenue"
                            icon={<ChartBar size={20} />}
                            label="Revenue"
                            active={url.includes("/teleconsultation/revenue")}
                        />
                    </div>

                    <div className="mt-6">
                        <p className="uppercase text-xs text-gray-400 mb-2">
                            Visit Clinic
                        </p>
                        <NavLink
                            href="/visit-clinic/invitation"
                            icon={<ClipboardText size={20} />}
                            label="Invitation Clinic"
                            active={url.includes("/visit-clinic/invitation")}
                        />
                        <NavLink
                            href="/visit-clinic/schedule"
                            icon={<Calendar size={20} />}
                            label="Schedule"
                            active={url.includes("/visit-clinic/schedule")}
                        />
                        <NavLink
                            href="/visit-clinic/history"
                            icon={<ClockCounterClockwise size={20} />}
                            label="History"
                            active={url.includes("/visit-clinic/history")}
                        />
                    </div>
                </nav>

                {/* Logout */}
                <div className="p-4 border-t">
                    <Form action="/logout" method="post">
                        <button
                            className="flex items-center gap-2 text-red-500 hover:text-red-600 font-medium"
                            type="submit"
                        >
                            <SignOut size={20} weight="bold" />
                            Log out
                        </button>
                    </Form>
                </div>
            </aside>

            {/* Main content */}
            <div className="flex-1 flex flex-col">
                {/* Navbar */}
                <header className="h-16 bg-white border-b flex items-center px-6 justify-between shadow-sm">
                    <h2 className="text-lg font-semibold text-gray-700">
                        Dashboard
                    </h2>
                </header>

                {/* Page Content */}
                <main className="flex-1 p-6 overflow-y-auto">
                    <DoctorProfileCard />
                    {children}
                </main>
            </div>
        </div>
    );
}

/* Sidebar Item Component */
function NavLink({
    href,
    icon,
    label,
    active,
}: {
    href: string;
    icon: ReactNode;
    label: string;
    active?: boolean;
}) {
    return (
        <Link
            href={href}
            className={`flex items-center gap-3 px-3 py-2 rounded-lg transition-colors ${
                active
                    ? "bg-blue-50 text-blue-600 font-medium"
                    : "text-gray-600 hover:bg-gray-100"
            }`}
        >
            {icon}
            <span>{label}</span>
        </Link>
    );
}
