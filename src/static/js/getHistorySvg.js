//Benutzt Vue Js
const app = Vue.createApp({
    data(){ return {
        //Die Standard Url für das SVG ist 7 Tage, das ist die Url dafür
        src:'https://'+window.location.hostname+'/backend/institution/gethistorysvg/7',
        selected:7,
    }},
    methods:{
        changeImage(time){
            //Diese Funktion wird aufgerufen, wenn ein Button geklickt wird, mit dem der anzuzeigende Zeitraum festgelegt wird
            //Setzt die Url, die das SVG für diesen Zeitraum liefert und ändert den angezeigten Button
            this.selected = time
            this.src = 'https://'+window.location.hostname+'/backend/institution/gethistorysvg/'+time

        },
    },
})

app.mount('#app')
