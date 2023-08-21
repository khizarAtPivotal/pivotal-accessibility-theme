jQuery(document).ready(() => {
    const $ = jQuery;
    const isMobile = window.matchMedia("(max-width: 767px)");

    $('#commentform').each((i, form) => {
        $(form).find('input:not([type="radio"]):not([type="checkbox"]):not([type="hidden"]):not([style="display: none;"]), select, textarea').each((i, input) => {
            const label = $(form).find(`label[for="${input.getAttribute('id')}"]`);

            input.addEventListener("invalid", function (event) {
                let message = '';

                if (event.target.value.length < 1) {
                    message = `${label.text().trim()} is required`;
                } else {
                    message = `${label.text().trim()} is invalid`;
                }

                if (isMobile.matches) {
                    input.setCustomValidity(message);
                    announceToScreenReader(message, 'alert', 100, true);
                } else {
                    input.setCustomValidity(message);
                }
            });

            input.addEventListener("input", function (event) {
                input.setCustomValidity("");
            });
        });
    });

    handleDesktopMenu();
});

function handleDesktopMenu() {
    const $ = jQuery;

    const menuItems = document.querySelectorAll('.menu-item');

    if (menuItems.length > 0) {
        menuItems.forEach((item) => {
            handleMenuItem(item);
        });
    }

    function handleMenuItem(item) {
        const anchor = item.querySelector('a');
        const toggle = item.querySelector('.menu-toggle');
        const submenu = item.querySelector('.sub-menu');

        if (!toggle || !submenu || !anchor) {
            return
        }

        toggle.setAttribute('aria-label', `${anchor.textContent.trim()}`);

        toggle.addEventListener('click', () => {
            item.classList.toggle('toggled');
            toggle.setAttribute('aria-expanded', item.classList.contains('toggled'));
        });

        anchor.addEventListener('keydown', (e) => {
            if (e.key === 'Tab' && e.shiftKey) {
                item.classList.remove('toggled');
            }
        });

        handleSubMenu(item, submenu)
    }

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const item = e.target.closest('.toggled');
            const toggle = item.querySelector('.menu-toggle');
            
            item.classList.remove('toggled');
            
            if(toggle) {
                toggle.focus();
            }
        }
    });

    function handleSubMenu(item, menu) {
        const items = menu.querySelectorAll('.menu-item');
        const last = items[items.length - 1];
        const lastAnchor = last.querySelector('a');

        if (lastAnchor) {
            lastAnchor.addEventListener('keydown', (e) => {
                if (e.key === 'Tab' && !e.shiftKey) {
                    item.classList.remove('toggled');
                }
            });
        }
    }

}

let liveElementTimeout = null;

function announceToScreenReader(text, role, timeout = 1000, once = false) {
    if (once && liveElementTimeout) {
        return;
    }

    const liveElement = document.querySelector(".live-status-region");
    const paraElement = document.createElement("p");
    const textElement = document.createTextNode(text);

    if (!liveElement) {
        return;
    }

    liveElement.setAttribute("role", role === undefined ? "status" : role);
    paraElement.appendChild(textElement);
    liveElement.appendChild(paraElement);

    liveElementTimeout = setTimeout(() => {
        liveElement.innerHTML = "";
        liveElement.setAttribute("role", "status");
        liveElementTimeout = null;
    }, timeout);
}