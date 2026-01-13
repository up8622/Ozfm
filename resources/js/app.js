import './bootstrap';


document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.toggle-btn');

    buttons.forEach(button => {
        button.addEventListener('click', () => {

            buttons.forEach(btn => {
                btn.classList.remove(
                    'bg-blue-500',
                    'text-white',
                    'shadow-md',
                    'border-blue-500'
                );
                btn.classList.add('bg-white', 'text-gray-700');
            });

            button.classList.remove('bg-white', 'text-gray-700');
            button.classList.add(
                'bg-blue-500',
                'text-white',
                'shadow-md',
                'border-blue-500'
            );
        });
    });
});
