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
    handleEmbla();
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
            return;
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

            if (!item) {
                return
            }

            const toggle = item.querySelector('.menu-toggle');

            item.classList.remove('toggled');

            if (toggle) {
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

function handleEmbla() {
    const OPTIONS = {};

    const node = document.querySelector('.embla');
    const viewport = node.querySelector('.embla__viewport');
    const prev = node.querySelector('.embla__prev');
    const next = node.querySelector('.embla__next');

    const embla = EmblaCarousel(viewport, OPTIONS);

    embla.on('select', () => {
        handleNavState();
    });

    embla.on('init', () => {
        handleNavState();
    });

    function handleNavState() {
        if (prev) {
            if (embla.canScrollPrev()) {
                prev.removeAttribute('disabled');
            } else {
                prev.setAttribute('disabled', 'disabled');
            }
        }

        if (next) {
            if (embla.canScrollNext()) {
                next.removeAttribute('disabled');
            } else {
                next.setAttribute('disabled', 'disabled');
            }
        }
    }

    function handleSlideChangeAnnouncement() {
        announceToScreenReader(`You are on slide ${embla.selectedScrollSnap() + 1}/${embla.internalEngine().slideIndexes.length}`)
    }

    if (prev) {
        prev.addEventListener('click', (e) => {
            embla.scrollPrev();
            handleSlideChangeAnnouncement();
        });
    }

    if (next) {
        next.addEventListener('click', (e) => {
            embla.scrollNext();
            handleSlideChangeAnnouncement();
        });
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


document.addEventListener("alpine:init", () => {
    Alpine.data("header", () => ({
        showSidebar: false,
        historyChangeListener: null,

        show() {
            this.showSidebar = true;

            window.location.hash = '#sidebar';

            this.historyChangeListener = (e) => {
                if (!location.hash) {
                    this.hide();
                }
            };

            window.addEventListener("hashchange", this.historyChangeListener);
        },

        hide() {
            this.showSidebar = false;

            history.replaceState(null, null, " ");

            window.removeEventListener("hashchange", this.historyChangeListener);
        },
    }));

    Alpine.data("search", () => ({
        focused: false,
        debounceTimeout: null,
        results: [],
        state: 'idle',

        init() {
            this.handleFocused();

            this.$refs.input.addEventListener('input', (e) => {
                const query = e.target.value;
                const selectedPostTypes = ['post', 'page'];

                clearTimeout(this.debounceTimeout);

                if (e.target.value.length <= 2) {
                    this.results = []
                    return;
                }

                this.debounceTimeout = setTimeout(() => {
                    var formData = new FormData();
                    formData.append('action', 'pivotalaccessibility_index_search');
                    formData.append('query', query);
                    formData.append('post_types', JSON.stringify(selectedPostTypes));

                    this.results = [];
                    this.state = 'searching'

                    fetch(pivotalaccessibilityData.ajaxURL, {
                        method: 'POST',
                        body: formData,
                    })
                        .then(response => response.json())
                        .then(data => {
                            this.state = 'searched'
                            this.results = data
                        })
                        .catch(error => {
                            this.state = 'searched'
                            console.error('Error:', error);
                        });
                }, 300);
            });

            this.$refs.input.addEventListener('focus', (e) => {
                this.focused = true
            });

            this.$refs.input.addEventListener('blur', (e) => {
                this.handleFocused();
            });
        },

        handleFocused() {
            if (this.$refs.input.value) {
                this.focused = true
            } else {
                this.focused = false
            }
        }
    }));
});