// resources/js/toast.js

const TOAST_CONTAINER_ID = 'toast-container';
const TOAST_DURATION = 3000; // milliseconds

function createToastContainer() {
    let container = document.getElementById(TOAST_CONTAINER_ID);
    if (!container) {
        container = document.createElement('div');
        container.id = TOAST_CONTAINER_ID;
        container.className = 'fixed top-4 right-4 z-50 space-y-2'; // Tailwind classes for positioning and spacing
        document.body.appendChild(container);
    }
    return container;
}

function showToast(message, type = 'info') {
    const container = createToastContainer();

    const toast = document.createElement('div');
    toast.className = `
        p-3 rounded-lg shadow-lg flex items-center justify-between space-x-4
        text-white font-semibold text-sm
        transition-all duration-300 ease-in-out transform
        translate-x-full opacity-0
        backdrop-filter backdrop-blur-lg bg-opacity-70
    `; // Base Tailwind and custom classes for Mac-style
    toast.style.minWidth = '200px'; // Ensure toasts have a minimum width

    let bgColorClass = '';
    let iconHtml = '';

    switch (type) {
        case 'success':
            bgColorClass = 'bg-green-500';
            iconHtml = '<i class="fa-solid fa-circle-check mr-2"></i>';
            break;
        case 'error':
            bgColorClass = 'bg-red-500';
            iconHtml = '<i class="fa-solid fa-circle-xmark mr-2"></i>';
            break;
        case 'warning':
            bgColorClass = 'bg-yellow-500';
            iconHtml = '<i class="fa-solid fa-triangle-exclamation mr-2"></i>';
            break;
        case 'info':
        default:
            bgColorClass = 'bg-blue-500';
            iconHtml = '<i class="fa-solid fa-circle-info mr-2"></i>';
            break;
    }

    toast.classList.add(bgColorClass);

    const content = document.createElement('div');
    content.className = 'flex items-center';
    content.innerHTML = `${iconHtml}<span>${message}</span>`;
    toast.appendChild(content);

    // Close button
    const closeButton = document.createElement('button');
    closeButton.className = 'ml-4 text-white hover:text-gray-200 focus:outline-none';
    closeButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    closeButton.onclick = () => dismissToast(toast);
    toast.appendChild(closeButton);

    container.appendChild(toast);

    // Animate in
    requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    });

    // Auto dismiss
    const timeout = setTimeout(() => dismissToast(toast), TOAST_DURATION);

    // Clear timeout if toast is manually dismissed
    toast.addEventListener('click', () => clearTimeout(timeout));
}

function dismissToast(toast) {
    toast.classList.remove('translate-x-0', 'opacity-100');
    toast.classList.add('translate-x-full', 'opacity-0');

    // Remove from DOM after animation
    toast.addEventListener('transitionend', () => {
        toast.remove();
        // Remove container if no toasts are left
        const container = document.getElementById(TOAST_CONTAINER_ID);
        if (container && container.children.length === 0) {
            container.remove();
        }
    }, { once: true });
}

export { showToast };