<template>
    <span ref="checkbox" class="checkbox" @click="this.checkboxer">
        <slot></slot>
    </span>
</template>
<script>
export default {
    name: "main-checkbox",
    props: {
        is_checked: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            isChecked: this.is_checked,
        };
    },
    methods: {
        checkboxer() {
            if (this.isChecked) {
                this.$refs.checkbox.classList.remove("checked");
                this.isChecked = false;
            } else {
                this.$refs.checkbox.classList.add("checked");
                this.isChecked = true;
            }
            this.$emit("is_checked", this.isChecked);
        },
    },
    mounted() {
        if (this.is_checked) {
            setTimeout(() => {
                this.$refs.checkbox.classList.add("checked");
                this.isChecked = true;
            }, 1);
        }
    },
};
</script>
<style lang="scss" scoped>
.checkbox {
    display: flex;
    align-items: center;
    margin-left: auto;
    font-weight: 400;
    font-size: 20px;
    line-height: 28.62px;
    color: rgba(0, 0, 0, 0.62);
    position: relative;
    user-select: none;
    cursor: pointer;
    @media (max-width: 767.98px) {
        font-size: 16px;
        line-height: 24px;
    }
    @media (max-width: 479.98px) {
        font-size: 14px;
        line-height: 20px;
    }
    &::after {
        content: "";
        display: inline-block;
        width: 52px;
        height: 28px;
        background: rgba(194, 213, 242, 0.61);
        border-radius: 32px;
        margin-left: 12px;
        @media (max-width: 479.98px) {
            margin-left: auto;
            width: 37px;
            height: 20px;
        }
    }
    &::before {
        content: "";
        display: inline-block;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 27px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: #fff;
        transition: all 0.3s ease;
        @media (max-width: 479.98px) {
            width: 15px;
            height: 15px;
            right: 19px;
        }
    }
    &.checked {
        &::before {
            right: 3px;
            background-color: #4282ec;
        }
    }
}
</style>
