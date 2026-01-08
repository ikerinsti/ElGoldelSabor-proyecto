// Barra lateral
class SidebarController {
    constructor(sidebarSelector) {
        this.sidebar = document.querySelector(sidebarSelector);
        this.buttons = this.sidebar.querySelectorAll(".sidebar-btn");
        this.initEvents();
    }

    initEvents() {
        this.buttons.forEach(btn => {
            btn.addEventListener("click", () => this.onButtonClick(btn));
        });
    }

    onButtonClick(btn) {
        this.clearActiveButtons();
        this.setActiveButton(btn);
        this.updateTargetDiv(btn);
    }

    clearActiveButtons() {
        this.buttons.forEach(b => b.classList.remove("active"));
    }

    setActiveButton(btn) {
        btn.classList.add("active");
    }

    updateTargetDiv(btn) {
        const targetSelector = btn.dataset.target;
        const classToRemove = btn.dataset.removeClass;

        if (!targetSelector || !classToRemove) return;

        const targetDiv = document.querySelector(targetSelector);

        document.querySelectorAll(".d-principal").forEach(div => {
            div.classList.add(classToRemove);
        });

        if (targetDiv) {
            targetDiv.classList.remove(classToRemove);
        }
    }
}