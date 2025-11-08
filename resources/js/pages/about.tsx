import React from "react";
import { Link } from "@inertiajs/react";

export default function About() {
    return (
        <div>
            <h1 className="text-2xl font-bold text-green-600">ℹ️ About Page</h1>
            <Link href="/" className="text-blue-500 underline mt-4 block">
                Back to Home
            </Link>
        </div>
    );
}
