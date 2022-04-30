<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <h3>Storage</h3>
                        <small>Use the slider to filter our options by the storage attached</small>
                        <storage-slider-component :slideroptions='storageSizeOptions'
                                                  @onUpdateStoreSliderFilter="onUpdateStoreSliderFilter"></storage-slider-component>

                    </div>
                    <div class="p-6">
                        <h3>Storage Type</h3>
                        <small>Select the type of storage that best fits your needs</small>
                        <disk-type-dropdown-component :slideroptions='storageTypeOptions'
                                                      @onHDDTypeFilterSelected="onHDDTypeFilterSelected"></disk-type-dropdown-component>

                    </div>
                    <div class="p-6">
                        <h3>RAM</h3>
                        <small>Pick the amount of ram to filter</small>
                        <ram-slider-component :slideroptions='ramOptions'
                                              @updateRamFilter="updateRamFilter"></ram-slider-component>

                    </div>
                    <div class="p-6">
                        <h3>Location</h3>
                        <small>Select one of our datacenters</small>
                        <location-drop-down-component :slideroptions='locationOptions'
                                                      @onLocationFilterSelected="onLocationFilterSelected"></location-drop-down-component>
                    </div>
                </div>
                <div class="servers-list-container">
                <div class="loading-spinner" v-if="loading"><cloud-spinner type="dots" size="128" color="orange" style="margin-left: auto;
    margin-right: auto;"/></div>
                <div><h3>Servers</h3>
                    <servers-table-component v-bind:serverOptions='availableServers'></servers-table-component>
                </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>


export default {
    data() {
        return {
            hasFilterChanges: false,
            loading: false,

            filteredData: null,
            availableServers: this.serverOptions,


            selectedStorageType: null,
            selectedRamOptions: [],
            selectedStorageOptions: [],
            selectedLocation: null,
        }
    },
    props: [
        'initial_data'
    ],
    mounted() {
        console.log('Component mounted.');
        setInterval(() => {
            this.getFilteredData()
        }, 1000)
    },
    created: function () {
        this.hasFilterChanges = true;
        this.getFilteredData()
    },
    computed: {
        storageTypeOptions: function () {
            return this.initial_data.storage_type
        },
        storageSizeOptions: function () {
            return this.initial_data.storage
        },
        ramOptions: function () {
            return this.initial_data.ram;
        },
        locationOptions: function () {
            return this.initial_data.location;
        },
    },
    methods: {

        getData() {
            this.hasFilterChanges = true;
            this.loading = true;
        },

        getFilteredData() {
            //console.log("Check for changes, has changes:" +this.hasFilterChanges);
            if (this.hasFilterChanges) {
                this.hasFilterChanges = false;

                const requestOptions = {
                    method: "POST",
                    headers: {"Content-Type": "application/json"},
                    body: JSON.stringify({
                        selectedStorageType: this.selectedStorageType,
                        selectedRamOptions: this.selectedRamOptions,
                        selectedStorageOptions: this.selectedStorageOptions,
                        selectedLocation: this.selectedLocation
                    })
                };
                fetch('/api/v1/configurator/filtered', requestOptions) //TODO SET url as base url or route name
                    .then(r => r.json())
                    .then(json => {
                        this.json = json;
                        this.filteredData = this.json;


                        this.availableServers = this.filteredData.entries;
                        //Hide the loading spinner
                        this.loading = false;
                    });
            }
        },

        onUpdateStoreSliderFilter(selectedStorageOptions) {
            if (this.selectedStorageOptions !== selectedStorageOptions) {
                this.selectedStorageOptions = selectedStorageOptions
                this.getData();
            }
        },
        updateRamFilter(selectedRam) {
            if (this.selectedRamOptions !== selectedRam) {
                this.selectedRamOptions = selectedRam;
                this.getData();
            }
        },
        onLocationFilterSelected(location) {
            if (this.selectedLocation !== location) {
                this.selectedLocation = location;
                this.getData();
            }
        },
        onHDDTypeFilterSelected(hddType) {
            if (this.selectedStorageType !== hddType) {
                this.selectedStorageType = hddType;
                this.getData();
            }
        }
    }
}
</script>
