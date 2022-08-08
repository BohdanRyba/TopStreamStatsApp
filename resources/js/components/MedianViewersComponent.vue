<template>
    <h1 class="text-center">Median amount of viewers</h1>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h4 class="card-title text-white"></h4>
                    <h6 class="card-subtitle text-gray-800 mb-0">Median amount of viewers for all streams (Raw SQL version)</h6>
                </div>
                <div class="card-content">
                    {{median}}
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" style="">
                <div class="card-header mb-3">
                    <h6 class="card-subtitle text-gray-800 mb-0">Median amount of viewers for all streams (Laravel version)</h6>
                </div>
                <div class="card-content">
                    {{median2}}
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
