import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent'

const routes = [{
    path: '/',
    component: ExampleComponent,
    name: 'example'
}, ];


const router = new VueRouter({
    routes, //short for routes:'routes'
    mode: 'history'
})


export default router;
