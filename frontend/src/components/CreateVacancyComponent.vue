<template>
    <div id="create-vacancy">

        <div class="creating-form">
            <h2>Добавление вакансии</h2>

            <tabs class="tabs" style="font-family: 'Inter'; font-size: 14px;">
                <tab title="Основная информация">

                    <h3>Основная информация</h3>

                    <div class="block-inputs">
                        <div class="input-info">
                            <label>Введите название вакансии</label>
                            <input type="text" v-model="titleVacancy">
                        </div>
                        <div class="input-info">
                            <label style="margin-bottom: 15px">Укажите опыт работы <b>{{calculatedExperience}}</b></label>
                            <SliderComponent
                                :min="minY"
                                :max="maxY"
                                @updateMin="updateMinYears"
                                @updateMax="updateMaxYears"
                            >

                            </SliderComponent>

                        </div>
                        <div class="input-info">
                            <label>Выберите регион</label>
                            <!--                            <input type="text">-->
                            <VSuperSelect
                                @change="setRegion"
                                class="select-region"
                                :inputWidth="'374px'"
                                :placeholder="'Введите регион'"
                                :items="regions"
                            >

                            </VSuperSelect>
                        </div>
                        <div class="input-info dist">
                            <label>Возможность работать дистанционно</label>
                            <div class="dist" style="background: #FAFAFF;" @click="dist = !dist">
                                <input v-model="dist" type="checkbox" id="dist" title="Возможно">
                                <label style="user-select: none" for="dist"
                                       @click="dist = !dist">{{ dist ? 'Не возможна' : 'Возможна' }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="textarea-block">
                        <label>Опишите вакансию</label>
                        <textarea class="area-edit"  v-model="disc">

                        </textarea>
                    </div>

                    <div class="textarea-block">
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

                </tab>

                <tab title="Чем предстоит заниматься">

                    <h3>Чем предстоит заниматься</h3>
                    <label>Перечень обязанностей</label>


                    <vue-tags-input
                        v-for="tags in todos"
                        class="tags-block"
                        v-model="tags.current"
                        :tags="tags.tags"
                        :placeholder="'ввод требования..'"
                        :autocomplete-min-length="1"
                        :allow-edit-tags="true"

                        :autocomplete-items="filteredItems(tags)"
                        @tags-changed="newTags => checkTag(tags, newTags)"
                    />

                    <button class="add-tags-block" @click="addTodo">Добавить требование</button>


                </tab>
                <tab title="Ключевые требования">
                    <h3>Ключевые требования</h3>
                    <label>Ключевые требования</label>

                    <vue-tags-input
                        v-for="tags in requirements"
                        class="tags-block"
                        v-model="tags.current"
                        :tags="tags.tags"
                        :placeholder="'ввод требования..'"
                        :autocomplete-min-length="1"
                        :allow-edit-tags="true"

                        :autocomplete-items="filteredItems(tags)"
                        @tags-changed="newTags => checkTag(tags, newTags)"
                    />


                    <button class="add-tags-block" @click="addRequirement">Добавить требование</button>
                </tab>

                <tab title="Мы предлагаем">
                    <h3>Мы предлагаем</h3>
                    <label>Мы предлагаем</label>

                    <vue-tags-input
                        v-for="tags in offers"
                        class="tags-block"
                        v-model="tags.current"
                        :tags="tags.tags"
                        :placeholder="'ввод условия..'"
                        :autocomplete-min-length="1"
                        :allow-edit-tags="true"

                        :autocomplete-items="filteredItems(tags)"
                        @tags-changed="newTags => checkTag(tags, newTags)"
                    />


                    <button class="add-tags-block" @click="addOffer">Добавить условия</button>
                </tab>
            </tabs>

            <button class="add-button" @click="saveVacancy">Добавить вакансию</button>
        </div>

        <div class="back">
            <a class="close-button" @click="close">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.989522 1.01254C0.696627 1.30544 0.696629 1.78031 0.989523 2.07321L5.9392 7.02288L0.989458 11.9726C0.696566 12.2655 0.696565 12.7404 0.989458 13.0333C1.28235 13.3262 1.75722 13.3262 2.05011 13.0333L6.99986 8.08354L11.9497 13.0334C12.2426 13.3263 12.7174 13.3263 13.0103 13.0334C13.3032 12.7405 13.3032 12.2656 13.0103 11.9727L8.06051 7.02287L13.0102 2.07314C13.3031 1.78025 13.3031 1.30538 13.0102 1.01248C12.7173 0.719591 12.2425 0.719592 11.9496 1.01248L6.99986 5.96222L2.05018 1.01255C1.75729 0.719651 1.28241 0.719652 0.989522 1.01254Z" fill="#fff"/>
                </svg>
            </a>
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
    name: "CreateVacancyComponent",
    created() {
        // получение ключевых слов
        axios.get('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php?type=getKeywords')
            .then(res => {
                this.keyWordsBank = res.data.map((el) => {
                    el.text = el.title;
                    return el;
                });
                this.todos[0].keyWords = this.keyWordsBank;
                this.requirements[0].keyWords = this.keyWordsBank;
                this.offers[0].keyWords = this.keyWordsBank;
            });
    },
    methods: {
        onInputDesc(e){
            this.disc = e.target.innerText;
        },
        setRegion(reg){
            this.selectedRegion = reg.$index;
        },
        saveVacancy(){

            let duties = [];
            for(let i = 0; i < this.todos.length; i++){
                // определение текста и парсинг кейвордов
                let text = '';
                let keyword = [];

                let currentTodo = this.todos[i].tags;

                for(let j = 0; j < currentTodo.length; j++){
                    if(currentTodo[j].id){
                        keyword.push(currentTodo[j].id);
                    }

                    text += ' ' + currentTodo[j].text;
                }

                duties.push({
                    text: text,
                    keyword: keyword
                });
            }


            let skills = [];
            for(let i = 0; i < this.requirements.length; i++){
                // определение текста и парсинг кейвордов
                let text = '';
                let keyword = [];

                let current = this.requirements[i].tags;

                for(let j = 0; j < current.length; j++){
                    if(current[j].id){
                        keyword.push(current[j].id);
                    }

                    text += ' ' + current[j].text;
                }

                skills.push({
                    text: text,
                    keyword: keyword
                });
            }

            let suggest = [];
            for(let i = 0; i < this.offers.length; i++){
                // определение текста и парсинг кейвордов
                let text = '';
                let keyword = [];

                let current = this.offers[i].tags;

                for(let j = 0; j < current.length; j++){
                    if(current[j].id){
                        keyword.push(current[j].id);
                    }

                    text += ' ' + current[j].text;
                }

                suggest.push({
                    text: text,
                    keyword: keyword
                });
            }

            let params = {
                "type": "createVacancy",
                "title": this.titleVacancy,
                "work_start": this.minY,
                "word_end": this.maxY,
                "region_id": this.selectedRegion,
                "is_distant": this.dist,
                "description": this.disc,
                "duties":duties,
                "skills": skills,
                "suggest": suggest
            }

            axios.post('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php', params)
            .then(res => {
                let id = res.data.id;
                let data = new FormData();
                data.append('id_vacancy', id);
                for(let i = 0; i < this.files.length; i++){
                    data.append('upload[]', this.files[i]);
                }

                axios.post('http://hr-gazprombank.creativityprojectcenter.ru/core/Files/uploadTask.php', data)
                .then(res => {
                    this.$emit('close');
                    //console.log(res + 'файлы')
                })
                
            })
        },
        addFiles(file) {
            this.files.push(file);
        },
        close(){
            this.$emit('close');
        },
        updateMinYears(y){
            this.minY = y;
        },
        updateMaxYears(y){
            this.maxY = y;
        },
        addTodo() {
            this.todos.push({
                current: '',
                tags: [],
                keyWords: this.keyWordsBank
            });
        },

        addRequirement() {
            this.requirements.push({
                current: '',
                tags: [],
                keyWords: this.keyWordsBank
            });
        },


        addOffer() {
            this.offers.push({
                current: '',
                tags: [],
                keyWords: this.keyWordsBank
            });
        },



        checkTag(objTags, newTags) {

            objTags.tags = newTags;  // добавление тега
            objTags.tags[objTags.tags.length - 1].style = 'background: #fff; '; // дефолтные стили для тега

            // проверка что кейворд
            let flag = false;
            for (let i = 0; i < objTags.keyWords.length; i++) {
                if (objTags.keyWords[i].text === objTags.tags[objTags.tags.length - 1].text) {
                    flag = true;
                    break;
                }
            }
            // закрашивание
            if (flag) {
                objTags.tags[objTags.tags.length - 1].style = objTags.tags[objTags.tags.length - 1].style + 'color: #5E8BFF; border: 1px dashed #5E8BFF;';
            } else {
                objTags.tags[objTags.tags.length - 1].style = objTags.tags[objTags.tags.length - 1].style + 'color: #403e3e;';
            }
        },
        filteredItems(tagsItem) {
            return tagsItem.keyWords.filter(i => {
                return i.text.toLowerCase().indexOf(tagsItem.current.toLowerCase()) !== -1;
            }).slice(0,3);
        },
    },
    computed: {
        calculatedExperience(){
            return `(от ${this.minY} до ${this.maxY} лет)`;
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
    z-index: 8;


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

    .creating-form {
        width: 50vw;
        height: 90vh;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
        position: fixed;
        z-index: 10;
        background: #fff;
        display: flex;
        flex-direction: column;
        padding: 15px 30px;
        border-radius: 20px;
        overflow-y: auto;
        -webkit-animation: scale-up-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        animation: scale-up-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;

        &::-webkit-scrollbar {
            width: 0;
        }

        h2 {
            font-family: $font-Inter;
            margin: 10px 0;
            font-style: normal;
            font-weight: 500;
            font-size: 28px;
            line-height: 34px;
            /* identical to box height */

            text-align: justify;

            color: #1E2437;
        }


        .tabs {
            margin-bottom: 18px;

            h3 {
                margin: 10px 0 20px 0;
                /* BlockHeader */

                font-family: $font-Inter;
                font-style: normal;
                font-weight: 500;
                font-size: 26px;
                line-height: 34px;
                /* identical to box height */

                text-align: justify;

                color: #1E2437;
            }

            label {
                font-family: $font-Inter;
                font-style: normal;
                font-weight: normal;
                font-size: 14px;
                line-height: 150%;
                /* identical to box height, or 24px */
                text-align: justify;
                margin-bottom: 5px;
                color: #9299B0;
            }


            .block-inputs {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-gap: 15px;

                .input-info {
                    display: flex;
                    flex-direction: column;

                    input {
                        &:focus {
                            outline: none;
                            border: 1px solid #0047FF;
                        }

                        border: 1px solid #EDEDF2;
                        box-sizing: border-box;
                        border-radius: 6px;
                        padding: 15px 30px;
                        font-family: $font-Inter;
                        font-style: normal;
                        font-weight: normal;
                        font-size: 14px;
                        line-height: 150%;
                        /* identical to box height, or 24px */
                        text-align: justify;
                        color: #9299B0;
                    }

                    .select-region {
                        width: 100%;
                    }

                    .slider {
                        width: 100%;
                    }

                    .dist {
                        width: 315px;
                        height: 52px;
                        display: flex;
                        justify-content: flex-start;
                        align-items: center;
                        flex-direction: row;
                        grid-gap: 10px;
                        border: 1px solid #EDEDF2;
                        box-sizing: border-box;
                        border-radius: 6px;
                        padding: 0 30px;
                        cursor: pointer;
                        transition: all .4s;

                        label {
                            margin: 0;
                            font-family: $font-Inter;
                            font-style: normal;
                            font-weight: normal;
                            font-size: 16px;
                            line-height: 150%;
                            /* identical to box height, or 27px */

                            text-align: justify;
                            cursor: pointer;
                            color: #1E2437;
                        }

                        input {
                            cursor: pointer;
                        }
                    }
                }


                margin-bottom: 15px;
            }

            .textarea-block {
                display: flex;
                flex-direction: column;
                margin-top: 15px;

                label {
                    font-family: $font-Inter;
                    font-style: normal;
                    font-weight: normal;
                    font-size: 14px;
                    line-height: 150%;
                    /* identical to box height, or 24px */

                    text-align: justify;
                    margin-bottom: 5px;
                    color: #9299B0;
                }

                .area-edit {
                    resize: none;
                    width: calc(100% - 60px);
                    height: 140px;
                    border: 1px solid #EDEDF2;
                    background: #FFFFFF;
                    border-radius: 5px;
                    padding: 15px 30px;
                    font-family: $font-Inter;
                    font-style: normal;
                    font-weight: normal;
                    font-size: 14px;
                    line-height: 150%;
                    overflow-y: auto;

                    &::-webkit-scrollbar {
                        width: 0;
                    }

                    &:focus {
                        outline: none;
                        border: 1px solid #0047FF;
                    }
                }

                .input-block {
                    width: 100%;
                    border: 2px dashed #EDEDF2;
                    box-sizing: border-box;
                    border-radius: 6px;

                }
            }


            /deep/ .tags-block {
                z-index: 1000;
                width: 100%;
                margin: 5px 0 15px 0;
                max-width: none;
/*                -webkit-animation: scale-up-top 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                animation: scale-up-top 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;*/
                 .ti-input {
                    border-radius: 10px;
                     padding: 7px 8px;
                     font-family: $font-Inter;
                     font-style: normal;
                     font-weight: normal;
                     font-size: 18px;
                     line-height: 150%;
                     text-align: justify;
                     color: #1E2437;
                }
            }

            .vue-tags-input {

            }



            .ti-focus {
                z-index: 1001;
            }


            .add-tags-block {
                background: #FFFFFF;
                border: 1px solid #0047FF;
                box-sizing: border-box;
                border-radius: 6px;
                margin-top: 5px;
                font-family: $font-Inter;
                font-style: normal;
                font-weight: normal;
                font-size: 18px;
                line-height: 100%;
                padding: 8px 7px;
                cursor: pointer;
                text-align: center;
                color: #0047FF;

                &:focus {
                    outline: none;
                }

                &:hover {
                    color: #fff;
                    background: #0047FF;
                    transition: all .35s;
                }

                &:active {
                    transform: scale(.98);
                }
            }

        }

        .add-button {
            cursor: pointer;
            font-family: $font-Inter;
            background: #0047FF;
            border-radius: 6px;
            border: none;
            font-style: normal;
            font-weight: normal;
            font-size: 18px;
            line-height: 100%;
            text-align: center;
            color: #FFFFFF;
            width: 240px;
            height: 40px;
            padding: 10px 0;


            &:active {
                transition: all .1s;
                transform: scale(.98);
            }

            &:focus {
                outline: none;
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
        -webkit-transform: scale(0.5) translateY(-50%) translateX(-50%);
        transform: scale(0.5) translateY(-50%) translateX(-50%);
    }
    100% {
        -webkit-transform: scale(1) translateY(-50%) translateX(-50%);
        transform: scale(1) translateY(-50%) translateX(-50%);
    }
}
@keyframes scale-up-center {
    0% {
        -webkit-transform: scale(0.5) translateY(-50%) translateX(-50%);
        transform: scale(0.5) translateY(-50%) translateX(-50%);
    }
    100% {
        -webkit-transform: scale(1) translateY(-50%) translateX(-50%);
        transform: scale(1) translateY(-50%) translateX(-50%);
    }
}


</style>

<style src="vue-slim-tabs/themes/default.css"></style>
<style src="vue2-dropzone/dist/vue2Dropzone.min.css"></style>
