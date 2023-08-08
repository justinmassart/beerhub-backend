import fs from 'fs';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import { homedir } from 'os';
import { resolve } from 'path';

let host = 'beerhub-backend.test';

export default defineConfig({
    plugins: [laravel(['resources/js/app.js', 'resources/css/app.css'])],
    server: detectServerConfig(host),
});

function detectServerConfig(host) {
    let keyPath = resolve(homedir(), `.config/valet/Certificates/${host}.key`);
    let certificatePath = resolve(
        homedir(),
        `.config/valet/Certificates/${host}.crt`,
    );

    if (!fs.existsSync(keyPath)) {
        return {};
    }

    if (!fs.existsSync(certificatePath)) {
        return {};
    }

    return {
        hmr: { host },
        host,
        https: {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certificatePath),
        },
    };
}
