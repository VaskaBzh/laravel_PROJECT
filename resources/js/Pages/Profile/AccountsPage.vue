<template>
    <Head title="Аккаунты" />
    <div class="accounts">
        <div class="accounts__wrapper">
            <main-title tag="h2" class="accounts__title">
                Аккаунты
                <span class="accounts__button" data-popup="#addAcc">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 21 21"
                        fill="none"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M1.07129 10.0703C1.07129 9.51803 1.519 9.07031 2.07129 9.07031H18.0713C18.6236 9.07031 19.0713 9.51803 19.0713 10.0703C19.0713 10.6226 18.6236 11.0703 18.0713 11.0703H2.07129C1.519 11.0703 1.07129 10.6226 1.07129 10.0703Z"
                        />
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M10.0708 1.0708C10.6231 1.0708 11.0708 1.51852 11.0708 2.0708V18.0708C11.0708 18.6231 10.6231 19.0708 10.0708 19.0708C9.51852 19.0708 9.0708 18.6231 9.0708 18.0708V2.0708C9.0708 1.51852 9.51852 1.0708 10.0708 1.0708Z"
                        />
                    </svg>
                </span>
            </main-title>
            <div class="accounts__content" v-if="this.accounts.length > 0">
                <account-profile
                    v-for="account in this.accounts"
                    :key="account.indexWorker"
                    :accKey="account.indexWorker"
                    :accountInfo="account"
                    @changeActive="this.activeChanger"
                />
            </div>
            <div class="accounts__content no-info" v-else>
                <img src="../../../assets/img/img_no-info.png" alt="no_info" />
                <span>Нужно время для регистрации аккаунта</span>
            </div>
        </div>
        <popup-view id="addAcc">
            <form
                @submit.prevent="this.addAcc"
                class="form form-popup popup__form"
            >
                <main-title tag="h3" title-name="Задайте имя сабаккаунта" />
                <div v-if="form.errors.name" class="form_message">
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
                    {{ form.errors.name }}
                </div>
                <input
                    v-model="form.name"
                    required
                    autofocus
                    type="text"
                    class="input popup__input"
                    placeholder="Введите имя"
                />
                <blue-button>
                    <button type="submit" class="all-link">+ Добавить</button>
                </blue-button>
            </form>
        </popup-view>
    </div>
</template>

<script>
import { Head, useForm } from "@inertiajs/vue3";
import AccountProfile from "@/Components/account/AccountProfile.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import PopupView from "@/Components/technical/PopupView.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import axios from "axios";

export default {
    components: {
        MainTitle,
        AccountProfile,
        Head,
        PopupView,
        BlueButton,
    },
    layout: profileLayoutView,
    data() {
        return {
            accounts: [],
            accountsAll: [],
            hash: {},
            history: {},
            updateId: 0,
            validate: false,
            activeIndex: 0,
        };
    },
    computed: {
        instance() {
            return axios.create({
                baseURL: "https://pool.api.btc.com/v1",
                headers: { "Content-Type": "application/json; charset=utf-8" },
            });
        },
    },
    methods: {
        activeMount() {
            document.querySelectorAll(".profile").forEach((profile) => {
                profile.classList.remove("active");
                if (profile.dataset.key == this.activeIndex) {
                    profile.classList.add("active");
                }
            });
        },
        activeChanger(el) {
            this.activeIndex = el;
            localStorage.active = JSON.stringify(this.activeIndex);
            setTimeout(this.activeMount, 300);
        },
        reloader(groups) {
            setInterval(() => {
                this.instance
                    .get(
                        "/worker/groups?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&puid=781195&page=1&page_size=52"
                    )
                    .then((response) => {
                        response.data.data.list.forEach((el, i) => {
                            if (i > 1) {
                                groups.forEach((group) => {
                                    if (el.name === group) {
                                        window.location.reload();
                                    }
                                });
                            }
                        });
                    });
            }, 1000);
        },
        doStuff() {
            localStorage.accounts = JSON.stringify(this.accountsAll);
            localStorage.hash = JSON.stringify(this.hash);
            localStorage.active = JSON.stringify(this.activeIndex);
            localStorage.history = JSON.stringify(this.history);
            if (localStorage.accounts) {
                this.accounts = JSON.parse(localStorage.accounts);
                document.querySelector(".preloader").style.display = "none";
                document.querySelector("body").style.overflowY = "visible";
            }
        },
        async startMount(index) {
            this.doStuff();
            this.activeChanger(index);
        },
        async historyHasher(i) {
            Reflect.ownKeys(this.hash).forEach((el) => {
                if (el !== "length") {
                    this.instance
                        .get(
                            `/worker/${el}/share-history?puid=781195&access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&dimension=1h&start_ts=${
                                Reflect.get(this.hash, el).createdAt
                            }&real_point=1&count=72`
                        )
                        .then((resp) => {
                            Reflect.set(
                                this.history[i - 2],
                                el,
                                resp.data.data.tickers
                            );
                            this.startMount(this.accountsAll[0].indexWorker);
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            });
        },
        async getAccGroup(arr, el, groupName, i, response) {
            arr.forEach((group, groupIndex) => {
                if (el.name === group) {
                    this.validate = true;
                    Reflect.set(this.history, i - 2, {});
                    let accountModel = {
                        img: "profile.png",
                        name: el.name,
                        hashRate: "",
                        workersActive: el.workers_active,
                        workersAll: el.workers_total,
                        workersInActive: el.workers_inactive,
                        workersDead: el.workers_dead,
                        todayProfit: "",
                        myPayment: "",
                        rejectRate: el.reject_percent,
                        shares1m: el.shares_1m,
                        shares1h: 0,
                        shares1d: 0,
                        unit: el.shares_unit,
                        indexWorker: i - 2,
                    };
                    if (el.name == groupName) {
                        this.updateGroup(el);
                    }
                    this.getHash(el.gid, accountModel, i, el);
                    Reflect.set(this.accountsAll, groupIndex, accountModel);
                } else if (
                    i === response.data.data.list.length - 1 &&
                    !this.validate
                ) {
                    this.doStuff();
                    this.reloader(arr);
                }
            });
        },
        async workerChecker(arr, groupName, el) {
            this.instance
                .get(
                    `/worker?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&group=${el.gid}&puid=781195`
                )
                .then((workers) => {
                    const workerChecker = (str, substr) => {
                        const regExp = new RegExp(substr);
                        return regExp.test(str);
                    };
                    let wordsLength = 0;
                    arr.forEach((group) => {
                        workers.data.data.data.forEach((worker) => {
                            if (workerChecker(worker.worker_name, group)) {
                                if (wordsLength < group.length) {
                                    wordsLength = group.length;
                                    groupName = group;
                                    this.updateId = worker.worker_id;
                                }
                            }
                        });
                    });
                });
        },
        async updateGroup(el) {
            let updateData = {
                puid: "781195",
                group_id: el.group_id,
                worker_id: this.updateId,
            };
            this.instance
                .post(
                    `/worker/update?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&group=${el.gid}&puid=781195`,
                    updateData
                )
                .then((re) => {
                    console.log(re);
                });
        },
        async getHash(groupId, accountModel, i, el) {
            this.instance
                .get(
                    `/worker?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&group=${groupId}&puid=781195`
                )
                .then((result) => {
                    if (result.data.data.data.length > 0) {
                        result.data.data.data.forEach((worker, workerIndex) => {
                            let hashModel = {
                                shares1m: worker.shares_1m,
                                shares1h: (worker.shares_15m * 4) / 60,
                                shares1d: worker.shares_1d,
                                persent: worker.reject_percent,
                                status: worker.status,
                                name: worker.worker_name,
                                indexWorker: i - 2,
                                workerId: worker.worker_id,
                                createdAt: el.created_at,
                            };
                            Reflect.set(this.hash, worker.worker_id, hashModel);
                            accountModel.shares1h +=
                                (Number(worker.shares_15m) * 4) / 60;
                            accountModel.shares1d += Number(worker.shares_1d);
                            if (
                                workerIndex ===
                                result.data.data.data.length - 1
                            ) {
                                this.historyHasher(i);
                            }
                        });
                    } else {
                        accountModel.shares1h = 0;
                        accountModel.shares1d = 0;
                        this.startMount(this.accountsAll[0].indexWorker);
                    }
                });
        },
        async getAcc() {
            this.instance
                .get(
                    "/worker/groups?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&puid=781195&page=1&page_size=52"
                )
                .then((response) => {
                    if (localStorage.accounts) {
                        if (
                            JSON.parse(localStorage.accounts).length >
                            response.data.data.list.length - 2
                        ) {
                            this.accountsAll.length = 0;
                        }
                    }
                    let arr = [];
                    // eslint-disable-next-line no-undef
                    axios.get(route("sub_process")).then((resp) => {
                        if (resp.data !== "") {
                            arr = resp.data;
                            let groupName = "";
                            response.data.data.list.forEach((el, i) => {
                                if (i === 0) {
                                    this.workerChecker(arr, groupName, el);
                                } else if (i > 1) {
                                    this.getAccGroup(
                                        arr,
                                        el,
                                        groupName,
                                        i,
                                        response
                                    );
                                }
                            });
                        } else {
                            this.startMount(this.accountsAll[0].indexWorker);
                        }
                    });
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async infoGetter() {
            if (localStorage.accounts) {
                this.accounts = JSON.parse(localStorage.accounts);
            }
            if (localStorage.active) {
                this.activeIndex = JSON.parse(localStorage.active);
            }

            this.getAcc();
        },
    },
    setup() {
        const form = useForm({
            name: "",
        });

        const instance = axios.create({
            baseURL: "https://pool.api.btc.com/v1",
            headers: { "Content-Type": "application/json; charset=utf-8" },
        });

        const addAcc = () => {
            let data = {
                puid: "781195",
                group_name: form.name,
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
                    setTimeout(() => {
                        window.location.reload();
                    }, 300);
                    console.log(resp);
                })
                .catch((err) => {
                    console.log(err);
                });
        };

        return {
            form,
            addAcc,
        };
    },
    created() {
        this.infoGetter();
    },
    mounted() {
        document.title = "Аккаунты";
        document.querySelector("html").removeAttribute("class");

        this.activeMount();

        document.querySelector(".preloader").style.display = "flex";
        document.querySelector("body").style.overflowY = "hidden";
    },
};
</script>

<style lang="scss" scoped>
.accounts {
    width: 100%;
    @media (min-width: 1271px) {
        padding-left: 330px;
    }
    &__wrapper {
        width: 100%;
    }
    &__content {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        &.no-info {
            display: flex;
            gap: 28px;
        }
        @media (max-width: 1270px) {
            grid-template-columns: 1fr;
        }
    }
    &__title {
        display: inline-flex;
        justify-content: space-between;
        margin-bottom: 16px;
        width: 100%;
        align-items: center;
        @media (max-width: 767.98px) {
            margin-bottom: 24px;
        }
    }
    &__button {
        width: 60px;
        height: 44px;
        border-radius: 13px;
        background-color: #4182ec;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        &::before {
            content: "";
            position: absolute;
            z-index: -1;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            border-radius: 10px;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            transition: all 0.3s ease 0s;
        }
        @media (any-hover: hover) {
            &:hover {
                transform: translate(-4px, -4px);
                &::before {
                    top: 4px;
                    left: 4px;
                }
            }
        }
        &:active {
            @media (min-width: 479.89px) {
                transform: translate(0, 0);
                box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
                &::before {
                    top: 0;
                    left: 0;
                }
            }
        }
        svg {
            width: 14px;
            height: 14px;
            fill: #fff;
        }
        @media (max-width: 479.89px) {
            background-color: transparent;
            width: 20px;
            height: 20px;

            svg {
                fill: #4182ec;
                width: 18px;
                height: 18px;
            }
        }
    }
}
</style>
