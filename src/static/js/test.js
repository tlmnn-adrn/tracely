const app = Vue.createApp({
    data(){ return {
        src:'https://localhost/test2/7',
        selected: 7
    }},
    methods:{
        changeImage(time){

            this.selected = time
            this.src = 'https://localhost/test2/' + time
            

        },
    },
})

app.mount('#app')
