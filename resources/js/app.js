import "./bootstrap";
import 'bootstrap';
import { createApp } from 'vue';

import CategoryTable from "./components/categories/CategoryTable.vue";
import Projects from "./components/projects/Projects.vue";
import FileUpload from "./components/FileUpload.vue";
import ProjectMedia from "./components/projects/ProjectMedia.vue";

import CategoryPage from "./components/public/CategoryPage.vue";


const app = createApp();

app
    .component('category-table', CategoryTable)
    .component('category-page', CategoryPage)
    .component('projects', Projects)
    .component('file-upload', FileUpload)
    .component('project-media', ProjectMedia)
    .mount("#app");
