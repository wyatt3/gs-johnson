import './bootstrap';
import { createApp } from 'vue';
import Carousel from './components/public/Carousel.vue';
import CategoryTable from './components/categories/CategoryTable.vue';
import Projects from './components/projects/Projects.vue';
import FileUpload from './components/FileUpload.vue';
import ProjectMedia from './components/projects/ProjectMedia.vue';
import CategoryPage from './components/public/CategoryPage.vue';


createApp()
    .component('Carousel', Carousel)
    .component('CategoryTable', CategoryTable)
    .component('Projects', Projects)
    .component('FileUpload', FileUpload)
    .component('projectMedia', ProjectMedia)
    .component('CategoryPage', CategoryPage)
    .mount('#app');
