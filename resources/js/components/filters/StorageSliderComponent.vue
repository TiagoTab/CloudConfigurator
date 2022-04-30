<template>
    <div class="filter-component  filter-component-slider">
        <Slider :format="nameFromIndex"
                v-model="value"
                :step="1"
                :max="max"
                v-on:change="update"
        />
    </div>
</template>

<script>
import Slider from '@vueform/slider'


export default {
    components: {Slider},
    props: [
        'slideroptions',
    ],
    data: () => {
        return {
            max: 1,
            value: [0, 1],
        };
    },
    mounted() {
        console.log('Storage Component mounted.')
        console.log(this.slideroptions);
        this.max = (this.slideroptions.length - 1);
        this.value = [0, this.max];
    },
    methods: {
        nameFromIndex(libIndex) {
            if (this.slideroptions != null ) {
                let index = parseInt(libIndex);

                return this.slideroptions[index].hdd;
            } else {
                return "??!?"
            }
        },
        update(){
            this.$nextTick(() => {
                let selectedStorageOptions = [];
                let lowerRange = this.value[0];
                let higherRange = this.value[1];
                this.slideroptions.forEach((option, index) => {
                    if (index >= lowerRange && index <= higherRange) {
                        selectedStorageOptions.push(option.hdd);
                    }
                });
                this.$emit("onUpdateStoreSliderFilter", selectedStorageOptions);
            });
        }
    }
}
</script>

<style src="../../../../node_modules/@vueform/slider/themes/default.css"></style>
<style>
:root {
    --slider-connect-bg: #5585c4;
    --slider-tooltip-bg: #26338c;
    --slider-handle-ring-color: #3B82F630;
}
</style>
