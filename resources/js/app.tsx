import React from "react";
import { createRoot } from "react-dom/client";
import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import "../css/app.css";

import Layout from "./layouts/layout";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: async (name) => {
        const pages = import.meta.glob("./pages/**/*.tsx");
        const page: any = await resolvePageComponent(
            `./pages/${name}.tsx`,
            pages
        );

        // Tentukan halaman tanpa layout
        const noLayoutPages = [
            "auth/login",
            "auth/register",
            "auth/registerOptions",
        ]; // sesuaikan path folder-nya
        if (!noLayoutPages.includes(name)) {
            page.default.layout =
                page.default.layout || ((page: any) => <Layout>{page}</Layout>);
        } else {
            // Kalau mau layout berbeda untuk halaman login/register
        }

        return page;
    },
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(<App {...props} />);
    },
});
