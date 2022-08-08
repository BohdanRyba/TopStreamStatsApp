<template>
    <h1 class="text-center">Median amount of viewers</h1>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card card-inverse bg-success">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <h3 class="card-text">{{median}}</h3>
                                <span>Median amount of viewers (SQL)</span>
                            </div>
                            <div class="media-right align-self-center">
                                <i class="ft-user font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card card-inverse bg-warning">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <h3 class="card-text">{{median}}</h3>
                                <span>Median amount of viewers (Laravel)</span>
                            </div>
                            <div class="media-right align-self-center">
                                <i class="ft-user font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

export default {
    name: 'MedianmediansComponent',
    methods: {
        getRandomColor() {
            return Math.floor(Math.random() * 16777215).toString(16);
        },
        async loadSqlmedians(){
            const median = await axios.get(this.$store.getters.getApiUrl + 'v1/medians', {withCredentials: true})
            console.log(median.data)
            this.median = median.data;
        },
        async loadLaravelmedians(){
            const median = await axios.get(this.$store.getters.getApiUrl + 'v2/medians', {withCredentials: true})
            this.median2 = median.data;
        }
    },
    mounted() {
        this.loadSqlmedians()
        this.loadLaravelmedians()
    },
    data() {
        return {
            median: 0,
            median2: 0,
        }
    }
}

</script>
