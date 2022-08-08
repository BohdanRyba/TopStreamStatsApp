<template>
    <h1 class="text-center">Viewers per game</h1>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h4 class="card-title text-white"></h4>
                    <h6 class="card-subtitle text-gray-800 mb-0">Highest viewer count stream per game (Raw SQL version)</h6>
                </div>
                <div class="card-content">
                    <ul class="list-group" style="height: 346px; overflow: auto" v-if="viewers">
                        <li class="list-group-item text-white" v-for="viewer in viewers">
                            <span class="badge text-black badge-primary mr-2" :style="{'background-color':'#'+this.getRandomColor()}">{{ viewer.total_viewers }}</span>
                            {{ viewer.game_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h6 class="card-subtitle text-gray-800 mb-0">Highest viewer count stream per game (Laravel version)</h6>
                </div>
                <div class="card-content">
                    <ul class="list-group" style="height: 346px; overflow: auto" v-if="viewers2">
                        <li class="list-group-item text-white" v-for="viewer in viewers2">
                            <span class="badge text-black badge-primary mr-2" :style="{'background-color':'#'+this.getRandomColor()}">{{ viewer.total_viewers }}</span>
                            {{ viewer.game_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'TotalViewersComponent',
    methods: {
        getRandomColor() {
            return Math.floor(Math.random() * 16777215).toString(16);
        },
        async loadSqlViewers(){
            const viewers = await axios.get(this.$store.getters.getApiUrl + 'v1/viewers', {withCredentials: true})
            console.log(viewers.data)
            this.viewers = viewers.data;
        },
        async loadLaravelViewers(){
            const viewers = await axios.get(this.$store.getters.getApiUrl + 'v2/viewers', {withCredentials: true})
            this.viewers2 = viewers.data;
        }
    },
    mounted() {
        this.loadSqlViewers()
        this.loadLaravelViewers()
    },
    data() {
        return {
            viewers: [],
            viewers2: [],
        }
    }
}

</script>
