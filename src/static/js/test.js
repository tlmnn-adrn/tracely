const app = Vue.createApp({
    data(){ return {
        src:'https://localhost/test2',
    }},
    methods:{
        changeImage(time){

            console.log('https://localhost/test2/'+time);
            this.src = 'https://localhost/test2/'+time

        },
    },
})

app.mount('#app')
