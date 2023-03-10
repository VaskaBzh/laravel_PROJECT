<template>
    <div class="wrap wrap-no-padding">
        <div class="wrap_head">
            <main-title tag="h3" v-if="this.title"
                >{{ this.title }}
            </main-title>
            <span v-else-if="this.viewportWidth < 767.98" class="wrap_head_elem"
                >Отображать в виде</span
            >
            <div
                class="legend"
                v-if="this.viewportWidth > 767.98 && this.legend"
            >
                <div class="legend_elem legend_elem-active">
                    Активные: {{ this.active }}
                </div>
                <div class="legend_elem legend_elem-unstable">
                    Нестабильные: {{ this.unstable }}
                </div>
                <div class="legend_elem legend_elem-unActive">
                    Неактивные: {{ this.unActive }}
                </div>
                <div class="legend_elem legend_elem-all">
                    Все: {{ this.all }}
                </div>
            </div>
            <div class="wrap_head-usability" v-if="this.viewportWidth < 767.98">
                <div
                    ref="block"
                    @click="this.visualType = 'block'"
                    class="wrap_head-usability_elem"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div
                    ref="table"
                    @click="this.visualType = 'table'"
                    class="wrap_head-usability_elem"
                >
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="no-info" v-if="this.table.rows.length == 0">
            <img src="../../../assets/img/img_no-info.png" alt="no_info" />
            <span>Нет данных</span>
        </div>
        <div
            class="wrap-overflow wrap-overflow-scrollY"
            v-else-if="
                (this.title === 'Воркеры' && this.visualType === 'block') ||
                (this.type === 'Воркеры' && this.visualType === 'block')
            "
        >
            <workers-table
                :table="this.table"
                :visualType="this.visualType"
                @graph_render="this.graphRender"
            />
        </div>
        <div
            class="wrap-overflow"
            v-else-if="this.title === 'Воркеры' || this.type === 'Воркеры'"
        >
            <workers-table
                :table="this.table"
                :visualType="this.visualType"
                @graph_render="this.graphRender"
            />
        </div>
        <div
            class="wrap-overflow wrap-overflow-scrollY"
            v-else-if="this.first >= 0 && this.visualType === 'block'"
        >
            <payment-table
                :table="this.table"
                :visualType="this.visualType"
                :first="this.first"
                :rows-val="this.rowsVal"
            />
        </div>
        <div class="wrap-overflow" v-else-if="this.first >= 0">
            <payment-table
                :table="this.table"
                :visualType="this.visualType"
                :first="this.first"
                :rows-val="this.rowsVal"
            />
        </div>
        <div
            class="wrap-overflow wrap-overflow-scrollY"
            v-else-if="this.visualType === 'block'"
        >
            <payment-table :table="this.table" :visualType="this.visualType" />
        </div>
        <div class="wrap-overflow" v-else>
            <payment-table :table="this.table" :visualType="this.visualType" />
        </div>
        <Link class="main__link" v-if="!this.table.rows" :to="`/${this.link}`">
        </Link>
        <Link
            class="main__link"
            v-else-if="this.link && this.table.rows.length > 4"
            :to="`/${this.link}`"
        >
            Расширенная страница {{ this.linkText }}
        </Link>
    </div>
</template>
<script>
import { Link, router } from "@inertiajs/vue3";
import PaymentTable from "@/Components/tables/PaymentTable.vue";
import MainTitle from "@/components/UI/MainTitle.vue";
import WorkersTable from "@/Components/tables/WorkersTable.vue";

export default {
    components: { WorkersTable, MainTitle, PaymentTable, Link },
    props: {
        table: Object,
        legend: Boolean,
        legendVal: Array,
        title: String,
        type: String,
        link: String,
        linkText: String,
        first: Number,
        rowsVal: Number,
    },
    data() {
        return {
            visualType: "table",
            viewportWidth: 0,
            index: localStorage.active,
            accounts: [],
        };
    },
    computed: {
        active() {
            let val = 0;
            if (this.legendVal.length > 0) {
                this.accounts.forEach((acc) => {
                    if (acc.indexWorker == this.index) {
                        val = acc.workersActive;
                    }
                });
            }
            return val;
        },
        unActive() {
            let val = 0;
            if (this.legendVal.length > 0) {
                this.accounts.forEach((acc) => {
                    if (acc.indexWorker == this.index) {
                        val = acc.workersInActive;
                    }
                });
            }
            return val;
        },
        unstable() {
            let val = 0;
            if (this.legendVal.length > 0) {
                this.accounts.forEach((acc) => {
                    if (acc.indexWorker == this.index) {
                        val = acc.workersDead;
                    }
                });
            }
            return val;
        },
        all() {
            let val = 0;
            if (this.legendVal.length > 0) {
                this.accounts.forEach((acc) => {
                    if (acc.indexWorker == this.index) {
                        val = acc.workersAll;
                    }
                });
            }
            return val;
        },
    },
    methods: {
        graphRender(key) {
            this.$emit("graph_render", key);
        },
        router() {
            return router;
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        vsType() {
            if (this.viewportWidth < 767.98) {
                if (this.visualType === "block") {
                    this.$refs.block.classList.add("active");
                    this.$refs.table.classList.remove("active");
                } else {
                    this.$refs.table.classList.add("active");
                    this.$refs.block.classList.remove("active");
                }
            }
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    mounted() {
        this.vsType();
    },
    beforeMount() {
        if (localStorage.accounts) {
            this.accounts = JSON.parse(localStorage.accounts);
        }
    },
    updated() {
        this.vsType();
    },
};
</script>
<style lang="scss" scoped></style>
