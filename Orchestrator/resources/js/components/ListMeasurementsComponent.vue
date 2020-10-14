<template>
    <div>
        <line-chart :chart-data="datacollection" :width="1100" :key="componentKey"></line-chart>
        <!--
        <div class= "card mt-3 mp-1" v-for="reply in replies" :key="reply.id">
            <div class="card-body">
                <h5>{{reply.id}}</h5>
                <p class="card-text">{{reply}}</p>
            </div>
        </div>
        -->
        <button v-on:click="getMeassurement" style="display:block;">Reload</button>
    </div>
</template>

<script>

import LineChart from '../lineChart.js'

/*
Por los ciclos de vida de Vue, hay que tener en cuenta el orden:
    - created
    - mounted
    - destroyed
*/
export default {
    components: {
        LineChart
    },
    data: function(){
        return {
            samples: {labels: [], datasets: []},
            datacollection: {labels: [], datasets: []},
            replies: [],
            componentKey: 0,
        } 
    },
    mounted () {
        //this.fillData();
    },
    created(){
        this.getMeassurement();
    },
    methods: {
        getMeassurement: function(){
            // fetch('/api/measurement') 
            // .then(function(response){
            //     return response.json();
            // })
            // .then(function(json){
            //     console.log(json.data.data);
            // })
            fetch('/api/measurement') //fetch('http://localhost:8000/api/measurement')
            .then(response => response.json())
            .then(json => this.replies = json.data.data)
            .then(value => {
                var temp = [];
                var hum = [];
                var pres = [];
                for (var i in value) {
                        this.samples.labels[i] = value[i].date;
                        temp[i] = value[i].temperature;
                        hum[i] = value[i].humidity;
                        pres[i] = value[i].pressure;
                }
                this.samples.datasets = [
                    {label: 'Temperatura [°C]', data: temp, backgroundColor: 'transparent', borderColor: 'red'},
                    {label: 'Presion[PSI]', data: pres, backgroundColor: 'transparent', borderColor: 'blue'},
                    {label: 'Humedad [%]', data: hum, backgroundColor: 'transparent', borderColor: 'purple'}
                    ];
                this.datacollection = this.samples
            })
            .then(reload => this.componentKey += 1)
        },
        // fillData: function(){
        //     this.datacollection = {
        //         labels: ['1', '2', '3', '4'],
        //         datasets: [
        //         {
        //             label: 'PRIMERO',
        //             data: [ 20, 40, 50, 20]
        //         },{
        //             label: 'SEGUNDO',
        //             data: [ 10, 20, 25, 10]
        //         },{
        //             label: 'TERCERO',
        //             data: [ 15, 30, 37.5, 15]
        //         }
        //         ]
        //     }
        //     console.log('DATOS PROCESADOS')
        //     console.log(this.samples)
        //     console.log('DATOS HARDCODEADOS')
        //     console.log(this.datacollection)
        // }
    }
}

</script>

<style lang="css">
.small {
  max-width: 800px;
  margin:  50px auto;
}
</style>