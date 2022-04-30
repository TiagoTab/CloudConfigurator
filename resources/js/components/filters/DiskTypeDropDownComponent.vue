<template>
    <div class="filter-component">
        <v-select v-model="key" :options="options" :change="setSelected(key)" style="text-transform: uppercase;"/>
    </div>
</template>

<script>
/*
Harddisk type	Dropdown	SAS, SATA, SSD
 */
import vSelect from 'vue-select'

export default {

    components: {vSelect},
    props: [
        'slideroptions',
    ],
    data() {
        return {
            options: [],
            key: ''
        }
    },
    mounted() {
        console.log('Disk Type Component mounted.')
        this.options = this.slideroptions.map((key, value) => Object.values(key)[0]);
    }, methods: {
        setSelected: function (value) {
            this.$emit("onHDDTypeFilterSelected", value);
        }
    }
}
import 'vue-select/dist/vue-select.css';

</script>

