<template>
    <span class="span-filter-counter">Available Servers Matching Filters: <strong>{{ totalAvailableOptions }}</strong></span>
    <div class="filter-component">
        <vue-table-lite
            :columns="table.columns"
            :rows="serverOptions"
            :messages="table.messages"
        />
    </div>
</template>

<script>
import VueTableLite from 'vue3-table-lite'

export default {
    components: {VueTableLite},
    props: ['serverOptions'],
    data() {
        return {
            table: {
                columns: [
                    {
                        label: "MODEL",
                        field: "model",
                        width: "20%",
                        sortable: false,
                    },
                    {
                        label: "RAM",
                        field: "ram",
                        width: "20%",
                        sortable: false,
                    },

                    {
                        label: "HDD",
                        field: "hdd",
                        width: "20%",
                        sortable: false,
                    },
                    {
                        label: "Location",
                        field: "location",
                        width: "20%",
                        sortable: false,
                    },
                    {
                        label: "Price",
                        field: "price",
                        width: "20%",
                        sortable: false,
                    },
                ],
                rows: this.serverOptions,

            }
        }
    }, mounted() {
        console.log('Server entries table Component mounted.')
    },
    computed: {
        totalAvailableOptions (){
            return (this.serverOptions != null) ? this.serverOptions.length : 0;
        }
    }
}
</script>
