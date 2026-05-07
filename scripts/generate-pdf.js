import puppeteer from 'puppeteer';
import { argv } from 'node:process';
import { pathToFileURL } from 'node:url';

async function run() {
    const input = argv[2];
    const output = argv[3];

    const browser = await puppeteer.launch({
        headless: "new",
        args: ['--no-sandbox', '--disable-gpu']
    });

    try {
        const page = await browser.newPage();

        // Simulation d'une résolution écran standard pour le rendu CSS
        await page.setViewport({ width: 800, height: 1131 });

        // Activation du mode Print pour les @media queries
        await page.emulateMediaType('print');

        const url = pathToFileURL(input).href;
        await page.goto(url, { waitUntil: 'networkidle0', timeout: 60000 });

        await page.pdf({
            path: output,
            format: 'A4',
            landscape: false, // Mode Portrait
            printBackground: true, // Crucial pour les fonds de couleurs légers
            preferCSSPageSize: true,
            margin: { top: '0', right: '0', bottom: '0', left: '0' } // Marges gérées par le CSS
        });

        console.log("SUCCESS");
    } catch (e) {
        console.error(e.message);
        process.exit(1);
    } finally {
        await browser.close();
    }
}
run();
