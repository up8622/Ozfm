import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.toggle-btn');
    const userTypeInput = document.getElementById('user_type');

    buttons.forEach(button => {
        button.addEventListener('click', () => {

            // reset svih dugmica
            buttons.forEach(btn => {
                btn.classList.remove(
                    'bg-blue-500',
                    'text-white',
                    'shadow-md',
                    'border-blue-500'
                );
                btn.classList.add('bg-white', 'text-gray-700');
            });

            // aktivno dugme
            button.classList.remove('bg-white', 'text-gray-700');
            button.classList.add(
                'bg-blue-500',
                'text-white',
                'shadow-md',
                'border-blue-500'
            );

            // SET USER TYPE
            userTypeInput.value = button.textContent.trim().toLowerCase();
        });
    });
});
