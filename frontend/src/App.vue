<template>
    <div id="app" style="overflow-x:hidden;">
        <div class="wrapper">
            <div class="menu-wrap">
                <div class="menu">
                    <div class="menu-item" @click="setCurrentPath()" :class="currentPath === 'resumeList' ? 'active' : ''">
                        <router-link to="/">
                            <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.9987 9.85654C13.8246 9.85654 11.889 8.3873 11.2958 6.28354C11.1704 5.84924 11.1062 5.39337 11.1062 4.92827C11.1062 4.46624 11.1704 4.01038 11.2958 3.573C11.8921 1.46924 13.8246 0 15.9987 0C18.6957 0 20.8912 2.21156 20.8912 4.92827C20.8912 7.64498 18.6987 9.85654 15.9987 9.85654ZM15.9987 1.54008C14.5034 1.54008 13.1733 2.55038 12.7635 3.99806C12.6779 4.29991 12.6351 4.61101 12.6351 4.92827C12.6351 5.24553 12.6779 5.5597 12.7635 5.85848C13.1733 7.30616 14.5034 8.31645 15.9987 8.31645C17.8548 8.31645 19.3623 6.79793 19.3623 4.92827C19.3623 3.05861 17.8548 1.54008 15.9987 1.54008Z" fill="#0047FF"/>
                                <path d="M18.3378 23.7418C17.977 23.7418 17.607 23.7357 17.2248 23.7295C16.4297 23.7172 15.5674 23.7172 14.7724 23.7295C12.4515 23.7634 10.4517 23.7942 9.23165 22.5837C8.53753 21.8968 8.20117 20.905 8.20117 19.559C8.20117 15.3638 11.4791 12.3206 15.9986 12.3206C20.518 12.3206 23.796 15.3638 23.796 19.559C23.796 20.905 23.4597 21.8937 22.7655 22.5837C21.7442 23.5971 20.1786 23.7418 18.3378 23.7418ZM15.9986 22.1771C16.4236 22.1771 16.8425 22.1833 17.2462 22.1894C19.2215 22.2202 20.9247 22.2449 21.6922 21.4841C22.0775 21.099 22.2671 20.4707 22.2671 19.559C22.2671 16.257 19.6313 13.8606 15.9986 13.8606C12.3659 13.8606 9.73008 16.257 9.73008 19.559C9.73008 20.4707 9.91966 21.1021 10.3049 21.4841C11.0694 22.2418 12.7726 22.2171 14.751 22.1894C15.1546 22.1833 15.5736 22.1771 15.9986 22.1771Z" fill="#0047FF"/>
                                <path d="M7.98691 9.18514C5.91983 9.18514 4.23804 7.49105 4.23804 5.40885C4.23804 3.32666 5.91983 1.63257 7.98691 1.63257C8.76666 1.63257 9.51276 1.86974 10.1427 2.31945C10.4882 2.56586 10.5677 3.04637 10.3231 3.39442C10.0785 3.74248 9.60144 3.82257 9.25591 3.57615C8.88591 3.31126 8.44864 3.17265 7.98691 3.17265C6.76379 3.17265 5.76694 4.17679 5.76694 5.40885C5.76694 6.64092 6.76379 7.64506 7.98691 7.64506C8.44864 7.64506 8.88897 7.50645 9.25897 7.24155C9.6045 6.99822 10.0815 7.08139 10.3231 7.42945C10.5646 7.7775 10.4821 8.25801 10.1366 8.50134C9.50665 8.94797 8.7636 9.18514 7.98691 9.18514Z" fill="#0047FF"/>
                                <path d="M4.76407 21.3271C3.17095 21.3271 1.81634 21.1978 0.917344 20.3045C0.299666 19.6916 0 18.8199 0 17.634C0 13.9779 2.856 11.3228 6.78834 11.3228C7.79436 11.3228 8.7484 11.5014 9.62599 11.8525C10.0174 12.0096 10.21 12.4593 10.0541 12.8536C9.89814 13.2479 9.45475 13.4419 9.0603 13.2848C8.36617 13.0045 7.60172 12.8659 6.78834 12.8659C3.7397 12.8628 1.52891 14.868 1.52891 17.634C1.52891 18.3856 1.67874 18.9 1.98758 19.208C2.61137 19.824 4.04854 19.8025 5.71811 19.7778L5.8343 19.7747C6.26851 19.7624 6.60487 20.1074 6.61099 20.5325C6.61711 20.9575 6.28075 21.3087 5.85877 21.3148L5.74257 21.3179C5.40927 21.321 5.08208 21.3271 4.76407 21.3271Z" fill="#0047FF"/>
                                <path d="M24.0131 9.18499C23.2364 9.18499 22.4903 8.94782 21.8604 8.50427C21.5149 8.26094 21.4323 7.78043 21.6739 7.43237C21.9185 7.08432 22.3955 7.00115 22.738 7.24448C23.111 7.5063 23.5483 7.64799 24.01 7.64799C25.2332 7.64799 26.23 6.64385 26.23 5.41178C26.23 4.17972 25.2332 3.17558 24.01 3.17558C23.5483 3.17558 23.108 3.31419 22.741 3.57908C22.3955 3.8255 21.9185 3.74233 21.6739 3.39735C21.4292 3.0493 21.5118 2.56879 21.8543 2.32238C22.4842 1.87267 23.2303 1.6355 24.01 1.6355C26.0771 1.6355 27.7589 3.32959 27.7589 5.41178C27.7589 7.49398 26.0802 9.18499 24.0131 9.18499Z" fill="#0047FF"/>
                                <path d="M27.2359 21.327C26.9179 21.327 26.5907 21.3209 26.2574 21.3178L26.1412 21.3147C25.7192 21.3086 25.3829 20.9574 25.389 20.5324C25.3951 20.1073 25.7437 19.7592 26.1657 19.7746L26.2819 19.7777C27.9514 19.8054 29.3886 19.827 30.0124 19.2079C30.3212 18.8999 30.4711 18.3855 30.4711 17.6339C30.4711 14.871 28.2603 12.8627 25.2116 12.8627C24.3983 12.8627 23.6369 13.0044 22.9397 13.2816C22.5452 13.4387 22.1018 13.2478 21.9459 12.8504C21.7899 12.4562 21.9795 12.0065 22.374 11.8494C23.2485 11.4982 24.2026 11.3196 25.2116 11.3196C29.144 11.3196 32 13.9747 32 17.6308C32 18.8167 31.7003 19.6915 31.0826 20.3014C30.1836 21.1977 28.826 21.327 27.2359 21.327Z" fill="#0047FF"/>
                            </svg>
                        </router-link>
                    </div>
                    <div class="menu-item" @click="setCurrentPath()" :class="currentPath === 'vacancy' ? 'active' : ''">
                        <router-link :to="{name: 'vacancy'}">
                            <svg width="33" height="21" viewBox="0 0 33 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M30.4806 20.0904H21.067C20.6384 20.0904 20.2905 19.7605 20.2905 19.354C20.2905 18.9475 20.6384 18.6175 21.067 18.6175H30.4806C30.8782 18.6175 31.2012 18.3112 31.2012 17.9341V2.65143C31.2012 2.27437 30.8782 1.96801 30.4806 1.96801H21.067C20.6384 1.96801 20.2905 1.63808 20.2905 1.23156C20.2905 0.825044 20.6384 0.495117 21.067 0.495117H30.4806C31.7354 0.495117 32.7541 1.46133 32.7541 2.65143V17.9341C32.7541 19.1242 31.7323 20.0904 30.4806 20.0904Z" fill="#9299B0"/>
                                <path d="M28.1231 6.39208H23.9427C23.5141 6.39208 23.1663 6.06215 23.1663 5.65563C23.1663 5.24912 23.5141 4.91919 23.9427 4.91919H28.1231C28.5517 4.91919 28.8996 5.24912 28.8996 5.65563C28.8996 6.06215 28.5517 6.39208 28.1231 6.39208Z" fill="#9299B0"/>
                                <path d="M28.1229 10.9819H25.4954C25.0668 10.9819 24.719 10.652 24.719 10.2455C24.719 9.83896 25.0668 9.50903 25.4954 9.50903H28.1229C28.5515 9.50903 28.8994 9.83896 28.8994 10.2455C28.8994 10.652 28.5515 10.9819 28.1229 10.9819Z" fill="#9299B0"/>
                                <path d="M28.1229 15.5745H23.9425C23.5139 15.5745 23.166 15.2445 23.166 14.838C23.166 14.4315 23.5139 14.1016 23.9425 14.1016H28.1229C28.5515 14.1016 28.8993 14.4315 28.8993 14.838C28.8993 15.2445 28.5515 15.5745 28.1229 15.5745Z" fill="#9299B0"/>
                                <path d="M11.4852 20.588H10.2212C8.81113 20.588 7.65578 19.5305 7.59366 18.2078C7.48185 18.1666 7.37315 18.1224 7.26134 18.0782C6.77684 18.4995 6.15257 18.7292 5.49104 18.7292C4.78603 18.7292 4.12449 18.47 3.62757 17.9987L2.7331 17.1474C2.23928 16.679 1.96597 16.0574 1.96286 15.3946C1.95975 14.7613 2.20201 14.1662 2.64924 13.7008C2.60265 13.5977 2.55607 13.4917 2.51259 13.3856C1.11498 13.3267 0 12.2309 0 10.8935V9.69455C0 8.35717 1.11498 7.26134 2.50948 7.20242C2.55296 7.09637 2.59955 6.99327 2.64614 6.88722C2.20201 6.42768 1.95975 5.83558 1.95975 5.20813C1.95975 4.53944 2.23306 3.91199 2.72999 3.44067L3.62446 2.59228C4.12139 2.12096 4.78292 1.86173 5.48793 1.86173C6.14947 1.86173 6.77373 2.0915 7.26134 2.51275C7.37004 2.46856 7.48185 2.42437 7.59366 2.38313C7.65578 1.05753 8.81113 0 10.2212 0H11.4852C12.8952 0 14.0506 1.05753 14.1127 2.38019C14.2245 2.42143 14.3332 2.46561 14.445 2.5098C14.9295 2.08856 15.5538 1.85878 16.2153 1.85878C16.9204 1.85878 17.5819 2.11801 18.0788 2.58934L18.9733 3.43772C19.4702 3.90904 19.7435 4.5365 19.7435 5.20519C19.7435 5.83264 19.5013 6.42474 19.0571 6.88428C19.1068 6.98738 19.1503 7.09343 19.1938 7.19948C20.5883 7.25839 21.7033 8.35422 21.7033 9.6916V10.8905C21.7033 12.2279 20.5883 13.3237 19.1938 13.3827C19.1503 13.4887 19.1037 13.5918 19.0571 13.6979C19.5013 14.1574 19.7435 14.7495 19.7435 15.377C19.7435 16.0456 19.4702 16.6731 18.9733 17.1444L18.0788 17.9928C17.5819 18.4641 16.9204 18.7234 16.2153 18.7234C15.5538 18.7234 14.9295 18.4936 14.4419 18.0723C14.3332 18.1165 14.2214 18.1607 14.1096 18.202C14.0506 19.5275 12.8952 20.588 11.4852 20.588ZM7.10295 16.4522C7.22407 16.4522 7.3483 16.4787 7.46011 16.5346C7.8266 16.7143 8.21171 16.8646 8.60304 16.9853C8.92605 17.0826 9.14345 17.3653 9.14345 17.6864V18.093C9.14345 18.6585 9.62796 19.1151 10.2212 19.1151H11.4852C12.0815 19.1151 12.5629 18.6556 12.5629 18.093V17.6864C12.5629 17.3653 12.7803 17.0826 13.1033 16.9853C13.4947 16.8675 13.8798 16.7143 14.2463 16.5346C14.5475 16.3874 14.914 16.4404 15.1532 16.6672L15.4575 16.9559C15.8675 17.3447 16.5787 17.3418 16.9825 16.9559L17.8769 16.1075C18.0819 15.9131 18.1937 15.6568 18.1937 15.3828C18.1937 15.1118 18.0819 14.8555 17.8769 14.6611L17.5726 14.3724C17.3334 14.1456 17.2775 13.798 17.4328 13.5123C17.6223 13.1647 17.7807 12.7994 17.908 12.4282C18.0105 12.1219 18.3086 11.9157 18.6472 11.9157H19.0758C19.6721 11.9157 20.1535 11.4561 20.1535 10.8935V9.69455C20.1535 9.12896 19.669 8.67236 19.0758 8.67236H18.6472C18.3086 8.67236 18.0105 8.46616 17.908 8.1598C17.7807 7.78863 17.6223 7.42336 17.4328 7.07575C17.2775 6.79001 17.3334 6.44241 17.5726 6.21559L17.8769 5.9269C18.0819 5.73248 18.1937 5.4762 18.1937 5.20519C18.1937 4.93123 18.0819 4.672 17.8769 4.48053L16.9825 3.63214C16.5787 3.24625 15.8644 3.2433 15.4575 3.63214L15.1532 3.92083C14.914 4.14765 14.5475 4.20068 14.2463 4.05339C13.8798 3.8737 13.4947 3.72346 13.1033 3.60268C12.7803 3.50547 12.5629 3.22268 12.5629 2.90159V2.49507C12.5629 1.92948 12.0784 1.47289 11.4852 1.47289H10.2212C9.62485 1.47289 9.14345 1.93243 9.14345 2.49507V2.90159C9.14345 3.22268 8.92605 3.50547 8.60304 3.60268C8.20861 3.72346 7.8266 3.8737 7.46011 4.05339C7.15885 4.20068 6.79237 4.14765 6.55322 3.92083L6.24885 3.63214C5.83889 3.2433 5.12766 3.24625 4.72391 3.63214L3.82944 4.48053C3.62446 4.67495 3.51265 4.93123 3.51265 5.20519C3.51265 5.4762 3.62446 5.73248 3.82944 5.9269L4.13381 6.21559C4.37296 6.44241 4.42886 6.79001 4.27357 7.07575C4.08412 7.42336 3.92572 7.78863 3.79838 8.1598C3.69589 8.46616 3.39774 8.67236 3.05921 8.67236H2.63061C2.0374 8.66942 1.5529 9.12896 1.5529 9.69455V10.8935C1.5529 11.4591 2.0374 11.9157 2.63061 11.9157H3.05921C3.39774 11.9157 3.69589 12.1219 3.79838 12.4282C3.92572 12.7994 4.08412 13.1647 4.27357 13.5123C4.42886 13.798 4.37296 14.1456 4.13381 14.3724L3.82944 14.6611C3.62446 14.8555 3.51265 15.1148 3.51265 15.3887C3.51265 15.6627 3.62757 15.916 3.82944 16.1075L4.72391 16.9559C5.12766 17.3388 5.842 17.3447 6.24885 16.9559L6.55322 16.6672C6.7023 16.5258 6.90107 16.4522 7.10295 16.4522Z" fill="#9299B0"/>
                                <path d="M10.8515 15.1885C8.00662 15.1885 5.6897 12.9909 5.6897 10.2926C5.6897 7.59428 8.00662 5.39673 10.8515 5.39673C13.6964 5.39673 16.0133 7.59133 16.0133 10.2926C16.0133 12.9939 13.6995 15.1885 10.8515 15.1885ZM10.8515 6.87256C8.86071 6.87256 7.24259 8.40731 7.24259 10.2956C7.24259 12.1838 8.86071 13.7185 10.8515 13.7185C12.8423 13.7185 14.4605 12.1838 14.4605 10.2956C14.4605 8.40731 12.8423 6.87256 10.8515 6.87256Z" fill="#9299B0"/>
                            </svg>
                        </router-link>
                    </div>
                </div>
            </div>
            <router-view>

            </router-view>
<!--            <FilterComponent class="filters"
                @setFilter="setFilter" @textEntered="setTextSearch"
            >

            </FilterComponent>-->

        </div>
    </div>
</template>

<script>
import PaginationComponent from "./components/PaginationComponent";
import FilterComponent from "./components/FilterComponent";
import axios from 'axios';

export default {
    name: 'app',
    components: {
        PaginationComponent,
        FilterComponent
    },
    data(){
        return {
            currentPath: '',
            showingTable: false,
            currentPage: 1,
            countPages: 1,
            poiFilters: '',
            textSearch: '',
            mobileVersion: false,
            headers: [
                'Имя',
                'Резюме',
                'Опыт',
                'Вакансии',
                'Статус'
            ],
            clients: [
                {
                    id: 'Анатолий Вассерман Возанович',
                    type_poi: 'Отделение банка банковское отделение банка',
                    coords: '55.554771 ш., 37.924931 д.',
                    percents: 89,
                    distance: 769
                }
            ],
            order: 'date',
            order_type: 0
        }
    },
    created() {
        this.$nextTick(function() {
            window.addEventListener('resize', this.getWindowWidth);
            this.getWindowWidth();
        });
    },
    mounted() {
        this.setCurrentPath ();
    },
    watch(){

    },
    methods: {
        setCurrentPath(){
            setTimeout(() => {
                this.currentPath = this.$route.name;
            }, 100);
        },
        setTextSearch(text){
            this.textSearch = text;
            this.getEvents();
        },
        setSort(order){
            this.currentPage = 1;
            if(this.order == order){
                this.order_type = !this.order_type
            } else {
                this.order = order;
                this.order_type = 0;
            }
            this.getEvents();
        },
        setFilter(poiTypes){
            this.currentPage = 1;
            let res = '';
            poiTypes.forEach((poi) => {
                if(poi.active){
                    res += '&filter[]='+poi.id;
                }
            });
            this.poiFilters = res;
            this.getEvents();
        },
        getEvents(){
            let asc = this.order_type ? 'DESC' : 'ASC';
            axios.get('https://franq.creativityprojectcenter.ru/api/api.php?type=getEvents'+
                '&page='+this.currentPage +
                '&order='+this.order+
                '&order_type='+asc+
                '&query='+this.textSearch+
                this.poiFilters
            )
                .then(res => {
                    this.countPages = res.data.page_count;
                    this.clients = res.data.data;
                    this.showingTable = true;
                })
        },
        changeCurrentPage(page){
            this.currentPage = page;
            this.getEvents();
        },
        getWindowWidth(event) {
            this.mobileVersion = document.documentElement.clientWidth < 768;
        },
    }
}
</script>

<style lang="scss" scoped>
@import "./styles_fonts";
$font-Inter: Inter, 'Inter';

html, body {
    margin: 0 !important;
    padding: 0 !important;

}

ul {
    list-style-type: none;
}

li {
    list-style: none;
    display: flex;
}


#app {
    width: 100vw;
    height: 100vh;


    .wrapper {
        margin: 0 auto;
        width: calc(100% - 50px);
        display: flex;
        

        .menu-wrap {
            height: 100vh;
            background: #fff;
            width: 55px;
            display: flex;
            justify-content: center;
            flex-direction: column;

            .menu {
                display: flex;
                flex-direction: column;
                align-items: center;

                .active {
                    background: #FAFAFF;
                    border-radius: 8px;
                    transition: all .4s;

                    a {
                        transition: all .4s;
                        svg {
                            path {
                                fill: #0047FF !important;
                            }
                        }
                    }
                }

                .menu-item {
                    padding: 5px 7px;
                    margin: 10px 0;
                    cursor: pointer;

                    &:hover {
                        background: #FAFAFF;
                        border-radius: 8px;
                        transition: all .4s;

                        a {
                            transition: all .4s;
                            svg {
                                path {
                                    fill: #0047FF;
                                }
                            }
                        }
                    }

                    a {
                        svg {
                            width: 32px;
                            height: 24px;
                            path {
                                fill: #9299B0;
                            }
                        }
                    }
                }

            }
        }

    }
}


</style>
