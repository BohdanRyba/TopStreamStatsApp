<template>
    <h1 class="text-center">Streams with the same amount</h1>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h4 class="card-title text-white"></h4>
                    <h6 class="card-subtitle text-gray-800 mb-0">Streams with the same amount of viewers (Raw SQL
                        version)</h6>
                </div>
                <div class="card-content">
                    <ul class="list-group" style="height: 346px; overflow: auto" v-if="sql.same">
                        <li class="list-group-item text-white" v-for="same in sql.same">
                            <span class="badge text-black badge-primary mr-2"
                                  :style="{'background-color':'#'+this.getRandomColor()}">{{
                                    same.viewer_count
                                }}</span>
                            {{ same.game_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h6 class="card-subtitle text-gray-800 mb-0">Streams with the same amount of viewers (Laravel
                        version)</h6>
                </div>
                <div class="card-content">
                    <ul class="list-group" style="height: 346px; overflow: auto" v-if="laravel.same">
                        <li class="list-group-item text-white" v-for="same in laravel.same">
                            <span class="badge text-black badge-primary mr-2"
                                  :style="{'background-color':'#'+this.getRandomColor()}">{{
                                    same.viewer_count
                                }}</span>
                            {{ same.game_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'SameViewersStreamsComponent',
    methods: {
        getRandomColor() {
            return Math.floor(Math.random() * 16777215).toString(16);
        },
        async loadSqlViewers() {
            const same = await axios.get(this.$store.getters.getApiUrl + 'v1/same', {withCredentials: true})
            this.sql.same = same.data;
        },
        async loadLaravelViewers() {
            const same = await axios.get(this.$store.getters.getApiUrl + 'v2/same', {withCredentials: true})
            this.laravel.same = same.data;
        }
    },
    mounted() {
        this.loadSqlViewers()
        this.loadLaravelViewers()
    },
    data() {
        return {
            laravel: {
                same: []
            },
            sql: {
                same: []
            },
        }
    }
}

</script>
