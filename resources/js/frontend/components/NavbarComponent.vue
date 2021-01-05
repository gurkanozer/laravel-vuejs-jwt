<template>
    <nav
        class="navbar navbar-expand fixed-top"
        :class="scrollPosition > 50 ? 'nav-scroll' : ''"
    >
        <div class="container">
            <slot> </slot>
        </div>
    </nav>
</template>
<script>
export default {
    data() {
        return {
            scrollPosition: 0
        };
    },
    methods: {
        handleTopBar() {
            this.scrollPosition = window.scrollY;
        }
    },
    mounted() {
        window.addEventListener("scroll", this.handleTopBar);
    }
};
</script>
