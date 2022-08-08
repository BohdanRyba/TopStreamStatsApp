<template>
    <h1 class="text-center">List of top 100 streams</h1>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h4 class="card-title text-white">
                        <select @change="toggleSqlSort()">
                            <option value="ASC" selected>ASC</option>
                            <option value="DESC">DESC</option>
                        </select>
                    </h4>
                    <h6 class="card-subtitle text-gray-800 mb-0">Highest viewer count stream per game (Raw SQL
                        version)</h6>
                </div>
                <div class="card-content">
                    <ul class="list-group" style="height: 346px; overflow: auto" v-if="sql.top">
                        <li class="list-group-item text-white" v-for="top in sql.top">
                            <span class="badge text-black badge-primary mr-2"
                                  :style="{'background-color':'#'+this.getRandomColor()}">{{
                                    top.total_viewers
                                }}</span>
                            {{ top.game_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h4 class="card-title text-white">
                        <select @change="toggleSort()" >
                            <option value="ASC" selected>ASC</option>
                            <option value="DESC">DESC</option>
                        </select>
                    </h4>
                    <h6 class="card-subtitle text-gray-800 mb-0">Highest viewer count stream per game (Laravel
                        version)</h6>
                </div>
                <div class="card-content">
                    <ul class="list-group" style="height: 346px; overflow: auto" v-if="laravel.top">
                        <li class="list-group-item text-white" v-for="top in laravel.top">
                            <span class="badge text-black badge-primary mr-2"
                                  :style="{'background-color':'#'+this.getRandomColor()}">{{
                                    top.total_viewers
                                }}</span>
                            {{ top.game_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'TopHundredStreamsComponent',
    methods: {
        getRandomColor() {
            return Math.floor(Math.random() * 16777215).toString(16);
        },
        async loadSqlTop() {
            const viewers = await axios.get(this.$store.getters.getApiUrl + 'v1/top', {
                params: {
                    sort: this.sql.sort
                }, withCredentials: true
            })
            console.log(viewers.data)
            this.sql.top = viewers.data;
        },
        async loadLaravelTop() {
            const viewers = await axios.get(this.$store.getters.getApiUrl + 'v2/top', {
                params: {
                    sort: this.laravel.sort
                }, withCredentials: true
            })
            this.laravel.top = viewers.data;
        },
        toggleSqlSort() {
            if (this.sql.sort === 'ASC') {
                this.sql.sort = 'DESC';
            } else {
                this.sql.sort = 'ASC';
            }
            this.loadSqlTop()

        },
        toggleSort() {
            if (this.laravel.sort === 'ASC') {
                this.laravel.sort = 'DESC';
            } else {
                this.laravel.sort = 'ASC';
            }
            this.loadLaravelTop()

        }
    },
    mounted() {
        this.loadSqlTop()
        this.loadLaravelTop()
    },
    data() {
        return {
            sql: {
                sort: "ASC",
                top: []
            },
            laravel: {
                sort: "ASC",
                top: []
            },
        }
    }
}

</script>
