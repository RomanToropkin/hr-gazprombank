<template>
    <div class="resume">

        <div class="resume-list">
            <div class="resume-search">
                <h1>{{data.full_name}}</h1>
                <button class="add-vac" @click="showVerdict = true">Вынести вердикт</button>
            </div>


            <div class="blocks-wrap">
                <div class="half-blocks">
                    <div class="info-block">
                        <div class="info-wrap">
                            <h3>Основная информация</h3>
                            <div class="main-info">
                                <div class="avatar">
                                    <img src="https://www.gl5.ru/photos/t/tri-dnya-dozhdya/2.jpg">
                                </div>
                                <div class="info">
                                    <div class="contacts">
                                        <div class="contact">
                                            <label>Телефон</label>
                                            <p>+7 928 345 21 23</p>
                                        </div>
                                        <div class="contact">
                                            <label>Электронная почта</label>
                                            <p>andrey1992@google.com</p>
                                        </div>
                                        <div class="contact">
                                            <label>Статус</label>
                                            <p v-if="data.status == 0" style="color: #FFC700">В обработке</p>
                                            <p v-if="data.status == 1" style="color: #FFC700">Отправлено тестовое</p>
                                            <p v-if="data.status == 2" style="color: #57C83A">Тест пройден</p>
                                            <p v-if="data.status == 3" style="color: #ED2B2B">Тест не пройден</p>
                                            <p v-if="data.status == 4" style="color: #57C83A">Принят</p>
                                            <p v-if="data.status == 5" style="color: #ED2B2B">Отклонен</p>
                                        </div>
                                        <div class="contact">
                                            <label>Опыт работы</label>
                                            <p>{{data.experience}} месяцев</p>
                                        </div>

                                    </div>
                                    <div class="vacancy-title">
                                        <label>Вакансия</label>
                                        <p>{{data.vacancy[0].title}}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="info-wrap">
                            <h3 style="margin: 0 0 0 0">Описание резюме</h3>
                            <div class="desc-wrap">
                                <p v-html="data.description" style="margin: 0 !important;"></p>
                            </div>
                        </div>
                    </div>

                    <div class="info-block">
                        <div class="info-wrap">
                            <h3>Тестовое задание</h3>

                            <div class="tasks-block">
                                <label>Тестовое задание</label>
                                <a :href="t.file_url" v-for="t in data.task" style="text-decoration: none">
                                    <p>Тестовое задание.pdf</p>
                                </a>
                            </div>

                            <div class="tasks-block">
                                <label>Полученные файлы</label>
                                <a class="received">
                                    <span class="task-received">
                                        <i class="title-task">Тестовое задание</i>
                                        <i class="title-file">Тестовое задание.pdf</i>
                                    </span>

                                    <p class="date">28 Ноября</p>
                                </a>
                                <a class="received">
                                    <span class="task-received">
                                        <i class="title-task">Тестовое задание</i>
                                        <i class="title-file">Тестовое задание.pdf</i>
                                    </span>

                                    <p class="date">28 Ноября</p>
                                </a>
                            </div>

                            <div class="buttons-block">
                                <button class="accept" @click="acceptTest">Принять тест</button>
                                <button class="decline" @click="denyTest">Отклонить тест</button>
                            </div>
                        </div>
                        <div class="info-wrap" style="border-top: 1px dashed #8a8888">
                            <h3>Фомирование ответа соискателю</h3>
                            <div class="tasks-block" style="margin-bottom: 5px">
                                <label>Ответ соискателю</label>
                                <textarea rows="5" v-model="data.generated_text"></textarea>
                            </div>
                            <div class="buttons-block">
                                <button class="accept">Отправить ответ</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="half-blocks">
                    <div class="info-block">
                        <div class="info-wrap">
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
                                            <i>Релевантность</i>
                                        </p>
                                    </div>
                                    <div class="table-content">
                                        <div class="table-row"
                                             v-for="(vac,index) in data.vacancy"
                                        >
                                            <div class="table-cell">
                                                <p>{{ vac.title }}</p>
                                            </div>

                                            <div class="table-cell">
                                                <p>{{ parseInt(vac.work_end)-parseInt(vac.work_start) }}</p>
                                            </div>

                                            <div class="table-cell">
                                                <p>{{vac.score*100}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pagination-wrap">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-block">
                        <div class="info-wrap">
                            <h3>Тестовое задание</h3>

                            <div class="tasks-block" style="margin-bottom: 10px">
                                <label>Тестовое задание</label>
                                <vue-dropzone
                                    :options="{
                                        url: 'https://httpbin.org/post',
                                        uploadMultiple: true,
                                        clickable: true
                                    }"
                                    @vdropzone-complete="addFiles"
                                    ref="myVueDropzone" id="dropzone" :useCustomSlot=true style="z-index: 101">
                                    <div class="dropzone-custom-content">
                                        <h3 class="dropzone-custom-title">Переместите сюда документы</h3>
                                        <div class="subtitle">...или нажмите, чтобы выбрать их с компьютера</div>
                                    </div>
                                </vue-dropzone>
                            </div>
                            <div class="buttons-block">
                                <button class="accept">Отправить</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <VerdictComponent :id="id" @close="closeVerdict" v-if="showVerdict"></VerdictComponent>
    </div>
</template>

<script>
import axios from 'axios';
import vue2Dropzone from 'vue2-dropzone';
import VerdictComponent from "./VerdictComponent";


export default {
    name: "ResumeComponent",
    components: {
        vueDropzone: vue2Dropzone,
        VerdictComponent
    },
    data() {
        return {
            showVerdict: false,
            currentPage: 1,
            countPages: 5,
            addingVac: false,
            vacs: [],
            files: [],
            data: '',
            id: '',
        }
    },
    created() {
        this.id = this.$route.params.id;
        axios.get('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php?type=getSummaryById&id='+this.$route.params.id)
        .then(res => {
            this.data = res.data;
        })
    },
    methods: {
        acceptTest(){
            axios.post('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php', {
                type: 'applyTest',
                id: this.id
            })
                .then(() => {
                    window.location.reload();
                })
        },
        denyTest(){
            axios.post('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php', {
                type: 'denyTest',
                id: this.id
            })
                .then(() => {
                    window.location.reload();
                })
        },
        closeVerdict(){
            this.showVerdict = false;
            axios.get('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php?type=getSummaryById&id='+this.$route.params.id)
                .then(res => {
                    this.data = res.data;
                })
        },
        addFiles(file) {
            this.files.push(file);
        },
        fetchVacs() {
            axios.get('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php?type=getVacancyList&offset=' + this.currentPage)
                .then(res => {
                    this.vacs = res.data.data;
                    this.countPages = res.data.page_count;
                })
        },
        changePage(page) {
            this.currentPage = page;
            this.fetchVacs();
        }
    }
}
</script>

<style scoped lang="scss">
@import "../styles_fonts";

$font-Inter: Inter, 'Inter';

.resume {
    width: 100%;
    height: calc(100vh - 30px);
    margin: 15px 0;


    .resume-list {
        margin: 0 auto;
        width: calc(100% - 56px);
        grid-gap: 20px;
        display: flex;
        flex-direction: column;

        .resume-search {
            background: #fff;
            align-items: center;
            justify-content: space-evenly;
            padding: 0 18px;
            display: grid;
            grid-template-columns: 3.5fr 1.2fr;
            border-radius: 0px 0px 20px 20px;


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

        .blocks-wrap {
            width: 100%;
            display: flex;
            grid-gap: 15px;


            .half-blocks {
                width: 50%;
                display: flex;
                flex-direction: column;
                grid-gap: 15px;


                .info-block {
                    width: 100%;
                    background: #fff;
                    border-radius: 20px;

                    .info-wrap {
                        width: calc(100% - 60px);
                        padding: 30px;


                        h3 {
                            margin-top: 0;
                            font-family: $font-Inter;
                            font-style: normal;
                            font-weight: 500;
                            font-size: 26px;
                            line-height: 34px;
                            text-align: justify;
                            color: #1E2437;
                        }

                        .main-info {
                            width: 100%;
                            display: grid;
                            grid-template-columns: 1fr 5fr;
                            grid-gap: 20px;


                            .avatar {
                                margin-top: 10px;

                                img {
                                    width: 120px;
                                    height: 120px;
                                    object-fit: cover;
                                    border-radius: 50%;
                                    box-shadow: 1px 1px 3px 0px #000;
                                }
                            }

                            .info {
                                display: flex;
                                flex-direction: column;


                                label {
                                    font-family: $font-Inter;
                                    font-style: normal;
                                    font-weight: normal;
                                    font-size: 15px;
                                    line-height: 110%;
                                    /* identical to box height, or 18px */
                                    text-align: justify;
                                    color: #9299B0;
                                    margin: 0 0 7px 0;
                                }

                                p {
                                    margin: 0;
                                    font-family: $font-Inter;
                                    font-style: normal;
                                    font-weight: 500;
                                    font-size: 21px;
                                    line-height: 110%;
                                    /* or 24px */
                                    text-align: justify;
                                    color: #1E2437;
                                }

                                .contacts {
                                    display: grid;
                                    grid-template-columns: 1fr 1fr;
                                    grid-gap: 15px;
                                    margin-bottom: 25px;
                                }

                            }

                        }

                        .desc-wrap {

                            p {
                                font-family: $font-Inter;
                                font-style: normal;
                                font-weight: normal;
                                font-size: 18px;
                                line-height: 150%;
                                /* or 27px */
                                color: #1E2437;
                                text-align: justify;
                            }
                        }

                        .tasks-block {
                            display: flex;
                            flex-direction: column;
                            width: 100%;
                            margin-bottom: 33px;

                            label {
                                font-family: $font-Inter;
                                font-style: normal;
                                font-weight: normal;
                                font-size: 16px;
                                line-height: 110%;
                                text-align: justify;
                                color: #9299B0;
                                margin-bottom: 8px;
                            }

                            a {
                                cursor: pointer;
                                width: 100%;
                                height: 60px;
                                background: #FFFFFF;
                                border: 1px solid #EDEDF2;
                                box-sizing: border-box;
                                border-radius: 6px;
                                display: flex;
                                align-items: center;
                                margin-bottom: 12px;

                                &:hover {
                                    transition: all .9s;
                                    background: #1253ff;

                                    p, span, i {
                                        color: white !important;
                                    }
                                }

                                p {
                                    padding-left: 27px;
                                    margin: 0;
                                    font-family: $font-Inter;
                                    font-style: normal;
                                    font-weight: 500;
                                    font-size: 18px;
                                    line-height: 110%;
                                    /* identical to box height, or 20px */
                                    text-align: justify;
                                    color: #1E2437;
                                }
                            }

                            .received {
                                display: flex;
                                align-items: center;
                                justify-content: space-between;

                                .task-received {
                                    display: flex;
                                    flex-direction: column;
                                    padding-left: 27px;

                                    .title-task {
                                        font-family: $font-Inter;
                                        font-style: normal;
                                        font-weight: 500;
                                        font-size: 18px;
                                        line-height: 110%;
                                        /* identical to box height, or 20px */
                                        text-align: justify;
                                        color: #1E2437;
                                        margin-bottom: 3px;
                                    }

                                    .title-file {
                                        font-family: $font-Inter;
                                        font-style: normal;
                                        font-weight: normal;
                                        font-size: 14px;
                                        line-height: 110%;
                                        /* identical to box height, or 18px */
                                        text-align: justify;
                                        color: #9299B0;
                                    }

                                }

                                p.date {
                                    font-family: $font-Inter;
                                    font-style: normal;
                                    font-weight: normal;
                                    font-size: 16px;
                                    line-height: 110%;
                                    /* identical to box height, or 18px */
                                    text-align: right;
                                    color: #9299B0;
                                    padding-right: 27px;
                                }
                            }

                            textarea {
                                resize: none;
                                padding: 15px 27px;
                                font-family: $font-Inter;
                                font-style: normal;
                                font-weight: normal;
                                font-size: 18px;
                                line-height: 150%;
                                background: #FFFFFF;
                                border: 1px solid #9299B0;
                                box-sizing: border-box;
                                border-radius: 6px;
                                color: #1E2437;

                                &:focus {
                                    outline: none;
                                }
                            }
                        }

                        .buttons-block {
                            display: flex;

                            button {
                                font-family: $font-Inter;
                                font-style: normal;
                                font-weight: normal;
                                font-size: 18px;
                                line-height: 100%;
                                text-align: center;
                                flex: none;
                                order: 0;
                                flex-grow: 0;
                                margin: 10px 0px;
                                padding: 13px 32px;
                                background: #FFFFFF;
                                box-sizing: border-box;
                                border-radius: 6px;
                                cursor: pointer;
                                transition: all .4s;
                            }

                            .accept {
                                color: #0047FF;
                                margin-right: 17px;
                                border: 1px solid #0047FF;

                                &:hover {
                                    color: #fff;
                                    background: #0047FF;
                                }
                            }

                            .decline {
                                border: 1px solid #ED2B2B;
                                color: #ED2B2B;

                                &:hover {
                                    color: #fff;
                                    background: #ED2B2B;
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

                            .table-head {
                                padding: 0 30px;
                                grid-template-columns: 1.5fr .85fr 1fr;
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
                                grid-template-columns: 1.5fr .85fr 1fr;
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

                                &:nth-child(3) {
                                    justify-content: center;
                                }


                                p, i {
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
<style src="vue2-dropzone/dist/vue2Dropzone.min.css"></style>