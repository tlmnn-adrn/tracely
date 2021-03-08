import('./qr-scanner.min.js').then((module) => {
    const QrScanner = module.default;
    QrScanner.WORKER_PATH = './static/js/qr/qr-scanner-worker.min.js';

    videoElem = document.getElementById('videoOutput');

    const qrScanner = new QrScanner(videoElem, result => 
        {qrScanner.stop();
        onScanned(videoElem, result);}
        );
    qrScanner.start();
});

function onScanned(videoElem, result){
    if(result.includes(window.location.hostname)){
        window.location = result;
    }
}