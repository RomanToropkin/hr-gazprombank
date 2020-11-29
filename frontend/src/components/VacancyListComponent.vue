<template>
    <div class="vacancy-list">
        <CreateVacancyComponent
            @close="addingVac = false"
            v-if="addingVac"
        >
        </CreateVacancyComponent>

        <div class="resume-list">
            <div class="resume-search">
                <h1>Список вакансий</h1>
                <button class="add-vac" @click="addingVac = true">Добавить вакансию</button>
                <button class="add-vac">Редактор ключевых слов</button>
            </div>

            <div class="table-wrap">
                <div class="table-clients">
                    <div class="table-head">
                        <p class="table-head-cell">
                            <i>Вакансия</i>
                        </p>
                        <p class="table-head-cell">
                            <i>Опыт</i>
                        </p>
                        <p class="table-head-cell">
                            <i>Категория</i>
                        </p>
                    </div>
                    <div class="table-content">
                        <div class="table-row"
                             v-for="(vac,index) in vacs"
                        >
                            <div class="table-cell">
                                <router-link :to="'/vacancy/'+vac.id">{{vac.title}}</router-link>
                            </div>

                            <div class="table-cell">
                                <p>{{vac.work_start}}</p>
                            </div>

                            <div class="table-cell">
                                <ul class="keywords">
                                    <li>
                                        <i>{{vac.category}}</i>
<!--                                    <svg @click="" width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.0946 5.82843L5.8017 5.12132L3.68038 3L5.8017 0.87868L5.0946 0.171573L2.97328 2.29289L0.851957 0.171572L0.144849 0.87868L2.26617 3L0.144849 5.12132L0.851956 5.82843L2.97328 3.70711L5.0946 5.82843Z" fill="#0047FF"/>
                                        </svg>-->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-wrap">
                    <PaginationComponent
                        :current="currentPage"
                        :count="parseInt(countPages)"
                        @page-changed="changePage"
                    ></PaginationComponent>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CreateVacancyComponent from "./CreateVacancyComponent";
import PaginationComponent from "./PaginationComponent";
import axios from 'axios';


export default {
    name: "VacancyListComponent",
    components: {
        CreateVacancyComponent,
        PaginationComponent
    },
    data(){
        return {
            currentPage: 1,
            countPages: 5,
            addingVac: false,
            vacs: []
        }
    },
    created(){
        this.fetchVacs();
    },
    methods: {
        fetchVacs(){
            axios.get('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php?type=getVacancyList&offset='+this.currentPage)
            .then(res => {
                this.vacs = res.data.data;
                this.countPages = res.data.page_count;
            })
        },
        changePage(page){
            this.currentPage = page;
            this.fetchVacs();
        }
    }
}
</script>

<style scoped lang="scss">
@import "../styles_fonts";
$font-Inter: Inter, 'Inter';

    .vacancy-list {
        width: 100%;
        height: calc(100vh - 30px);
        margin: 15px 0;


        .resume-list {
            width: 100%;

            .resume-search {
                background: #fff;
                align-items: center;
                justify-content: space-evenly;
                width: calc(100% - 56px);
                padding: 0 18px;
                display: grid;
                grid-template-columns: 2fr 1.4fr 1.2fr;
                border-radius: 0px 0px 20px 20px;
                margin: 0 auto;

                .add-vac {
                    height: 40px;
                    border: none;
                    outline: none;
                    color: #fff;
                    width: 252px;
                    background: #0047FF;
                    border-radius: 6px;
                    cursor: pointer;

                    &:active {
                        transform: scale(.98);
                        transition: all .3s;
                    }

                    &:focus {
                        outline: none;
                    }

                }

                h1 {
                    font-family: $font-Inter;
                    font-style: normal;
                    font-weight: 500;
                    font-size: 28px;
                    line-height: 34px;
                    text-align: justify;
                    color: #1E2437;
                }
            }

            .table-wrap {
                -webkit-animation: scale-up-ver-top 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                animation: scale-up-ver-top 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                width: 100%;
                display: flex;
                flex-direction: column;
                transition: all 1.5s;

                .table-clients {
                    transition: all 1.5s;
                    width: 100%;

                    .table-head {
                        padding: 0 30px;
                        grid-template-columns: 2.9fr .5fr 1.5fr;
                        display: grid;
                        grid-gap: 5px;
                        display: -ms-grid;
                        width: calc(100% - 60px) !important;
                    }

                    .table-content {
                        max-height: calc(100vh - 230px);
                        overflow-y: auto;
                        width: calc(100% - 30px);
                        margin: 0 auto;

                        &::-webkit-scrollbar {
                            width: 0;
                        }
                    }

                    .table-content .table-row {
                        width: calc(100% - 60px);
                        padding: 0 30px;
                        grid-template-columns: 2.95fr .5fr 1.5fr;
                        display: grid;
                        grid-gap: 5px;
                        display: -ms-grid;
                    }

                    .table-head {
                        width: 100%;

                        .table-head-cell {
                            display: flex;
                            align-items: center;
                            //text-align: center;
                            user-select: none;
                            font-family: $font-Inter;
                            font-style: normal;
                            font-weight: normal;
                            font-size: 18px;
                            line-height: 150%;
                            text-align: justify;
                            color: #9299B0;

                            i {
                                font-style: normal;
                                font-weight: bold;
                            }
                            svg {
                                transition: all .3s;
                                margin: 0 0 0 7px;
                            }

                            .hidden-ico {
                                opacity: .2;
                            }

                            .translated-ico {
                                transform: scaleY(-1);
                            }
                        }
                    }

                    .table-row:nth-child(odd) {
                        background: #F5F5F5;
                    }

                    .table-cell {
                        display: flex;
                        max-width: 100%;
                        align-items: center;
                        position: relative;

                        p,i, a {
                            text-decoration: none;
                            font-family: $font-Inter;
                            font-style: normal;
                            font-weight: normal;
                            font-size: 16px;
                            line-height: 150%;
                            text-align: justify;
                            color: #1E2437;
                        }

                        .avatar {
                            width: 30px;
                            height: 30px;
                            object-fit: cover;
                            border-radius: 50%;
                            margin: 0 auto;
                            //margin-right: 12px;
                        }

                        .status-icon {
                            width: 4px;
                            height: 4px;
                            margin-right: 5px;
                        }

                        .vacancies-open {
                            color: #0047FF;
                            cursor: pointer;
                            border-bottom: 1px dashed #0047FF;
                        }

                        .relevant-list {
                            position: absolute;
                            z-index: 55;
                            top: 10px;
                            left: -2px;
                        }


                        .keywords {
                            max-width: 100%;
                            display: flex;
                            flex-wrap: wrap;
                            grid-gap: 7px;
                            padding: 0;

                            li {
                                list-style-type: none;
                                display: flex;
                                align-items: center;
                                padding: 5px 8px;
                                background: #DCE3FA;
                                border-radius: 6px;

                                &:hover {
                                    cursor: pointer;
                                    background: #BFCDFF;
                                    i {
                                        color: #0047FF;
                                    }
                                }



                                i {
                                    color: #5E8BFF;
                                    font-family: $font-Inter;
                                    font-style: normal;
                                    font-weight: normal;
                                    font-size: 16px;
                                    line-height: 19px;
                                    text-align: justify;
                                }

                                 svg {
                                     margin-left: 5px;
                                     width: 6px;
                                     height: 6px;

                                 }


                            }
                        }
                    }
                }


                .pagination-wrap {
                    justify-content: flex-start;
                    width: calc(100% - 17px);
                    display: flex;
                    margin-top: 10px;
                    padding-left: 17px;

                    /deep/ #pagination {
                        width: 300px;
                    }
                }
            }

        }
    }


@-webkit-keyframes flip-diagonal-1-tr {
    0% {
        -webkit-transform: rotate3d(1, 1, 0, 0deg);
        transform: rotate3d(1, 1, 0, 0deg);
    }
    100% {
        -webkit-transform: rotate3d(1, 1, 0, 180deg);
        transform: rotate3d(1, 1, 0, 180deg);
    }
}
@keyframes flip-diagonal-1-tr {
    0% {
        -webkit-transform: rotate3d(1, 1, 0, 0deg);
        transform: rotate3d(1, 1, 0, 0deg);
    }
    100% {
        -webkit-transform: rotate3d(1, 1, 0, 180deg);
        transform: rotate3d(1, 1, 0, 180deg);
    }
}

/* ----------------------------------------------
 * Generated by Animista on 2020-11-27 21:21:5
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info.
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

/**
 * ----------------------------------------
 * animation scale-up-top
 * ----------------------------------------
 */
@-webkit-keyframes scale-up-top {
    0% {
        -webkit-transform: scale(0.5);
        transform: scale(0.5);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
    }
}
@keyframes scale-up-top {
    0% {
        -webkit-transform: scale(0.5);
        transform: scale(0.5);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
    }
}

/* ----------------------------------------------
 * Generated by Animista on 2020-11-27 21:23:6
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info.
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

/**
 * ----------------------------------------
 * animation scale-up-ver-top
 * ----------------------------------------
 */
@-webkit-keyframes scale-up-ver-top {
    0% {
        -webkit-transform: scaleY(0.4);
        transform: scaleY(0.4);
        -webkit-transform-origin: 100% 0%;
        transform-origin: 100% 0%;
    }
    100% {
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
        -webkit-transform-origin: 100% 0%;
        transform-origin: 100% 0%;
    }
}
@keyframes scale-up-ver-top {
    0% {
        -webkit-transform: scaleY(0.4);
        transform: scaleY(0.4);
        -webkit-transform-origin: 100% 0%;
        transform-origin: 100% 0%;
    }
    100% {
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
        -webkit-transform-origin: 100% 0%;
        transform-origin: 100% 0%;
    }
}



</style>