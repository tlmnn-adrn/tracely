import('./qr-scanner.min.js').then((module) => {
    const QrScanner = module.default;
    QrScanner.WORKER_PATH = './static/js/qr/qr-scanner-worker.min.js';

    videoElem = document.getElementById('videoOutput');

    const qrScanner = new QrScanner(videoElem, result => console.log('decoded qr code:', result));
    qrScanner.start();
});