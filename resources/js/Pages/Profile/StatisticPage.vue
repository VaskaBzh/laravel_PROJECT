<template>
    <Head title="Статистика" />
    <div class="statistic">
        <div class="statistic__wrapper">
            <main-title tag="h2" class="statistic__title">
                Статистика
            </main-title>
            <statistic-chart
                :viewportWidth="this.viewportWidth"
                :graphs="graphs"
            />
            <div class="wrap">
                <main-title tag="h3" class="statistic__wrap_title">
                    Начисления и выплаты
                </main-title>
                <div class="statistic__block">
                    <payment-card
                        BTCValueFirst="0.00000000"
                        BTCValueSecond="0.226346000"
                        titleFirst="Начисление за вчера"
                        titleSecond="Прогнозируемое начисление за сегодня"
                        :iconFirst="1"
                        :iconSecond="1"
                    />
                    <payment-card
                        BTCValueFirst="1.00000000"
                        BTCValueSecond="0.00120000"
                        titleFirst="Сумма к выплате"
                        titleSecond="Всего выплачено"
                        :iconFirst="2"
                        :iconSecond="2"
                    />
                </div>
            </div>
            <wrap-table
                :table="this.tables.workers"
                link="workers"
                linkText="воркеров"
                :legend="true"
                title="Воркеры"
                :legendVal="this.workers"
            />
            <wrap-table
                :table="this.tables.payment"
                link="payment"
                linkText="выплат"
                title="Выплаты"
            />
        </div>
    </div>
</template>
<script>
import { Head } from "@inertiajs/vue3";
import PaymentCard from "@/Components/account/PaymentCard.vue";
import StatisticChart from "@/Components/charts/StatisticChart.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import WrapTable from "@/Components/tables/WrapTable.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";

export default {
    components: { WrapTable, StatisticChart, MainTitle, PaymentCard, Head },
    layout: profileLayoutView,
    data() {
        return {
            visualType: "table",
            viewportWidth: 0,
            workers: [],
            hash: [],
            accounts: [],
            history: [],
            graphs: [
                {
                    id: 1,
                    title: ["Хешрейт", "Время"],
                    values: [],
                },
            ],
            tables: {
                workers: {
                    titles: [
                        "Имя воркера",
                        "Текущий",
                        "Ср.хешрейт /1ч",
                        "Ср.хешрейт /24ч",
                        "Частота отказов /24ч",
                    ],
                    shortTitles: [
                        "Имя",
                        "Текущий",
                        "Ср.хешрейт/1д",
                        "Отказы/1д",
                    ],
                    rows: [],
                    mainRow: {
                        hash: "Общий Хешрейт",
                        hashRate: 0,
                        hashAvarage: 0,
                        hashAvarage24: 0,
                        rejectRate: 0,
                    },
                    mainShortRow: {
                        hash: "Общий",
                        hashRate: 0,
                        hashAvarage: 0,
                        hashAvarage24: 0,
                        rejectRate: 0,
                    },
                },
                payment: {
                    titles: ["Дата", "Сумма", "Ссылка на транзакцию"],
                    // rows: [
                    // {
                    //     date: "29.11.2022",
                    //     time: "15:10:45",
                    //     BTC: 0,
                    //     link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                    // },
                    // {
                    //     date: "29.11.2022",
                    //     time: "15:10:45",
                    //     BTC: 0,
                    //     link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                    // },
                    // {
                    //     date: "29.11.2022",
                    //     time: "15:10:45",
                    //     BTC: 0,
                    //     link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                    // },
                    // {
                    //     date: "29.11.2022",
                    //     time: "15:10:45",
                    //     BTC: 0,
                    //     link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                    // },
                    // {
                    //     date: "29.11.2022",
                    //     time: "15:10:45",
                    //     BTC: 0,
                    //     link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                    // },
                    // {
                    //     date: "29.11.2022",
                    //     time: "15:10:45",
                    //     BTC: 0,
                    //     link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                    // },
                    // {
                    //     date: "29.11.2022",
                    //     time: "15:10:45",
                    //     BTC: 0,
                    //     link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                    // },
                    // {
                    //     date: "29.11.2022",
                    //     time: "15:10:45",
                    //     BTC: 0,
                    //     link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                    // },
                    // ],
                },
            },
        };
    },
    computed: {
        hashRate() {
            return Number(this.tables.workers.rows.mainRow.hashRate).toFixed(2);
        },
        hashAvarage() {
            return Number(this.tables.workers.rows.mainRow.hashAvarage).toFixed(
                2
            );
        },
        hashAvarage24() {
            return Number(
                this.tables.workers.rows.mainRow.hashAvarage24
            ).toFixed(2);
        },
        rejectRate() {
            return Number(this.tables.workers.rows.mainRow.rejectRate).toFixed(
                2
            );
        },
        active() {
            let val = 0;
            for (let i = 0; i < this.tables.workers.rows.length; i++) {
                if (this.tables.workers.rows[i].hashClass === "active") {
                    val = this.tables.workers.rows[i].hash;
                }
            }
            return val;
        },
        unactive() {
            let val = 0;
            for (let i = 0; i < this.tables.workers.rows.length; i++) {
                if (this.tables.workers.rows[i].hashClass === "unactive") {
                    val = this.tables.workers.rows[i].hash;
                }
            }
            return val;
        },
        unstable() {
            let val = 0;
            for (let i = 0; i < this.tables.workers.rows.length; i++) {
                if (this.tables.workers.rows[i].hashClass === "unstable") {
                    val = this.tables.workers.rows[i].hash;
                }
            }
            return val;
        },
        all() {
            return this.active + this.unactive + this.unstable;
        },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    mounted() {
        document.title = "Статистика";
        // if (this.tables.workers.rows && this.tables.workers.rows.length > 3) {
        //     this.tables.workers.rows.length = 3;
        // }
        // if (this.tables.payment.rows && this.tables.payment.rows.length > 4) {
        //     this.tables.payment.rows.length = 4;
        // }
    },
    beforeMount() {
        if (localStorage.workers) {
            this.workers = JSON.parse(localStorage.workers);
        }
        if (localStorage.accounts) {
            this.accounts = JSON.parse(localStorage.accounts);
        }
        if (localStorage.hash) {
            this.hash = JSON.parse(localStorage.hash);
        }
        if (localStorage.history) {
            this.history = JSON.parse(localStorage.history);
        }

        let index = 0;

        this.accounts.forEach((el, i) => {
            if (el.name == "workertesttest") {
                index = i;
            }
        });

        this.hash.forEach((row) => {
            if (row.indexWorker === index) {
                let workersRowModel = {
                    hashClass: row.status.toLowerCase(),
                    hash: row.name,
                    hashRate: row.shares1m,
                    hashAvarage: row.shares1h,
                    hashAvarage24: row.shares1d,
                    rejectRate: row.persent,
                };
                this.tables.workers.rows.push(workersRowModel);
            }
        });

        this.tables.workers.mainRow.hashRate = this.accounts[index].hashRate15m;
        this.tables.workers.mainRow.hashAvarage = this.accounts[index].hashRate;
        this.tables.workers.mainRow.hashAvarage24 =
            this.accounts[index].hashRate24;
        this.tables.workers.mainShortRow.hashRate =
            this.accounts[index].hashRate15m;
        this.tables.workers.mainShortRow.hashAvarage =
            this.accounts[index].hashRate;
        this.tables.workers.mainShortRow.hashAvarage24 =
            this.accounts[index].hashRate24;
        this.history = this.history[index];

        for (let i = 1; i <= 25; i++) {
            let timeStamp = this.history[this.history.length - i];
            this.graphs[0].values.push(Number(timeStamp[1]).toFixed(0));
        }
    },
};
</script>
<style lang="scss" scoped>
.statistic {
    @media (min-width: 1271px) {
        padding-left: 330px;
    }
    width: 100%;
    &__title {
        margin-bottom: 16px;
        @media (max-width: 479.98px) {
            margin-bottom: 24px;
        }
    }
    .graph {
        margin-bottom: 32px;
        animation: shadowDown 0.3s ease forwards;
        @media (max-width: 479.98px) {
            margin-bottom: 0;
        }
    }
    &__wrap {
        &_title {
            @media (min-width: 767.98px) {
                margin-bottom: 12px;
            }
        }
    }
    &__block {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        @media (max-width: 767.98px) {
            grid-template-columns: 1fr;
            gap: 8px;
        }
    }
    &__link {
        margin-top: 16px;
        font-size: 18px;
        @media (max-width: 479.98px) {
            font-size: 14px;
        }
    }
}
</style>
