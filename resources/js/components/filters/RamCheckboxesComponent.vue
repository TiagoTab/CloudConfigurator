<template>
    <div class="ram-filter">
        <ul>
            <li v-for="item in slicedArray">
                <input
                    :value="item.ram"
                    type="checkbox"
                    v-model="checkedOptions"
                    v-on:input="checkboxVal = $event.target.value"
                    @change="updateFilter($event)"
                />
                {{ item.ram_size_gb }} <span class="ram-type">{{ item.ram_type }}</span>
            </li>
        </ul>
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
            checkedOptions: [],
        };
    },
    mounted() {
        console.log('RAM Component mounted.')
    },
    methods: {
        nameFromIndex(index) {
            if (this.slideroptions != null) {
                return this.slideroptions[index].ram;
            } else {
                return "??!?"
            }
        },
        updateFilter: function (event) {
            this.$nextTick(() => {
                this.$emit("updateRamFilter", this.checkedOptions);
            });
        }
    },
    computed: {
        slicedArray() {
            return this.slideroptions
        }
    }
}
</script>

<style src="../../../../node_modules/@vueform/slider/themes/default.css"></style>
