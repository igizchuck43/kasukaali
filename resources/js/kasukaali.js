document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-mobile-menu]').forEach((button) => {
        const target = document.querySelector(button.dataset.mobileMenu);
        button.addEventListener('click', () => target?.classList.toggle('hidden'));
    });

    document.querySelectorAll('[data-modal-open]').forEach((button) => {
        button.addEventListener('click', () => document.querySelector(button.dataset.modalOpen)?.classList.remove('hidden'));
    });

    document.querySelectorAll('[data-modal-close]').forEach((button) => {
        button.addEventListener('click', () => button.closest('[data-modal]')?.classList.add('hidden'));
    });

    document.querySelectorAll('[data-counter]').forEach((counter) => {
        const target = Number(counter.dataset.counter || 0);
        let current = 0;
        const step = Math.max(1, Math.ceil(target / 48));
        const timer = setInterval(() => {
            current = Math.min(target, current + step);
            counter.textContent = current.toLocaleString();
            if (current >= target) clearInterval(timer);
        }, 24);
    });

    document.querySelectorAll('[data-swipe-action]').forEach((button) => {
        button.addEventListener('click', () => {
            const card = button.closest('[data-profile-card]');
            card?.classList.add('opacity-60', 'scale-95');
        });
    });

    const chatBox = document.querySelector('[data-chat-poll]');
    if (chatBox) {
        const url = chatBox.dataset.chatPoll;
        setInterval(async () => {
            const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (response.ok) chatBox.innerHTML = await response.text();
        }, 7000);
    }
});
