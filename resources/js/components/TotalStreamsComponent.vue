<template>
    <h1 class="text-center">Streams per game</h1>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h4 class="card-title text-white"></h4>
                    <h6 class="card-subtitle text-gray-800 mb-0">Total amount of streams per game (Raw SQL version)</h6>
                </div>
                <div class="card-content">
                    <ul class="list-group" style="height: 346px; overflow: auto" v-if="streams">
                        <li class="list-group-item text-white" v-for="stream in streams">
                            <span class="badge text-black badge-primary mr-2" :style="{'background-color':'#'+this.getRandomColor()}">{{ stream.total_streams }}</span>
                            {{ stream.game_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h6 class="card-subtitle text-gray-800 mb-0">Total amount of streams per game (Laravel version)</h6>
                </div>
                <div class="card-content">
                    <ul class="list-group" style="height: 346px; overflow: auto" v-if="streams2">
                        <li class="list-group-item text-white" v-for="stream in streams2">
                            <span class="badge text-black badge-primary mr-2" :style="{'background-color':'#'+this.getRandomColor()}">{{ stream.total_streams }}</span>
                            {{ stream.game_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'TotalStreamsComponent',
    methods: {
        getRandomColor() {
            return Math.floor(Math.random() * 16777215).toString(16);
        },
        async loadSqlStreams(){
            const streams = await axios.get(this.$store.getters.getApiUrl + 'v1/streams', {withCredentials: true})
            this.streams = streams.data;
        },
        async loadLaravelStreams(){
            const streams = await axios.get(this.$store.getters.getApiUrl + 'v2/streams', {withCredentials: true})
            this.streams2 = streams.data;
        }
    },
    mounted() {
        this.loadSqlStreams()
        this.loadLaravelStreams()
    },
    data() {
        return {
            streams: [],
            streams2: [],
        }
    }
}

</script>
