//Importieren der Qr Code scan-Bibliothek https://github.com/nimiq/qr-scanner nach der Anleitung aus deren Webseite

import('./qr-scanner.min.js').then((module) => {
    const QrScanner = module.default;
    QrScanner.WORKER_PATH = './static/js/qr/qr-scanner-worker.min.js';

    //Das Videoelement, in dem das Kamerabild angezeigt werden soll
    videoElem = document.getElementById('videoOutput');

    //Funktio, die angibt, was passiert, wenn ein QR Code gescannt wird.
    const qrScanner = new QrScanner(videoElem, result => 
        {
            //Schließt den QR-Scanner
            qrScanner.stop();
            //Ruft die Funktion auf, die zur gescannten Seite weiterleitet
            onScanned(videoElem, result);}
        );
    qrScanner.start();
});

//Leitet zur gescannten URL weiter, wenn diese von der selben URL ist
function onScanned(videoElem, result){
    if(result.includes(window.location.hostname)){
        window.location = result;
    }
}