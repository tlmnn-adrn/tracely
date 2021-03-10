const app = Vue.createApp({
    data(){ return {
        src:'https://localhost/backend/institution/gethistorysvg/7',
        selected:7,
    }},
    methods:{
        changeImage(time){

            this.selected = time
            this.src = 'https://localhost/backend/institution/gethistorysvg/'+time

        },
    },
})

app.mount('#app')
