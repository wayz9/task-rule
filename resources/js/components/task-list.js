import { Livewire } from "../../../vendor/livewire/livewire/dist/livewire.esm";

// Draggable Actions
const draggableActions = {
    draggingIndex: null,
    dragOverIndex: null,

    isDragging(index) {
        return this.draggingIndex === index;
    },

    isDragOverTarget(index) {
        return this.dragOverIndex === index;
    },

    removeBulletPoint(index) {
        this.tasks.splice(index, 1);
    },

    dragStart(event, index) {
        event.dataTransfer.setData("text/plain", index);
        this.draggingIndex = index;
    },

    dragOver(event) {
        event.preventDefault();
        const targetIndex = parseInt(
            event.target.closest("li").getAttribute("data-index")
        );
        if (this.draggingIndex !== targetIndex) {
            this.dragOverIndex = targetIndex;
        }
    },

    drop(event, targetIndex) {
        event.preventDefault();
        const sourceIndex = parseInt(
            event.dataTransfer.getData("text/plain"),
            10
        );

        if (sourceIndex !== targetIndex) {
            const itemToMove = this.tasks.splice(sourceIndex, 1)[0];
            this.tasks.splice(targetIndex, 0, itemToMove);
        }

        this.draggingIndex = null;
    },

    dragEnd() {
        this.draggingIndex = null;
        this.dragOverIndex = null;
    },
};

export default (tasks) => ({
    tasks: tasks,
    reorderEnabled: true,

    init() {
        Livewire.hook(
            "deleteTask",
            ({ uri, options, payload, respond, succeed, fail }) => {
                // Runs after commit payloads are compiled, but before a network request is sent...
                succeed(({ status, json }) => {
                    alert("Task deleted successfully!");
                });

                fail(({ status, content, preventDefault }) => {
                    // Runs when the response has an error status code...
                    // "preventDefault" allows you to disable Livewire's
                    // default error handling...
                    // "content" is the raw response content...
                });
            }
        );
    },

    deleteTask(index) {
        this.$wire.deleteTask(this.tasks[index].id);
        this.tasks.splice(index, 1);
    },

    ...draggableActions,
});
