<template>
    <div id="wrap">
        <h1>Фильтры</h1>
        <div class="filter-block vacancy">
            <div class="filter-title">
                <p>Вакансии</p>
                <div class="search-box">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="path-1-inside-1" fill="white">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5871 11.4419C13.5394 10.2462 14.1084 8.7318 14.1084 7.08447C14.1084 3.21848 10.9744 0.0844727 7.1084 0.0844727C3.24241 0.0844727 0.108398 3.21848 0.108398 7.08447C0.108398 10.9505 3.24241 14.0845 7.1084 14.0845C8.78672 14.0845 10.3271 13.4938 11.533 12.5091L14.7197 15.6957C15.0126 15.9886 15.4874 15.9886 15.7803 15.6957C16.0732 15.4028 16.0732 14.928 15.7803 14.6351L12.5871 11.4419Z"/>
                        </mask>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5871 11.4419C13.5394 10.2462 14.1084 8.7318 14.1084 7.08447C14.1084 3.21848 10.9744 0.0844727 7.1084 0.0844727C3.24241 0.0844727 0.108398 3.21848 0.108398 7.08447C0.108398 10.9505 3.24241 14.0845 7.1084 14.0845C8.78672 14.0845 10.3271 13.4938 11.533 12.5091L14.7197 15.6957C15.0126 15.9886 15.4874 15.9886 15.7803 15.6957C16.0732 15.4028 16.0732 14.928 15.7803 14.6351L12.5871 11.4419Z" fill="white"/>
                        <path d="M12.5871 11.4419L11.4138 10.5074L10.5793 11.5553L11.5265 12.5026L12.5871 11.4419ZM11.533 12.5091L12.5936 11.4484L11.6347 10.4894L10.5842 11.3472L11.533 12.5091ZM15.7803 15.6957L16.841 16.7564L16.841 16.7564L15.7803 15.6957ZM12.6084 7.08447C12.6084 8.38029 12.1621 9.56774 11.4138 10.5074L13.7605 12.3764C14.9166 10.9247 15.6084 9.08331 15.6084 7.08447H12.6084ZM7.1084 1.58447C10.146 1.58447 12.6084 4.04691 12.6084 7.08447H15.6084C15.6084 2.39005 11.8028 -1.41553 7.1084 -1.41553V1.58447ZM1.6084 7.08447C1.6084 4.04691 4.07083 1.58447 7.1084 1.58447V-1.41553C2.41398 -1.41553 -1.3916 2.39005 -1.3916 7.08447H1.6084ZM7.1084 12.5845C4.07083 12.5845 1.6084 10.122 1.6084 7.08447H-1.3916C-1.3916 11.7789 2.41398 15.5845 7.1084 15.5845V12.5845ZM10.5842 11.3472C9.63631 12.1213 8.42846 12.5845 7.1084 12.5845V15.5845C9.14498 15.5845 11.0179 14.8663 12.4818 13.6709L10.5842 11.3472ZM15.7803 14.6351L12.5936 11.4484L10.4723 13.5697L13.659 16.7564L15.7803 14.6351ZM14.7197 14.6351C15.0126 14.3422 15.4874 14.3422 15.7803 14.6351L13.659 16.7564C14.5377 17.6351 15.9623 17.6351 16.841 16.7564L14.7197 14.6351ZM14.7197 15.6957C14.4268 15.4028 14.4268 14.928 14.7197 14.6351L16.841 16.7564C17.7197 15.8777 17.7197 14.4531 16.841 13.5744L14.7197 15.6957ZM11.5265 12.5026L14.7197 15.6957L16.841 13.5744L13.6478 10.3812L11.5265 12.5026Z" fill="#9299B0" mask="url(#path-1-inside-1)"/>
                    </svg>
                    <input type="text" v-model="searchText" placeholder="поиск..">
                </div>
            </div>

            <div class="filter-cont">
                <div class="filter-item" v-for="(vac,index) in filterVacs">

                    <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="6" height="6" rx="1" :fill="vac.checked ? '#0047FF' : '#D1D1DC'"/>
                    </svg>

                    <p
                        @click="setVacancy(index)"
                        :class="vac.checked ? 'active' : 'unactive'">{{ vac.title }}</p>
                </div>
            </div>
        </div>
        <div class="filter-block status">
            <div class="filter-title">
                <p>Статус</p>
            </div>

            <div class="filter-cont">
                <div class="filter-item" v-for="(status,index) in statuses">

                    <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="6" height="6" rx="1" :fill="status.checked ? '#0047FF' : '#D1D1DC'"/>
                    </svg>

                    <p
                        @click="setStatus(index)"
                        :class="status.checked ? 'active' : 'unactive'">{{status.title}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "FiltersComponent",
    data(){
        return {
            searchText: '',
            vacs : [],
            statuses: [
                {
                    id: 0,
                    title: 'В обработке',
                    checked: 1
                },
                {
                    id: 1,
                    title: 'Отправлено тестовое задание',
                    checked: 1
                },
                {
                    id: 2,
                    title: 'Тест пройден',
                    checked: 1
                },
                {
                    id: 3,
                    title: 'Тест не пройден',
                    checked: 1
                },
                {
                    id: 4,
                    title: 'Принят',
                    checked: 1
                },
                {
                    id: 5,
                    title: 'Отклонен',
                    checked: 1
                },
            ],
            statusParams: '',
            vacancyParams: '',
        }
    },
    methods: {
        setStatus(ind){
            this.statuses[ind].checked = !this.statuses[ind].checked;
            let strParams = '';
            for(let i = 0; i < this.statuses.length; i++){
                if(this.statuses[i].checked){
                    strParams += '&status[]='+this.statuses[i].id.toString();
                }
            }
            this.statusParams = strParams;
            this.$emit('setted', {
                statusParams: this.statusParams,
                vacancyParams: this.vacancyParams
            });
        },
        setVacancy(ind){
            this.vacs[ind].checked = !this.vacs[ind].checked;
            let strParams = '';
            for(let i = 0; i < this.vacs.length; i++){
                if(this.vacs[i].checked){
                    strParams += '&filter[]='+this.vacs[i].id.toString();
                }
            }
            this.vacancyParams = strParams;
            this.$emit('setted', {
                statusParams: this.statusParams,
                vacancyParams: this.vacancyParams
            });
        }
    },
    created(){
        axios.get('http://hr-gazprombank.creativityprojectcenter.ru/api/api.php?type=getVacancyList')
        .then(res => {
            this.vacs = res.data.data.map(el => {
                el.checked = 1;
                return el;
            });

            let strParams = '';
            for(let i = 0; i < this.vacs.length; i++){
                if(this.statuses[i].checked){
                    strParams += '&filter[]='+this.vacs[i].id.toString();
                }
            }
            this.vacancyParams = strParams;


            strParams = '';
            for(let i = 0; i < this.statuses.length; i++){
                if(this.statuses[i].checked){
                    strParams += '&status[]='+this.statuses[i].id.toString();
                }
            }
            this.statusParams = strParams;

            this.$emit('setted', {
                statusParams: this.statusParams,
                vacancyParams: this.vacancyParams
            });

        })
    },
    computed: {
        filterVacs(){
            return this.vacs.filter(i => {
                return i.title.toLowerCase().indexOf(this.searchText.toLowerCase()) !== -1;
            });
        }
    }
}
</script>

<style lang="scss" scoped>

@import "../styles_fonts";
$font-Inter: Inter, 'Inter';


#wrap {
    width: 100%;
    height: 100%;
    display: grid;
    grid-template-rows: .3fr 2fr 1.5fr;

    h1 {
        margin: 0;
        font-family: $font-Inter;
        font-style: normal;
        font-weight: 500;
        font-size: 28px;
        line-height: 34px;
        /* identical to box height */

        text-align: justify;

        color: #1E2437;

    }


    .filter-block {
        //justify-content: space-between;
        background: #fff;
        box-sizing: border-box;
        border-radius: 20px;
        padding: 10px 12px;
        display: flex;
        flex-direction: column;

        .filter-title {
            width: 100%;
            p {
                font-family: $font-Inter;
                font-style: normal;
                font-weight: 500;
                font-size: 18px;
                line-height: 150%;
                text-align: justify;
                color: #1E2437;
                margin: 1px 0 10px 0;
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
                padding: 0 7px;


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
        }

        .filter-cont {
            overflow-y: scroll;
            &::-webkit-scrollbar {
                width: 0;
            }
            width: 100%;
            display: flex;
            flex-direction: column;

            .filter-item {
                display: flex;
                padding: 10px 0;
                justify-content: space-between;


                svg {
                    width: 6px;
                    height: 6px;
                    margin-top: 7px;
                }

                p {
                    cursor: pointer;
                    width: calc(100% - 20px);
                    margin: 0;
                    font-family: $font-Inter;
                    font-style: normal;
                    font-weight: normal;
                    font-size: 16px;
                    line-height: 130%;
                    color: #1E2437;

                }

                .active {

                    color: #1E2437;
                    &:hover {
                        color: #727272;
                    }
                }

                .unactive {
                    color: #D1D1DC;

                    &:hover {
                        color: #0047FF;
                    }
                }
            }
        }
    }

    .vacancy {
        .filter-title {
            height: 77px;
        }

        .filter-cont {
            max-height: calc(100% - 85px);
        }

        max-height: 340px;
    }

    .status {
        .filter-title {
            height: 35px;
        }

        .filter-cont {
            max-height: calc(100% - 40px);
        }

        max-height: 250px;


    }

}

/* ----------------------------------------------
 * Generated by Animista on 2020-11-27 21:18:32
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info.
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

/**
 * ----------------------------------------
 * animation slide-top
 * ----------------------------------------
 */
@-webkit-keyframes slide-top {
    0% {
        -webkit-transform: translateY(100px);
        transform: translateY(100px);
    }
    100% {
        -webkit-transform: translateY(0px);
        transform: translateY(0px);
    }
}
@keyframes slide-top {
    0% {
        -webkit-transform: translateY(100px);
        transform: translateY(100px);
    }
    100% {
        -webkit-transform: translateY(0px);
        transform: translateY(0px);
    }
}


</style>