<template>
    <div>
        <div class= "card mt-3" v-for="sample in samples" :key="sample.id">
            <h5>{{sample.id}}</h5>
            <p class="card-text">{{sample}}</p>
        </div>
    </div>
</template>

<script>
export default {
    created(){
        this.getMeassurement();
    },
    methods: {
        getMeassurement: function(){
            /*
            fetch('/api/measurement') //fetch('http://localhost:8000/api/measurement')
            .then(function(response){
                return response.json();
            })
            .then(function(json){
                console.log(json.data.data);
            })
            */
            fetch('/api/measurement') //fetch('http://localhost:8000/api/measurement')
            .then(response => response.json())
            .then(json => this.samples = json.data.data);
        }
    },
    data: function(){
        return {
            samples: []
        }
    }
}
</script>