import { Livewire } from "../../../vendor/livewire/livewire/dist/livewire.esm";

export default (data) => ({
    tabs: data,
    init() {
        let that = this;
        const tabs = that.$refs.tabs;
        const leftShadow = that.$refs.leftShadow;
        const rightShadow = that.$refs.rightShadow;

        function updateShadows() {
            const scrollLeft = tabs.scrollLeft;
            const maxScrollLeft = tabs.scrollWidth - tabs.clientWidth;

            leftShadow.style.opacity = scrollLeft > 0 ? 1 : 0;
            rightShadow.style.opacity = scrollLeft < maxScrollLeft ? 1 : 0;
        }

        this.$refs.tabs.addEventListener("scroll", updateShadows);
        Livewire.hook("commit", ({ succeed }) => {
            succeed(({ snapshot, effect }) => {
                this.$nextTick(() => {
                    updateShadows();
                });
            });
        });

        this.$nextTick(() => {
            updateShadows();
        });
    },
});
