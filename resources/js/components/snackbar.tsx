import React, { useEffect } from "react";

interface SnackbarProps {
    message: string;
    type?: "success" | "error" | "info";
    duration?: number;
    onClose?: () => void;
}

export const Snackbar: React.FC<SnackbarProps> = ({
    message,
    type = "info",
    duration = 3000,
    onClose,
}) => {
    useEffect(() => {
        const timer = setTimeout(() => {
            onClose?.();
        }, duration);
        return () => clearTimeout(timer);
    }, [duration, onClose]);

    const bgColor =
        type === "success"
            ? "bg-green-500"
            : type === "error"
            ? "bg-red-500"
            : "bg-gray-800";

    return (
        <div className="fixed bottom-5 left-1/2 -translate-x-1/2 z-50">
            <div
                className={`${bgColor} text-white px-5 py-2 rounded-lg shadow-md transition-opacity duration-300`}
            >
                {message}
            </div>
        </div>
    );
};
