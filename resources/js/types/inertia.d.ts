import "@inertiajs/react";

declare module "@inertiajs/react" {
    interface PageProps {
        flash: {
            success?: string;
            error?: string;
        };
    }
}
