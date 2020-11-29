<template>
    <div id="wrap">
        <FiltersComponent
            @setted="setParams"
            class="filters-list">

        </FiltersComponent>

        <div class="resume-list"
             @click="openVacanciesList(null)"
        >
            <div class="resume-search">
                <h1>Список резюме</h1>
                <div class="search-box">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="path-1-inside-1" fill="white">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5871 11.4419C13.5394 10.2462 14.1084 8.7318 14.1084 7.08447C14.1084 3.21848 10.9744 0.0844727 7.1084 0.0844727C3.24241 0.0844727 0.108398 3.21848 0.108398 7.08447C0.108398 10.9505 3.24241 14.0845 7.1084 14.0845C8.78672 14.0845 10.3271 13.4938 11.533 12.5091L14.7197 15.6957C15.0126 15.9886 15.4874 15.9886 15.7803 15.6957C16.0732 15.4028 16.0732 14.928 15.7803 14.6351L12.5871 11.4419Z"/>
                        </mask>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5871 11.4419C13.5394 10.2462 14.1084 8.7318 14.1084 7.08447C14.1084 3.21848 10.9744 0.0844727 7.1084 0.0844727C3.24241 0.0844727 0.108398 3.21848 0.108398 7.08447C0.108398 10.9505 3.24241 14.0845 7.1084 14.0845C8.78672 14.0845 10.3271 13.4938 11.533 12.5091L14.7197 15.6957C15.0126 15.9886 15.4874 15.9886 15.7803 15.6957C16.0732 15.4028 16.0732 14.928 15.7803 14.6351L12.5871 11.4419Z" fill="white"/>
                        <path d="M12.5871 11.4419L11.4138 10.5074L10.5793 11.5553L11.5265 12.5026L12.5871 11.4419ZM11.533 12.5091L12.5936 11.4484L11.6347 10.4894L10.5842 11.3472L11.533 12.5091ZM15.7803 15.6957L16.841 16.7564L16.841 16.7564L15.7803 15.6957ZM12.6084 7.08447C12.6084 8.38029 12.1621 9.56774 11.4138 10.5074L13.7605 12.3764C14.9166 10.9247 15.6084 9.08331 15.6084 7.08447H12.6084ZM7.1084 1.58447C10.146 1.58447 12.6084 4.04691 12.6084 7.08447H15.6084C15.6084 2.39005 11.8028 -1.41553 7.1084 -1.41553V1.58447ZM1.6084 7.08447C1.6084 4.04691 4.07083 1.58447 7.1084 1.58447V-1.41553C2.41398 -1.41553 -1.3916 2.39005 -1.3916 7.08447H1.6084ZM7.1084 12.5845C4.07083 12.5845 1.6084 10.122 1.6084 7.08447H-1.3916C-1.3916 11.7789 2.41398 15.5845 7.1084 15.5845V12.5845ZM10.5842 11.3472C9.63631 12.1213 8.42846 12.5845 7.1084 12.5845V15.5845C9.14498 15.5845 11.0179 14.8663 12.4818 13.6709L10.5842 11.3472ZM15.7803 14.6351L12.5936 11.4484L10.4723 13.5697L13.659 16.7564L15.7803 14.6351ZM14.7197 14.6351C15.0126 14.3422 15.4874 14.3422 15.7803 14.6351L13.659 16.7564C14.5377 17.6351 15.9623 17.6351 16.841 16.7564L14.7197 14.6351ZM14.7197 15.6957C14.4268 15.4028 14.4268 14.928 14.7197 14.6351L16.841 16.7564C17.7197 15.8777 17.7197 14.4531 16.841 13.5744L14.7197 15.6957ZM11.5265 12.5026L14.7197 15.6957L16.841 13.5744L13.6478 10.3812L11.5265 12.5026Z" fill="#9299B0" mask="url(#path-1-inside-1)"/>
                    </svg>

                    <input type="text" placeholder="Введите необходимый запрос">


                </div>
                <div class="mode-box">
                    <div class="mode" @click="modeSearch = 'name'" :class="modeSearch === 'name' ? 'active' : 'inactive'"><p>По имени</p></div>
                    <div class="mode" @click="modeSearch = 'resume'" :class="modeSearch === 'resume' ? 'active' : 'inactive'"><p>По резюме</p></div>
                </div>
            </div>

            <div class="table-wrap">
                <div class="table-clients">
                    <div class="table-head">
                        <p class="table-head-cell">   </p>
                        <p class="table-head-cell">
                            <i>Имя</i>
                        </p>
                        <p class="table-head-cell">
                            <i>Резюме</i>
                        </p>
                        <p class="table-head-cell">
                            <i>Опыт</i>
                        </p>
                        <p class="table-head-cell">
                            <i>Подходящие вакансии</i>
                        </p>
                        <p class="table-head-cell">
                            <i>Статус</i>
                        </p>
                    </div>
                    <div class="table-content">
                        <div class="table-row"
                             v-for="(client,index) in clients"
                        >
                            <div class="table-cell">
                                <img class="avatar" :src="'https://blog.vverh.digital/wp-content/uploads/2019/01/%D0%9F%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82.png'" alt="">
                            </div>
                            <div class="table-cell" style="cursor: pointer">
                                <router-link :to="'/resume/'+client.id">{{client.full_name}}</router-link>
                            </div>

                            <div class="table-cell">
                                <p>{{client.title}}</p>
                            </div>


                            <div class="table-cell">
                                <p>{{client.experience}} месяцев</p>
                            </div>

                            <div class="table-cell">
                                <p class="vacancies-open"
                                   @click.stop="openVacanciesList(index)"
                                >
                                    {{slicedVacs(client)}}
<!--                                    {{clients[0].vacancy}}-->
                                </p>

                                <RelevantVacanciesComponent
                                    :vacs="client.vacancy"
                                    class="relevant-list"
                                    v-if="index == currentVacancies">
                                </RelevantVacanciesComponent>
                            </div>

                            <div class="table-cell">
                                <svg class="status-icon" v-if="client.status == 3 || client.status == 5" width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="2" cy="2" r="2" fill="#ED2B2B"/>
                                </svg>

                                <svg class="status-icon" v-if="client.status == 0 || client.status == 1" width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="2" cy="2" r="2" fill="#FFC700"/>
                                </svg>

                                <svg class="status-icon" v-if="client.status == 2 || client.status == 4" width="5" height="4" viewBox="0 0 5 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <ellipse cx="2.25688" cy="2" rx="2.25688" ry="2" fill="#57C83A"/>
                                </svg>

                                <p v-if="client.status == 0" >Не обработан</p>
                                <p v-if="client.status == 1" >Отправлено тестовое</p>
                                <p v-if="client.status == 2" >Тест пройден</p>
                                <p v-if="client.status == 3" >Тест не пройден</p>
                                <p v-if="client.status == 4" >Принят</p>
                                <p v-if="client.status == 5" >Отклонен</p>
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
import RelevantVacanciesComponent from "./RelevantVacanciesComponent";
import PaginationComponent from "./PaginationComponent";
import FiltersComponent from "./FiltersComponent";
import axios from 'axios';

export default {
    name: "ResumeListComponent",
    components: {
        RelevantVacanciesComponent,
        PaginationComponent,
        FiltersComponent
    },
    data(){
        return {
            clients: [
                {
                    avatar: '',
                    name: 'Анатолий Вассерман',
                    resumeTitle: 'Разработчик сложных интерфейсов',
                    exp: '4 года',
                    vacancy: 'Back-end разработчик и еще 4',
                    status: 0 // 0 не обработан, 1 - в обработке, 2 - обработан
                },
            ],
            modeSearch: 'name',
            currentPage: 1,
            countPages: 1,
            currentVacancies: null,
            statusParams: '',
            vacancyParams: '',
        }
    },
    created(){
        //this.fetchResume();
    },
    methods: {
        setParams(s) {
            this.statusParams = s.statusParams;
            this.vacancyParams = s.vacancyParams;
            this.fetchResume();
        },
        changePage(page){
            this.currentPage = page;
            this.fetchResume();
        },
        slicedVacs(c){
            try{
                let pred = c.vacancy.map(el => el.title).slice(0,4).toString();
                if(c.vacancy.length > 4){
                    pred += 'и еще ' + (c.vacancy.length - 4).toString();
                }
                return pred;
            } catch(e) {
                return '';
            }

        },
        fetchResume(){
            axios.get('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php?type=getSummaryList&offset='+this.currentPage + this.statusParams + this.vacancyParams)
            .then(res => {
                this.countPages = res.data.page_count;
                this.clients = res.data.data;
                console.log(res.data);
            })
        },
        openVacanciesList(i){
            this.currentVacancies = i;
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../styles_fonts";
$font-Inter: Inter, 'Inter';

#wrap {
    display: flex;
    justify-content: space-between;
    width: 100%;
    height: calc(100vh - 30px);
    margin: 15px 0;

    .filters-list {
        width: 260px;
        height: 100%;
        //background: #fff;
        margin: 0 0 0 14px !important;
    }

    .resume-list {
        width: calc(100% - 305px);

        .resume-search {
            width: calc(100% - 36px);
            padding: 0 18px;
            display: grid;
            grid-template-columns: 2fr 1.4fr 1.2fr;
            border-radius: 0px 0px 20px 20px;
            align-items: center;
            height: 100px;
            background: white;

            h1 {
                /* BlockHeader */

                font-family: $font-Inter;
                font-style: normal;
                font-weight: 500;
                font-size: 24px;
                line-height: 34px;
                /* identical to box height */
                text-align: justify;
                color: #1E2437;
            }

            .search-box {
                height: 40px;
                display: grid;
                grid-template-columns: 20px 1fr;
                grid-gap: 7px;
                align-items: center;
                border: 1px solid #EDEDF2;
                box-sizing: border-box;
                border-radius: 6px;
                width: calc(100% - 50px);
                padding: 0 10px;


                svg {
                    width: 16px;
                    height: 16px;
                }

                input {
                    font-family: $font-Inter;
                    font-style: normal;
                    font-weight: normal;
                    font-size: 14px;
                    line-height: 100%;
                    color: #9299B0;
                    border: none;

                    &:focus {
                        outline: none;
                    }
                }
            }

            .mode-box {
                display: grid;
                grid-template-columns: 1fr 1fr;
                width: 200px;
                height: 42px;
                box-sizing: border-box;


                .mode {
                    border: 1px solid #EDEDF2;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    cursor: pointer;
                    transition: background-color ,border-color .3s;



                    &:nth-child(1){
                        border-radius: 10px 0 0 10px;
                    }

                    &:nth-child(2){
                        border-radius: 0 10px 10px 0;
                    }

                    p {
                        margin: 0;
                        font-family: $font-Inter;
                        font-style: normal;
                        font-weight: normal;
                        font-size: 14px;
                        line-height: 100%;
                        /* identical to box height, or 16px */

                        text-align: center;

                    }
                }

                .inactive {
                    &:hover {
                        transition: all .3s;
                        background: #ececec;
                    }
                }

                .active {
                    border-color: #EA643A;
                    background: #EA643A;
                    p {
                        color: #fff;
                    }
                }
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


                .table-content {
                    max-height: calc(100vh - 250px);
                    overflow-y: auto;
                    &::-webkit-scrollbar {
                        width: 0;
                    }
                }

                .table-head, .table-content .table-row {
                    grid-template-columns: .2fr .8fr 1.35fr .4fr 1.2fr .7fr;
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

                .table-row {
                    //grid-template-columns: .8fr .8fr .8fr 1.2fr 1.1fr;
                    //padding: 0 15px;
                    //border-radius: 20px;
                }

                .table-row:nth-child(odd) {
                    background: #F5F5F5;
                }

                .table-cell {
                    display: flex;
                    max-width: 100%;
                    align-items: center;
                    position: relative;

                    p,i,a {
                        text-decoration: none;
                        font-family: $font-Inter;
                        font-style: normal;
                        font-weight: normal;
                        font-size: 16px;
                        line-height: 150%;
                        //text-align: justify;
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
                        z-index: 101;
                        top: 10px;
                        left: -2px;
                    }
                }
            }


            .pagination-wrap {
                justify-content: flex-start;
                width: 100%;
                display: flex;
                margin-top: 10px;

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