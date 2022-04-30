require('./bootstrap');

import { createApp } from 'vue';
import {ref} from "vue"
import easySpinner from 'vue-easy-spinner';


import configurator from './components/ConfiguratorComponent.vue';
import storageSlider from './components/filters/StorageSliderComponent.vue';
import sliderRam from './components/filters/RamCheckboxesComponent.vue';
import locationDropDown from "./components/filters/LocationDropDownComponent.vue";
import diskTypeDropDown from "./components/filters/DiskTypeDropDownComponent.vue";
import serversTable from './components/table/ServersTableComponent.vue';


let app=createApp({}).use(easySpinner, {
    /*options*/
    prefix: 'cloud',
});

app.component('configurator-component' , configurator);

app.component('ram-slider-component' , sliderRam);
app.component('storage-slider-component' , storageSlider);
app.component('location-drop-down-component',locationDropDown);
app.component('disk-type-dropdown-component',diskTypeDropDown);
app.component('servers-table-component',serversTable);


app.mount("#app")

