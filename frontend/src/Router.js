import Vue from 'vue';
import VueRouter from 'vue-router';
import ResumeListComponent from "./components/ResumeListComponent";
import ResumeComponent from "./components/ResumeComponent";
import VacancyListComponent from "./components/VacancyListComponent";
import VacancyComponent from "./components/VacancyComponent";
Vue.use(VueRouter);


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'resumeList',
            component: ResumeListComponent
        },
        {
            path: '/resume/:id',
            name: 'resume',
            component: ResumeComponent,
            props: true
        },
        {
            path: '/vacancy',
            name: 'vacancy',
            component: VacancyListComponent
        },
        {
            path: '/vacancy/:id',
            name: 'vacancyById',
            component: VacancyComponent,
            props: true
        }

    ],
});

export default router;
