import './bootstrap';
import { createApp } from 'vue';
import CategoryTable from './components/categories/CategoryTable.vue';
import Projects from './components/projects/Projects.vue';
import FileUpload from './components/FileUpload.vue';
import ProjectMedia from './components/projects/ProjectMedia.vue';
import CategorySection from './components/public/CategorySection.vue';


createApp()
    .component('CategoryTable', CategoryTable)
    .component('Projects', Projects)
    .component('FileUpload', FileUpload)
    .component('projectMedia', ProjectMedia)
    .component('CategorySection', CategorySection)
    .mount('#app');
