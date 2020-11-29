<template>
    <div id="create-vacancy">

        <div class="back">
            <a class="close-button" @click="close">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.989522 1.01254C0.696627 1.30544 0.696629 1.78031 0.989523 2.07321L5.9392 7.02288L0.989458 11.9726C0.696566 12.2655 0.696565 12.7404 0.989458 13.0333C1.28235 13.3262 1.75722 13.3262 2.05011 13.0333L6.99986 8.08354L11.9497 13.0334C12.2426 13.3263 12.7174 13.3263 13.0103 13.0334C13.3032 12.7405 13.3032 12.2656 13.0103 11.9727L8.06051 7.02287L13.0102 2.07314C13.3031 1.78025 13.3031 1.30538 13.0102 1.01248C12.7173 0.719591 12.2425 0.719592 11.9496 1.01248L6.99986 5.96222L2.05018 1.01255C1.75729 0.719651 1.28241 0.719652 0.989522 1.01254Z" fill="#fff"/>
                </svg>
            </a>
        </div>

        <div class="verdict">
            <h3>Принятие решения</h3>
            <p>Примите решение о резюме Андрея Сергеевича</p>
            <div class="buttons">
                <button @click="accept">Принять резюме</button>
                <button @click="deny">Отклонить резюме</button>
            </div>
        </div>


    </div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';
import VSuperSelect from 'v-super-select';
import SliderComponent from "./SliderComponent";
import vue2Dropzone from 'vue2-dropzone'
import axios from 'axios';


export default {
    components: {
        VueTagsInput,
        VSuperSelect,
        SliderComponent,
        vueDropzone: vue2Dropzone
    },
    props: ['id'],
    data() {
        return {
            files: [],
            regions: [
                {
                    text: 'Владимирская область',
                    value: '0',
                },
                {
                    text: 'Воронежская область',
                    value: '1',
                },
                {
                    text: 'Ивановская область',
                    value: '2',
                },
                {
                    text: 'Калужская область',
                    value: '3',
                },
                {
                    text: 'Костромская область',
                    value: '4',
                },
                {
                    text: 'Курская область',
                    value: '5',
                },
                {
                    text: 'Липецкая область',
                    value: '6',
                },
                {
                    text: 'Московская область',
                    value: '7',
                }
            ],
            query: '',
            selectedTags: [
                {key: 'web-development', value: 'Web Development'},
                {key: 'php', value: 'PHP'},
                {key: 'javascript', value: 'JavaScript'},
            ],
            tag: '',

            // наборы ключевых слов
            todos: [{
                current: '',
                tags: [],
                keyWords: [],
            }],
            requirements: [{
                current: '',
                tags: [],
                keyWords: [],
            }],
            offers: [{
                current: '',
                tags: [],
                keyWords: [],
            }],

            // хранилище всех ключевых слов
            keyWordsBank: [],

            // данные вакансии

            titleVacancy: 'Веб разработчик',
            // опыт работы
            minY: 0,
            maxY: 10,
            selectedRegion: '2',
            dist: false,
            disc: 'Кушать печеньки писать код',

        }
    },
    name: "VerdictComponent",
    methods: {
        accept(){
            axios.post('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php', {
                type: 'applyUser',
                id: this.id
            })
            .then(() => {
                this.close();
            })
        },
        deny(){
            axios.post('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php', {
                type: 'denyUser',
                id: this.id
            })
                .then(() => {
                    this.close();
                })
        },
        close(){
            this.$emit('close');
        }
    }
}
</script>

<style scoped lang="scss">
@import "../styles_fonts";

$font-Inter: Inter, 'Inter';


#create-vacancy {
    width: 100vw;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 101;


    .back {
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9;
        background: rgba(0, 0, 0, .55);

        .close-button {
            position: fixed;
            right: 4vw;
            top: 4vh;
            width: 24px;
            cursor: pointer;
            height: 24px;
            svg {
                width: 24px;
                height: 24px;
            }
        }
    }

    .verdict {
        -webkit-animation: scale-up-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        animation: scale-up-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        width: 40vw;
        height: 30vh;
        position: fixed;
        background: #fff;
        border-radius: 20px;
        z-index: 102;
        top: 20%;
        left: 30vw;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        padding: 0 50px;

        h3 {
            font-family: $font-Inter;
            font-style: normal;
            font-weight: 500;
            font-size: 28px;
            line-height: 34px;
            /* identical to box height */
            text-align: justify;
            color: #1E2437;
            margin: 0;
        }

        p {
            font-family: $font-Inter;
            font-style: normal;
            font-weight: normal;
            font-size: 18px;
            line-height: 150%;
            /* identical to box height, or 27px */
            text-align: justify;
            color: #000000;
            margin: 0;
        }

        .buttons {
            button {
                font-family: $font-Inter;
                font-style: normal;
                font-weight: normal;
                font-size: 18px;
                line-height: 100%;
                /* identical to box height, or 18px */
                text-align: center;
                color: #FFFFFF;
                padding: 13px 32px;
                background: #0047FF;
                border-radius: 6px;
                border: none;
                cursor: pointer;
                margin-right: 12px;

                &:focus {
                    outline: none;
                }

                &:active {
                    transition: all .3s;
                    transform: scale(.98);
                }

                flex: none;
                order: 0;

                &:nth-child(2){
                    background: #ED2B2B;
                }
            }
        }


    }

}

/* ----------------------------------------------
 * Generated by Animista on 2020-11-28 11:35:44
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
 * Generated by Animista on 2020-11-28 16:29:11
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info.
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

/**
 * ----------------------------------------
 * animation scale-up-center
 * ----------------------------------------
 */
@-webkit-keyframes scale-up-center {
    0% {
        -webkit-transform: scale(0.5) ;
        transform: scale(0.5) ;
    }
    100% {
        -webkit-transform: scale(1) ;
        transform: scale(1) ;
    }
}
@keyframes scale-up-center {
    0% {
        -webkit-transform: scale(0.5) ;
        transform: scale(0.5) ;
    }
    100% {
        -webkit-transform: scale(1) ;
        transform: scale(1) ;
    }
}


</style>

<style src="vue-slim-tabs/themes/default.css"></style>
<style src="vue2-dropzone/dist/vue2Dropzone.min.css"></style>
