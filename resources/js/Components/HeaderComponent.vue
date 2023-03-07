<template>
    <nav class="nav__container">
        <Link :href="route('home')">
            <img
                class="nav__logo headder"
                src="../../assets/img/logo_high_quality.png"
                alt="logo"
            />
        </Link>

        <nav-links :is_auth="is_auth" />
        <div
            @click="burgerAction"
            v-if="viewportWidth < 767.98"
            class="nav__burger"
            :class="{ active: is_clicked }"
        >
            <div class="nav__burger_con">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div
            v-if="viewportWidth >= 991.98 && !is_auth"
            class="nav__button"
            data-popup="#auth"
            @mousedown="this.linkChanger"
        >
            Личный кабинет
        </div>
        <Link
            :href="route('logout')"
            v-if="viewportWidth >= 991.98 && is_auth"
            class="nav__button"
        >
            Выйти
        </Link>

        <div
            v-else-if="viewportWidth < 991.98 && !is_auth"
            class="nav__buttons_mobile"
        >
            <div
                class="nav__button_mobile"
                data-popup="#auth"
                @click="this.linkChanger"
            >
                <img src="../../assets/img/user.svg" alt="" />
            </div>
            <div
                @click="burgerAction"
                v-if="viewportWidth < 767.98"
                class="nav__burger"
                :class="{ active: is_clicked }"
            >
                <div class="nav__burger_con">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <popup-view id="auth">
        <div
            v-for="(error, i) in this.errors"
            :key="i"
            class="form_wrapper-message"
        >
            <div v-if="error" class="form_message">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z"
                    />
                </svg>
                {{ error }}
            </div>
        </div>
        <div v-if="mail_to_code.email.error" class="form_wrapper-message">
            <div class="form_message">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z"
                    />
                </svg>
                {{ mail_to_code.email.error }}
            </div>
        </div>
        <div class="invisible next" ref="next"></div>
        <swiper
            class="popup__slider"
            :modules="modules"
            :slides-per-view="1"
            :space-between="15"
            :pagination="pagination"
            :navigation="{
                nextEl: '.next',
                prevEl: '.prev',
            }"
            autoHeight
            @slideChange="swipe"
            v-if="this.is_reg === false"
        >
            <swiper-slide
                tag="form"
                @submit.prevent="submit"
                class="form form-popup popup__form popup_slide"
                data-id="login"
            >
                <main-title tag="h3" title-name="Войти в аккаунт Allbtc" />
                <input
                    v-model="form.email"
                    required
                    autofocus
                    type="email"
                    name="email"
                    class="input popup__input"
                    placeholder="Введите ваш Email или логин"
                />
                <input
                    v-model="form.password"
                    required
                    type="password"
                    name="password"
                    class="input popup__input"
                    placeholder="Введите пароль"
                />
                <blue-button>
                    <button class="all-link" type="submit">Войти</button>
                </blue-button>
                <div class="popup__text">
                    Нет аккаунта?
                    <span class="main__link" @click="this.formChanger">
                        Зарегистрироваться
                    </span>
                </div>
            </swiper-slide>
            <!--            <swiper-slide-->
            <!--                tag="from"-->
            <!--                class="form form-popup popup__form popup_slide"-->
            <!--                data-id="email"-->
            <!--            >-->
            <!--                <main-title tag="h3" title-name="Создать аккаунт Allbtc" />-->
            <!--                <input-->
            <!--                    v-model="new_account_input.email"-->
            <!--                    required-->
            <!--                    autofocus-->
            <!--                    type="email"-->
            <!--                    name="email"-->
            <!--                    class="input popup__input"-->
            <!--                    placeholder="Введите ваш Email"-->
            <!--                />-->

            <!--                <blue-button @click="this.formChanger">-->
            <!--                    <button class="all-link">Дальше</button>-->
            <!--                </blue-button>-->
            <!--                <div class="popup__text">-->
            <!--                    Уже есть аккаунт?-->
            <!--                    <span class="main__link prev"> Войти </span>-->
            <!--                </div>-->
            <!--            </swiper-slide>-->
            <!--            <blue-button type="submit">-->
            <!--                <button class="all-link">Зарегистрироватсья</button>-->
            <!--            </blue-button>-->
        </swiper>
        <swiper
            tag="from"
            class="popup__slider form form-popup popup__form"
            :modules="modules"
            :slides-per-view="1"
            :space-between="15"
            :pagination="pagination"
            :navigation="{
                nextEl: '.next',
                prevEl: '.prev',
            }"
            :allowSlideNext="false"
            :allowTouchMove="false"
            autoHeight
            @slideChange="swipe"
            @swiper="this.swiper_init"
            v-else-if="this.is_reg === true"
        >
            <swiper-slide class="popup_slide form form-popup" data-id="email">
                <main-title tag="h3" title-name="Создать аккаунт Allbtc" />
                <input
                    v-model="new_account_input.email"
                    autofocus
                    name="Reg_email"
                    type="email"
                    class="input popup__input"
                    placeholder="Введите ваш Email"
                    ref="email"
                />

                <blue-button
                    type="button"
                    @click="
                        sendCode();
                        this.email_validate();
                    "
                >
                    <div class="all-link">Дальше</div>
                </blue-button>
                <div class="popup__text">
                    Уже есть аккаунт?
                    <span class="main__link" @click="this.formChanger">
                        Войти
                    </span>
                </div>
            </swiper-slide>
            <swiper-slide class="popup_slide form form-popup" data-id="email">
                <main-title
                    tag="h3"
                    title-name="Создать аккаунт Allbtc"
                ></main-title>
                <div class="popup__text">
                    Мы отправили проверочный код на ваш электронный адрес
                </div>
                <input
                    type="text"
                    class="input popup__input"
                    placeholder="Введите код"
                    ref="code"
                />
                <div class="popup__text">
                    Код не пришёл?
                    <span class="main__link" @click="sendCode"
                        >Отправить повторно</span
                    >
                </div>
                <div class="popup__buttons form__buttons">
                    <blue-button class="back prev">
                        <button class="all-link">Назад</button>
                    </blue-button>
                    <blue-button @click="this.codeValidate">
                        <button class="all-link">Дальше</button>
                    </blue-button>
                </div>
            </swiper-slide>
            <swiper-slide class="popup_slide form form-popup" data-id="email">
                <main-title tag="h3" title-name="Создать аккаунт Allbtc" />
                <input
                    v-model="new_account_input.name"
                    required
                    autofocus
                    name="Reg_name"
                    type="text"
                    class="input popup__input"
                    placeholder="Введите ваш логин"
                    ref="name"
                />

                <blue-button type="button" @click="this.name_validate">
                    <button class="all-link">Дальше</button>
                </blue-button>
            </swiper-slide>
            <swiper-slide class="popup_slide form form-popup" data-id="email">
                <main-title tag="h3" title-name="Создать аккаунт Allbtc" />
                <input
                    v-model="new_account_input.password"
                    required
                    autofocus
                    autocomplete="off"
                    type="password"
                    class="input popup__input"
                    placeholder="Введите пароль"
                    ref="password"
                />
                <input
                    v-model="new_account_input.passwordConfirme"
                    required
                    autofocus
                    autocomplete="off"
                    type="password"
                    class="input popup__input"
                    placeholder="Подтвердите пароль"
                    ref="passwordConfirme"
                />

                <blue-button
                    type="button"
                    @click="
                        account_create();
                        this.password_validate();
                    "
                >
                    <button class="all-link">Зарегистрироваться</button>
                </blue-button>
            </swiper-slide>
        </swiper>
    </popup-view>
</template>

<script>
import { Link, useForm } from "@inertiajs/vue3";
import NavLinks from "@/Components/navs/NavLinks.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import PopupView from "@/Components/technical/PopupView.vue";
import { Pagination, Navigation } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";
import axios from "axios";

import "swiper/css";
import "swiper/css/pagination";

export default {
    components: {
        PopupView,
        BlueButton,
        MainTitle,
        Link,
        NavLinks,
        // eslint-disable-next-line vue/no-unused-components
        Swiper,
        // eslint-disable-next-line vue/no-unused-components
        SwiperSlide,
    },
    data() {
        return {
            is_clicked: false,
            viewportWidth: 0,
            is_reg: false,
            errors: {
                email: "",
                name: "",
                code: "",
                password: "",
                login: "",
            },
            swiper: {},
        };
    },
    props: {
        is_auth: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
            default: false,
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    mounted() {
        setTimeout(this.handleScroll, 10);
    },
    setup() {
        const form = useForm({
            email: "",
            password: "",
            remember: false,
        });
        const new_account_input = useForm({
            email: "",
            name: "",
            password: "",
            passwordConfirme: "",
        });
        const mail_to_code = useForm({
            email: "",
        });

        let code = "";
        const submit = () => {
            // eslint-disable-next-line no-undef
            form.post(route("login_process"), {
                onFinish: () => form.reset("password"),
            });
        };

        const sendCode = () => {
            mail_to_code.email = new_account_input.email;
            // eslint-disable-next-line no-undef
            axios.post(route("email_code"), mail_to_code).then((resp) => {
                localStorage.code = resp.data;
            });
        };

        const instance = axios.create({
            baseURL: "https://pool.api.btc.com/v1",
            headers: { "Content-Type": "application/json; charset=utf-8" },
        });
        const addAcc = () => {
            let data = {
                puid: "781195",
                group_name: new_account_input.name,
            };
            // eslint-disable-next-line no-undef
            axios.put(route("sub_create"), data);
            //     .then((resp) => {
            //     console.log(resp);
            // });
            instance
                .post(
                    "groups/create?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&puid=781195",
                    data
                )
                .then((resp) => {
                    console.log(resp);
                })
                .catch((err) => {
                    console.log(err);
                });
        };

        const account_create = () => {
            if (
                new_account_input.passwordConfirme ===
                new_account_input.password
            ) {
                // eslint-disable-next-line no-undef
                new_account_input.post(route("user_create"), {
                    onFinish: () => addAcc(),
                });
            }
        };

        let swipe = () => {
            document.querySelectorAll("#auth .popup_slide").forEach((el) => {
                setTimeout(() => {
                    if (el.classList.contains("swiper-slide-active")) {
                        location.replace(`#${el.dataset.id}`);
                    }
                }, 10);
            });
        };

        return {
            pagination: {
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            },
            paginationUnClicalble: {
                clickable: false,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            },
            runCallbacksOnInit: {},
            modules: [Pagination, Navigation],
            form,
            new_account_input,
            submit,
            account_create,
            swipe,
            sendCode,
            code,
            mail_to_code,
        };
    },
    methods: {
        async codeValidate() {
            if (this.$refs.code.value !== localStorage.code) {
                this.errors.code = "Неверный код";
            } else {
                this.errors_destroyer();
                this.slideNext();
            }
        },
        formChanger() {
            this.is_reg === true ? (this.is_reg = false) : (this.is_reg = true);
            this.errors_destroyer();
        },
        slideNext() {
            this.swiper.allowSlideNext = true;
            this.$refs.next.click();
            this.swiper.allowSlideNext = false;
        },
        swiper_init(swiper) {
            this.swiper = swiper;
        },
        errors_destroyer() {
            this.errors = {
                email: "",
                name: "",
                code: "",
                password: "",
            };
        },
        email_validate() {
            // eslint-disable-next-line no-undef
            let reg =
                /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            let tester = (val) => {
                // eslint-disable-next-line no-undef
                return reg.test(val);
            };
            this.errors_destroyer();
            axios
                .post(route("user_get"), { email: this.$refs.email.value })
                .then((resp) => {
                    if (Reflect.get(resp.data, Reflect.ownKeys(resp.data))) {
                        let acc = Reflect.get(
                            resp.data,
                            Reflect.ownKeys(resp.data)
                        );
                        if (acc.email) {
                            if (acc.email == this.$refs.email.value) {
                                this.errors.email =
                                    "Аккаунт с такой почтой уже существует";
                            }
                        }
                    } else if (this.$refs.email.value === "") {
                        this.errors.email = "Необходимо заполнить «Email»";
                    } else if (!tester(this.$refs.email.value)) {
                        this.errors.email = "Некорректное поле «Email»";
                    } else {
                        this.errors_destroyer();
                        this.slideNext();
                    }
                });
        },
        name_validate() {
            this.errors_destroyer();
            const instance = axios.create({
                baseURL: "https://pool.api.btc.com/v1",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                },
            });
            let validate = true;

            if (this.$refs.name.value === "") {
                this.errors.name = "Необходимо заполнить «Логин»";
            } else {
                this.get_group(instance, validate);
            }
        },
        async get_group(instance, validate) {
            instance
                .get(
                    "/worker/groups?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&puid=781195&page=1&page_size=52"
                )
                .then((resp) => {
                    resp.data.data.list.forEach((group, i) => {
                        if (i > 1) {
                            if (group.name === this.$refs.name.value) {
                                this.errors.name = "Логин уже занят";
                                validate = false;
                            } else if (
                                i === resp.data.data.list.length - 1 &&
                                validate === true
                            ) {
                                this.errors_destroyer();
                                this.slideNext();
                            }
                        }
                    });
                });
        },
        password_validate() {
            if (
                this.$refs.passwordConfirme.value ===
                    this.$refs.password.value &&
                this.$refs.password.value !== "" &&
                this.$refs.password.value.length > 6
            ) {
                this.errors_destroyer();
            } else {
                this.errors_destroyer();
                this.errors.password = "Необходимо подтвердить пароль";
            }
        },
        linkChanger() {
            this.is_reg = false;
            document.querySelectorAll("#auth .popup_slide").forEach((el) => {
                setTimeout(() => {
                    if (el.classList.contains("swiper-slide-active")) {
                        location.replace(`#${el.dataset.id}`);
                    }
                }, 10);
            });
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        burgerAction() {
            if (this.is_clicked === true && this.viewportWidth < 767.98) {
                this.is_clicked = false;
                document.querySelector("body").style.overflow = "auto";
                document
                    .querySelector(".nav__links_con")
                    .classList.remove("open");
            } else if (
                this.is_clicked === false &&
                this.viewportWidth < 767.98
            ) {
                this.is_clicked = true;
                document.querySelector("body").style.overflow = "hidden";
                document.querySelector(".nav__links_con").classList.add("open");
            }
        },
        handleScroller(bool) {
            if (
                bool === false &&
                document.querySelector("body").classList.contains("header-fix")
            ) {
                document
                    .querySelector(".nav__container")
                    .classList.remove("fixed");
            } else if (
                bool === true &&
                document.querySelector("body").classList.contains("header-fix")
            ) {
                document
                    .querySelector(".nav__container")
                    .classList.add("fixed");
            }
        },
        handleScroll(attr) {
            if (attr === "update") {
                document.querySelector("body").classList.remove("header-fix");
            }
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        document
                            .querySelector(".nav__container")
                            .classList.remove("fixed");
                        document
                            .querySelector("body")
                            .classList.remove("header-fix");
                    } else if (!entry.isIntersecting) {
                        document
                            .querySelector("body")
                            .classList.add("header-fix");
                    }
                });
            });
            animationObserver.observe(
                document.querySelector(".observer_block")
            );
            window.addEventListener("wheel", (e) => {
                if (e.deltaY < 0) {
                    setTimeout(() => {
                        this.handleScroller(true);
                    }, 10);
                } else {
                    this.handleScroller(false);
                }
            });
        },
    },
};
</script>

<style lang="scss" scoped>
.header-fix {
    @media (min-width: 1271px) {
        nav.nav__container {
            position: fixed;
            transform: translateX(-50%) translateY(-120%);
            z-index: 100;
        }
    }
}

#app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    overflow: hidden;
    background: linear-gradient(
        179.87deg,
        #e6eaf0 1.02%,
        #e6eaf1 4.79%,
        #e7ebf1 8.76%,
        #eaeef4 14.75%,
        #e8ecf2 19.07%
    );
    width: 100vw;
}

.swiper {
    padding-bottom: 0 !important;
    .swiper {
        &-slide {
            margin: auto 0;
        }
    }
}

.all-link {
    width: 100%;
    height: 100%;
    padding: 14px 40px;
    display: block;
}

.nav__logo {
    max-width: 170px;
    @media (max-width: 767.98px) {
        &.headder {
            position: relative;
            z-index: 100;
        }
        max-width: 138px;
    }
}

nav.nav__container {
    position: relative;
    z-index: 100;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 115px;
    width: 100%;
    box-sizing: border-box !important;
    padding: 40px 0 15px;
    @media (min-width: 1271px) {
        transition: all 0.3s ease 0s;
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%) translateY(0);
        width: 100vw;
        z-index: 100;
        &:before {
            transition: all 0.3s ease 0s;
            left: 50%;
            content: "";
            transform: translateX(-50%) translateY(-120%);
            top: 0;
            width: 100vw;
            height: 101px;
            z-index: -1;
            position: fixed;
            filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.1));
            background: linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
        }
        &.fixed {
            transform: translateX(-50%) translateY(0);

            &:before {
                transform: translateX(-50%) translateY(0);
            }
        }
    }
    @media (max-width: 1270px) {
        padding: 40px 0 15px;
        gap: 50px;
    }
    @media (max-width: 991.98px) {
        padding-top: 20px;
    }
    @media (max-width: 767.98px) {
        padding: 20px 15px 15px;
        position: fixed;
        gap: 15px;
        &::before {
            content: "";
            position: absolute;
            z-index: 100;
            width: 100%;
            height: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.1));
            background: linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
        }
    }
}

.nav__buttons_mobile {
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
    z-index: 100;

    & .nav__burger {
        background: #4182ec;
        border-radius: 5px;
        width: 60px;
        height: 45px;
        gap: 4px;
        transition: all 0.3s ease 0s;

        &:active {
            background: #305ea8;
            box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
        }

        &_con {
            margin: 0 auto;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 4px;
            width: 18px;
            overflow: hidden;
        }

        & span {
            display: block;
            width: 18px;
            height: 1.5px;
            flex: 0 0 1.5px;
            background-color: #fff;
            border-radius: 5px;
            position: relative;
            right: 0;
            transition: all 0.3s ease 0.3s;

            &:nth-child(2) {
                transition: all 0.3s ease 0s;

                &::before {
                    transition: all 0.3s ease 0s;
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: #fff;
                }
            }
        }

        &.active {
            & span {
                &:nth-child(1) {
                    transition: all 0.3s ease 0s;
                    right: 100%;
                }

                &:nth-child(2) {
                    transition: all 0.3s ease 0.3s;
                    transform: rotate(45deg);

                    &::before {
                        transition: all 0.3s ease 0.3s;
                        transform: rotate(-90deg);
                    }
                }

                &:nth-child(3) {
                    transition: all 0.3s ease 0s;
                    right: -100%;
                }
            }
        }
    }
}

.nav__button {
    font-style: normal;
    font-weight: 400;
    font-size: 17px;
    line-height: 143.1%;
    color: #3f7bdd;
    background: rgba(194, 213, 242, 0.61);
    border-radius: 5px;
    padding: 11px 36px;
    white-space: nowrap;
    transition: all 0.3s ease 0s;
    cursor: pointer;
    @media (any-hover: hover) {
        &:hover {
            background: rgba(194, 213, 242);
        }
    }

    &_mobile {
        background: rgba(194, 213, 242, 0.61);
        border-radius: 5px;
        width: 60px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        @media (any-hover: hover) {
            &:hover {
                background: rgba(194, 213, 242);
            }
        }
    }
}
</style>
