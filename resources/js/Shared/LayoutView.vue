<template>
    <header-component :is_auth="auth_user" />
    <div class="page">
        <div class="preloader">
            <div class="preloader__wrap">
                <svg
                    class="preloader_propeller"
                    xmlns="http://www.w3.org/2000/svg"
                    width="31"
                    height="30"
                    viewBox="0 0 31 30"
                    fill="none"
                >
                    <path
                        d="M0.453124 12.9C0.453124 11.625 0.834123 10.6565 1.59612 9.9945C2.35912 9.3315 3.22812 9 4.20312 9C4.85312 9 5.48412 9.144 6.09612 9.432C6.70912 9.719 7.21562 10.1625 7.61562 10.7625C7.96562 11.3125 8.41562 11.756 8.96562 12.093C9.51562 12.431 10.1031 12.6625 10.7281 12.7875L10.9531 12.3375C11.0281 12.1875 11.1156 12.05 11.2156 11.925L9.97813 8.475C9.82812 8.05 9.70312 7.6375 9.60313 7.2375C9.50313 6.8375 9.45312 6.425 9.45312 6C9.45312 4.425 10.1406 3.031 11.5156 1.818C12.8906 0.605999 14.9031 -6.79712e-07 17.5531 -5.63877e-07C18.8281 -5.08145e-07 19.7971 0.3815 20.4601 1.1445C21.1221 1.9065 21.4531 2.7625 21.4531 3.7125C21.4531 4.3625 21.3096 5 21.0226 5.625C20.7346 6.25 20.2906 6.7625 19.6906 7.1625C19.1406 7.5125 18.6971 7.9625 18.3601 8.5125C18.0221 9.0625 17.7906 9.65 17.6656 10.275L18.1156 10.5C18.2656 10.575 18.4031 10.6625 18.5281 10.7625L21.9781 9.525C22.4031 9.375 22.8156 9.25 23.2156 9.15C23.6156 9.05 24.0156 9 24.4156 9C26.0156 9 27.4221 9.6875 28.6351 11.0625C29.8471 12.4375 30.4531 14.45 30.4531 17.1C30.4531 18.375 30.0721 19.344 29.3101 20.007C28.5471 20.669 27.6906 21 26.7406 21C26.0906 21 25.4531 20.8565 24.8281 20.5695C24.2031 20.2815 23.6906 19.8375 23.2906 19.2375C22.9406 18.6875 22.4906 18.244 21.9406 17.907C21.3906 17.569 20.8031 17.3375 20.1781 17.2125L19.9531 17.6625C19.8781 17.8125 19.7906 17.95 19.6906 18.075L20.9656 21.525C21.1156 21.95 21.2346 22.3565 21.3226 22.7445C21.4096 23.1315 21.4531 23.5375 21.4531 23.9625C21.4531 25.9875 20.6156 27.5 18.9406 28.5C17.2656 29.5 15.4031 30 13.3531 30C12.0781 30 11.1096 29.6 10.4476 28.8C9.78462 28 9.45312 27.1125 9.45312 26.1375C9.45312 25.5125 9.59712 24.906 9.88512 24.318C10.1721 23.731 10.6156 23.2375 11.2156 22.8375C11.7656 22.4875 12.2091 22.0375 12.5461 21.4875C12.8841 20.9375 13.1156 20.35 13.2406 19.725L12.7906 19.5C12.6406 19.425 12.5031 19.3375 12.3781 19.2375L8.92812 20.475C8.52812 20.625 8.14662 20.75 7.78362 20.85C7.42162 20.95 7.04062 21 6.64062 21C5.01562 21.025 3.57812 20.35 2.32812 18.975C1.07812 17.6 0.453124 15.575 0.453124 12.9ZM13.2031 15C13.2031 15.625 13.4221 16.156 13.8601 16.593C14.2971 17.031 14.8281 17.25 15.4531 17.25C16.0781 17.25 16.6091 17.031 17.0461 16.593C17.4841 16.156 17.7031 15.625 17.7031 15C17.7031 14.375 17.4841 13.844 17.0461 13.407C16.6091 12.969 16.0781 12.75 15.4531 12.75C14.8281 12.75 14.2971 12.969 13.8601 13.407C13.4221 13.844 13.2031 14.375 13.2031 15Z"
                    />
                    <defs>
                        <linearGradient
                            id="paint0_linear_0_158"
                            x1="16.5"
                            y1="4"
                            x2="15"
                            y2="28.5"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="white" />
                            <stop offset="1" stop-color="#FFE6E6" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
        <div class="observer_block"></div>
        <slot></slot>
    </div>
    <footer-component />
</template>

<script>
import FooterComponent from "@/Components/FooterComponent.vue";
import HeaderComponent from "@/Components/HeaderComponent.vue";

export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
    },

    components: { HeaderComponent, FooterComponent },
};
</script>

<style lang="scss">
.page {
    flex: 1 1 auto;
    @media (max-width: 767.98px) {
        margin-top: 80px;
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

.all-link {
    width: 100%;
    display: block;
    text-align: center;
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
    @media (max-width: 1270px) {
        padding-top: 40px;
        padding: 15px;
        gap: 50px;
    }
    @media (max-width: 991.98px) {
        padding-top: 20px;
    }
    @media (max-width: 767.98px) {
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
            box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
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

.swiper {
    padding-bottom: 48px !important;

    .swiper-pagination {
        .swiper-pagination-bullet {
            position: relative;
            width: 21px;
            height: 21px;
            overflow: hidden;
            opacity: 1;
            background: transparent;
            border-radius: 3px;

            &::before {
                content: "";
                position: absolute;
                width: 100%;
                height: 100%;
                border: 5px solid rgba(63, 123, 222, 0.16);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            &::after {
                content: "";
                position: absolute;
                width: 100%;
                height: 100%;
                border: 8px solid #3f7bde;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.3s ease 0s;
                opacity: 0;
                visibility: hidden;
            }

            &.swiper-pagination-bullet-active {
                &::after {
                    opacity: 1;
                    visibility: visible;
                }
            }
        }
    }
}
</style>
