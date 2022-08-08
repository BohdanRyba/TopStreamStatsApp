<template>
    <h1 class="text-center">Streams with an even and odd number of viewers</h1>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card container" style="">
                <div class="card-header mb-3">
                    <h6 class="card-subtitle text-gray-800 mb-0">Streams with an odd number of viewers (Raw SQL
                        version)</h6>
                </div>
                <div class="card-content">
                    <div class="row">
                        <ul class="list-group col-lg-6 col-md-6 col-12" style="height: 346px; overflow: auto"
                            v-if="sql.even">

                            <li class="list-group-item text-white">
                                <h2>EVEN</h2>
                            </li>
                            <li class="list-group-item text-white" v-for="even in sql.even">
                                <span class="badge text-black badge-primary mr-2"
                                      :style="{'background-color':'#'+this.getRandomColor()}">
                                    {{ even.viewer_count }}
                                </span>
                                {{ even.game_name }}
                            </li>
                        </ul>
                        <ul class="list-group col-lg-6 col-md-6 col-12" style="height: 346px; overflow: auto"
                            v-if="sql.odds">

                            <li class="list-group-item text-white">
                                <h2>ODD</h2>
                            </li>
                            <li class="list-group-item text-white" v-for="odd in sql.odds">
                                <span class="badge text-black badge-primary mr-2"
                                      :style="{'background-color':'#'+this.getRandomColor()}">
                                    {{ odd.viewer_count }}
                                </span>
                                {{ odd.game_name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card container" style="">
                <div class="card-header mb-3">
                    <h6 class="card-subtitle text-gray-800 mb-0">Streams with an even number of viewers (Laravel
                        version)</h6>
                </div>
                <div class="card-content ">
                    <div class="row">
                        <ul class="list-group col-lg-6 col-md-6 col-12" style="height: 346px; overflow: auto"
                            v-if="laravel.even">
                            <li class="list-group-item text-white">
                                <h2>EVEN</h2>
                            </li>
                            <li class="list-group-item text-white" v-for="even in laravel.even">
                                <span class="badge text-black badge-primary mr-2"
                                      :style="{'background-color':'#'+this.getRandomColor()}">
                                    {{ even.viewer_count }}
                                </span>
                                {{ even.game_name }}
                            </li>
                        </ul>
                        <ul class="list-group col-lg-6 col-md-6 col-12" style="height: 346px; overflow: auto"
                            v-if="laravel.odds">

                            <li class="list-group-item text-white">
                                <h2>ODD</h2>
                            </li>
                            <li class="list-group-item text-white" v-for="odd in laravel.odds">
                                <span class="badge text-black badge-primary mr-2"
                                      :style="{'background-color':'#'+this.getRandomColor()}">{{
                                        odd.viewer_count
                                    }}</span>
                                {{ odd.game_name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'TotalEvenAndOddsComponent',
    methods: {
        getRandomColor() {
            return Math.floor(Math.random() * 16777215).toString(16);
        },
        async loadSqlViewers() {
            const even = await axios.get(this.$store.getters.getApiUrl + 'v1/even', {withCredentials: true})
            const odds = await axios.get(this.$store.getters.getApiUrl + 'v1/odds', {withCredentials: true})
            this.sql.even = even.data;
            this.sql.odds = odds.data;
        },
        async loadLaravelViewers() {
            const even = await axios.get(this.$store.getters.getApiUrl + 'v2/even', {withCredentials: true})
            const odds = await axios.get(this.$store.getters.getApiUrl + 'v2/odds', {withCredentials: true})
            this.laravel.even = even.data;
            this.laravel.odds = odds.data;
        }
    },
    mounted() {
        this.loadSqlViewers()
        this.loadLaravelViewers()
    },
    data() {
        return {
            sql: {
                even: [],
                odds: []
            },
            laravel: {
                even: [],
                odds: [],
            },
        }
    }
}

</script>
